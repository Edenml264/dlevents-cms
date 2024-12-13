<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Configuración del Navbar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.cms.navbar.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Logo -->
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Logo
                            </label>
                            @if($settings->logo_path)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($settings->logo_path) }}" 
                                         alt="Logo actual" 
                                         class="h-12 object-contain">
                                </div>
                            @endif
                            <input type="file" 
                                   name="logo" 
                                   accept="image/*"
                                   class="block w-full text-sm text-gray-500
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-full file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-violet-50 file:text-violet-700
                                          hover:file:bg-violet-100">
                        </div>

                        <!-- Botón de Contacto -->
                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" 
                                       name="show_contact_button" 
                                       value="1"
                                       {{ $settings->show_contact_button ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                <span class="ml-2 text-gray-700">Mostrar botón de contacto</span>
                            </label>
                        </div>

                        <!-- Teléfono de Contacto -->
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Teléfono de Contacto
                            </label>
                            <input type="text" 
                                   name="contact_phone" 
                                   value="{{ $settings->contact_phone }}"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <!-- Redes Sociales -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Redes Sociales</h3>
                            
                            <!-- Facebook -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    Facebook URL
                                </label>
                                <input type="url" 
                                       name="social_links[facebook]" 
                                       value="{{ $settings->social_links['facebook'] ?? '' }}"
                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>

                            <!-- Instagram -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    Instagram URL
                                </label>
                                <input type="url" 
                                       name="social_links[instagram]" 
                                       value="{{ $settings->social_links['instagram'] ?? '' }}"
                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>

                            <!-- Twitter -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    Twitter URL
                                </label>
                                <input type="url" 
                                       name="social_links[twitter]" 
                                       value="{{ $settings->social_links['twitter'] ?? '' }}"
                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>

                            <!-- YouTube -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    YouTube URL
                                </label>
                                <input type="url" 
                                       name="social_links[youtube]" 
                                       value="{{ $settings->social_links['youtube'] ?? '' }}"
                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
