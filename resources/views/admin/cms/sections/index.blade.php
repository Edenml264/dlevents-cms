@extends('admin.layouts.admin')

@section('header')
    Gestión de Contenidos
@endsection

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-lg font-medium text-gray-900">Gestión de Páginas y Secciones</h3>
            <p class="mt-1 text-sm text-gray-600">Administra el contenido de todas las páginas y secciones del sitio</p>
        </div>
        <a href="{{ route('admin.cms.sections.create') }}" class="inline-flex items-center px-4 py-2 bg-dl-gold border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-dl-gold-dark focus:bg-dl-gold-dark active:bg-dl-gold-dark focus:outline-none focus:ring-2 focus:ring-dl-gold focus:ring-offset-2 transition ease-in-out duration-150">
            <i class="fas fa-plus mr-2"></i> Crear Nueva Sección
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p class="font-medium">¡Éxito!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <!-- Menú de Navegación -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Seleccionar Página</h3>
            <div class="flex flex-wrap gap-3">
                <button type="button" 
                        class="inline-flex items-center px-4 py-2 rounded-md text-sm font-medium {{ request('page') == 'home' || !request('page') ? 'bg-dl-gold text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition duration-150 ease-in-out"
                        onclick="window.location.href='{{ route('admin.cms.sections.index', ['page' => 'home']) }}'">
                    <i class="fas fa-home mr-2"></i> Inicio
                </button>
                <button type="button" 
                        class="inline-flex items-center px-4 py-2 rounded-md text-sm font-medium {{ request('page') == 'services' ? 'bg-dl-gold text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition duration-150 ease-in-out"
                        onclick="window.location.href='{{ route('admin.cms.sections.index', ['page' => 'services']) }}'">
                    <i class="fas fa-concierge-bell mr-2"></i> Servicios
                </button>
                <button type="button" 
                        class="inline-flex items-center px-4 py-2 rounded-md text-sm font-medium {{ request('page') == 'gallery' ? 'bg-dl-gold text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition duration-150 ease-in-out"
                        onclick="window.location.href='{{ route('admin.cms.sections.index', ['page' => 'gallery']) }}'">
                    <i class="fas fa-images mr-2"></i> Galería
                </button>
                <button type="button" 
                        class="inline-flex items-center px-4 py-2 rounded-md text-sm font-medium {{ request('page') == 'contact' ? 'bg-dl-gold text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition duration-150 ease-in-out"
                        onclick="window.location.href='{{ route('admin.cms.sections.index', ['page' => 'contact']) }}'">
                    <i class="fas fa-envelope mr-2"></i> Contacto
                </button>
            </div>
        </div>
    </div>

    @if($pageInfo)
    <!-- Vista Previa y Estructura de la Página -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Estructura de la Página -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">{{ $pageInfo['title'] }}</h3>
                        <p class="mt-1 text-sm text-gray-600">{{ $pageInfo['description'] }}</p>
                    </div>
                    <a href="{{ url('/' . request('page')) }}" target="_blank" class="inline-flex items-center text-sm text-dl-gold hover:text-dl-gold-dark">
                        <i class="fas fa-external-link-alt mr-1"></i> Ver en sitio
                    </a>
                </div>

                <div class="space-y-4">
                    @foreach($pageInfo['sections'] as $key => $sectionName)
                        <div class="border rounded-lg p-4 {{ isset($sections->firstWhere('identifier', $key)->is_active) && $sections->firstWhere('identifier', $key)->is_active ? 'border-green-500' : 'border-gray-200' }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="w-2 h-2 rounded-full {{ isset($sections->firstWhere('identifier', $key)->is_active) && $sections->firstWhere('identifier', $key)->is_active ? 'bg-green-500' : 'bg-gray-300' }} mr-2"></span>
                                    <h4 class="text-sm font-medium text-gray-900">{{ $sectionName }}</h4>
                                </div>
                                @if($section = $sections->firstWhere('identifier', $key))
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('admin.cms.sections.edit', $section) }}" 
                                           class="text-dl-gold hover:text-dl-gold-dark inline-flex items-center text-sm">
                                            <i class="fas fa-edit mr-1"></i> Editar
                                        </a>
                                    </div>
                                @else
                                    <a href="{{ route('admin.cms.sections.create', ['identifier' => $key, 'page' => request('page')]) }}" 
                                       class="text-dl-gold hover:text-dl-gold-dark inline-flex items-center text-sm">
                                        <i class="fas fa-plus mr-1"></i> Crear
                                    </a>
                                @endif
                            </div>
                            @if($section = $sections->firstWhere('identifier', $key))
                                <div class="mt-2 text-sm text-gray-600">
                                    <div class="flex items-center space-x-4">
                                        <span class="inline-flex items-center">
                                            <i class="fas fa-code mr-1"></i> {{ ucfirst($section->type) }}
                                        </span>
                                        <span class="inline-flex items-center">
                                            <i class="fas fa-sort mr-1"></i> Orden: {{ $section->order }}
                                        </span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Vista Previa -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-6">Vista Previa del Contenido</h3>
                <div class="border rounded-lg bg-gray-50 p-4 overflow-y-auto" style="max-height: 600px;">
                    @forelse($activeSections as $section)
                        <div class="mb-8 last:mb-0">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="text-sm font-medium text-gray-700">{{ $section['name'] }}</h4>
                                <span class="px-2 py-1 text-xs rounded-full {{ 
                                    $section['type'] === 'image' ? 'bg-blue-100 text-blue-800' :
                                    ($section['type'] === 'gallery' ? 'bg-purple-100 text-purple-800' :
                                    ($section['type'] === 'html' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'))
                                }}">
                                    <i class="fas fa-{{ 
                                        $section['type'] === 'image' ? 'image' :
                                        ($section['type'] === 'gallery' ? 'images' :
                                        ($section['type'] === 'html' ? 'code' : 'align-left'))
                                    }} mr-1"></i>
                                    {{ ucfirst($section['type']) }}
                                </span>
                            </div>
                            <div class="bg-white rounded-lg border p-4">
                                {!! $section['content'] !!}
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center h-96 text-gray-500">
                            <i class="fas fa-eye-slash text-4xl mb-2"></i>
                            <p>No hay contenido activo para mostrar</p>
                            <p class="text-sm mt-2">Activa algunas secciones para ver una vista previa</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Secciones Adicionales -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-medium text-gray-900">
                    Otras Secciones de {{ ucfirst(request('page', 'Inicio')) }}
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Identificador</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orden</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($sections->whereNotIn('identifier', array_keys($pageInfo['sections'] ?? [])) as $section)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $section->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $section->identifier }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="inline-flex items-center">
                                        @switch($section->type)
                                            @case('text')
                                                <i class="fas fa-align-left mr-2"></i>
                                                @break
                                            @case('html')
                                                <i class="fas fa-code mr-2"></i>
                                                @break
                                            @case('image')
                                                <i class="fas fa-image mr-2"></i>
                                                @break
                                            @case('gallery')
                                                <i class="fas fa-images mr-2"></i>
                                                @break
                                        @endswitch
                                        {{ ucfirst($section->type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $section->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $section->is_active ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $section->order }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                    <a href="{{ route('admin.cms.sections.edit', $section) }}" 
                                       class="text-dl-gold hover:text-dl-gold-dark inline-flex items-center">
                                        <i class="fas fa-edit mr-1"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.cms.sections.destroy', $section) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900 inline-flex items-center" 
                                                onclick="return confirm('¿Estás seguro de que deseas eliminar esta sección?')">
                                            <i class="fas fa-trash-alt mr-1"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center py-6">
                                        <i class="fas fa-folder-open text-4xl text-gray-400 mb-2"></i>
                                        <p>No hay secciones adicionales para esta página</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection