<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MSCommand extends Model
{
    protected $table = 'mscommands';

    public $timestamps = false;

    public function sensor()
    {
        return $this->belongsTo('App\Sensor');
    }
}
