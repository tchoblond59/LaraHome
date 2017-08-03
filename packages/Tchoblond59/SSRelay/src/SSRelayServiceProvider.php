<?php

namespace Tchoblond59\SSTestPlugin;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class SSTestPluginServiceProvider extends ServiceProvider
{

    protected $listen = [
        'App\Events\MSMessageEvent' => [
            'App\Listeners\SSRelayEventListener',
        ],
    ];
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/views', 'sstestplugin');
        Event::listen('App\Events\MSMessageEvent', 'App\Listeners\SSRelayEventListener');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
