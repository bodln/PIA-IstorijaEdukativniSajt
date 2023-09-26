<x-layout>
    <x-card class="p-10 mx-auto mt-24" style="width: 70%;">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Izmeni Kurs
            </h2>
            <p class="mb-4">Postavi kurs za edukaciju studenata</p>
        </header>

        <form method="POST" action="/courses/{{ $course->id }}">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="title" class="inline-block text-lg mb-2">Naslov</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
                    placeholder="Primer: Dan D" 
                    value="{{ $course->title }}"/>

                @error('title')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="tags" class="inline-block text-lg mb-2">
                    Tagovi (Razdvojeni Zarezom)
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags"
                    placeholder="Primer: Renesansa, Bronzano doba, Francuska itd." 
                    value="{{ $course->tags }}"/>

                @error('tags')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="inline-block text-lg mb-2">
                    Kratak Opis
                </label>
                <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10"
                    placeholder="Uticaj crkve tokom Svetog rimskog carstva je odlikovan u ...">{{ $course->description }}</textarea>

                @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 trix-content">
                <label for="content" class="inline-block text-lg mb-2">
                    Sadržaj
                </label>

                <x-trix-field id="content" name="content" value="{!! $course->richTextContent !!}"/>

                @error('content')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    Izmeni Kurs
                </button>

                <a href="/" class="text-black ml-4"> Nazad </a>
            </div>
        </form> 
    </x-card>
</x-layout>