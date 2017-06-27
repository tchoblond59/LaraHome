<?php

namespace App\Http\Controllers;

use App\ScheduledMSCommands;
use App\Widget;
use Illuminate\Http\Request;
use App\Sensors\SSRelay\SSRelay;
use App\Sensor;
use App\Mqtt\MSMessage;
use App\Mqtt\MqttSender;
use App\Message;
use App\MSCommand;

class SSRelayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['triggerShortcut']);
    }
    
    public function configureWidget($id)
    {
        $widget = Widget::findOrFail($id);
        $sensor = $widget->sensor;
        $messages = Message::where('node_address', '=', '69')
            ->where('sensor_address', '=', '1')
            ->where('command', '=', '1')
            //->orderBy('created_at', 'desc')
            ->get();
        return view('sensors.ssrelay.configwidget')->with(['widget' => $widget,
        'messages' => $messages]);
    }

    public function toggle(Request $request)
    {
        $widget = Widget::findOrFail($request->id);
        $sensor = Sensor::findOrFail($widget->sensor_id);
        $val='0';
        if($request->has('state'))
        {
            $val='1';
        }
        $message = new MSMessage();
        $message->set($sensor->node_address, $sensor->sensor_address, 'V_STATUS');
        $message->setMessage($val);
        MqttSender::sendMessage($message);
        $reponse['message'] = "Challenge accepted";
        $reponse['type'] = "success";
        return json_encode($reponse);
    }

    public function store($id, Request $request)
    {
        $widget = Widget::findOrFail($id);
        $sensor = Sensor::findOrFail($widget->sensor_id);
        $this->validate($request, [
            'name' => 'required',
            'command' => 'required'
        ]);
        $command = new MSCommand();
        $command->sensor_id = $sensor->id;
        $command->name = $request->name;
        $command->command = 1; //SET
        $command->ack = 0; //No Ack
        $command->type = 2;//V_STATUS Binary
        $command->payload = $request->command;
        $command->save();
        return redirect()->back();



        
    }
}
