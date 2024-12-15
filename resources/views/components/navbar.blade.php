@php
$navbarSettings = App\Models\NavbarSetting::getCurrentSettings();
$activePages = App\Models\MenuItem::active()->ordered()->get();
@endphp

<nav class="bg-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                @if($navbarSettings->logo)
                    <a href="{{ route('home') }}">
                        <img class="h-8 w-auto" 
                             src="{{ $navbarSettings->logo }}" 
                             alt="{{ config('app.name') }}">
                    </a>
                @else
                    <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800">
                        {{ config('app.name') }}
                    </a>
                @endif
            </div>

            <!-- Menú Principal -->
            <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                @foreach($activePages as $page)
                    <a href="{{ $page->url }}" 
                       class="inline-flex items-center px-1 pt-1 border-b-2 
                              {{ request()->is($page->url) ? 'border-dl-brown text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}
                              text-sm font-medium">
                        {{ $page->name }}
                    </a>
                @endforeach
            </div>

            <!-- Redes Sociales y Botón de Contacto -->
            <div class="hidden sm:ml-6 sm:flex sm:items-center sm:space-x-4">
                <!-- Redes Sociales -->
                @if($navbarSettings->social_links)
                    @foreach($navbarSettings->social_links as $link)
                        @if(isset($link['url']) && $link['url'])
                            <a href="{{ $link['url'] }}" 
                               target="_blank" 
                               class="text-gray-400 hover:text-gray-500">
                                <span class="sr-only">{{ ucfirst($link['platform']) }}</span>
                                <i class="fab fa-{{ strtolower($link['platform']) }} text-xl"></i>
                            </a>
                        @endif
                    @endforeach
                @endif

                <!-- Botón de Contacto -->
                @if($navbarSettings->show_contact_button)
                    <a href="#contact"
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-dl-brown hover:bg-dl-brown-dark">
                        {{ $navbarSettings->contact_button_text ?? 'Contactar' }}
                    </a>
                @endif
            </div>

            <!-- Botón Menú Móvil -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button type="button" 
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                    <span class="sr-only">Abrir menú principal</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" 
                              stroke-linejoin="round" 
                              stroke-width="2" 
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menú Móvil -->
    <div class="sm:hidden" x-show="mobileMenuOpen" style="display: none;">
        <div class="pt-2 pb-3 space-y-1">
            @foreach($activePages as $page)
                <a href="{{ $page->url }}"
                   class="block pl-3 pr-4 py-2 border-l-4 
                          {{ request()->is($page->url) ? 'border-dl-brown text-dl-brown bg-dl-brown/10' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }}
                          text-base font-medium">
                    {{ $page->name }}
                </a>
            @endforeach
        </div>
        
        <!-- Redes Sociales en Móvil -->
        <div class="pt-4 pb-3 border-t border-gray-200">
            <div class="flex items-center justify-around px-4">
                @if($navbarSettings->social_links)
                    @foreach($navbarSettings->social_links as $link)
                        @if(isset($link['url']) && $link['url'])
                            <a href="{{ $link['url'] }}" 
                               target="_blank" 
                               class="text-gray-400 hover:text-gray-500">
                                <span class="sr-only">{{ ucfirst($link['platform']) }}</span>
                                <i class="fab fa-{{ strtolower($link['platform']) }} text-xl"></i>
                            </a>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>
