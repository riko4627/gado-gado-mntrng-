<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Verify2FARequest;
use App\Interfaces\Verify2FAInterfaces;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Verify2FAController extends Controller
{
    protected $verifyRepo;

    public function __construct(Verify2FAInterfaces $verifyRepo)
    {
        $this->verifyRepo = $verifyRepo;
    }

    public function showVerifyForm()
    {
        $userId = session('login_user_id') ?? session('2fa_user_id');
        if (!$userId) {
            return redirect('/login')->with('error', 'Sesi tidak valid.');
        }
        return view('auth.2fa-verify');
    }

    public function setup2FA()
    {
        $user = Auth::user();

        if ($user->google2fa_enabled) {
            return redirect('/admin')->with('info', '2FA sudah aktif.');
        }

        // 🔥 jangan generate ulang kalau sudah ada di session
        if (!session()->has('2fa_secret')) {
            $this->verifyRepo->generate2FASecret($user);
        }

        $data = [
            'secret' => session('2fa_secret'),
            'qr_url' => app(\PragmaRX\Google2FA\Google2FA::class)
                ->getQRCodeUrl(
                    'Monitoring Sistem UWN',
                    $user->email,
                    session('2fa_secret')
                )
        ];

        return view('auth.2fa-setup', compact('data'));
    }

    public function enable2FA(Verify2FARequest $request)
    {
        $user = Auth::user();

        if (!session()->has('2fa_secret')) {
            return back()->with('error', 'Session 2FA tidak ditemukan, ulangi setup.');
        }

        $result = $this->verifyRepo->enable2FA($user, $request->otp);

        if ($result) {
            return redirect('/admin')->with('success', '2FA berhasil diaktifkan!');
        }

        return redirect()->route('2fa.setup')
            ->with('error', 'Kode OTP salah / expired. Coba lagi.');
    }

    public function verify(Verify2FARequest $request)
    {
        $userId = session('login_user_id') ?? session('2fa_user_id');
        $user = User::findOrFail($userId);

        if (!$this->verifyRepo->verify2FA($user, $request->otp)) {
            return back()->with('error', 'Kode OTP salah atau kedaluwarsa.');
        }

        // Clear 2FA session
        session()->forget(['login_user_id', '2fa_user_id', '2fa_temp']);

        Auth::login($user);

        return redirect('/admin')->with('success', 'Login berhasil dengan 2FA!');
    }
}
