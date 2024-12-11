@props(['section'])

@if($section)
    {{-- Meta Tags Básicos --}}
    @if($section->meta_title)
        <title>{{ $section->meta_title }}</title>
    @endif

    @if($section->meta_description)
        <meta name="description" content="{{ $section->meta_description }}">
    @endif

    @if($section->meta_keywords)
        <meta name="keywords" content="{{ $section->meta_keywords }}">
    @endif

    {{-- Directivas para Robots --}}
    <meta name="robots" content="{{ $section->getRobotsDirective() }}">

    {{-- Open Graph Tags --}}
    @if($section->og_title)
        <meta property="og:title" content="{{ $section->og_title }}">
    @endif

    @if($section->og_description)
        <meta property="og:description" content="{{ $section->og_description }}">
    @endif

    @if($section->og_image)
        <meta property="og:image" content="{{ asset($section->og_image) }}">
    @endif

    {{-- URL Canónica --}}
    @if($section->canonical_url)
        <link rel="canonical" href="{{ $section->canonical_url }}">
    @endif
@endif