<x-layout>
    <x-card class="p-10">
        <header>
            <h1
                class="text-3xl text-center font-bold my-6 uppercase"
            >
                Upravljanje Kursevima
            </h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                @unless ($courses->isEmpty())
                    @foreach ($courses as $course)
                    <tr class="border-gray-300">
                        <td
                            class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                        >
                            <a href="/courses/{{ $course->id }}">
                                {{ $course->title }}
                            </a>
                        </td>
                        <td
                            class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                        >
                        <a href="/courses/{{ $course->id }}/edit">
                            <i class="fa-solid fa-pencil"></i> Izmeni
                        </a>
                        </td>
                        <td
                            class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                        >
                        <form method="POST" action="/courses/{{ $course->id }}">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500"><i class="fa-solid fa-trash"></i>Briši</button>
                        </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr class="border-gray-300">
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            <p class="text-center">Nema pronađenih kurseva</p>
                        </td>
                    </tr>
                @endunless
                
            </tbody>
        </table>
    </x-card>
</x-layout>
