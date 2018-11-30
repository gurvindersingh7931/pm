<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest')->except(['destroy']);
	}
    public function create()
    {
    	return view('sessions.index');
    }
    public function store()
    {
        // dd(auth()->attempt(request(["email", 'password'])));
    	if (! auth()->attempt(request(['email', 'password']))) {
    		return back()->withErrors([
    			'message' => 'Invalid credentials'
    		]);
    	}

    	return redirect()->home();
    }

    public function index()
    {
        $auth_user = auth()->user();
        return "h";
        $projects = Project::all();
        return view('projects.index', compact('projects'))->with('tasks', $tasks);
        $tasks = Task::where('user_id', '=', $auth_user->id)->get();
    }

    public function destroy()
    {
        auth()->logout();
        return redirect()->home();
    }
}
