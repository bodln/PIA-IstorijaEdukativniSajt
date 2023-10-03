<x-layout>
    <x-card class="p-10 mx-auto mt-24" style="width: 70%; max-width: 70%;">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Kreiraj Kurs
            </h2>
            <p class="mb-4">Postavi kurs za edukaciju studenata</p>
        </header>

        <form method="POST" action="/courses">
            @csrf
            <div class="mb-6">
                <label for="title" class="inline-block text-lg mb-2">Naslov</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
                    placeholder="Primer: Rimsko carstvo" 
                    value="{{ old('title') }}"/>

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
                    value="{{ old('tags') }}"/>

                @error('tags')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="inline-block text-lg mb-2">
                    Kratak Opis
                </label>
                <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10"
                    placeholder="Uticaj crkve tokom Svetog rimskog carstva je odlikovan u ...">{{ old('description') }}</textarea>

                @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 trix-content">
                <label for="content" class="inline-block text-lg mb-2">
                    Sadržaj
                </label>

                <x-trix-field id="content" name="content" value="{!! old('content') !!}"/>

                @error('content')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                style="background-color: #ef3b2d;">
                    Kreiraj Kurs
                </button>

                <div class="text-gray-500 italic text-sm mb-4 mr-4 ml-4 text-center">(za dodavanje pitanja uđite u izmenu kursa posle kreacije)</div>
                <a href="/" class="text-black ml-4"> Nazad </a>
            </div>
        </form>
    </x-card>
</x-layout>