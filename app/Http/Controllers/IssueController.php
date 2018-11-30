<?php

namespace App\Http\Controllers;

use App\Notifications\IssueAdded;
use App\User;
use Illuminate\Http\Request;
use App\Issue;
use App\Task;

class IssueController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function index(Task $task) {
        $task->issues = Issue::where('task_id', '=', $task->id)->get()->sortByDesc('created_at');
    	return view('issues.index', compact('task'));
    }

    public function show(Task $task, Issue $issue) {
    	return view('issues.show', compact('issue'));
    }

    public function create(Task $task) {
        return view('issues.create', compact('task'));
    }

    public function update(Issue $issue) {
        $auth_user = auth()->user();
        if ($auth_user->can('update', $issue)) {
            $issue->is_resolved = !$issue->is_resolved;
            $issue->save();
            return redirect('/tasks/'.$issue->task->id.'/issues');
        } else {
            abort(403, "Unauthorized access");       
        }
    }

    public function store(Task $task) {
//        return request('title');
        $data = array(
            'title' => request('title'),
            'description' => request('body'),
            'is_resolved' => false,
            'user_id' => auth()->id()
        );
    	$issue = $task->addIssue($data);
    	$admins  = User::where('privilage', 0)->get();
    	foreach ($admins as $admin){
            $admin->notify(new IssueAdded($issue));
        }
        return redirect('/tasks/'.$task->id.'/issues');
    }

    public function delete(Issue $issue) {
        $auth_user = auth()->user();
        if ($auth_user->can('delete', $issue)) {
            foreach ($issue->comments as $comment) {
                Comment::where('id', '=', $comment->id)->delete();
            }
            $issue->delete();
            return back();
        } else {
            return abort(403, 'Unauthorized action');
        }
    }
}
