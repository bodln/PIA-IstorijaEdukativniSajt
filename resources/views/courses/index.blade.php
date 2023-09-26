<x-layout>
    @include('partials._hero')
    @include('partials._search')

    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

        @if(count($courses) == 0)
        <p>No listings found</p>
        @endif

        @foreach($courses as $course)
        <x-listing-card :course="$course" />
        @endforeach

    </div>

    <div class="mt-6 p-4">
        {{ $courses->links() }}
    </div>
</x-layout>