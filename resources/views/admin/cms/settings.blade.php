@extends('admin.layouts.admin')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('CMS - Configuración del Sitio') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.cms.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Tabs de Configuración -->
                        <div x-data="{ activeTab: 'general' }">
                            <div class="border-b border-gray-200 mb-6">
                                <nav class="-mb-px flex space-x-8">
                                    @foreach(['general' => 'General', 'navbar' => 'Navbar', 'typography' => 'Tipografía', 'colors' => 'Colores', 'images' => 'Imágenes'] as $tab => $label)
                                        <button type="button"
                                            @click="activeTab = '{{ $tab }}'"
                                            :class="{ 'border-dl-gold text-dl-gold': activeTab === '{{ $tab }}' }"
                                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm hover:text-dl-gold hover:border-dl-gold">
                                            {{ $label }}
                                        </button>
                                    @endforeach
                                </nav>
                            </div>

                            <!-- Tab del Navbar -->
                            <div x-show="activeTab === 'navbar'" class="space-y-6">
                                <div class="border-b border-gray-200 pb-6">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-900">Configuración del Navbar</h3>
                                            <p class="mt-1 text-sm text-gray-500">
                                                Personaliza la apariencia y funcionalidad del menú principal
                                            </p>
                                        </div>
                                        <a href="{{ route('admin.cms.navbar.edit') }}" 
                                           class="inline-flex items-center px-4 py-2 bg-dl-gold border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-dl-gold-dark">
                                            <i class="fas fa-edit mr-2"></i>
                                            Configurar Navbar
                                        </a>
                                    </div>

                                    <!-- Vista previa de la configuración actual -->
                                    <div class="mt-6 bg-gray-50 rounded-lg p-4">
                                        <h4 class="text-sm font-medium text-gray-500 mb-4">Configuración Actual</h4>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <!-- Logo -->
                                            <div>
                                                <h5 class="text-sm font-medium text-gray-700 mb-2">Logo</h5>
                                                @if($navbarSettings->logo_path)
                                                    <img src="{{ Storage::url($navbarSettings->logo_path) }}" 
                                                         alt="Logo actual" 
                                                         class="h-10 object-contain bg-white p-2 rounded">
                                                @else
                                                    <p class="text-sm text-gray-500">No hay logo configurado</p>
                                                @endif
                                            </div>

                                            <!-- Botón de Contacto -->
                                            <div>
                                                <h5 class="text-sm font-medium text-gray-700 mb-2">Botón de Contacto</h5>
                                                <div class="flex items-center space-x-2">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $navbarSettings->show_contact_button ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                        {{ $navbarSettings->show_contact_button ? 'Activado' : 'Desactivado' }}
                                                    </span>
                                                    @if($navbarSettings->show_contact_button && $navbarSettings->contact_phone)
                                                        <span class="text-sm text-gray-600">
                                                            {{ $navbarSettings->contact_phone }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Redes Sociales -->
                                            <div class="md:col-span-2">
                                                <h5 class="text-sm font-medium text-gray-700 mb-2">Redes Sociales</h5>
                                                <div class="flex flex-wrap gap-2">
                                                    @foreach($navbarSettings->social_links as $network => $url)
                                                        @if($url)
                                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-dl-gold bg-opacity-10 text-dl-gold">
                                                                <i class="fab fa-{{ $network }} mr-1"></i>
                                                                {{ ucfirst($network) }}
                                                            </span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Otras Tabs -->
                            @foreach($settings as $group => $groupSettings)
                                <div x-show="activeTab === '{{ $group }}'" class="space-y-6">
                                    @foreach($groupSettings as $setting)
                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3 sm:gap-6">
                                            <div class="sm:col-span-1">
                                                <label for="{{ $setting->key }}" class="block text-sm font-medium text-gray-700">
                                                    {{ $setting->label }}
                                                </label>
                                                @if($setting->description)
                                                    <p class="mt-1 text-sm text-gray-500">{{ $setting->description }}</p>
                                                @endif
                                            </div>
                                            <div class="sm:col-span-2">
                                                @switch($setting->type)
                                                    @case('color')
                                                        <input type="color" 
                                                               name="settings[{{ $setting->key }}]" 
                                                               id="{{ $setting->key }}"
                                                               value="{{ $setting->value }}"
                                                               class="h-10 w-full rounded-md">
                                                        @break
                                                    @case('image')
                                                        <div class="flex items-center space-x-4">
                                                            @if($setting->value)
                                                                <img src="{{ $setting->value }}" alt="{{ $setting->label }}" class="h-12 w-12 object-cover rounded">
                                                            @endif
                                                            <input type="file" 
                                                                   name="settings[{{ $setting->key }}]" 
                                                                   id="{{ $setting->key }}"
                                                                   accept="image/*"
                                                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-dl-gold file:text-white hover:file:bg-dl-gold-dark">
                                                        </div>
                                                        @break
                                                    @default
                                                        <input type="text" 
                                                               name="settings[{{ $setting->key }}]" 
                                                               id="{{ $setting->key }}"
                                                               value="{{ $setting->value }}"
                                                               class="mt-1 focus:ring-dl-gold focus:border-dl-gold block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                @endswitch
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-dl-gold border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-dl-gold-dark active:bg-dl-gold-dark focus:outline-none focus:border-dl-gold-dark focus:ring ring-dl-gold-light disabled:opacity-25 transition ease-in-out duration-150">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
