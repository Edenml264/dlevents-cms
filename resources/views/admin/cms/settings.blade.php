@extends('admin.layouts.admin')

@section('header')
    {{ __('Configuración del Sitio') }}
@endsection

@section('content')
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <form action="{{ route('admin.cms.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Tabs de Configuración -->
                <div x-data="{ activeTab: 'general' }">
                    <!-- Navegación de Tabs -->
                    <div class="border-b border-gray-200 mb-6">
                        <nav class="-mb-px flex space-x-8">
                            @foreach(['general' => 'General', 'typography' => 'Tipografía', 'colors' => 'Colores', 'images' => 'Imágenes', 'navbar' => 'Navbar'] as $tab => $label)
                                <button type="button"
                                    @click="activeTab = '{{ $tab }}'"
                                    :class="{ 'border-dl-brown text-dl-brown': activeTab === '{{ $tab }}' }"
                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm hover:text-dl-brown hover:border-dl-brown">
                                    {{ $label }}
                                </button>
                            @endforeach
                        </nav>
                    </div>

                    <!-- Contenido de los Tabs -->
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
                                                        <img src="{{ $setting->value }}" 
                                                             alt="{{ $setting->label }}" 
                                                             class="h-12 w-12 object-cover rounded">
                                                    @endif
                                                    <input type="file" 
                                                           name="settings[{{ $setting->key }}]" 
                                                           id="{{ $setting->key }}"
                                                           accept="image/*"
                                                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-dl-brown file:text-white hover:file:bg-dl-brown-dark">
                                                </div>
                                                @break
                                            @case('font')
                                                <select name="settings[{{ $setting->key }}]" 
                                                        id="{{ $setting->key }}"
                                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-dl-brown focus:border-dl-brown sm:text-sm rounded-md">
                                                    @foreach(json_decode($setting->options) as $option)
                                                        <option value="{{ $option }}" {{ $setting->value === $option ? 'selected' : '' }}>
                                                            {{ $option }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @break
                                            @default
                                                <input type="text" 
                                                       name="settings[{{ $setting->key }}]" 
                                                       id="{{ $setting->key }}"
                                                       value="{{ $setting->value }}"
                                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-dl-brown focus:ring-dl-brown sm:text-sm">
                                        @endswitch
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                    <!-- Configuración del Navbar -->
                    <div x-show="activeTab === 'navbar'" class="space-y-6">
                        <!-- Logo del Navbar -->
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3 sm:gap-6">
                            <div class="sm:col-span-1">
                                <label for="navbar_logo" class="block text-sm font-medium text-gray-700">
                                    Logo del Navbar
                                </label>
                                <p class="mt-1 text-sm text-gray-500">Logo que aparecerá en la barra de navegación</p>
                            </div>
                            <div class="sm:col-span-2">
                                <div class="flex items-center space-x-4">
                                    @if($navbarSettings && $navbarSettings->logo)
                                        <img src="{{ $navbarSettings->logo }}" 
                                             alt="Logo actual" 
                                             class="h-12 w-auto object-contain rounded">
                                    @endif
                                    <input type="file" 
                                           name="navbar[logo]" 
                                           id="navbar_logo"
                                           accept="image/*"
                                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-dl-brown file:text-white hover:file:bg-dl-brown-dark">
                                </div>
                            </div>
                        </div>

                        <!-- Botón de Contacto -->
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3 sm:gap-6">
                            <div class="sm:col-span-1">
                                <label class="block text-sm font-medium text-gray-700">
                                    Botón de Contacto
                                </label>
                                <p class="mt-1 text-sm text-gray-500">Configuración del botón de contacto en el navbar</p>
                            </div>
                            <div class="sm:col-span-2">
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <input type="checkbox" 
                                               name="navbar[show_contact_button]" 
                                               id="show_contact_button"
                                               value="1"
                                               @if($navbarSettings && $navbarSettings->show_contact_button) checked @endif
                                               class="h-4 w-4 text-dl-brown focus:ring-dl-brown border-gray-300 rounded">
                                        <label for="show_contact_button" class="ml-2 block text-sm text-gray-700">
                                            Mostrar botón de contacto
                                        </label>
                                    </div>
                                    <input type="text" 
                                           name="navbar[contact_button_text]" 
                                           id="contact_button_text"
                                           value="{{ $navbarSettings ? $navbarSettings->contact_button_text : '' }}"
                                           placeholder="Texto del botón"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-dl-brown focus:ring-dl-brown sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <!-- Enlaces de Redes Sociales -->
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3 sm:gap-6">
                            <div class="sm:col-span-1">
                                <label class="block text-sm font-medium text-gray-700">
                                    Redes Sociales
                                </label>
                                <p class="mt-1 text-sm text-gray-500">Enlaces a redes sociales en el navbar</p>
                            </div>
                            <div class="sm:col-span-2">
                                <div class="space-y-4" x-data="{ links: {{ $navbarSettings && $navbarSettings->social_links ? json_encode($navbarSettings->social_links) : '[]' }} }">
                                    <template x-for="(link, index) in links" :key="index">
                                        <div class="flex space-x-2">
                                            <input type="text" 
                                                   x-model="link.platform"
                                                   :name="'navbar[social_links]['+index+'][platform]'"
                                                   placeholder="Plataforma"
                                                   class="mt-1 block w-1/3 rounded-md border-gray-300 shadow-sm focus:border-dl-brown focus:ring-dl-brown sm:text-sm">
                                            <input type="url" 
                                                   x-model="link.url"
                                                   :name="'navbar[social_links]['+index+'][url]'"
                                                   placeholder="URL"
                                                   class="mt-1 block w-2/3 rounded-md border-gray-300 shadow-sm focus:border-dl-brown focus:ring-dl-brown sm:text-sm">
                                            <button type="button" 
                                                    @click="links.splice(index, 1)"
                                                    class="mt-1 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                <span class="sr-only">Eliminar</span>
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </template>
                                    <button type="button" 
                                            @click="links.push({platform: '', url: ''})"
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-dl-brown hover:bg-dl-brown-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-dl-brown">
                                        Agregar Red Social
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-dl-brown border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-dl-brown-dark active:bg-dl-brown-dark focus:outline-none focus:border-dl-brown-dark focus:ring ring-dl-brown-light disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('Guardar Cambios') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Para previsualizar las fuentes en el selector
    document.addEventListener('DOMContentLoaded', function() {
        const fontSelects = document.querySelectorAll('select[name^="settings[font"]');
        fontSelects.forEach(select => {
            select.style.fontFamily = select.value;
            select.addEventListener('change', function() {
                this.style.fontFamily = this.value;
            });
        });
    });
</script>
@endpush
