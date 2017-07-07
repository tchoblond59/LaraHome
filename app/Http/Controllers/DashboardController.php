<?php

namespace App\Http\Controllers;

use App\Dashboard;
use App\Scenario;
use App\ScenarioWidget;
use App\Sensor;
use App\Widget;
use Illuminate\Http\Request;
use App\SensorFactory;
use Auth;
use App\Mqtt\MqttSender;
use App\Mqtt\MSMessage;
class DashboardController extends Controller
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

    public function show($id)
    {
        $dashboard = Dashboard::findOrFail($id);
        $widgets = [];
        foreach ($dashboard->widgets as $widget)
        {
            $sensor = SensorFactory::create($widget->sensor->classname);
            $widgets[] = $sensor->getWidget($widget);
        }
        $sensors = Sensor::all();
        $scenarios = Scenario::all();
        return view('dashboards.show')->with(['widgets' => $widgets,
        'dashboard' => $dashboard,
        'sensors' => $sensors,
        'scenarios' => $scenarios]);

    }

    public function create()
    {
        return view('dashboards.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $dashboard = new Dashboard();
        $dashboard->name = $request->name;
        $dashboard->position = 0;
        $dashboard->user_id = Auth::id();
        $dashboard->save();
        return redirect('/dashboard/show/'.$dashboard->id);
    }

    public function addWidget($id, Request $request)
    {
        $this->validate($request, [
        'sensor' => 'required|exists:sensors,id',
        'name' => 'required']);

        $widget = new Widget();
        $widget->sensor_id = $request->sensor;
        $widget->dashboard_id = $id;
        $widget->name = $request->name;
        $widget->save();
        return redirect()->back();
    }

    public function addScenario($id, Request $request)
    {
        $this->validate($request, ['scenario' => 'required|exists:scenarios,id']);
        $widget = new ScenarioWidget();
        $widget->scenario_id = $request->scenario;
        $widget->dashboard_id = $id;
        $widget->save();

        return redirect()->back();
    }
}
