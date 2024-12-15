@if(isset($navbar))
    {!! $navbar !!}
@else
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <a href="/" class="text-xl font-bold text-dl-brown">Diamond Lighting Events</a>
                </div>
                <div class="hidden md:flex items-center space-x-6">
                    <a href="/" class="text-gray-700 hover:text-dl-brown">Inicio</a>
                    <a href="/servicios" class="text-gray-700 hover:text-dl-brown">Servicios</a>
                    <a href="/galeria" class="text-gray-700 hover:text-dl-brown">Galería</a>
                    <a href="/contacto" class="text-gray-700 hover:text-dl-brown">Contacto</a>
                </div>
            </div>
        </div>
    </nav>
@endif
