<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScenarioMSCommand extends Model
{
    protected $table= 'scenarios_mscommands';

    public $timestamps = false;

    public function scenario()
    {
        return $this->belongsTo('App\Scenario');
    }
}
