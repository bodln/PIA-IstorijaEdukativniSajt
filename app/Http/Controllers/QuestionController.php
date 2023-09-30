<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function show(Request $request, Course $course)
    {

        $course->questions = $course->questions()->where('difficulty', $request['difficulty'])->get();
        //dd($course->questions);

        return view('questions.show', [
            'course' => $course
        ]);
    }

    public function create($courseId)
    {
        $course = Course::find($courseId);

        if (!$course) {
            abort(404);
        }
        return view('questions.create', compact('course'));
    }

    public function edit(Question $question)
    {
        return view('questions.edit', ['question' => $question]);
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'question' => 'required|max:1000',
            'option1' => 'required|max:100',
            'option2' => 'required|max:100',
            'option3' => 'required|max:100',
            'option4' => 'required|max:100'
        ]);

        $courseId = request('course_id');
        //dd($courseId);
        $formFields['course_id'] = $courseId;
        $formFields['difficulty'] = request('difficulty');
        $formFields['attempts'] = 0;
        $formFields['completions'] = 0;
        $formFields['answer'] = request('option1');

        Question::create($formFields);

        return redirect('/courses/' . (int)$courseId . '/edit')->with('message', 'Pitanje uspešno kreirano.');
    }

    public function update(Request $request, Question $question)
    {
        $formFields = $request->validate([
            'question' => 'required|max:1000',
            'option1' => 'required|max:100',
            'option2' => 'required|max:100',
            'option3' => 'required|max:100',
            'option4' => 'required|max:100'
        ]);

        $courseId = request('course_id');

        $formFields['course_id'] = $courseId;
        $formFields['difficulty'] = request('difficulty');
        $formFields['attempts'] = 0;
        $formFields['completions'] = 0;
        $formFields['answer'] = request('option1');

        $question->update($formFields);

        return redirect('/courses/' . (int)$courseId . '/edit')->with('message', 'Pitanje uspešno izmenjeno.');
    }

    public function destroy(Question $question)
    {

        if ($question->course->user_id != auth()->id()) {
            abort(403, 'Unauthorized action');
        }

        $question->delete();
        return redirect('/courses/' . (int)$question->course->id . '/edit')->with('message', 'Pitanje uspešno obrisano.');
    }

    public function checkAnswers(Request $request)
    {
        $selectedAnswers = $request->input('answers');
        $previousAnswers = $request->session()->get('selectedAnswers', []);
        $results = [];
        $questions = [];

        
        if (!empty($selectedAnswers)) {
            
            $user = User::find(auth()->user()->id);
            
            foreach ($selectedAnswers as $questionId => $selectedAnswer) {
                $question = Question::find($questionId);
                if (!in_array($questionId, $previousAnswers)) {
                    $question->attempts++;
                    $user->attempts++;
                }

                if ($question->answer === $selectedAnswer) {
                    $results[$questionId] = true;
                    if (!in_array($questionId, $previousAnswers)) {
                        $question->completions++;
                        $user->completions++;
                    }
                } else {
                    $results[$questionId] = false;
                }

                $questions[] = $question;

                $user->save();
                $question->save();
            }

            $request->session()->put('selectedAnswers', array_keys($selectedAnswers));
            session(['questions' => $questions, 'results' => $results]);
        }

        return redirect('/questions/result');
    }

    public function results()
    {
        $results = session('results');
        $questions = session('questions');

        return view('questions.results', ['results' => $results, 'questions' => $questions]);
    }
}
