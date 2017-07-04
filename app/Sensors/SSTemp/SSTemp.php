<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 04/07/17
 * Time: 09:56
 */

namespace App\Sensors\SSTemp;

use App\Sensor;

use App\Message;
use DB;

class SSTemp extends Sensor
{
    public function getWidget(\App\Widget $widget)
    {
        $sensor = Sensor::findOrFail($widget->sensor_id);
        $last_message = Message::where('node_address', '=', $sensor->node_address)
            ->where('sensor_address', '=', $sensor->sensor_address)
            ->orderBy('created_at', 'desc')->first();
        if($last_message!=null)
        {
            return view('sensors.sstemp.widget_empty')->with(['widget' => $widget,
                'last_message' => $last_message]);
        }
        return view('sensors.sstemp.widget')->with(['widget' => $widget,
            'last_message' => $last_message]);  
    }

    public function onDelete()
    {

    }
}