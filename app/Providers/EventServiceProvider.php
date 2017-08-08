<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use App\Plugin;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\PluginsEvent' => [
            'App\Listeners\PluginsListenerEvent'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        /*if(\Schema::hasTable('plugins'))
        {
            foreach (Plugin::where('enable', '=', '1')->get() as $plugin) {
                $this->app->register($plugin->provider);
            }
        }*/

        parent::boot();

    }
}
