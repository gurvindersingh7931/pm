<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
	protected $fillable = ['progress', 'task_id', 'note'];
    public function task() {
    	return $this->belongsTo(Task::class);
    }
}
