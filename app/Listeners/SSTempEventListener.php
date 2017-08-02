<?php

namespace App\Listeners;
use App\Sensor;
use App\Events\MSMessageEvent;
use App\Events\SSTempEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SSTempEventListener
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
        $sensor = Sensor::where('node_address', '=', $event->message->getNodeId())->where('sensor_address', '=', $event->message->getChildId())->where('classname', '=', 'SSTemp')->first();
        $msmessage = $event->message;
        if($sensor && $msmessage->getCommand()==1 && ($msmessage->getType()==0 || $msmessage->getType()==1))
        {
            $type = 'temp';
            if($msmessage->getType()==1)
                $type = 'hum';

            $sstemp_event = new SSTempEvent($sensor, $type, $msmessage->getMessage());
            event($sstemp_event);
        }
    }
}
