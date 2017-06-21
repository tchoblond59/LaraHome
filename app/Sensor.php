<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $table = 'sensors';

    public $timestamps = false;

    protected $fillable = ['id'];

    public function getWidget()
    {
    }

}
