@extends('admin.layouts.admin')

@section('header')
    {{ __('CMS - Panel de Control') }}
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Configuración General -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4">Configuración General</h3>
                        <a href="{{ route('admin.cms.settings') }}" class="inline-flex items-center px-4 py-2 bg-dl-gold border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-dl-gold-dark active:bg-dl-gold-dark focus:outline-none focus:border-dl-gold-dark focus:ring ring-dl-gold-light disabled:opacity-25 transition ease-in-out duration-150">
                            Ajustes del Sitio
                        </a>
                    </div>

                    <!-- Páginas -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Páginas</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach(['home' => 'Inicio', 'services' => 'Servicios', 'gallery' => 'Galería', 'contact' => 'Contacto'] as $page => $label)
                                <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow">
                                    <h4 class="font-medium text-lg mb-2">{{ $label }}</h4>
                                    <div class="space-y-2">
                                        <a href="{{ route('admin.cms.edit-page', $page) }}" class="inline-block w-full text-center px-4 py-2 bg-dl-brown text-white rounded hover:bg-dl-brown-dark transition-colors">
                                            Editar Contenido
                                        </a>
                                        <a href="{{ route('admin.cms.preview', $page) }}" class="inline-block w-full text-center px-4 py-2 border border-dl-brown text-dl-brown rounded hover:bg-gray-50 transition-colors">
                                            Vista Previa
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
