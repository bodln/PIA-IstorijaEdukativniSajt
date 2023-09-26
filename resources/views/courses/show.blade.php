<x-layout>
    @include('partials._search')

    <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div class="mx-4">
        <x-card class="p-24">
            <div class="flex flex-col items-center justify-center text-center">
                <img class="w-48 mr-6 mb-6" src="{{ $course->logo ? asset('storage/'
        . "") : asset('/images/no-image.png') }}" alt="" />

                <h3 class="text-2xl mb-2">{{ $course->title }}</h3>
                <div class="text-xl font-bold mb-4">{{ auth()->user()->name }}</div>

                <x-listing-tags :tagsCsv="$course->tags" />

                {{-- <div class="text-lg my-4">
                    <i class="fa-solid fa-location-dot"></i> {{ $course->location }}
                </div> --}}
                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <h3 class="text-3xl font-bold mb-4">
                        Kratak opis
                    </h3>
                    <div class="text-lg space-y-6">
                        {{ $course->description }}

                        {{-- <a href="mailto:{{ $course->email }}"
                            class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"><i
                                class="fa-solid fa-envelope"></i>
                            Contact Employer</a>

                        <a href="{{ $course->website }}" target="_blank"
                            class="block bg-black text-white py-2 rounded-xl hover:opacity-80"><i
                                class="fa-solid fa-globe"></i> Visit
                            Website</a> --}}
                    </div>
                </div>
                <div style="text-align: left;">
                    <h3 class="text-3xl font-bold mb-4">
                        Sadržaj
                    </h3>
                    <div class="text-lg space-y-6">
                        {!! $course->content !!}
                    </div>
                </div>
            </div>
        </x-card>

        @auth
        @if (auth()->user()->id == $course->user_id)
        <x-card class="mt-4 p-2 flex space-x-6">
            <a href="/courses/{{ $course->id }}/edit">
                <i class="fa-solid fa-pencil"></i> Edit
            </a>
            <form method="POST" action="/courses/{{ $course->id }}">
                @csrf
                @method('DELETE')
                <button class="text-red-500"><i class="fa-solid fa-trash"></i>Delete</button>
            </form>
        </x-card>
        @endif
        @endauth
    </div>
</x-layout>