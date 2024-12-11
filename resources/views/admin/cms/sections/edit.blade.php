@extends('admin.layouts.admin')

@section('header')
    Editar Sección
@endsection

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-lg font-medium text-gray-900">Editar Sección: {{ $section->name }}</h3>
            <p class="mt-1 text-sm text-gray-600">Modifica el contenido y configuración de la sección</p>
        </div>
        <a href="{{ route('admin.cms.sections.index', ['page' => $section->page]) }}" 
           class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <i class="fas fa-arrow-left mr-2"></i> Volver
        </a>
    </div>

    <div class="bg-white shadow rounded-lg">
        <form action="{{ route('admin.cms.sections.update', $section) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <input type="hidden" name="page" value="{{ $section->page }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Información Básica -->
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $section->name) }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-dl-gold focus:ring-dl-gold sm:text-sm">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="identifier" class="block text-sm font-medium text-gray-700">Identificador</label>
                        <input type="text" name="identifier" id="identifier" value="{{ old('identifier', $section->identifier) }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-dl-gold focus:ring-dl-gold sm:text-sm"
                               {{ in_array($section->identifier, array_keys($pageInfo['sections'] ?? [])) ? 'readonly' : '' }}>
                        @error('identifier')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Tipo de Contenido</label>
                        <select name="type" id="type" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-dl-gold focus:ring-dl-gold sm:text-sm">
                            <option value="text" {{ $section->type === 'text' ? 'selected' : '' }}>Texto</option>
                            <option value="html" {{ $section->type === 'html' ? 'selected' : '' }}>HTML</option>
                            <option value="image" {{ $section->type === 'image' ? 'selected' : '' }}>Imagen</option>
                            <option value="gallery" {{ $section->type === 'gallery' ? 'selected' : '' }}>Galería</option>
                        </select>
                        @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700">Orden</label>
                        <input type="number" name="order" id="order" value="{{ old('order', $section->order) }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-dl-gold focus:ring-dl-gold sm:text-sm">
                        @error('order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1" 
                               {{ old('is_active', $section->is_active) ? 'checked' : '' }}
                               class="h-4 w-4 text-dl-gold focus:ring-dl-gold border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-700">Sección Activa</label>
                    </div>
                </div>

                <!-- Contenido -->
                <div class="space-y-6">
                    <div id="content-text" class="{{ $section->type !== 'text' ? 'hidden' : '' }}">
                        <label for="content-text-input" class="block text-sm font-medium text-gray-700">Contenido de Texto</label>
                        <textarea name="content" id="content-text-input" rows="10" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-dl-gold focus:ring-dl-gold sm:text-sm">{{ old('content', $section->type === 'text' ? $section->content : '') }}</textarea>
                    </div>

                    <div id="content-html" class="{{ $section->type !== 'html' ? 'hidden' : '' }}">
                        <label for="content-html-input" class="block text-sm font-medium text-gray-700">Contenido HTML</label>
                        <textarea name="content" id="content-html-input" rows="10" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-dl-gold focus:ring-dl-gold sm:text-sm">{{ old('content', $section->type === 'html' ? $section->content : '') }}</textarea>
                    </div>

                    <div id="content-image" class="{{ $section->type !== 'image' ? 'hidden' : '' }}">
                        <label class="block text-sm font-medium text-gray-700">Imagen</label>
                        @if($section->type === 'image' && $section->content)
                            <div class="mt-2 mb-4">
                                <img src="{{ asset('storage/' . $section->content) }}" alt="{{ $section->name }}" 
                                     class="max-w-full h-auto rounded-lg shadow-lg">
                            </div>
                        @endif
                        <input type="file" name="image" id="image" accept="image/*" 
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-dl-gold file:text-white hover:file:bg-dl-gold-dark">
                    </div>

                    <div id="content-gallery" class="{{ $section->type !== 'gallery' ? 'hidden' : '' }}">
                        <label class="block text-sm font-medium text-gray-700">Galería de Imágenes</label>
                        @if($section->type === 'gallery' && $section->content)
                            <div class="mt-2 mb-4 grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach(json_decode($section->content, true) as $image)
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $image) }}" alt="Imagen de galería" 
                                             class="w-full h-48 object-cover rounded-lg shadow-sm">
                                        <input type="hidden" name="existing_gallery[]" value="{{ $image }}">
                                        <button type="button" onclick="removeGalleryImage(this)" 
                                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <input type="file" name="gallery[]" id="gallery" accept="image/*" multiple 
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-dl-gold file:text-white hover:file:bg-dl-gold-dark">
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-6">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-dl-gold border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-dl-gold-dark focus:bg-dl-gold-dark active:bg-dl-gold-dark focus:outline-none focus:ring-2 focus:ring-dl-gold focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="fas fa-save mr-2"></i> Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('type').addEventListener('change', function() {
        // Ocultar todos los contenedores de contenido
        document.querySelectorAll('[id^="content-"]').forEach(el => el.classList.add('hidden'));
        
        // Mostrar el contenedor correspondiente al tipo seleccionado
        const selectedType = this.value;
        document.getElementById('content-' + selectedType).classList.remove('hidden');
    });

    function removeGalleryImage(button) {
        button.closest('.relative').remove();
    }
</script>
@endpush
@endsection