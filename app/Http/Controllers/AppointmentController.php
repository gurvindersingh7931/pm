<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Notifications\Reminder;
use App\Appointment;
use Illuminate\Support\Facades\Notification;
use DateTime;
use Auth;

class AppointmentController extends Controller
{
	public function __construct() {
    	$this->middleware('auth');
    }

    public function index() {
    	$auth_user = auth()->user();
		$users = User::where('privilage', '=', '1')->get();
		return view('appointment.index', compact('users'));
    }

    public function create(Request $request) {
    	$admins = User::where('privilage', 0)->orWhere('privilage', 1)->get();
		foreach ($admins as $admin) {
			$appointment = new Appointment;
			$appointment->user_id = $admin->id;
			$appointment->data =$request->message;
			$appointment->priority=$request->priority;
			$appointment->save();
		}
		//echo $appointment; die;
		return back();
	}

	public function update($id) {
		$user = auth()->user();
		if($user->privilage == '0' || $user->privilage == '1')
		{
			$appointment = Appointment::find($id);
			echo $appointment;
			$appointment->is_done = 1;
			$appointment->completed_on = new DateTime();
			$status = $appointment->save();
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
			$appointment = Appointment::find($id);
			$appointment->is_strike = 1;
			$status = $appointment->save();
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
			$appointment = Appointment::find($id);
			$appointment->is_strike = 0;
			$status = $appointment->save();
			return redirect()->back();
		}
		else {
			abort(403, "Unauthorized action");
		}

	}

	public function completedAppointments()
	{
		$data_apt = Appointment::all()->where('user_id',Auth::user()->id)->where('is_done','1')->sortByDesc('completed_on');
		return view('appointment.completed')->with('appointments',$data_apt);
	}
}
