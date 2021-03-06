<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    protected $table = 'dashboards';

    public $timestamps = false;
    
    public function widgets()
    {
        return $this->hasMany('App\Widget');
    }

    public function scenarios()
    {
        return $this->belongsToMany('App\Scenario', 'scenario_widgets', 'dashboard_id','scenario_id');
    }

    public function scenarioWidgets()
    {
        return $this->hasMany('App\ScenarioWidget');
    }
}
