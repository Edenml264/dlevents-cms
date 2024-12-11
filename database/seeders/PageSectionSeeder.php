<?php

namespace Database\Seeders;

use App\Models\PageSection;
use Illuminate\Database\Seeder;

class PageSectionSeeder extends Seeder
{
    public function run(): void
    {
        PageSection::create([
            'name' => 'Página Principal',
            'identifier' => 'home',
            'type' => 'html',
            'content' => '<div class="space-y-6">
                <h1 class="text-4xl font-bold text-dl-brown">Diamond Lighting Events</h1>
                <p class="text-xl text-dl-brown/80">
                    Transformamos tus eventos en experiencias inolvidables a través de servicios audiovisuales de primera clase.
                </p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="p-6 bg-white shadow-lg rounded-lg">
                        <h3 class="text-xl font-semibold mb-4">Bodas</h3>
                        <p>Iluminación y sonido profesional para hacer de tu día especial un momento mágico.</p>
                    </div>
                    <div class="p-6 bg-white shadow-lg rounded-lg">
                        <h3 class="text-xl font-semibold mb-4">Eventos Corporativos</h3>
                        <p>Soluciones audiovisuales completas para impactar en tus presentaciones y eventos empresariales.</p>
                    </div>
                    <div class="p-6 bg-white shadow-lg rounded-lg">
                        <h3 class="text-xl font-semibold mb-4">Conciertos</h3>
                        <p>Sistemas de sonido e iluminación de alto rendimiento para eventos musicales inolvidables.</p>
                    </div>
                </div>
            </div>',
            'is_active' => true,
            'order' => 1,
            
            // SEO
            'meta_title' => 'Diamond Lighting Events - Servicios Audiovisuales Profesionales',
            'meta_description' => 'Servicios audiovisuales profesionales para bodas, eventos corporativos y conciertos. Especialistas en iluminación, sonido y video de alta calidad en México.',
            'meta_keywords' => 'iluminación eventos, audio eventos, video eventos, bodas, eventos corporativos, conciertos, servicios audiovisuales',
            
            // Open Graph
            'og_title' => 'Diamond Lighting Events | Servicios Audiovisuales Profesionales',
            'og_description' => 'Transformamos tus eventos en experiencias inolvidables con nuestros servicios audiovisuales profesionales.',
            'index_page' => true,
            'follow_links' => true
        ]);

        // Sección Servicios
        PageSection::create([
            'name' => 'Servicios',
            'identifier' => 'services',
            'type' => 'html',
            'content' => '<div class="space-y-8">
                <h2 class="text-3xl font-bold text-dl-brown">Nuestros Servicios</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <h3 class="text-2xl font-semibold">Iluminación Profesional</h3>
                        <ul class="list-disc list-inside space-y-2">
                            <li>Iluminación arquitectónica</li>
                            <li>Iluminación decorativa</li>
                            <li>Efectos especiales</li>
                            <li>Mapping y proyección</li>
                        </ul>
                    </div>
                    <div class="space-y-4">
                        <h3 class="text-2xl font-semibold">Audio Profesional</h3>
                        <ul class="list-disc list-inside space-y-2">
                            <li>Sistemas de sonido Line Array</li>
                            <li>Microfonía profesional</li>
                            <li>Monitoreo para escenarios</li>
                            <li>DJ y música en vivo</li>
                        </ul>
                    </div>
                </div>
            </div>',
            'is_active' => true,
            'order' => 2,
            
            // SEO
            'meta_title' => 'Servicios Audiovisuales Profesionales | Diamond Lighting Events',
            'meta_description' => 'Descubre nuestra gama completa de servicios audiovisuales profesionales. Iluminación, sonido y video para todo tipo de eventos.',
            'meta_keywords' => 'iluminación profesional, audio profesional, video mapping, efectos especiales, sonido line array',
            'index_page' => true,
            'follow_links' => true
        ]);
    }
}