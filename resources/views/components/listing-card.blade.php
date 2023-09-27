@props(['course'])

<x-card>
    <div class="d-flex flex-column justify-content-center align-items-center">
        {{-- <img class="hidden w-48 mr-6 md:block" src="{{ asset('images/no-image.png') }}" alt="" /> --}}
        <h1 class="text-2xl font-bold m-2 text-center">
            <a href="/courses/{{ $course->id }}">{{ $course->title }}</a>
        </h1>
        <x-listing-tags :tagsCsv="$course->tags" />
        <div class="border border-gray-200 w-full mb-6 mt-6"></div>
        <div class="text-l mb-4 mr-4 ml-4 text-justify" style="overflow-wrap: break-word;">{{ $course->description }}</div>
        <div class="text-lg m-4 flex items-center justify-center">
            <i class="fa-regular fa-user"></i> 
            <p>{{ $course->user->name }}</p>
        </div>
    </div>
</x-card>