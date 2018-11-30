<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Task;
use App\User;
use App\Progress;
use Carbon\Carbon;
use App\Notifications\DeadlineArriving;

class TaskController extends Controller
{
    public function index()
    {
        $auth_user = auth()->user();
        $tasks = Task::where('user_id', '=', $auth_user->id)->get();
        //$user = $tasks[0]->project->user;
        //$user->notify(new DeadlineArriving($tasks[0]));
        return view('tasks.index', compact('tasks'));
    }
    /**
     * @param  Project
     * @return view
     */
    public function store(Project $project)
    {
        $auth_user = auth()->user();
        if(!request('assigned_to')) {
        	$created_task = $project->addTask([
        		'name' => request('name'),
                'user_id' => auth()->id(),
        		'progress' => 0,
        		'target' => Carbon::parse(request('target'))->toDateTimeString()
        	]);
            //$created_task->addNote(request('note'));
            Progress::create([
                'task_id' => $created_task->id,
                'note' => 'Task begun',
                'progress' => $created_task->progress
            ]);
        } else {
            if($auth_user->can('assign', User::class)) {
                $created_task = $project->addTask([
                    'name' => request('name'),
                    'user_id' => request('assigned_to'),
                    'progress' => 0,
                    'target' => Carbon::parse(request('target'))->toDateTimeString()
                ]);
                //$created_task->addNote(request('note'));
                Progress::create([
                    'task_id' => $created_task->id,
                    'note' => 'Task begun',
                    'progress' => $created_task->progress
                ]);
            } else {
                return abort(403, 'Unauthorized Action');
            }
        }
        //$project->addTask(request());
    	return back();
    }

    /**
     * @param  Task
     * @return view
     */
    public function show(Task $task)
    {
        // return $task;
    	return view('tasks.show', compact('task'));
    }

    /**
     * @param  Task
     * @return view
     */
    public function update(Task $task)
    {
        $task->progress = request('progress');
        $task->addNote(request('note'));
        Progress::create([
            'task_id' => $task->id,
            'note' => request('note'),
            'progress' => request('progress')
        ]);
        $task->save();
        return back();
    }

    public function createTask(Project $project)
    {
        return view('tasks.create')->with('project', $project);
    }
}
