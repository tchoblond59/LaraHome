<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scenario extends Model
{
    protected $table= 'scenarios';

    public $timestamps = false;
    
    public function commands()
    {
        return $this->belongsToMany('App\Command', 'scenario_command');
    }

    public function scenarioCommand()
    {
        return $this->hasMany('App\ScenarioCommand');
    }

    public function play()
    {
        if($this->enable)
        {
            \Log::info('Playing scenario '.$this->name);
            foreach ($this->commands as $command)
            {
                $command->play();
            }
        }
    }
    
}
