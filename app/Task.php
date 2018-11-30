<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	protected $fillable = ['name', 'progress', 'target', 'user_id'];
	
	protected $dates = ['target'];

	public function issues() {
		return $this->hasMany(Issue::class);
	}
	
	public function project()
	{
		return $this->belongsTo(Project::class);
	}
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	public function notes()
	{
		return $this->hasMany(Note::class);
	}

	public function addNote($body)
	{
		$this->notes()->create(compact('body'));
	}

	public function addIssue($body)
	{
		return $this->issues()->create($body);
	}

	public function progressMetric()
	{
		return $this->hasMany(Progress::class);
	}
}
