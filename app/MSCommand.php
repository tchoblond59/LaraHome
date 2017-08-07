<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class MSCommand extends Model
{
    protected $table = 'mscommands';

    public $timestamps = false;

    public function sensor()
    {
        return $this->belongsTo('App\Sensor');
    }

    public function send()
    {
        Artisan::call('mscommand:send', ['id' => $this->id]);
    }

    public function scheduledMSCommands()
    {
        return $this->hasMany('App\ScheduledMSCommands', 'mscommand_id');
    }
}
