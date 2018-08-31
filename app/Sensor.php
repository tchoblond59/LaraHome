<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;
class Sensor extends Model
{
    protected $table = 'sensors';

    public $timestamps = false;

    protected $fillable = ['id', 'node_address', 'sensor_address', 'name', 'classname'];

    public static function getSensorsName()
    {
        $plugins = Plugin::where('enable', '=', '1')->get();
        return $plugins;
    }

    public function getJs()
    {
        return [];
    }

    public function getCss()
    {
        return [];
    }

    public function onEnable()
    {

    }

    public function onDisable()
    {

    }
}
