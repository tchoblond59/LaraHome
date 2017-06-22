<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 22/06/17
 * Time: 13:38
 */

namespace App;


class SensorFactory
{
    public static function create($sensorstring)
    {
        $classname = 'App\\Sensors\\'.$sensorstring.'\\'.$sensorstring;
        $sensor = new $classname();
        return $sensor;
    }
}