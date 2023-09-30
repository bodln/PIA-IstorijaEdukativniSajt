<x-layout>
    <div class="mx-4 flex flex-col items-center justify-center">
        <x-card>
            <div class="mx-4 flex flex-col items-center justify-center">
                <p class="text-2xl font-bold mt-3">{{ $course->title }}</p>
                <form action="/questions/check" method="POST">
                    @csrf
                    <div class="mx-4 flex flex-col items-center justify-center">
                        @if ($course->questions->isNotEmpty())
                            Težina: {{ $course->questions->first()->difficulty }}
                            <div class="border border-gray-200 w-full mb-6 mt-6"></div>
                            @foreach ($course->questions as $question)
                                <h1>{{ $question->question }}</h1>
                                @php
                                    $options = [
                                        $question->option1,
                                        $question->option2,
                                        $question->option3,
                                        $question->option4,
                                    ];
                                    shuffle($options);
                                @endphp
                                <div class="mx-4 grid grid-cols-2 gap-10">
                                    @foreach ($options as $option)
                                        <label class="block mb-2">
                                            <input class="text-l font-bold mt-3" type="radio" name="answers[{{ $question->id }}]" value="{{ $option }}">
                                            {{ $option }}
                                        </label>
                                    @endforeach
                                </div>
                                <div class="border border-gray-200 w-full mb-6 mt-6"></div>
                            @endforeach

                            <button type="submit"
                                class="pr-2 pl-2 h-10 mb-4 mt-3 text-white border border-gray-300 rounded-lg bg-red-500 hover:bg-red-600">
                                Proveri odgovore
                            </button>
                        @else
                            <p class="m-9">Nema pitanja za ovaj kurs sa ovom težinom</p>
                        @endif
                    </div>
                </form>
            </div>
        </x-card>
    </div>
</x-layout>
