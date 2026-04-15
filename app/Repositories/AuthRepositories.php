<?php

namespace App\Repositories;

use App\Interfaces\AuthInterfaces;
use App\Models\User;
use Illuminate\Support\Str;

class AuthRepositories implements AuthInterfaces
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }



    public function findOrCreateUser($socialUser, $provider)
    {
        $email = $socialUser->getEmail();

        if (!$email) {
            throw new \Exception('Email dari Google tidak tersedia');
        }

        $user = $this->user->where('google_id', $socialUser->getId())
            ->orWhere('email', $email)
            ->first();

        if ($user) {
            $user->update([
                'google_id' => $socialUser->getId(),
            ]);
            return $user;
        }

        return $this->user->create([
            'name'      => $socialUser->getName() ?? 'User Google',
            'email'     => $email,
            'google_id' => $socialUser->getId(),
            'role'      => 'user',
            'password'  => bcrypt(str()->random(16)),
        ]);
    }

    public function createToken($user)
    {
        // Hapus token lama jika ingin single-session (opsional)
        $user->tokens()->delete();

        return $user->createToken('auth_token')->plainTextToken;
    }
}
