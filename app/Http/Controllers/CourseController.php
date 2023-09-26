<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index(){
        return view('courses.index', [
            'courses' => Course::latest()
            ->filter(request(['tag', 'search']))
            ->paginate(4)
        ]);
    }

    public function show(Course $course) {
        return view('courses.show', [
            'course' => $course
        ]);
    }

    public function create(){
        return view('courses.create');
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'title' => 'required',
            'tags' => 'required',
            'description' => 'required',
            'content' => 'required'
        ]);
        if (!array_key_exists('content', $formFields)) {
            $formFields['content'] = 'test';
        }
        //dd($formFields);
        $formFields['user_id'] = auth()->id();
 
        Course::create($formFields);

        return redirect('/')->with('message', 'Kurs uspešno kreiran.');
    }

    public function edit(Course $course){
        return view('courses.edit', ['course' => $course]);
    }

    public function update(Request $request, Course $course){

        if($course->user_id != auth()->id()){
            abort(403, 'Unauthorized action');
        } 

        $formFields = $request->validate([
            'title' => 'required',
            'tags' => 'required',
            'description' => 'required|max:20'
        ]);

        $course->content = $request->input('content');
        $course->update($formFields);

        return back()->with('message', 'Kurs uspešno izmenjen.');
    }
}
