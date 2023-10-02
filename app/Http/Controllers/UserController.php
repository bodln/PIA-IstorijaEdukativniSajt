<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function show()
    {
        $users = User::paginate(10);

        return view('users.show', [
            'users' => $users
        ]);
    }

    public function create() {
        return view('users.register');
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:2'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        auth()->login($user);

        return redirect('/')->with('message', 'User created.');
    }

    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out.');
    }

    public function login(){
        return view('users.login');
    }

    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in.');
        }

        return back()->withErrors(['email' => 'Invalid Credentials.'])->onlyInput('email');
    }

    public function toggleAdmin(User $user){
        if (auth()->user()->role != 'admin') {
            abort(403, 'Unauthorized action');
        }

        if($user->role == 'admin'){
            $user->role = 'student';
        } else {
            $user->role = 'admin';
        }

        $role = 'admin';
        if($user->role == 'teacher'){

            $role = 'Profesor';
        }
        elseif ($user->role == 'student'){

            $role = 'Učenik';
        }

        $user->save();
        return redirect('/users/manage')->with('message', $user->name . ' je postao: ' . $role);
    }

    public function toggleTeacher(User $user){
        if (auth()->user()->role != 'admin') {
            abort(403, 'Unauthorized action');
        }

        if($user->role == 'teacher'){
            $user->role = 'student';
        } else {
            $user->role = 'teacher';
        }

        $role = 'admin';
        if($user->role == 'teacher'){

            $role = 'Profesor';
        }
        elseif ($user->role == 'student'){

            $role = 'Učenik';
        }

        $user->save();
        return redirect('/users/manage')->with('message', $user->name . ' je postao: ' . $role);
    }
}
