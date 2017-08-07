<?php

namespace App\Listeners;

use App\Events\PluginsEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PluginsListenerEvent
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PluginsEvent  $event
     * @return void
     */
    public function handle(PluginsEvent $event)
    {
        //
    }
}
