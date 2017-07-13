<?php

namespace App\Http\Controllers;

use App\Events\MSMessageEvent;
use App\Mqtt\MSMessage;
use App\SensorFactory;
use Illuminate\Http\Request;
use App\Sensor;
use App\Dashboard;
use App\Widget;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dashboards = Dashboard::where('user_id', '=', Auth::id())->get();
        return view('home')->with(['dashboards' => $dashboards]);
    }

    public function dashboard($id)
    {
        $dashboard = Dashboard::findOrFail($id);
        foreach ($dashboard->widgets as $widget)
        {
            $sensor = SensorFactory::create($widget->sensor->classname);
            $widgets[] = $sensor->getWidget($widget);
        }
        return view('dashboards.show')->with(['widgets' => $widgets]);
    }

    public function api($api_id)
    {
        if($api_id==env('EVENT_API_ID'))
        {
            $message = new MSMessage();
            $message->set(69,1,'V_TEMP');
            $message->setMessage("21.2");
            event(new MSMessageEvent($message));
            return 'ok';
        }
        else
        {
            return view('errors.403');
        }

    }
}
