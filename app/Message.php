<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    public function whereSensorIs(Sensor $sensor)
    {
        return $this->where('node_address', '=', $sensor->node_address)->where('sensor_address', '=', $sensor->sensor_address);
    }
}
