<?php

namespace App\Http\Controllers;

use App\MSCommand;
use Illuminate\Http\Request;
use App\Sensor;
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
}
