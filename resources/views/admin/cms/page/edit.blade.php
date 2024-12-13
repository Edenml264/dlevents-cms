<x-admin-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6">
                        {{ __('Edit Page Content') }}
                    </h2>

                    @if (session('success'))
                        <div class="mb-4 px-4 py-2 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @foreach ($sections as $section)
                        <div class="mb-8">
                            <form method="POST" action="{{ route('admin.cms.section.update', $section) }}">
                                @csrf
                                @method('PATCH')

                                <div class="mt-4">
                                    <x-label for="identifier" :value="__('Identifier')" />
                                    <x-input id="identifier" class="block mt-1 w-full" type="text" name="identifier" value="{{ $section->identifier }}" required autofocus />
                                </div>

                                <div class="mt-4">
                                    <x-label for="content" :value="__('Content')" />
                                    <x-textarea id="content" name="content" rows="4" required>{{ $section->content }}</x-textarea>
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <x-button class="ml-4">
                                        {{ __('Update') }}
                                    </x-button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>