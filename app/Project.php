<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'user_id'];
    
    public function tasks()
    {
    	return $this->hasMany(Task::class);
    }

    public function addTask($name)
    {
    	return $this->tasks()->create($name);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
