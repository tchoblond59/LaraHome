<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    protected $table = 'widgets';

    public $timestamps = false;
    
    public function dashboard()
    {
        return $this->belongsTo('App\Dashboard');
    }

    public function sensor()
    {
        return $this->belongsTo('App\Sensor');
    }
}
