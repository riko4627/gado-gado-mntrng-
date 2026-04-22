<?php

namespace App\Repositories;

use App\Interfaces\AuthInterfaces;
use App\Interfaces\Verify2FAInterfaces;
use App\Models\User;
use Illuminate\Support\Str;
use PragmaRX\Google2FAQRCode\Google2FA;

class Verify2FARepositories implements Verify2FAInterfaces
{
    protected $user;

    protected $google2fa;

    public function __construct()
    {
        $this->google2fa = new Google2FA();
    }

    public function generate2FASecret($user)
    {
        $secret = $this->google2fa->generateSecretKey();

        session(['2fa_secret' => $secret]);

        $qrUrl = $this->google2fa->getQRCodeUrl(
            'Monitoring Sistem UWN',
            $user->email,
            $secret
        );

        return [
            'secret' => $secret,
            'qr_url' => $qrUrl
        ];
    }

    public function enable2FA($user, $otp)
    {
        $secret = session('2fa_secret');

        if (!$secret) {
            return redirect()->route('2fa.setup')
                ->with('error', 'Session expired, silakan scan ulang QR.');
        }

        // 🔥 kasih toleransi waktu (penting!)
        $valid = $this->google2fa->verifyKey($secret, $otp, 2);

        if (!$valid) {
            return false;
        }

        $user->update([
            'google2fa_secret' => encrypt($secret),
            'google2fa_enabled' => true,
        ]);

        session()->forget('2fa_secret');

        return true;
    }

    public function verify2FA($user, $otp)
    {
        $secret = decrypt($user->google2fa_secret);

        return $this->google2fa->verifyKey($secret, $otp, 2);
    }
}
