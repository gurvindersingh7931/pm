<?php

namespace App\Http\Controllers;

use App\Notifications\CommentAdded;
use App\User;
use Illuminate\Http\Request;
use App\Issue;
use App\Comment;

class CommentController extends Controller
{
    public function create(Issue $issue) {
    	$data = array('body' => request('body'), 'created_by' => auth()->id());
    	$comment = $issue->addComment($data);
//    	return $comment;
        $employees = User::where('privilage', 2)->get();

        $issue_data = Issue::where('id', $comment->issue_id)->first();
//        auth()->user()->name;
        foreach ($employees as $employee){
            $employee->notify(new CommentAdded($issue_data->title, auth()->user()->name, $issue_data->id, $issue_data->task_id));
        }
    	return back();
    }

    public function delete(Comment $comment) {
    	$auth_user = auth()->user();
    	if ($auth_user->can('delete', $comment)) {
    		$comment->delete();
    		return back();
    	} else {
    		return abort(403, 'Unauthorized action');
    	}
    }
}
