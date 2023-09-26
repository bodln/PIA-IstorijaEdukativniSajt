<x-layout>
    <x-card class="p-10 mx-auto mt-24" style="width: 70%;">
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
                    placeholder="Primer: Dan D" 
                    value="{{ old('title') }}"/>

                @error('title')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- <div class="mb-6">
                <label for="location" class="inline-block text-lg mb-2">Job Location</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="location"
                    placeholder="Example: Remote, Boston MA, etc" 
                    value="{{ old('location') }}"/>

                @error('location')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div> --}}

            {{-- <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2">Contact Email</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="email" 
                value="{{ old('email') }}"/>

                @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div> --}}

            {{-- <div class="mb-6">
                <label for="website" class="inline-block text-lg mb-2">
                    Website/Application URL
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="website" 
                value="{{ old('website') }}"/>

                @error('website')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div> --}}

            <div class="mb-6">
                <label for="tags" class="inline-block text-lg mb-2">
                    Tagsovi (Razdvojeni Zarezom)
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags"
                    placeholder="Primer: Renesansa, Bronzano doba, Francuska itd." 
                    value="{{ old('tags') }}"/>

                @error('tags')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- <div class="mb-6">
                <label for="logo" class="inline-block text-lg mb-2">
                    Company Logo
                </label>
                <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo" />
            </div> --}}

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

            <div class="mb-6">
                <label for="content" class="inline-block text-lg mb-2">
                    Sadržaj
                </label>

                <x-trix-field id="content" name="content" style="height: 500px;"/>

                @error('content')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    Kreiraj Kurs
                </button>

                <a href="/" class="text-black ml-4"> Nazad </a>
            </div>
        </form>
    </x-card>
</x-layout>