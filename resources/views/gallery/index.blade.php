<x-app-layout>
    <!-- Header de Galería -->
    <div class="relative bg-dl-brown py-16">
        <div class="absolute inset-0 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1574879948818-1cfda7aa5b1a?auto=format&fit=crop&q=80" alt="Gallery Background" class="w-full h-full object-cover opacity-40">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-white mb-4">Galería de Eventos</h1>
            <p class="text-xl text-dl-gold">Momentos inolvidables creados con nuestra tecnología</p>
        </div>
    </div>

    <!-- Filtros -->
    <div class="bg-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center gap-4">
                <button class="px-6 py-2 rounded-full bg-dl-brown text-white hover:bg-dl-gold transition duration-300">
                    Todos
                </button>
                <button class="px-6 py-2 rounded-full border border-dl-brown text-dl-brown hover:bg-dl-gold hover:border-dl-gold hover:text-white transition duration-300">
                    Bodas
                </button>
                <button class="px-6 py-2 rounded-full border border-dl-brown text-dl-brown hover:bg-dl-gold hover:border-dl-gold hover:text-white transition duration-300">
                    Corporativos
                </button>
                <button class="px-6 py-2 rounded-full border border-dl-brown text-dl-brown hover:bg-dl-gold hover:border-dl-gold hover:text-white transition duration-300">
                    Conciertos
                </button>
            </div>
        </div>
    </div>

    <!-- Grid de Galería -->
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Imagen 1 - Boda -->
                <div class="group relative overflow-hidden rounded-lg shadow-lg cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&q=80" 
                         alt="Wedding Event" 
                         class="w-full h-64 object-cover transform transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <h3 class="text-white text-xl font-semibold">Boda Elegante</h3>
                            <p class="text-dl-gold">Iluminación y DJ</p>
                        </div>
                    </div>
                </div>

                <!-- Imagen 2 - Corporativo -->
                <div class="group relative overflow-hidden rounded-lg shadow-lg cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1505236858219-8359eb29e329?auto=format&fit=crop&q=80" 
                         alt="Corporate Event" 
                         class="w-full h-64 object-cover transform transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <h3 class="text-white text-xl font-semibold">Evento Corporativo</h3>
                            <p class="text-dl-gold">Pantallas LED y Sonido</p>
                        </div>
                    </div>
                </div>

                <!-- Imagen 3 - Concierto -->
                <div class="group relative overflow-hidden rounded-lg shadow-lg cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&q=80" 
                         alt="Concert Event" 
                         class="w-full h-64 object-cover transform transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <h3 class="text-white text-xl font-semibold">Concierto en Vivo</h3>
                            <p class="text-dl-gold">Iluminación y Pantallas</p>
                        </div>
                    </div>
                </div>

                <!-- Imagen 4 - Boda -->
                <div class="group relative overflow-hidden rounded-lg shadow-lg cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?auto=format&fit=crop&q=80" 
                         alt="Wedding Party" 
                         class="w-full h-64 object-cover transform transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <h3 class="text-white text-xl font-semibold">Fiesta de Boda</h3>
                            <p class="text-dl-gold">Pista de Baile LED</p>
                        </div>
                    </div>
                </div>

                <!-- Imagen 5 - Corporativo -->
                <div class="group relative overflow-hidden rounded-lg shadow-lg cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?auto=format&fit=crop&q=80" 
                         alt="Corporate Conference" 
                         class="w-full h-64 object-cover transform transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <h3 class="text-white text-xl font-semibold">Conferencia</h3>
                            <p class="text-dl-gold">Sistema de Audio</p>
                        </div>
                    </div>
                </div>

                <!-- Imagen 6 - Concierto -->
                <div class="group relative overflow-hidden rounded-lg shadow-lg cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?auto=format&fit=crop&q=80" 
                         alt="Concert Stage" 
                         class="w-full h-64 object-cover transform transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <h3 class="text-white text-xl font-semibold">Escenario Principal</h3>
                            <p class="text-dl-gold">Iluminación Completa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Llamado a la acción -->
    <div class="bg-dl-brown py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">¿Te gustaría ver más?</h2>
            <p class="text-xl text-dl-gold mb-8">Contáctanos para conocer más sobre nuestros servicios</p>
            <a href="{{ route('contact') }}" class="inline-block bg-dl-gold hover:bg-dl-gold-dark text-white font-semibold px-8 py-3 rounded-lg transition duration-300">
                Contactar Ahora
            </a>
        </div>
    </div>
</x-app-layout>