<x-app-layout>
    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('post.store') }}" method="post">
                    {{-- title --}}
                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="title" name="title"
                            :value="old('title')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    {{-- content --}}
                    <div>
                        <x-input-label for="content" :value="__('content')" />
                        <x-input-textarea id="content" class="block mt-1 w-full" type="content" name="content"
                            :value="old('content')" required autofocus autocomplete="username" />
                    </input-textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
 