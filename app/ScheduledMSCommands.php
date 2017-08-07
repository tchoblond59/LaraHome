<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduledMSCommands extends Model
{
    protected $table = 'scheduled_mscommands';

    public $timestamps = false;

    public function mscommand()
    {
        return $this->belongsTo('App\MSCommand', 'mscommand_id');
    }
}
