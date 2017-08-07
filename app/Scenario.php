<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scenario extends Model
{
    protected $table= 'scenarios';

    public $timestamps = false;
    
    public function mscommands()
    {
        return $this->belongsToMany('App\MSCommand', 'scenarios_mscommands', 'scenario_id','mscommand_id');
    }

    public function scenarioMSCommand()
    {
        return $this->hasMany('App\ScenarioMSCommand');
    }

    public function play()
    {
        foreach ($this->mscommands as $mscommand)
        {
            $mscommand->send();
        }
    }
    
}
