<?php

namespace App;

use App\Interfaces\CommandInterface;
use Illuminate\Database\Eloquent\Model;

class Scenario extends Model implements CommandInterface
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

    public function command()
    {
        return $this->morphOne('App\Command', 'commandable');
    }

    /*Create scenario as command so we can call scenario form another one*/
    public function generateCommand()
    {
        Command::create([
            'name' => $this->name,
            'commandable_type' => self::class,
            'commandable_id' => $this->id,
            'enable' => 1
        ]);
    }

    /*Remove scenarion from commands table*/
    public function removeCommand()
    {
        $this->command()->delete();
    }

    public function deleteCommand()
    {
        $this->removeCommand();
    }
    
}
