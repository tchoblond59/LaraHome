<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function create(User $real_user)
    {
        return $real_user->hasRole('admin');
    }

    public function store(User $real_user)
    {
        return $real_user->hasRole('admin');
    }

    public function edit(User $real_user, User $user_edit)
    {
        return $real_user->hasRole('admin') || ($real_user->id == $user_edit->id);
    }

    public function addRole(User $real_user)
    {
        return $real_user->hasRole('admin');
    }

    public function deleteRole(User $real_user)
    {
        return $real_user->hasRole('admin');
    }
}
