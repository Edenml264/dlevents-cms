<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Diamond Lighting Events') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-white">
        <!-- Navigation -->
        <nav class="bg-white border-b border-dl-gold/20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-24">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('images/logo.png') }}" alt="Diamond Lighting Events" class="h-16">
                            </a>
                        </div>
                    </div>
                    
                    <!-- Navigation Links -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6 space-x-8">
                        <a href="{{ route('home') }}" class="text-dl-brown hover:text-dl-gold-dark transition">Inicio</a>
                        <a href="{{ route('services') }}" class="text-dl-brown hover:text-dl-gold-dark transition">Servicios</a>
                        <a href="{{ route('gallery') }}" class="text-dl-brown hover:text-dl-gold-dark transition">Galería</a>
                        <a href="{{ route('contact') }}" class="text-dl-brown hover:text-dl-gold-dark transition">Contacto</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-dl-brown text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-dl-gold text-lg font-semibold mb-4">Contacto</h3>
                        <p class="mb-2">Email: info@diamondlighting.com</p>
                        <p>Tel: (123) 456-7890</p>
                    </div>
                    <div>
                        <h3 class="text-dl-gold text-lg font-semibold mb-4">Servicios</h3>
                        <ul class="space-y-2">
                            <li>DJ Profesional</li>
                            <li>Iluminación LED</li>
                            <li>Pantallas LED</li>
                            <li>Pistas de Baile</li>
                            <li>Estrados</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-dl-gold text-lg font-semibold mb-4">Síguenos</h3>
                        <div class="flex space-x-4">
                            <!-- Aquí irán los íconos de redes sociales -->
                        </div>
                    </div>
                </div>
                <div class="mt-8 pt-8 border-t border-dl-gold/20 text-center">
                    <p>&copy; {{ date('Y') }} Diamond Lighting Events. Todos los derechos reservados.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
