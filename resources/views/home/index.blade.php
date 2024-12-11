<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-dl-brown">
        <div class="absolute inset-0 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&q=80" alt="Background" class="w-full h-full object-cover opacity-40">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                Iluminamos Tus Momentos Especiales
            </h1>
            <p class="text-xl text-dl-gold mb-8">
                Servicios audiovisuales profesionales para bodas, eventos y convenciones
            </p>
            <a href="{{ route('contact') }}" class="inline-block bg-dl-gold hover:bg-dl-gold-dark text-white font-semibold px-8 py-3 rounded-lg transition duration-300">
                Solicitar Cotización
            </a>
        </div>
    </div>

    <!-- Servicios Destacados -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-dl-brown text-center mb-12">Nuestros Servicios</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- DJ Service -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <img src="https://images.unsplash.com/photo-1516873240891-4bf014598ab4?auto=format&fit=crop&q=80" alt="DJ Service" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-dl-brown mb-2">DJ Profesional</h3>
                        <p class="text-gray-600">Música de calidad y ambiente perfecto para tu evento</p>
                    </div>
                </div>

                <!-- Iluminación LED -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <img src="https://images.unsplash.com/photo-1504196606672-aef5c9cefc92?auto=format&fit=crop&q=80" alt="LED Lighting" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-dl-brown mb-2">Iluminación LED</h3>
                        <p class="text-gray-600">Sistemas de iluminación modernos y efectos especiales</p>
                    </div>
                </div>

                <!-- Pantallas LED -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <img src="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?auto=format&fit=crop&q=80" alt="LED Screens" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-dl-brown mb-2">Pantallas LED</h3>
                        <p class="text-gray-600">Displays de alta definición para contenido visual impactante</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Por qué Elegirnos -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-dl-brown text-center mb-12">¿Por Qué Elegirnos?</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-dl-gold rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-dl-brown mb-2">Experiencia</h3>
                    <p class="text-gray-600">Años de experiencia en eventos</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-dl-gold rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-dl-brown mb-2">Equipos Modernos</h3>
                    <p class="text-gray-600">Tecnología de última generación</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-dl-gold rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-dl-brown mb-2">Personal Calificado</h3>
                    <p class="text-gray-600">Equipo profesional y dedicado</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-dl-gold rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-dl-brown mb-2">Puntualidad</h3>
                    <p class="text-gray-600">Compromiso con los horarios</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Llamado a la Acción -->
    <div class="bg-dl-brown py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">¿Listo para Crear un Evento Inolvidable?</h2>
            <p class="text-xl text-dl-gold mb-8">Contáctanos hoy mismo para una cotización personalizada</p>
            <a href="{{ route('contact') }}" class="inline-block bg-dl-gold hover:bg-dl-gold-dark text-white font-semibold px-8 py-3 rounded-lg transition duration-300">
                Contactar Ahora
            </a>
        </div>
    </div>
</x-app-layout>