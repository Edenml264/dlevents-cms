@php
$footerSettings = App\Models\FooterSetting::getCurrentSettings();
@endphp

<footer class="bg-gray-800 text-white py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($footerSettings as $setting)
                <div>
                    <h3 class="text-lg font-bold">{{ $setting->identifier }}</h3>
                    <p class="mt-2">{!! $setting->content !!}</p>
                </div>
            @endforeach
        </div>
    </div>
</footer>
