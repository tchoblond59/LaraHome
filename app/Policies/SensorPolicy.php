<?php

namespace App\Policies;

use App\User;
use App\Sensor;
use Illuminate\Auth\Access\HandlesAuthorization;

class SensorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the sensor.
     *
     * @param  \App\User  $user
     * @param  \App\Sensor  $sensor
     * @return mixed
     */
    public function view(User $user, Sensor $sensor)
    {
        return $user->can('list sensor');
    }

    public function index(User $user)
    {
        return $user->can('list sensor');
    }
    /**
     * Determine whether the user can create sensors.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create sensor');
    }

    /**
     * Determine whether the user can update the sensor.
     *
     * @param  \App\User  $user
     * @param  \App\Sensor  $sensor
     * @return mixed
     */
    public function update(User $user, Sensor $sensor)
    {
        return $user->can('create sensor');
    }

    /**
     * Determine whether the user can delete the sensor.
     *
     * @param  \App\User  $user
     * @param  \App\Sensor  $sensor
     * @return mixed
     */
    public function delete(User $user, Sensor $sensor)
    {
        return $user->can('create sensor');
    }
}
