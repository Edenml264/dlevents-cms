@extends('admin.layouts.admin')

@section('header')
    Editar Sección
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/filepond/dist/filepond.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="space-y-6">
    <div class="bg-white shadow rounded-lg">
        <form action="{{ route('admin.cms.sections.update', $section) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Información Básica -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Información Básica</h3>
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $section->name) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="identifier" class="block text-sm font-medium text-gray-700">Identificador</label>
                            <input type="text" name="identifier" id="identifier" value="{{ old('identifier', $section->identifier) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('identifier') border-red-500 @enderror">
                            @error('identifier')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Tipo de Contenido</label>
                            <select name="type" id="type"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('type') border-red-500 @enderror">
                                <option value="text" {{ old('type', $section->type) == 'text' ? 'selected' : '' }}>Texto</option>
                                <option value="html" {{ old('type', $section->type) == 'html' ? 'selected' : '' }}>HTML</option>
                                <option value="image" {{ old('type', $section->type) == 'image' ? 'selected' : '' }}>Imagen</option>
                                <option value="gallery" {{ old('type', $section->type) == 'gallery' ? 'selected' : '' }}>Galería</option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="order" class="block text-sm font-medium text-gray-700">Orden</label>
                            <input type="number" name="order" id="order" value="{{ old('order', $section->order) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('order') border-red-500 @enderror">
                            @error('order')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1" 
                                {{ old('is_active', $section->is_active) ? 'checked' : '' }}
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                Sección Activa
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Contenido -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Contenido</h3>
                    <div id="content-editor">
                        <div class="text-content {{ in_array($section->type, ['image', 'gallery']) ? 'hidden' : '' }}">
                            <label for="content" class="block text-sm font-medium text-gray-700">Contenido</label>
                            <textarea name="content" id="content" rows="10"
                                class="tinymce-editor mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('content') border-red-500 @enderror">{{ old('content', $section->content) }}</textarea>
                            @error('content')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="media-content {{ !in_array($section->type, ['image', 'gallery']) ? 'hidden' : '' }}">
                            <input type="file" name="media" class="filepond" 
                                data-initial-files="{{ $section->type == 'image' ? $section->content : '' }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('admin.cms.sections.index') }}" 
                    class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                    Cancelar
                </a>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    @include('admin.cms.partials.tinymce')
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            const contentEditor = document.getElementById('content-editor');
            const textContent = contentEditor.querySelector('.text-content');
            const mediaContent = contentEditor.querySelector('.media-content');

            // Configurar FilePond
            const pond = FilePond.create(document.querySelector('input[type="file"]'), {
                server: {
                    url: '{{ route("admin.cms.upload") }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                allowMultiple: {{ $section->type == 'gallery' ? 'true' : 'false' }},
                acceptedFileTypes: ['image/*']
            });

            // Cambiar editor según el tipo
            typeSelect.addEventListener('change', function() {
                if (this.value === 'text' || this.value === 'html') {
                    textContent.classList.remove('hidden');
                    mediaContent.classList.add('hidden');
                    if (this.value === 'html') {
                        initTinyMCE('.tinymce-editor');
                    }
                } else {
                    textContent.classList.add('hidden');
                    mediaContent.classList.remove('hidden');
                    pond.allowMultiple = this.value === 'gallery';
                }
            });

            // Inicializar el editor correcto según el tipo seleccionado
            if (typeSelect.value === 'html') {
                initTinyMCE('.tinymce-editor');
            }
        });
    </script>
@endpush
@endsection