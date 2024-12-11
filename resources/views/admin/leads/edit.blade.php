@extends('admin.layouts.admin')

@section('header')
    Editar Lead
@endsection

@section('content')
<div class="space-y-6">
    <div class="bg-white shadow rounded-lg">
        <form action="{{ route('admin.leads.update', $lead) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Información Personal -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Información Personal</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $lead->name) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $lead->email) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Teléfono</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone', $lead->phone) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('phone') border-red-500 @enderror">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Información del Evento -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Información del Evento</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="event_type" class="block text-sm font-medium text-gray-700">Tipo de Evento</label>
                            <select name="event_type" id="event_type"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('event_type') border-red-500 @enderror">
                                <option value="boda" {{ old('event_type', $lead->event_type) == 'boda' ? 'selected' : '' }}>Boda</option>
                                <option value="corporativo" {{ old('event_type', $lead->event_type) == 'corporativo' ? 'selected' : '' }}>Corporativo</option>
                                <option value="concierto" {{ old('event_type', $lead->event_type) == 'concierto' ? 'selected' : '' }}>Concierto</option>
                                <option value="otro" {{ old('event_type', $lead->event_type) == 'otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('event_type')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="event_date" class="block text-sm font-medium text-gray-700">Fecha del Evento</label>
                            <input type="date" name="event_date" id="event_date" 
                                value="{{ old('event_date', $lead->event_date ? $lead->event_date->format('Y-m-d') : '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('event_date') border-red-500 @enderror">
                            @error('event_date')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="budget" class="block text-sm font-medium text-gray-700">Presupuesto Estimado</label>
                            <input type="number" name="budget" id="budget" step="0.01" value="{{ old('budget', $lead->budget) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('budget') border-red-500 @enderror">
                            @error('budget')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Estado y Notas -->
            <div class="mt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Estado y Seguimiento</h3>
                
                <div class="space-y-4">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Estado</label>
                        <select name="status" id="status"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('status') border-red-500 @enderror">
                            <option value="nuevo" {{ old('status', $lead->status) == 'nuevo' ? 'selected' : '' }}>Nuevo</option>
                            <option value="contactado" {{ old('status', $lead->status) == 'contactado' ? 'selected' : '' }}>Contactado</option>
                            <option value="en_negociacion" {{ old('status', $lead->status) == 'en_negociacion' ? 'selected' : '' }}>En Negociación</option>
                            <option value="convertido" {{ old('status', $lead->status) == 'convertido' ? 'selected' : '' }}>Convertido</option>
                            <option value="perdido" {{ old('status', $lead->status) == 'perdido' ? 'selected' : '' }}>Perdido</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700">Notas</label>
                        <textarea name="notes" id="notes" rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('notes') border-red-500 @enderror">{{ old('notes', $lead->notes) }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('admin.leads.show', $lead) }}" 
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
@endsection