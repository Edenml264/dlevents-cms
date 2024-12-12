<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            [
                'key' => 'site_name',
                'value' => 'DL Events',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Nombre del Sitio',
                'order' => 1
            ],
            [
                'key' => 'site_description',
                'value' => 'Servicios de Eventos y Banquetes',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Descripción del Sitio',
                'order' => 2
            ],

            // Typography
            [
                'key' => 'primary_font',
                'value' => 'Inter',
                'type' => 'font',
                'group' => 'typography',
                'label' => 'Fuente Principal',
                'options' => json_encode(['Inter', 'Roboto', 'Open Sans', 'Montserrat']),
                'order' => 1
            ],
            [
                'key' => 'heading_font',
                'value' => 'Montserrat',
                'type' => 'font',
                'group' => 'typography',
                'label' => 'Fuente para Títulos',
                'options' => json_encode(['Inter', 'Roboto', 'Open Sans', 'Montserrat']),
                'order' => 2
            ],

            // Colors
            [
                'key' => 'primary_color',
                'value' => '#8B4513',
                'type' => 'color',
                'group' => 'colors',
                'label' => 'Color Principal',
                'order' => 1
            ],
            [
                'key' => 'secondary_color',
                'value' => '#DAA520',
                'type' => 'color',
                'group' => 'colors',
                'label' => 'Color Secundario',
                'order' => 2
            ],
            [
                'key' => 'accent_color',
                'value' => '#FFD700',
                'type' => 'color',
                'group' => 'colors',
                'label' => 'Color de Acento',
                'order' => 3
            ],

            // Images
            [
                'key' => 'logo',
                'value' => null,
                'type' => 'image',
                'group' => 'images',
                'label' => 'Logo',
                'description' => 'Logo principal del sitio',
                'order' => 1
            ],
            [
                'key' => 'favicon',
                'value' => null,
                'type' => 'image',
                'group' => 'images',
                'label' => 'Favicon',
                'description' => 'Ícono para la pestaña del navegador (32x32)',
                'order' => 2
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::create($setting);
        }
    }
}
