<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@mbahdarmo.com'],
            [
                'name'     => 'Admin Mbah Darmo',
                'email'    => 'admin@mbahdarmo.com',
                'password' => Hash::make('mbahdarmo2026'),
                'role'     => 'admin',
            ]
        );
    }
}
