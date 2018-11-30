<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Reminder;
use Illuminate\Support\Facades\Notification;
use DateTime;
use Auth;

class ReminderController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function index() {
    	$auth_user = auth()->user();

    	if ($auth_user->privilage == 1) {
    		$users = User::where('privilage', '=', '1')->get();
    		//echo "<pre>"; print_r($auth_user); die;
    		return view('reminders.index', compact('users'));
    	} else {
    		abort(403, "Unauthorized Access");
    	}
    }

	public function create(Request $request) {
		$admins = User::where('privilage', 0)->orWhere('privilage', 1)->get();
		
		foreach ($admins as $admin) {
			$reminder = new Reminder;
			$reminder->user_id = $admin->id;
			$reminder->data =$request->message;
			$reminder->priority=$request->priority;
			// $reminder->is_done = 0;
			// $reminder->is_strike = 0;
			// $reminder->priority = 1;
			$reminder->save(); 
			//Notification::send($admin, new Reminder(request('message')));
		}
		return back();
	}
	

	public function update($id) {
		
		$user = auth()->user();
		if($user->privilage == '0' || $user->privilage == '1')
		{
			$reminder = Reminder::find($id);
			echo $reminder;
			$reminder->is_done = 1;
			$reminder->completed_on = new DateTime();
			$status = $reminder->save();
			return redirect()->back();
		}
		else {
			abort(403, "Unauthorized action");
		}
	}

	// Strike Status ------------------------------------------
	public function strikeStatus($id) {
		$user = auth()->user();
		if($user->privilage == '0' || $user->privilage == '1')
		{
			$reminder = Reminder::find($id);
			$reminder->is_strike = 1;
			$status = $reminder->save();
			return redirect()->back();
		}
		else {
			abort(403, "Unauthorized action");
		}

	}

	// UnStrike Status ------------------------------------------
	public function unstrikeStatus($id) {
		$user = auth()->user();
		if($user->privilage == '0' || $user->privilage == '1')
		{
			$reminder = Reminder::find($id);
			$reminder->is_strike = 0;
			$status = $reminder->save();
			return redirect()->back();
		}
		else {
			abort(403, "Unauthorized action");
		}

	}

	public function delete(User $user, $id) {
		if($user->can('delete', User::class)) {
			$user->notifications()->delete(['id' => $id]);
			return back();
		} else {
			abort(403, "Unauthorized action");
		}
	}

	public function completedReminders()
	{
		$data_rem = Reminder::all()->where('user_id',Auth::user()->id)->where('is_done','1')->sortByDesc('completed_on');
		return view('reminders.completed')->with('reminders',$data_rem);
	}
}
