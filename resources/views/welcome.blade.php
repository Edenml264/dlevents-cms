@extends('layouts.app')

@section('content')
    @include('layouts.partials.navbar')
    
    <main class="min-h-screen bg-white">
        @foreach($sections as $section)
            <section class="py-16 px-4 {{ $loop->first ? 'bg-dl-brown text-white' : ($loop->iteration % 2 == 0 ? 'bg-gray-50' : '') }}">
                <div class="container mx-auto">
                    @if($section->title)
                        <h2 class="text-3xl font-bold mb-8 text-center {{ $loop->first ? 'text-white' : 'text-dl-brown' }}">
                            {{ $section->title }}
                        </h2>
                    @endif
                    <div class="prose max-w-none {{ $loop->first ? 'prose-invert' : '' }}">
                        {!! $section->content !!}
                    </div>
                </div>
            </section>
        @endforeach
    </main>

    @include('layouts.partials.footer')
@endsection

@push('styles')
<style>
    .prose img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
    }
    .prose {
        max-width: none;
    }
    .prose-invert {
        color: white;
    }
    .prose-invert a {
        color: #FDB813;
    }
    .prose-invert a:hover {
        color: #FFD700;
    }
    .bg-dl-brown {
        background-color: #4A3933;
    }
    .bg-dl-gold {
        background-color: #FDB813;
    }
    .text-dl-brown {
        color: #4A3933;
    }
    .hover\:bg-dl-gold-dark:hover {
        background-color: #E5A711;
    }
</style>
@endpush
