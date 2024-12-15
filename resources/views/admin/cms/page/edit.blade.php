<x-admin-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Edit Page Content') }} - {{ $page->name }}
                        </h2>
                        <div class="flex space-x-4">
                            <button type="button" 
                                id="saveAllChanges"
                                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition">
                                {{ __('Save All Changes') }}
                            </button>
                            <a href="{{ route('admin.cms.preview', $page) }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                               target="_blank">
                                {{ __('Preview Page') }}
                            </a>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="mb-4 px-4 py-2 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @foreach ($sections as $section)
                        <div class="mb-8 p-6 bg-gray-50 rounded-lg shadow-sm">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900">
                                    {{ $section->name ?? 'Section' }}
                                    <span class="ml-2 text-sm text-gray-500">({{ $section->identifier }})</span>
                                </h3>
                                <div class="flex items-center space-x-4">
                                    <span class="text-sm text-gray-500">Order: {{ $section->order }}</span>
                                </div>
                            </div>

                            <form id="form_{{ $section->id }}" 
                                  action="{{ route('admin.cms.section.update', $section) }}" 
                                  method="POST" 
                                  class="space-y-4">
                                @csrf
                                @method('PATCH')

                                <div>
                                    <x-label for="title_{{ $section->id }}" value="{{ __('Title') }}" />
                                    <x-input id="title_{{ $section->id }}" 
                                            name="title" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            value="{{ old('title', $section->title) }}" />
                                </div>

                                <div>
                                    <x-label for="content_{{ $section->id }}" value="{{ __('Content') }}" />
                                    <textarea id="content_{{ $section->id }}" 
                                            name="content" 
                                            class="tinymce block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                            rows="20">{{ old('content', $section->content) }}</textarea>
                                </div>

                                <div class="flex items-center space-x-4">
                                    <div>
                                        <x-label for="order_{{ $section->id }}" value="{{ __('Order') }}" />
                                        <x-input id="order_{{ $section->id }}" name="order" type="number" class="mt-1 block w-24" value="{{ old('order', $section->order) }}" />
                                    </div>

                                    <div class="flex items-center">
                                        <input type="checkbox" id="is_active_{{ $section->id }}" name="is_active" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" {{ $section->is_active ? 'checked' : '' }}>
                                        <x-label for="is_active_{{ $section->id }}" class="ml-2" value="{{ __('Active') }}" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('admin.cms.partials.tinymce')

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const saveAllButton = document.getElementById('saveAllChanges');
            
            saveAllButton.addEventListener('click', async function(e) {
                e.preventDefault();
                
                if (!confirm('¿Estás seguro de que quieres guardar todos los cambios?')) {
                    return;
                }

                const forms = document.querySelectorAll('form[id^="form_"]');
                let hasError = false;

                for (const form of forms) {
                    try {
                        const formData = new FormData(form);
                        const sectionId = form.id.replace('form_', '');
                        
                        // Asegurarse de que TinyMCE actualice el textarea antes de enviar
                        if (typeof tinymce !== 'undefined') {
                            const editor = tinymce.get('content_' + sectionId);
                            if (editor) {
                                formData.set('content', editor.getContent());
                            }
                        }

                        // Manejar explícitamente el estado del checkbox
                        const isActiveCheckbox = document.getElementById('is_active_' + sectionId);
                        formData.set('is_active', isActiveCheckbox.checked ? '1' : '0');
                        
                        // Agregar el campo order si existe
                        const orderInput = document.getElementById('order_' + sectionId);
                        if (orderInput) {
                            formData.set('order', orderInput.value);
                        }

                        const response = await fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        // Verificar el tipo de contenido de la respuesta
                        const contentType = response.headers.get('content-type');
                        if (!contentType || !contentType.includes('application/json')) {
                            throw new Error('La respuesta del servidor no es JSON válido');
                        }

                        const data = await response.json();

                        if (!response.ok || !data.success) {
                            hasError = true;
                            console.error('Error al guardar la sección ' + sectionId + ':', data.message || 'Error desconocido');
                            alert('Error al guardar la sección ' + sectionId + ': ' + (data.message || 'Error desconocido'));
                        }
                    } catch (error) {
                        hasError = true;
                        console.error('Error al guardar la sección ' + sectionId + ':', error);
                        alert('Error al guardar la sección ' + sectionId + ': ' + error.message);
                    }
                }

                if (hasError) {
                    alert('Hubo un error al guardar algunos cambios. Por favor, revisa la consola para más detalles.');
                } else {
                    alert('Todos los cambios se guardaron correctamente.');
                    location.reload();
                }
            });
        });
    </script>
    @endpush
</x-admin-layout>