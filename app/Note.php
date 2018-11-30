<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
	protected $fillable = ['body'];
    public function task()
    {
    	return $this->belongsTo(Task::class);
    }
}
