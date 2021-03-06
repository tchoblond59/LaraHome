<?php

namespace App\Http\Controllers;

use App\Command;
use Illuminate\Http\Request;
use App\MSCommand;
use App\ScheduledMSCommands;

class ConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $commands = ScheduledMSCommands::join('mscommands', 'scheduled_mscommands.mscommand_id', '=', 'mscommands.id')
            ->join('sensors', 'mscommands.sensor_id', '=', 'sensors.id')
            ->select('sensors.name as sensor_name', 'mscommands.name', 'scheduled_mscommands.cron')->get();
        //dd($commands);
        return view('config.index')->with(['commands' => Command::all(), "scheduled_commands" => $commands]);
    }

    public function createScheduledTask(Request $request)
    {
        $this->validate($request, [
            'action' => 'required',
            'cron' => 'required'
        ]);
        $command = MSCommand::findOrFail($request->action);
        $scheduled = new ScheduledMSCommands();
        $scheduled->cron = $request->cron;
        $scheduled->mscommand_id = $request->action;
        $scheduled->save();
        return redirect()->back();
    }

    public function CreateMSCommandShortcut(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        $command = MSCommand::findOrFail($request->id);
        $command->url = str_random(50);
        $command->save();
        return redirect()->back();

    }
}
