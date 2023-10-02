<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        return view('courses.index', [
            'courses' => Course::latest()
                ->filter(request(['tag', 'search']))
                ->paginate(10)
        ]);
    }

    public function show(Course $course)
    {
        return view('courses.show', [
            'course' => $course
        ]);
    }

    public function create()
    {
        if (auth()->user()->role == 'student') {
            abort(403, 'Unauthorized action');
        }
        
        return view('courses.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role == 'student') {
            abort(403, 'Unauthorized action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'tags' => 'required',
            'description' => 'required|max:500',
            'content' => 'required'
        ]);
        if (!array_key_exists('content', $formFields)) {
            $formFields['content'] = 'test';
        }
        //dd($request);
        $formFields['user_id'] = auth()->id();

        Course::create($formFields);

        return redirect('/')->with('message', 'Kurs uspešno kreiran.');
    }

    public function edit(Course $course)
    {
        if ($course->user_id != auth()->id()) {
            abort(403, 'Unauthorized action');
        }

        return view('courses.edit', ['course' => $course]);
    }

    public function update(Request $request, Course $course)
    {
        if ($course->user_id != auth()->id()) {
            abort(403, 'Unauthorized action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'tags' => 'required',
            'description' => 'required|max:500',
            'content' => 'required'
        ]);

        $course->content = $request->input('content');
        $course->update($formFields);

        return back()->with('message', 'Kurs uspešno izmenjen.');
    }

    public function destroy(Course $course)
    {
        if ($course->user_id != auth()->id() & auth()->user()->role != 'admin') {
            abort(403, 'Unauthorized action');
        }

        $course->delete();
        return redirect('/')->with('message', 'Kurs uspešno obrisano.');
    }

    public function manage()
    {
        if (auth()->user()->role === 'admin' | auth()->user()->role === 'teacher') {
            $user = Auth::user();

            if (auth()->user()->role === 'admin') {
                $courses = Course::paginate(10);
            } else {
                $courses = $user->courses()->paginate(10);
            }
            return view('courses.manage', ['courses' => $courses]);
        }
        abort(403, 'Unauthorized action');
    }
}
