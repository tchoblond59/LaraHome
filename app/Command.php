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
        if($command instanceof CommandInterface)
        {
            $command->play();
        }
        else
        {

        }
    }
}
