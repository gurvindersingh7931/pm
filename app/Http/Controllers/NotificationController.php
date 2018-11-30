<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Notifications\DeadlineArriving;

class NotificationController extends Controller
{
	
	public function __construct() {
		$this->middleware('auth');
	}

    public function index() {
    	$notifications = auth()->user()->notifications;
    	return view('notifications.index', compact('notifications'));
    }

    public function update($notification_id) {
    	$user = auth()->user();
    	foreach($user->unreadNotifications as $notification) {
    		if($notification->id == $notification_id) {
    			$notification->markAsRead();
    			return back();
    		}
    	}
    }

    public function updateIssue($notification_id, $task_id) {
        $user = auth()->user();
        foreach($user->unreadNotifications as $notification) {
            if($notification->notifiable_id == $notification_id) {
                $notification->markAsRead();
                return redirect('/tasks/' . $task_id . '/issues');
            }
        }
    }

    public function updateComment($notification_id, $issue_id, $task_id) {
        $user = auth()->user();
        foreach($user->unreadNotifications as $notification) {
            if($notification->notifiable_id == $notification_id) {
                $notification->markAsRead();
                return redirect('/tasks/'.$task_id.'/issues/'.$issue_id);
            }
        }
    }

}
