<?php

namespace App;

use App\Interfaces\CommandInterface;
use Illuminate\Database\Eloquent\Model;

class Command extends Model
{

    protected $guarded = ['created_at', 'updated_at'];
    public function commandable()
    {
        return $this->morphTo();
    }

    public function play()
    {
        $command = $this->commandable;
        if($command instanceof CommandInterface && $this->enable)
        {
            \Log::info('Play command '.$command->name);
            $command->play();
        }
        else
        {

        }
    }
}
