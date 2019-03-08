<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScenarioCommand extends Model
{
    protected $table= 'scenario_command';

    public $timestamps = false;

    public function scenario()
    {
        return $this->belongsTo('App\Scenario');
    }
}
