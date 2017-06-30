<?php

namespace App\Http\Controllers;

use App\MSCommand;
use App\ScheduledMSCommands;
use App\SensorFactory;
use App\Widget;
use Illuminate\Http\Request;
use App\Sensor;
use DB;
class SensorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['triggerShortcut']);
    }
    public function create()
    {
        $plugins = Sensor::getSensorsName();
        return view('sensors.add')->with(['plugins' => $plugins]);
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required',
            'node_address' => 'required',
            'sensor_address' => 'required',
            'classname' => 'required'
        ]);
        Sensor::create($request->all());
        return redirect()->back();
    }

    public function triggerShortcut($random)
    {
        $command = MSCommand::where('url', '=', $random)->first();
        if($command!=null)
        {
            $command->send();
        }
        return ('ok');
    }
    
    public function index()
    {
        $sensors = Sensor::all();
        return view('sensors.index')->with(['sensors' => $sensors]);
    }

    public function update($id)
    {
        $sensor= Sensor::findOrFail($id);
        return view('sensors.update')->with(['sensor' => $sensor]);
    }

    public function upgrade($id, Request $request)
    {
        $this->validate($request, ['name' => 'required',
            'node_address' => 'required|numeric',
            'sensor_address' => 'required|numeric']);
        $sensor = Sensor::findOrFail($id);
        $sensor->name = $request->name;
        $sensor->node_address = $request->node_address;
        $sensor->sensor_address = $request->sensor_address;
        $sensor->save();
        return redirect()->back();
    }

    public function delete($id)
    {
        $sensor = Sensor::findOrFail($id);
        $ms_commands = MSCommand::where('sensor_id', '=', $id)->get();
        foreach ($ms_commands as $command)
        {
            //$command->scheduledMSCommands->delete();
            DB::table('scheduled_mscommands')->where('mscommands_id', '=', $command->id)->delete();//Okay this is shit but... It works
        }
        DB::table('mscommands')->where('sensor_id', '=', $id)->delete();
        Widget::where('sensor_id', '=', $id)->delete();
        $plugin = SensorFactory::create($sensor->classname, $sensor->id);
        $plugin->onDelete();
        $sensor->destroy($sensor->id);
        return redirect()->back();


    }
}
