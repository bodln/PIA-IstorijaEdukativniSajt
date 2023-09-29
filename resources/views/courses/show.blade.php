<x-layout>
    @include('partials._search')

    <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div class="mx-4 flex flex-col items-center justify-center">
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
        <x-card class="p-24">
            <div class="flex flex-col items-center justify-center break-words text-center" >
                {{-- <img class="w-48 mr-6 mb-6" src="{{ $course->logo ? asset('storage/'
        . "") : asset('/images/no-image.png') }}" alt="" /> --}}

                <h3 class="text-2xl font-bold m-2 text-center">{{ $course->title }}</h3>
                <div class="text-lg m-4 flex items-center justify-center">
                    <i class="fa-regular fa-user"></i> 
                    <p>{{ $course->user->name }}</p>
                </div>

                <x-listing-tags :tagsCsv="$course->tags" />

                {{-- <div class="text-lg my-4">
                    <i class="fa-solid fa-location-dot"></i> {{ $course->location }}
                </div> --}}
                <div class="text-lg space-y-6 text-justify break-words" style="overflow-wrap: break-word;">
                     <p style="max-width: 800px">{{ $course->description }}</p>
                </div>
                <div class="border border-gray-200 w-full mb-6 mt-6"></div>
                <div style="text-align: left;">
                    {{-- <h3 class="text-3xl font-bold mb-4">
                        Sadržaj
                    </h3> --}}
                    <div class="text-lg space-y-6 text-justify">
                        {!! $course->content !!}
                    </div>
                </div>
                <div class="text-gray-500 italic text-sm mr-4 ml-4 text-center">{{ $course->updated_at->addHours(2) }}</div>
            </div>
        </x-card>

        
    </div>
</x-layout>