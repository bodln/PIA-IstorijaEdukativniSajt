<x-layout>
    <div style="widows: 100%; display: flex; justify-content:center; align-items:center; min-height: 100vh;">
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
                        <p class="text-lg font-semibold mb-3">{{ $question->question }}</p>
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
                            <label class="block mb-2 radio-label text-center">
                                <input class="text-l mt-3" data-question-id="{{ $question->id }}" type="radio"
                                    name="answers[{{ $question->id }}]" value="{{ $option }}"
                                    onclick="updateLabelStyle(this)">
                                <span>{{ $option }}</span>
                            </label>
                            @endforeach
                        </div>
                        <button type="button" style="background-color: black;" class="p-2 mt-3 bg-black text-white py-2 px-5 hint-button"
                            data-question-id="{{ $question->id }}" data-hint-used="false">
                            pola-pola
                        </button>
                        <div class="border border-gray-200 w-full mb-6 mt-6"></div>
                        @endforeach

                        <button type="submit"
                        style="background-color: #ef3b2d;"
                            class="pr-2 pl-2 h-10 mb-8 mt-3 text-white border border-gray-300 rounded-lg bg-red-500 hover:bg-red-600">
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
    </div>
</x-layout>

<style>
    .radio-label {
        width: 350px;
    }

    .selected-label {
        font-weight: bold;
    }
</style>

<script>
    const questionsData = @json($course->questions->keyBy('id'));

    function updateLabelStyle(radioButton) {
        const labels = radioButton.parentNode.parentNode.querySelectorAll('label');

        labels.forEach(label => {
            label.classList.remove('selected-label');
        });

        if (radioButton.checked) {
            radioButton.parentNode.classList.add('selected-label');
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        const hintButtons = document.querySelectorAll('.hint-button');

        hintButtons.forEach(button => {
            button.addEventListener("click", provideHint);
        });

        function provideHint(event) {
            const questionId = event.currentTarget.getAttribute("data-question-id");
            const hintUsed = event.currentTarget.getAttribute("data-hint-used");

            if (hintUsed === "false") {
                const selectedOptions = document.querySelectorAll(`input[type="radio"][data-question-id="${questionId}"]`);
                const incorrectOptions = [];

                selectedOptions.forEach(option => {
                    if (option.value !== questionsData[questionId].answer) {
                        incorrectOptions.push(option);
                    }
                });

                shuffleArray(incorrectOptions);
                const optionsToStrike = incorrectOptions.slice(0, 2);

                optionsToStrike.forEach(option => {
                    const label = option.parentNode;
                    label.style.textDecoration = "line-through";
                });

                event.currentTarget.setAttribute("data-hint-used", "true");
            }
        }

        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }
    });
</script>
