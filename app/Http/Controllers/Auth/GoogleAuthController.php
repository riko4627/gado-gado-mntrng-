<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\AuthRepositories;
use App\Traits\HttpResponseTraits;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{
    use HttpResponseTraits;

    protected $authRepo;

    public function __construct(AuthRepositories $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    // Mengarahkan user ke halaman login Google
    public function redirectToProvider()
    {
        /** @var \Laravel\Socialite\Two\AbstractProvider $driver */
        $driver = Socialite::driver('google');

        return $driver->stateless()->redirect();
    }

    // Menangani kembalian (callback) dari Google
    public function handleProviderCallback()
    {
        try {
            $socialUser = Socialite::driver('google')->stateless()->user();

            // Ambil / buat user
            $user = $this->authRepo->findOrCreateUser($socialUser, 'google');

            // ── User BARU (null) → disimpan sebagai pending ──────────────
            if ($user === null) {
                return redirect()->route('login')->with('status', 'pending');
            }

            // ── User LAMA → cek status ───────────────────────────────────
            if ($user->isPending()) {
                return redirect()->route('login')->with('status', 'pending');
            }

            if ($user->isRejected()) {
                return redirect()->route('login')->with('status', 'rejected');
            }

            // ── Status APPROVED → check 2FA ────────────────────────────────
            if ($user->google2fa_enabled) {
                // Set session untuk 2FA verify
                session(['login_user_id' => $user->id]);
                return redirect('/2fa/verify')->with('info', 'Verifikasi 2FA diperlukan.');
            }

            Auth::login($user);
            return redirect('/admin');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Autentikasi gagal: ' . $e->getMessage());
        }
    }

    // Logout dan hapus session
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/gado-gado/01/login');
    }
}
