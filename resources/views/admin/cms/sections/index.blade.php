@extends('admin.layouts.admin')

@section('header')
    Gestión de Contenido
@endsection

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-lg font-medium text-gray-900">Secciones de la Página</h3>
            <p class="mt-1 text-sm text-gray-600">Administra el contenido de las diferentes secciones del sitio web</p>
        </div>
        <div>
            <a href="{{ route('admin.cms.sections.create') }}" 
                class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                Nueva Sección
            </a>
        </div>
    </div>

    <!-- Lista de Secciones -->
    <div class="bg-white shadow rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Identificador
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tipo
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Estado
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Orden
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($sections as $section)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $section->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $section->identifier }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $section->type == 'text' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $section->type == 'html' ? 'bg-purple-100 text-purple-800' : '' }}
                                    {{ $section->type == 'image' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $section->type == 'gallery' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                    {{ ucfirst($section->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $section->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $section->is_active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $section->order }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.cms.sections.edit', $section) }}" 
                                    class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    Editar
                                </a>
                                <form action="{{ route('admin.cms.sections.destroy', $section) }}" 
                                    method="POST" 
                                    class="inline-block"
                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta sección?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                No hay secciones disponibles
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection