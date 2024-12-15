@extends('admin.layouts.admin')

@section('header')
    {{ __('CMS Management') }}
@endsection

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6">
                        {{ __('CMS Management') }}
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach(['home' => 'Inicio', 'services' => 'Servicios', 'gallery' => 'Galería', 'contact' => 'Contacto'] as $identifier => $label)
                            <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow">
                                <h4 class="font-medium text-lg mb-2">{{ $label }}</h4>
                                <div class="space-y-2">
                                    <a href="{{ route('admin.cms.page.edit', ['page' => $identifier]) }}" 
                                       class="inline-block w-full text-center px-4 py-2 bg-dl-brown text-white rounded hover:bg-dl-brown-dark transition-colors">
                                        Editar Contenido
                                    </a>
                                    <a href="{{ route('admin.cms.preview', ['page' => $identifier]) }}" 
                                       class="inline-block w-full text-center px-4 py-2 border border-dl-brown text-dl-brown rounded hover:bg-gray-50 transition-colors"
                                       target="_blank">
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
@endsection
