<x-admin-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Create Footer Setting') }}
                    </h2>

                    <form method="POST" action="{{ route('footer-settings.store') }}">
                        @csrf
                        <div class="mt-4">
                            <x-label for="identifier" :value="__('Identifier')" />
                            <x-input id="identifier" class="block mt-1 w-full" type="text" name="identifier" :value="old('identifier')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="content" :value="__('Content')" />
                            <textarea id="content" class="block mt-1 w-full" name="content" rows="4" required>{{ old('content') }}</textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Create') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
