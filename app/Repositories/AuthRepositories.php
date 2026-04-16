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

    /**
     * Cari user berdasarkan google_id atau email.
     * - Jika user BARU → simpan dengan status 'pending', kembalikan null
     * - Jika user LAMA → update google_id, kembalikan user (status dicek di controller)
     *
     * @return User|null
     */
    public function findOrCreateUser($socialUser, $provider): ?User
    {
        $email = $socialUser->getEmail();

        if (!$email) {
            throw new \Exception('Email dari Google tidak tersedia');
        }

        $user = $this->user->where('google_id', $socialUser->getId())
            ->orWhere('email', $email)
            ->first();

        if ($user) {
            // Update google_id jika belum tersimpan
            $user->update([
                'google_id' => $socialUser->getId(),
            ]);
            return $user;
        }

        // User baru → simpan sebagai pending, JANGAN login
        $this->user->create([
            'name'      => $socialUser->getName() ?? 'User Google',
            'email'     => $email,
            'google_id' => $socialUser->getId(),
            'role'      => 'user',
            'status'    => 'pending',
            'password'  => bcrypt(str()->random(16)),
        ]);

        return null; // null = user baru, perlu approval
    }

    public function createToken($user)
    {
        // Hapus token lama jika ingin single-session (opsional)
        $user->tokens()->delete();

        return $user->createToken('auth_token')->plainTextToken;
    }
}
