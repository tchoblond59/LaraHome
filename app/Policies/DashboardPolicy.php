<?php

namespace App\Policies;

use App\Dashboard;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DashboardPolicy
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

    public function show(User $user, Dashboard $dashboard)
    {
        return $user->hasRole('admin') || $user->id == $dashboard->user_id;
    }

    public function create(User $user)
    {
        return true;
    }



}
