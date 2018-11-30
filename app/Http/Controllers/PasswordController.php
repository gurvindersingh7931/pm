<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


class PasswordController extends Controller
{
    public function index() 
    {
    	$auth_user = auth()->user();
    	if($auth_user)
    	{
    		return view('password.reset.index');
    	}
        return abort(403, 'Unauthorized access');
    }

    public function reset(Request $request) 
    {
    	$auth_user = auth()->user();
    	if($auth_user)
    	{
    		// check if the password given is right
            $old = $request->old;
    		$new = $request->password;
            $para = array(
                'email' => $auth_user->email, 
                'password' => $old
            );
            // return $para;
    		$validation = auth()->attempt($para);
            // var_dump($gg);
    		if ($validation){
                $user = User::find($auth_user->id);
                $user->password = bcrypt($new);
                $user->save();

                if($user)
                {
                    return back()->withErrors([
                        'message' => 'Password Updated Successfully'
                    ]);
                }
                else{
                    return back()->withErrors([
                        'message' => 'Something Went Wrong!'
                    ]);
                }
            }
            else
                return back()->withErrors([
                    'message' => 'Invalid credentials'
                ]);
    	}
        return abort(403, 'Unauthorized access');
    }
}
