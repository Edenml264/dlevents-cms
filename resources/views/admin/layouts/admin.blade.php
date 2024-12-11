<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diamond Lighting Events - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @stack('styles')
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white">
            <div class="p-4">
                <h1 class="text-2xl font-bold">DL Events</h1>
            </div>
            <nav class="mt-4">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                </a>
                <a href="{{ route('admin.leads.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.leads.*') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-users mr-2"></i>Leads
                </a>
                <a href="{{ route('admin.profile.edit') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.profile.*') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-user-cog mr-2"></i>Mi Perfil
                </a>
                <div class="space-y-1">
                    <div x-data="{ open: false }" class="space-y-1">
                        <button type="button" @click="open = !open"
                            class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group w-full flex items-center pl-2 pr-1 py-2 text-left text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            :class="{ 'bg-gray-100': open }">
                            <svg class="mr-3 flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-500"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <span class="flex-1">Gestión de Contenido</span>
                            <svg class="text-gray-400 ml-3 flex-shrink-0 h-5 w-5 transform group-hover:text-gray-400 transition-colors ease-in-out duration-150"
                                :class="{ 'rotate-90': open }" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M6 6L14 10L6 14V6Z" fill="currentColor" />
                            </svg>
                        </button>
                        <div class="space-y-1" x-show="open" style="display: none;">
                            <a href="{{ route('admin.cms.sections.index') }}"
                                class="group w-full flex items-center pl-11 pr-2 py-2 text-sm font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-50">
                                Secciones
                            </a>
                            <a href="{{ route('admin.cms.menu.index') }}"
                                class="group w-full flex items-center pl-11 pr-2 py-2 text-sm font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-50">
                                Menú
                            </a>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-700">
                        <i class="fas fa-sign-out-alt mr-2"></i>Cerrar Sesión
                    </button>
                </form>
            </nav>
        </div>

        <!-- Content -->
        <div class="flex-1 overflow-auto">
            <header class="bg-white shadow">
                <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        @yield('header')
                    </h2>
                </div>
            </header>

            <main class="py-6">
                <div class="mx-auto px-4 sm:px-6 lg:px-8">
                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>