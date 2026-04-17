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
     protected $authRepo;

    public function __construct(Verify2FAInterfaces $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function showVerifyForm()
    {
        return view('auth.2fa-verify');
    }

    public function verify(Verify2FARequest $request)
    {
        $user = User::find(session('2fa_user_id'));

        if (!$this->authRepo->verify2FA($user, $request->otp)) {
            return back()->with('error', 'Kode salah');
        }

        Auth::login($user);

        return redirect('/dashboard');
    }
}
