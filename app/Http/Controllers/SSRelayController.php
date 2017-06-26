<?php

namespace App\Http\Controllers;

use App\Widget;
use Illuminate\Http\Request;
use App\Sensors\SSRelay\SSRelay;
use App\Sensor;
use App\Mqtt\MSMessage;
use App\Mqtt\MqttSender;
use App\Message;
class SSRelayController extends Controller
{
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
        $val=0;
        if($request->has('state'))
        {
            $val=1;
        }
        $message = new MSMessage();
        $message->set($sensor->node_address, $sensor->sensor_address, 'V_STATUS');
        $message->setMessage($val);
        MqttSender::sendMessage($message);
        $reponse['message'] = "Challenge accepted";
        $reponse['type'] = "success";
        return json_encode($reponse);
    }
}
