<?php

namespace App\Listeners;

use App\Events\MSMessageEvent;
use App\Events\SSRelayEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Sensor;
use App\Sensors\SSRelay;

class SSRelayEventListener
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
     * @param  MSMessageEvent  $event
     * @return void
     */
    public function handle(MSMessageEvent $event)
    {
        $sensor = Sensor::where('node_address', '=', $event->message->getNodeId())->where('sensor_address', '=', $event->message->getChildId())->where('classname', '=', 'SSRelay')->first();

        if($sensor && $event->message->getCommand()==1 && $event->message->getType()==2)
        {
            $state = $event->message->getMessage();
            $ss_event = new SSRelayEvent($sensor, $state);
            event($ss_event);
        }
    }
}
