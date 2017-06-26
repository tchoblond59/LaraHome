<?php

namespace App\Http\Controllers;

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
}
