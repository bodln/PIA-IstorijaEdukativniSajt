<x-layout>
    <div class="mx-4 flex flex-col items-center justify-center">
        <x-card>
            <div class="mx-4 flex flex-col items-center justify-center">
                <p class="text-2xl  m-4 font-bold">Rezultati</p>
                <div class="border border-gray-200 w-full mb-6 mt-6"></div>
                @if (!empty($questions))
                    @php
                        $count = 0;
                        $correctCount = 0;
                    @endphp
                    @foreach ($questions as $question)
                        <p class="text-l font-bold mt-3 {{ $results[$question->id] ? 'text-green-500' : 'text-red-500' }}">
                            {{ $question->question }}</p>
                        <p class="text-l font-bold mt-3 {{ $results[$question->id] ? 'text-green-500' : 'text-red-500' }}">
                            Stopa uspešnosti svih učesnika:
                            {{ $question->completions }} / {{ $question->attempts }} ({{ number_format(($question->completions /
                            $question->attempts) * 100, 2) }}%)
                        </p>
                        @php
                            $count++;
                        @endphp
                        @if ($results[$question->id])
                            @php
                                $correctCount++;
                            @endphp
                        @endif
                        <div class="border border-gray-200 w-full mb-6 mt-6"></div>
                    @endforeach
                    <p class="text-l font-bold mt-3 mb-4">Broj tačnih odgovora: {{ $correctCount }}/{{ $count }}</p>
                @else
                    <p class="m-7">Niste odgovorili ni na jedno pitanje</p>
                @endif
            </div>
        </x-card>
    </div>
</x-layout>
