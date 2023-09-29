<x-layout>
    <x-card class="p-10 mx-auto mt-24" style="width: 70%; max-width: 70%;">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Izmeni Pitanje
            </h2>
            <p class="mb-4">Izmeni pitanje za kurs: {{ $question->course->title }}</p>
        </header>

        <form method="POST" action="/questions/{{ $question->id }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="course_id" value="{{ $question->course->id }}">
            <div class="mb-6">
                <label for="question" class="inline-block text-lg mb-2">
                    Tekst Pitanja
                </label>
                <textarea class="border border-gray-200 rounded p-2 w-full" name="question" rows="10"
                    placeholder="Koje godine je počeo Drugi svetski rat?">{{ $question->question }}</textarea>

                @error('question')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                
            </div>

            <div class="mb-6">
                <label for="difficulty" class="inline-block text-lg mb-2">
                    Težina
                </label>
                <select name="difficulty" id="difficulty">
                    <option value="Lako" selected>Lako</option>
                    <option value="Srednje">Srednje</option>
                    <option value="Teško">Teško</option>
                </select>

                @error('difficulty')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="option1" class="inline-block text-lg mb-2">Opcija 1 <b>(Tačan odgovor)</b></label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="option1"
                    placeholder="Primer: 1939" 
                    value="{{ $question->option1 }}"/>

                @error('option1')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="option2" class="inline-block text-lg mb-2">Opcija 2</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="option2"
                    placeholder="Primer: 1991" 
                    value="{{ $question->option2 }}"/>

                @error('option2')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="option3" class="inline-block text-lg mb-2">Opcija 3</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="option3"
                    placeholder="Primer: 2001" 
                    value="{{ $question->option3 }}"/>

                @error('option3')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="option4" class="inline-block text-lg mb-2">Opcija 4</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="option4"
                    placeholder="Primer: 1912" 
                    value="{{ $question->option4 }}"/>

                @error('option4')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    Izmeni Pitanje
                </button>

                <a href="/courses/{{ $question->course->id }}/edit" class="text-black ml-4"> Nazad </a>
            </div>
        </form>
    </x-card>
</x-layout>