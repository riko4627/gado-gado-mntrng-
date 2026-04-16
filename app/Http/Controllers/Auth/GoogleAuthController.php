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

        // 🔥 login pakai session
        Auth::login($user);

        // redirect ke dashboard
        return redirect('/admin');

    } catch (\Exception $e) {
        dd($e->getMessage());
    }
}

    // Logout dan hapus token
    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
}
}
