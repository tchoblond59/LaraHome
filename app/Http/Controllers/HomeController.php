<?php

namespace App\Http\Controllers;

use App\Events\MSMessageEvent;
use App\Message;
use App\Mqtt\MSMessage;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use App\Dashboard;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('api');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dashboards = Dashboard::where('user_id', '=', Auth::id())->get();
        if($dashboards->count() == 1)
        {
            return redirect()->route('dashboard',['id' => $dashboards->first()->id]);
        }
        else
        {
            return view('home')->with(['dashboards' => $dashboards]);
        }
    }

    public function api($api_id, Request $request)
    {
        $reponse = ["status" => "nok"];
        if($api_id==env('EVENT_API_ID'))
        {
            if($request->has('api_key') && $request->api_key=env('EVENT_API_KEY')) {
                $message = new Message();
                $message->node_address = $request->node_id;
                $message->sensor_address = $request->child_sensor_id;
                $message->command = $request->command;
                $message->ack = $request->ack;
                $message->type = $request->type;
                $message->value = $request->payload;

                    $message->save();
                    $reponse = ["status" => "ok"];

                    //Dispatch the event to the subscribers
                    $MsMessage = new MSMessage($message->id);
                    event(new MSMessageEvent($MsMessage, $message->id));
            }
        }
        return json_encode($reponse);
    }
}
