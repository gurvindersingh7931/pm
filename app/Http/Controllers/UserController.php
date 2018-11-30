<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Project;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    public function __constructor() 
    {
    	$this->middleware('auth');
    }



    public function create() 
    {
        $auth_user = auth()->user();
        $users = User::where('privilage', '>=' , 0)->get();
        if($auth_user->can('create', User::class))
            return view('users.index', compact('users'));
        return abort(403, 'Unauthorized access');
    }

    public function search() 
    {
        $term =  Input::get('q');
        $users = User::where('id', $term)
                        ->orWhere('name', 'like', '%'.$term.'%')
                        ->orWhere('email', 'like', '%'.$term.'%')
                        ->get();

        $projects = Project::where('name', 'like', '%'.$term.'%')->get();
            
    	return view('users.search')->with('users', $users)
                                    ->with('projects', $projects);
    }

    public function edit(User $user)
    {
    	$auth_user = auth()->user();
    	$privilages = array(
    		array(
    			'value' => 0,
    			'name' => 'Super Admin'
    		),
    		array(
    			'value' => 1,
    			'name' => 'Manager'
    		),
    		array(
    			'value' => 2,
    			'name' => 'Employee'
    		),
            array(
                'value' => 3,
                'name' => 'Blocked'
            ),
    	);
    	if($auth_user->can('view', $user))
    		return view('users.edit', compact(['user', 'privilages']));
    	return abort(403, 'Unauthorized access');
    }

    public function update(User $user) {
    	$auth_user = auth()->user();
    	if($auth_user->can('update', $user)) {
    		$user->name = request('name');
	    	$user->email = request('email');
	    	$user->privilage = request('privilage');
	    	$user->save();	
    	} else {
    		return abort(403, 'Unauthorized action');
    	}
    	return back()->with('status', 'User data updated');
    }
}
