<?php

namespace App\Http\Controllers;

use App\Events\SSRelayEvent;
use App\ScheduledMSCommands;
use App\Widget;
use Illuminate\Http\Request;
use App\Sensors\SSRelay\SSRelay;
use App\Sensor;
use App\Sensors\SSRelay\SSRelayConfig;
use App\Mqtt\MSMessage;
use App\Mqtt\MqttSender;
use App\Message;
use App\MSCommand;

class SSRelayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
        $ssrelay_config = SSRelayConfig::where('sensor_id', '=', $sensor->id)->first();
        return view('sensors.ssrelay.configwidget')->with(['widget' => $widget,
        'messages' => $messages,
        'ssrelay_config' => $ssrelay_config]);
    }

    public function toggle(Request $request)
    {
        $widget = Widget::findOrFail($request->id);
        $sensor = Sensor::findOrFail($widget->sensor_id);

        $message = new MSMessage($sensor->id);
        $message->set($sensor->node_address, $sensor->sensor_address, 'V_STATUS');

        $relay = SSRelayConfig::where('node');

        $ssrelay_config = SSRelayConfig::where('sensor_id', '=', $sensor->id)->first();
        if($ssrelay_config->type=="temporisé")
        {
            $message->setMessage('1');
            MqttSender::sendMessage($message);
            usleep($ssrelay_config->delay * 1000);
            $message->setMessage('0');
            MqttSender::sendMessage($message);
        }
        else
        {
            $val='0';
            if($request->has('state'))
            {
                $val='1';
            }
            $message->setMessage($val);
            MqttSender::sendMessage($message);
            $event = new SSRelayEvent($sensor, $val);
            event($event);
        }

        $reponse['message'] = "Done";
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

    public function update($id)//Widget id
    {
        $widget = Widget::findOrFail($id);
        $sensor = Sensor::findOrFail($widget->sensor_id);
        $ssrelay_config = SSRelayConfig::getFromSensor($sensor->id);
        return view('sensors.ssrelay.update')->with(['widget' => $widget,
        'sensor' => $sensor,
        'ssrelay_config' => $ssrelay_config]);
    }
    
    public function upgrade($id, Request $request)
    {
        $this->validate($request, ['type' => 'required']);
        $ssrelay_config = SSRelayConfig::findOrFail($id);
        $ssrelay_config->type = $request->type;
        if($request->type == 'temporisé')
        {
            if($request->has('delay') && is_numeric($request->delay))
            {
                $ssrelay_config->delay = $request->delay;
            }
            else
            {
                return redirect()->back()->withErrors(['Le champs délai doit être rempli et de type numerique']);
            }
        }
        $ssrelay_config->save();
        return redirect()->back();
    }
}
