<?php

namespace Database\Seeders;

use App\Models\PageSection;
use Illuminate\Database\Seeder;

class PageSectionsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiar secciones existentes
        PageSection::where('page', 'home')->delete();

        // Crear secciones de prueba
        $sections = [
            [
                'name' => 'Hero Section',
                'identifier' => 'hero',
                'title' => 'Iluminando tus Momentos Especiales',
                'content' => '<div class="text-center">
                    <h1 class="text-4xl md:text-6xl font-bold mb-6">Iluminando tus Momentos Especiales</h1>
                    <p class="text-xl mb-8">Servicios profesionales de iluminación para eventos</p>
                    <a href="/contacto" class="bg-dl-gold text-white px-8 py-3 rounded-lg text-lg hover:bg-dl-gold-dark transition">
                        Cotiza tu Evento
                    </a>
                </div>',
                'type' => 'html',
                'is_active' => true,
                'order' => 1,
                'page' => 'home'
            ],
            [
                'name' => 'Servicios',
                'identifier' => 'services',
                'title' => 'Nuestros Servicios',
                'content' => '<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-bold mb-4">Iluminación Arquitectónica</h3>
                        <p>Transformamos espacios con iluminación profesional</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-bold mb-4">Iluminación para Eventos</h3>
                        <p>Creamos ambientes únicos para tus celebraciones</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-bold mb-4">Audio Profesional</h3>
                        <p>Sonido de alta calidad para todo tipo de eventos</p>
                    </div>
                </div>',
                'type' => 'html',
                'is_active' => true,
                'order' => 2,
                'page' => 'home'
            ],
            [
                'name' => '¿Por qué Elegirnos?',
                'identifier' => 'why-choose-us',
                'title' => '¿Por qué Elegirnos?',
                'content' => '<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-bold mb-4">Experiencia Comprobada</h3>
                        <p>Más de 10 años transformando eventos en experiencias memorables</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-bold mb-4">Equipo Profesional</h3>
                        <p>Personal altamente capacitado y comprometido con la excelencia</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-bold mb-4">Tecnología de Punta</h3>
                        <p>Equipos modernos y soluciones innovadoras para cada evento</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-bold mb-4">Atención Personalizada</h3>
                        <p>Nos adaptamos a tus necesidades y presupuesto para crear la experiencia perfecta</p>
                    </div>
                </div>',
                'type' => 'html',
                'is_active' => true,
                'order' => 3,
                'page' => 'home'
            ],
            [
                'name' => 'Testimonios',
                'identifier' => 'testimonials',
                'title' => 'Lo que Dicen Nuestros Clientes',
                'content' => '<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <p class="mb-4">"El servicio fue excepcional. Transformaron completamente nuestro evento con una iluminación mágica."</p>
                        <p class="font-semibold">- María García, Boda 2023</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <p class="mb-4">"Profesionales, puntuales y con un servicio de primera calidad. Totalmente recomendados."</p>
                        <p class="font-semibold">- Juan Pérez, Evento Corporativo</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <p class="mb-4">"Superaron nuestras expectativas. El ambiente que crearon fue simplemente perfecto."</p>
                        <p class="font-semibold">- Ana Martínez, XV Años</p>
                    </div>
                </div>',
                'type' => 'html',
                'is_active' => true,
                'order' => 4,
                'page' => 'home'
            ],
            [
                'name' => 'Llamado a la Acción',
                'identifier' => 'cta',
                'title' => '¿Listo para Iluminar tu Evento?',
                'content' => '<div class="text-center">
                    <p class="text-xl mb-8">Contáctanos hoy mismo y recibe una cotización personalizada</p>
                    <div class="space-x-4">
                        <a href="/contacto" class="inline-block px-6 py-3 bg-dl-gold text-white rounded-lg hover:bg-dl-gold-dark transition-colors">Cotizar Ahora</a>
                        <a href="/servicios" class="inline-block px-6 py-3 border border-dl-brown text-dl-brown rounded-lg hover:bg-gray-100 transition-colors">Ver Servicios</a>
                    </div>
                </div>',
                'type' => 'html',
                'is_active' => true,
                'order' => 5,
                'page' => 'home'
            ]
        ];

        foreach ($sections as $section) {
            PageSection::create($section);
        }
    }
}
