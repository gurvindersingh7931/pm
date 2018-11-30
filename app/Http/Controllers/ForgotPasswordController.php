<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Notifications\ForgotPassword;
use Illuminate\Support\Facades\Notification;

class ForgotPasswordController extends Controller
{

    public function index()
    {
    	return view('sessions.forgotPassword');
    }   
    public function create()
    {
        $user = User::where('email', request('email'))->first();
        if ($user) {

            $admins = User::where('privilage', 0)->get();
            foreach ($admins as $admin) {
                try
                {
                    Notification::send($admin, new ForgotPassword($user->name, $user->id));
                }
                catch(\Illuminate\Database\QueryException $exception){
                    return back()->withErrors([
                        'message' => 'Already Requested'
                    ]);
                }

            }
            return back()->withErrors([
                'message' => 'Request Sent'
            ]);
        }
        else
        {
            return back()->withErrors([
                'message' => 'Invalid email'
            ]);
        }
    }
    public function update($id)
    {
        $user = auth()->user();
        if ($user->privilage == 0) {
            foreach($user->unreadNotifications as $notification) {
                if($notification->id == $id) {
                    // return request('id');

                    // Update password
                    $pass = User::find($id);
                    // return $pass;
                    $pass->password = bcrypt(request('password'));
                    $pass->save();

                    if($pass)
                    {
                        $notification->delete();
                        return back();    
                    }
                    else
                    {
                        return "gg";
                        return back()->withErrors([
                            'message' => 'Something Went Wrong'
                        ]);
                    } 
                }
                else
                {
                    return back()->withErrors([
                        'message' => 'No notification found'
                    ]);   
                }
            }
        }
        else
        {
            abort(403, "Unauthorized Access");
        }
    }
}

