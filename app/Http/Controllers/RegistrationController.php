<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function create()
    {
    	return view('registrations.index');
    }
    public function store()
    {
    	$this->validate(request(), [
    		'name' => 'required',
    		'email' => 'required',
    		'password' => 'required|confirmed'
    	]);
        if(!User::first()) {
        	$user = User::create([
        		'name' => request('name'),
        		'email' => request('email'),
                'privilage' => 0,
        		'password' => bcrypt(request('password'))
        	]);
        } else {
            $user = User::create([
                'name' => request('name'),
                'email' => request('email'),
                //'privilage' => 2, // Employee
                'privilage' => 3, // Blocked by default
                'password' => bcrypt(request('password'))
            ]);
        }

    	auth()->login($user);

    	return redirect('/projects');
    }
}
