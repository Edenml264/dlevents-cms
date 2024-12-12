<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@edenmendez.com',
            'password' => Hash::make('Admin@2024'),
            'email_verified_at' => now(),
        ]);
    }
}
