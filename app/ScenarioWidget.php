<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScenarioWidget extends Model
{
    protected $table = 'scenario_widgets';

    public $timestamps = false;

    public function scenario()
    {
        return $this->belongsTo('App\Scenario');
    }

    public function dashboard()
    {
        return $this->belongsTo('App\Dashboard');
    }
}