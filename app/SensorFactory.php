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
    public static function create($sensorstring, $id=0)
    {
        $classname = 'App\\Sensors\\'.$sensorstring.'\\'.$sensorstring;
        $sensor = new $classname();
        if($id!=0)
            $sensor->find($id);
        return $sensor;
    }

    public static function createAll($sensors)
    {
        $factory = [];
        foreach ($sensors as $sensor)
        {
            var_dump($sensor->classname);
            $factory[] = SensorFactory::create($sensor->classname);
        }
        return $factory;
    }
}