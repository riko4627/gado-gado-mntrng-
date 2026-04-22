<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Seed akun Super Admin utama.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'akbartriwicaksono46@gmail.com'],
            [
                'name'        => 'Akbar Tri Wicaksono',
                'email'       => 'akbartriwicaksono46@gmail.com',
                'role'        => 'super_admin',
                'status'      => 'approved',
                'approved_at' => now(),
                'password'    => bcrypt('super-secret-' . str()->random(16)),
                'google_id'   => null, // akan terisi otomatis saat login Google
            ]
        );

        $this->command->info('✅ Super Admin berhasil dibuat: akbartriwicaksono46@gmail.com');
    }
}
