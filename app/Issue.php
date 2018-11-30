<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = ['title', 'description', 'is_resolved', 'user_id'];

    public function task() {
    	return $this->belongsTo(Task::class);
    }

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function comments() {
    	return $this->hasMany(Comment::class);
    }

    public function addComment($comment) {
    	return $this->comments()->create($comment);
    }
}
