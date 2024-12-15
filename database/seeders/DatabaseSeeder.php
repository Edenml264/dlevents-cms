<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\PagesTableSeeder;
use Database\Seeders\PageSectionsTableSeeder;
use Database\Seeders\SiteSettingsSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
            ]
        );

        $this->call([
            AdminUserSeeder::class,
            PagesTableSeeder::class,
            PageSectionsTableSeeder::class,
            SiteSettingsSeeder::class,
        ]);
    }
}
