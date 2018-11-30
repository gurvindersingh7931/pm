<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Reminder;
use App\Appointment;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'privilage'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function project()
    {
        return $this->hasOne(Project::class);
    }
    public function issues()
    {
        return $this->hasMany(Issue::class);
    }
    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
