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
        $classname = $sensorstring;
        $sensor = new $classname();
        if($id!=0)
            $sensor = $sensor->find($id);
        return $sensor;
    }

    public static function createAll($sensors)
    {
        $factory = [];
        foreach ($sensors as $sensor)
        {
            $factory[] = SensorFactory::create($sensor->classname);
        }
        return $factory;
    }
}