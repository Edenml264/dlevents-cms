@extends('admin.layouts.admin')

@section('header')
    Detalle del Lead
@endsection

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-lg font-medium text-gray-900">Información del Lead</h3>
            <p class="mt-1 text-sm text-gray-600">Vista detallada del lead y su información</p>
        </div>
        <div>
            <a href="{{ route('admin.leads.edit', $lead) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                Editar Lead
            </a>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Información Personal -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Información Personal</h3>
                    <dl class="grid grid-cols-1 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nombre</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $lead->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Email</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $lead->email }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Teléfono</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $lead->phone }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Información del Evento -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Información del Evento</h3>
                    <dl class="grid grid-cols-1 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tipo de Evento</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($lead->event_type) }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Fecha del Evento</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $lead->event_date ? $lead->event_date->format('d/m/Y') : 'No especificada' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Presupuesto Estimado</dt>
                            <dd class="mt-1 text-sm text-gray-900">${{ number_format($lead->budget, 2) }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Estado y Notas -->
            <div class="mt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Estado y Seguimiento</h3>
                <dl class="grid grid-cols-1 gap-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Estado Actual</dt>
                        <dd class="mt-1">
                            <span class="px-2 py-1 text-sm font-semibold rounded-full 
                                {{ $lead->status == 'nuevo' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $lead->status == 'contactado' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $lead->status == 'en_negociacion' ? 'bg-purple-100 text-purple-800' : '' }}
                                {{ $lead->status == 'convertido' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $lead->status == 'perdido' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst(str_replace('_', ' ', $lead->status)) }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Notas</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $lead->notes ?: 'Sin notas adicionales' }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Fecha de Creación</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $lead->created_at->format('d/m/Y H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Última Actualización</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $lead->updated_at->format('d/m/Y H:i') }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection