<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PageSectionController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 'home');
        
        // Obtener las secciones de la página seleccionada
        $sections = PageSection::forPage($page)->ordered()->get();

        // Obtener las secciones activas ordenadas para la vista previa
        $activeSections = PageSection::forPage($page)
            ->active()
            ->ordered()
            ->get()
            ->map(function ($section) {
                return [
                    'name' => $section->name,
                    'content' => $section->formatted_content,
                    'type' => $section->type
                ];
            });

        // Obtener información específica de la página
        $pageInfo = $this->getPageInfo($page);

        return view('admin.cms.sections.index', compact('sections', 'activeSections', 'pageInfo'));
    }

    private function getPageInfo($page)
    {
        $pageInfo = [
            'home' => [
                'title' => 'Inicio',
                'description' => 'Página principal del sitio',
                'sections' => [
                    'hero' => 'Banner Principal',
                    'about' => 'Acerca de Nosotros',
                    'services_preview' => 'Vista Previa de Servicios',
                    'testimonials' => 'Testimonios',
                    'cta' => 'Llamada a la Acción'
                ]
            ],
            'services' => [
                'title' => 'Servicios',
                'description' => 'Nuestros servicios de iluminación y eventos',
                'sections' => [
                    'header' => 'Encabezado de Servicios',
                    'services_list' => 'Lista de Servicios',
                    'packages' => 'Paquetes',
                    'process' => 'Nuestro Proceso'
                ]
            ],
            'gallery' => [
                'title' => 'Galería',
                'description' => 'Galería de eventos y trabajos realizados',
                'sections' => [
                    'header' => 'Encabezado de Galería',
                    'categories' => 'Categorías',
                    'portfolio' => 'Portafolio de Trabajos'
                ]
            ],
            'contact' => [
                'title' => 'Contacto',
                'description' => 'Información de contacto y formulario',
                'sections' => [
                    'header' => 'Encabezado de Contacto',
                    'form' => 'Formulario de Contacto',
                    'map' => 'Mapa y Ubicación',
                    'info' => 'Información de Contacto'
                ]
            ]
        ];

        return $pageInfo[$page] ?? null;
    }

    public function create()
    {
        $page = request('page', 'home');
        $pageInfo = $this->getPageInfo($page);
        $section = new PageSection(['page' => $page]);
        
        if (request('identifier')) {
            $section->identifier = request('identifier');
            $section->name = $pageInfo['sections'][request('identifier')] ?? '';
        }

        return view('admin.cms.sections.edit', compact('section', 'pageInfo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'identifier' => 'required|string|max:255|unique:page_sections,identifier',
            'type' => 'required|in:text,html,image,gallery',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'page' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'identifier', 'type', 'order', 'page']);
        $data['is_active'] = $request->has('is_active');

        // Manejar el contenido según el tipo
        switch ($request->type) {
            case 'image':
                if ($request->hasFile('image')) {
                    $data['content'] = $request->file('image')->store('sections', 'public');
                }
                break;

            case 'gallery':
                $images = [];
                if ($request->hasFile('gallery')) {
                    foreach ($request->file('gallery') as $image) {
                        $images[] = $image->store('sections', 'public');
                    }
                }
                $data['content'] = json_encode($images);
                break;

            default:
                $data['content'] = $request->content;
                break;
        }

        PageSection::create($data);

        return redirect()
            ->route('admin.cms.sections.index', ['page' => $request->page])
            ->with('success', 'Sección creada correctamente');
    }

    public function edit(PageSection $section)
    {
        $pageInfo = $this->getPageInfo($section->page);
        return view('admin.cms.sections.edit', compact('section', 'pageInfo'));
    }

    public function update(Request $request, PageSection $section)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'identifier' => 'required|string|max:255|unique:page_sections,identifier,' . $section->id,
            'type' => 'required|in:text,html,image,gallery',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'nullable|string',
            'existing_gallery.*' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'identifier', 'type', 'order', 'page']);
        $data['is_active'] = $request->has('is_active');

        // Manejar el contenido según el tipo
        switch ($request->type) {
            case 'image':
                if ($request->hasFile('image')) {
                    // Eliminar imagen anterior si existe
                    if ($section->content) {
                        Storage::disk('public')->delete($section->content);
                    }
                    $data['content'] = $request->file('image')->store('sections', 'public');
                }
                break;

            case 'gallery':
                $images = [];
                // Mantener imágenes existentes seleccionadas
                if ($request->has('existing_gallery')) {
                    $images = $request->existing_gallery;
                }
                // Agregar nuevas imágenes
                if ($request->hasFile('gallery')) {
                    foreach ($request->file('gallery') as $image) {
                        $images[] = $image->store('sections', 'public');
                    }
                }
                $data['content'] = json_encode($images);
                break;

            default:
                $data['content'] = $request->content;
                break;
        }

        $section->update($data);

        return redirect()
            ->route('admin.cms.sections.index', ['page' => $section->page])
            ->with('success', 'Sección actualizada correctamente');
    }

    public function destroy(PageSection $section)
    {
        $section->delete();

        return redirect()->route('admin.cms.sections.index')
            ->with('success', 'Sección eliminada exitosamente.');
    }

    public function initializeHomeSections()
    {
        // Primero, eliminamos todas las secciones existentes de la página de inicio
        PageSection::where('page', 'home')->delete();

        $sections = [
            [
                'name' => 'Banner Principal',
                'identifier' => 'hero',
                'page' => 'home',
                'type' => 'html',
                'content' => '
                    <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                        Iluminamos Tus Momentos Especiales
                    </h1>
                    <p class="text-xl text-dl-gold mb-8">
                        Servicios audiovisuales profesionales para bodas, eventos y convenciones
                    </p>
                ',
                'order' => 1,
                'is_active' => true
            ],
            [
                'name' => 'Servicios Destacados',
                'identifier' => 'featured_services',
                'page' => 'home',
                'type' => 'html',
                'content' => '
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                            <img src="https://images.unsplash.com/photo-1516873240891-4bf014598ab4?auto=format&fit=crop&q=80" alt="DJ Service" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-dl-brown mb-2">DJ Profesional</h3>
                                <p class="text-gray-600">Música de calidad y ambiente perfecto para tu evento</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                            <img src="https://images.unsplash.com/photo-1504196606672-aef5c9cefc92?auto=format&fit=crop&q=80" alt="LED Lighting" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-dl-brown mb-2">Iluminación LED</h3>
                                <p class="text-gray-600">Sistemas de iluminación modernos y efectos especiales</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                            <img src="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?auto=format&fit=crop&q=80" alt="LED Screens" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-dl-brown mb-2">Pantallas LED</h3>
                                <p class="text-gray-600">Displays de alta definición para contenido visual impactante</p>
                            </div>
                        </div>
                    </div>
                ',
                'order' => 2,
                'is_active' => true
            ],
            [
                'name' => '¿Por Qué Elegirnos?',
                'identifier' => 'why_choose_us',
                'page' => 'home',
                'type' => 'html',
                'content' => '
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-dl-gold rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-check text-white text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-dl-brown mb-2">Experiencia</h3>
                            <p class="text-gray-600">Años de experiencia en eventos</p>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 bg-dl-gold rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-bolt text-white text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-dl-brown mb-2">Equipos Modernos</h3>
                            <p class="text-gray-600">Tecnología de última generación</p>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 bg-dl-gold rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-users text-white text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-dl-brown mb-2">Personal Calificado</h3>
                            <p class="text-gray-600">Equipo profesional y dedicado</p>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 bg-dl-gold rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-clock text-white text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-dl-brown mb-2">Puntualidad</h3>
                            <p class="text-gray-600">Compromiso con los horarios</p>
                        </div>
                    </div>
                ',
                'order' => 3,
                'is_active' => true
            ],
            [
                'name' => 'Llamada a la Acción',
                'identifier' => 'cta',
                'page' => 'home',
                'type' => 'html',
                'content' => '
                    <div class="text-center">
                        <h2 class="text-3xl font-bold text-white mb-4">¿Listo para Crear un Evento Inolvidable?</h2>
                        <p class="text-xl text-dl-gold mb-8">Contáctanos hoy mismo para una cotización personalizada</p>
                        <a href="/contacto" class="inline-block bg-dl-gold hover:bg-dl-gold-dark text-white font-semibold px-8 py-3 rounded-lg transition duration-300">
                            Contactar Ahora
                        </a>
                    </div>
                ',
                'order' => 4,
                'is_active' => true
            ]
        ];

        foreach ($sections as $sectionData) {
            PageSection::create($sectionData);
        }

        return redirect()->route('admin.cms.sections.index', ['page' => 'home'])
            ->with('success', 'Secciones de la página de inicio inicializadas correctamente');
    }
}
