<?php

namespace App\Providers;

use App\User;
use App\Dashboard;
use App\Policies\UserPolicy;
use App\Sensor;
use App\Policies\DashboardPolicy;
use App\Policies\SensorPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Dashboard::class => DashboardPolicy::class,
        Sensor::class => SensorPolicy::class,
        User::class => UserPolicy::class

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
