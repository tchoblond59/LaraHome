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
        $dirs = File::directories(__DIR__.'/Sensors');
        $base_dirs;
        foreach ($dirs as $dir)
        {
            $base_dirs[] = basename($dir);
        }
        return $base_dirs;
    }

}
