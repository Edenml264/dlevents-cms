<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@edenmendez.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('Admin@2024'),
                'email_verified_at' => now(),
            ]
        );
    }
}
