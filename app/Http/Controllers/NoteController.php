<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class NoteController extends Controller
{
    public function store(Task $task)
    {
    	$task->addNote(request('body'));
    	return back();
    }
}
