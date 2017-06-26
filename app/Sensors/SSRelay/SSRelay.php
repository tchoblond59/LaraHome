<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 21/06/17
 * Time: 15:01
 */

namespace App\Sensors\SSRelay;


use App\Sensor;

class SSRelay extends Sensor
{
    public function getWidget(\App\Widget $widget)
    {
        return view('sensors.ssrelay.widget')->with(['widget' => $widget]);
    }

    public function getWidgetList()
    {
        return [1 => 'Relay NONC'];
    }
}