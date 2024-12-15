@if(isset($footer))
    {!! $footer !!}
@else
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-semibold mb-4">Diamond Lighting Events</h3>
                    <p class="text-gray-300">Iluminando tus momentos especiales con elegancia y estilo.</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-4">Enlaces Rápidos</h3>
                    <ul class="space-y-2">
                        <li><a href="/servicios" class="text-gray-300 hover:text-white">Servicios</a></li>
                        <li><a href="/galeria" class="text-gray-300 hover:text-white">Galería</a></li>
                        <li><a href="/contacto" class="text-gray-300 hover:text-white">Contacto</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-4">Contacto</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li>Email: info@dlevents.com</li>
                        <li>Teléfono: (123) 456-7890</li>
                        <li>Dirección: Ciudad de México</li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-700 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Diamond Lighting Events. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
@endif
