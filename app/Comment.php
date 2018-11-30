<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $fillable = ['body', 'created_by'];
    public function issue() {
    	$this->belongsTo(Issue::class);
    }
}
