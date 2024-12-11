<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-dl-brown">
        <div class="absolute inset-0 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&q=80" alt="Background" class="w-full h-full object-cover opacity-40">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
            @if($hero = $sections->firstWhere('identifier', 'hero'))
                {!! $hero->formatted_content !!}
                <a href="{{ route('contact') }}" class="inline-block bg-dl-gold hover:bg-dl-gold-dark text-white font-semibold px-8 py-3 rounded-lg transition duration-300">
                    Solicitar Cotización
                </a>
            @endif
        </div>
    </div>

    <!-- Servicios Destacados -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-dl-brown text-center mb-12">Nuestros Servicios</h2>
            @if($services = $sections->firstWhere('identifier', 'featured_services'))
                {!! $services->formatted_content !!}
            @endif
        </div>
    </div>

    <!-- Por qué Elegirnos -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-dl-brown text-center mb-12">¿Por Qué Elegirnos?</h2>
            @if($whyChooseUs = $sections->firstWhere('identifier', 'why_choose_us'))
                {!! $whyChooseUs->formatted_content !!}
            @endif
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-16 bg-dl-brown">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($cta = $sections->firstWhere('identifier', 'cta'))
                {!! $cta->formatted_content !!}
            @endif
        </div>
    </div>
</x-app-layout>