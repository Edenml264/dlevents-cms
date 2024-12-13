<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'identifier' => 'home',
                'name' => 'Página de Inicio',
                'is_active' => true,
            ],
            [
                'identifier' => 'services',
                'name' => 'Servicios',
                'is_active' => true,
            ],
            [
                'identifier' => 'gallery',
                'name' => 'Galería',
                'is_active' => true,
            ],
            [
                'identifier' => 'contact',
                'name' => 'Contacto',
                'is_active' => true,
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(
                ['identifier' => $page['identifier']],
                $page
            );
        }
    }
}
