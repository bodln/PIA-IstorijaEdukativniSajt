<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Prijavi se
        </h2>
        <p class="mb-4">Prijavi se na nalog</p>
    </header>

    <form method="POST" action="/users/authenticate">
        @csrf

        <div class="mb-6">
            <label for="email" class="inline-block text-lg mb-2"
                >Email</label
            >
            <input
                type="email"
                class="border border-gray-200 rounded p-2 w-full"
                name="email"
                value="{{ old('email') }}"
            />
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label
                for="password"
                class="inline-block text-lg mb-2"
            >
                Šifra
            </label>
            <input
                type="password"
                class="border border-gray-200 rounded p-2 w-full"
                name="password"
            />
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <button
                type="submit"
                style="background-color: #ef3b2d;"
                class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
            >
                Prijavi se
            </button>
        </div>

        <div class="mt-8">
            <p>
                Nemaš nalog?
                <a href="/register" class="text-laravel" style="color: #ef3b2d;"
                    >Registruj se</a
                >
            </p>
        </div>
    </form>
    </x-card>
</x-layout>