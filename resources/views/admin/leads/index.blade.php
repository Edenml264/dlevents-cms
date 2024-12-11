@extends('admin.layouts.admin')

@section('header')
    Gestión de Leads
@endsection

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-lg font-medium text-gray-900">Lista de Leads</h3>
            <p class="mt-1 text-sm text-gray-600">Administra todos los leads y sus estados</p>
        </div>
    </div>

    <!-- Filtros -->
    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('admin.leads.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Estado</label>
                <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Todos</option>
                    <option value="nuevo" {{ request('status') == 'nuevo' ? 'selected' : '' }}>Nuevo</option>
                    <option value="contactado" {{ request('status') == 'contactado' ? 'selected' : '' }}>Contactado</option>
                    <option value="en_negociacion" {{ request('status') == 'en_negociacion' ? 'selected' : '' }}>En Negociación</option>
                    <option value="convertido" {{ request('status') == 'convertido' ? 'selected' : '' }}>Convertido</option>
                    <option value="perdido" {{ request('status') == 'perdido' ? 'selected' : '' }}>Perdido</option>
                </select>
            </div>

            <div>
                <label for="date_from" class="block text-sm font-medium text-gray-700">Fecha Desde</label>
                <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="date_to" class="block text-sm font-medium text-gray-700">Fecha Hasta</label>
                <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div class="flex items-end">
                <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    Filtrar
                </button>
            </div>
        </form>
    </div>

    <!-- Tabla de Leads -->
    <div class="bg-white shadow rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Teléfono
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Estado
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Fecha
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($leads as $lead)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $lead->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $lead->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $lead->phone }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $lead->status == 'nuevo' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $lead->status == 'contactado' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $lead->status == 'en_negociacion' ? 'bg-purple-100 text-purple-800' : '' }}
                                    {{ $lead->status == 'convertido' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $lead->status == 'perdido' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst(str_replace('_', ' ', $lead->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $lead->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.leads.show', $lead) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Ver</a>
                                <a href="{{ route('admin.leads.edit', $lead) }}" class="text-green-600 hover:text-green-900">Editar</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                No hay leads disponibles
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4">
            {{ $leads->links() }}
        </div>
    </div>
</div>
@endsection