<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    public function whereSensorIs(Sensor $sensor)
    {
        return $this->where('node_address', '=', $sensor->node_address)->where('sensor_address', '=', $sensor->sensor_address);
    }

    public function getCarbonDateAttribute()
    {
        return Carbon::parse($this->created_at);
    }
}
