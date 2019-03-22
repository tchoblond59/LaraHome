<?php

namespace App\Http\Controllers;

use App\Command;
use App\MSCommand;
use App\ScenarioCommand;
use App\ScenarioMSCommand;
use App\ScenarioWidget;
use Illuminate\Http\Request;
use App\Scenario;

class ScenarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['playShortcut']);
    }

    public function index()
    {
        $scenarios = Scenario::all();
        return view('scenario.index')->with(['scenarios' => $scenarios]);
    }

    public function create(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        $scenario = new Scenario();
        $scenario->name = $request->name;
        $scenario->save();
        return redirect('/scenario/update/'.$scenario->id);
    }

    public function edit($id)
    {
        $scenario = Scenario::findOrFail($id);
        $commands =  Command::all();
        return view('scenario.edit')->with(['scenario' => $scenario,
        'commands' => $commands]);
    }

    public function addCommand($id, Request $request)
    {
        $this->validate($request, ['command' => 'required']);
        Scenario::findOrFail($id);
        $sc_command = new ScenarioCommand();
        $sc_command->scenario_id = $id;
        $sc_command->command_id = $request->command;
        $sc_command->save();
        return redirect()->back();
    }

    public function deleteCommand($id, Request $request)
    {
        $this->validate($request, ['command' => 'required']);
        Scenario::findOrFail($id);
        $sc_command = ScenarioCommand::where('scenario_id', '=', $id)->where('command_id', '=', $request->command)->first();
        if($sc_command!=null)
            $sc_command->delete();
        return redirect()->back();
    }

    public function delete($id, Request $request)
    {
        $scenario = Scenario::findOrFail($id);
        ScenarioCommand::where('scenario_id', '=', $id)->delete();
        ScenarioWidget::where('scenario_id', '=', $id)->delete();
        $scenario->delete();
        return redirect()->back();
    }

    public function play($id)
    {
        Scenario::findOrFail($id)->play();
        return redirect()->back();
    }

    public function createShortcut($id)
    {
        $scenario = Scenario::findOrFail($id);
        $scenario->url = str_random(50);
        $scenario->save();
        return redirect()->back();
    }


    public function playShortcut($random)
    {
        $scenario = Scenario::where('url', '=', $random)->first();
        if($scenario!=null)
        {
            $scenario->play();
            return ('ok');
        }
        return ('nok');
    }

    public function enable($id, Request $request)
    {
        $scenario = Scenario::findOrFail($id);
        $scenario->enable = $request->has('enable_scenario');
        $scenario->save();
        return json_encode('ok');
    }
}
