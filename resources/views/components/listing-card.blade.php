@props(['course'])

<x-card>
    <div class="flex">
        <img class="hidden w-48 mr-6 md:block" src="{{ asset('images/no-image.png') }}" alt="" />
        <div>
            <h3 class="text-2xl">
                <a href="/courses/{{ $course->id }}">{{ $course->title }}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{ $course->description }}</div>
            <x-listing-tags :tagsCsv="$course->tags"/>
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> {{ auth()->user()->name }}
            </div>
        </div>
    </div>
</x-card>