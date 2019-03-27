<?php

namespace App;

use App\Interfaces\CommandInterface;
use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
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
