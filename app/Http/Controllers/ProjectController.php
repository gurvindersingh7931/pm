<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Task;
use App\Progress;
use App\Note;
use Carbon\Carbon;
use App\Reminder;
use App\Appointment;
use App\User;
use Auth;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $auth_user = auth()->user();
        // return $auth_user;
    
        $tasks = Task::where('user_id', '=', $auth_user->id)->get();
        if ($auth_user->privilage == 2){
            return view('tasks.index', compact('tasks'));
        }
        
        $projects = Project::all();

        if ($auth_user->privilage == 1){
                    $data_rem = Reminder::all()->where('user_id',Auth::user()->id)->where('is_done','0')->sortByDesc('priority');
                    $data_apt = Appointment::all()->where('user_id',Auth::user()->id)->where('is_done','0')->sortByDesc('priority');
            return view('projects.index', compact('projects'))
                                            ->with('reminders',$data_rem)
                                            ->with('appointments',$data_apt);
        }

        $tasks = Task::all();
        $employees = User::where('privilage', 2)->get();
        $data_rem = Reminder::all()->where('user_id',Auth::user()->id)->where('is_done','0')->sortByDesc('priority');
        $data_apt = Appointment::all()->where('user_id',Auth::user()->id)->where('is_done','0')->sortByDesc('priority');
        //echo($data_rem); die;
        return view('projects.index', compact('projects'))
                                        ->with('employees', $employees)
                                        ->with('tasks', $tasks)
                                        ->with('reminders',$data_rem)
                                        ->with('appointments',$data_apt);
    }

    public function create()
    {
        $user = auth()->user();
        //dd($user->can('create', Project::class));
        if($user->can('create', Project::class)) {
            return view('projects.create');    
        }
        return abort(403, 'Unauthorized Access');
    	
    }

    public function store()
    {
    	$this->validate(request(), [
    		'name' => 'required|min:4'
    	]);
    	Project::create([
    		'name' => request('name'),
            'user_id' => auth()->user()->id
    	]);
    	return redirect('/projects');
    }

    public function show(Project $project)
    {
        $auth_user = auth()->user();
        if (!$auth_user->can('assign', User::class)) {
            return view('projects.show', compact('project'));
        } else {
            $employees = User::where('privilage', '=', 2)->get();
            return view('projects.show', compact(['project', 'employees']));
        }
    }

    public function delete(Project $project)
    {
        $auth_user = auth()->user();
        if($auth_user->can('delete', $project)) {
            foreach($project->tasks as $task) {
                Progress::where('task_id', '=', $task->id)->delete();
                Note::where('task_id', '=', $task->id)->delete();
            }
            Task::where('project_id', '=', $project->id)->delete();
            $project->delete();
            $auth_user->notifications()->delete();
            return back();
        }
        return abort(403, 'Action not authorized');
    }
}
