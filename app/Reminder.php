<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Reminder extends Model
{
    protected $fillable = ['message', 'is_strike', 'is_done', 'priority'];

    public function user()
    {
    	$this->belongsToMany(User::class);
    }
}
