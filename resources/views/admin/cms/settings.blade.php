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
                                    @foreach(['general' => 'General', 'typography' => 'Tipografía', 'colors' => 'Colores', 'images' => 'Imágenes'] as $tab => $label)
                                        <button type="button"
                                            @click="activeTab = '{{ $tab }}'"
                                            :class="{ 'border-dl-gold text-dl-gold': activeTab === '{{ $tab }}' }"
                                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm hover:text-dl-gold hover:border-dl-gold">
                                            {{ $label }}
                                        </button>
                                    @endforeach
                                </nav>
                            </div>

                            <!-- Contenido de las Tabs -->
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
                                                    @case('font')
                                                        <select name="settings[{{ $setting->key }}]" 
                                                            id="{{ $setting->key }}"
                                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-dl-gold focus:border-dl-gold sm:text-sm rounded-md">
                                                            @foreach(json_decode($setting->options) as $option)
                                                                <option value="{{ $option }}" @selected($setting->value === $option)>
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
                                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-dl-gold focus:border-dl-gold sm:text-sm">
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
