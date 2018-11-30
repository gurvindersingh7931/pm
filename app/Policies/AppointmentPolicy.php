<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppointmentPolicy
{
    use HandlesAuthorization;

    public function index(User $user) {
        return $user->privilage == 1;
    }

    public function create(User $user) {
        return $user->privilage == 1;
    }

    public function delete(User $user) {
        return $user->privilage == 1;
    }

    public function update(User $user) {
        return $user->privilage == 0;
    }

    public function show(User $user) {
        return $user->privilage == 1;
    }

}
