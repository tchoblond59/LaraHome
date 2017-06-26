<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sensor;
class SensorController extends Controller
{
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
}
