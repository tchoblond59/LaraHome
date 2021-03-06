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
        $scenario->generateCommand();
        return redirect('/scenario/update/'.$scenario->id);
    }

    public function edit($id)
    {
        $scenarios = Scenario::all();
        $scenario = Scenario::findOrFail($id);
        $commands =  Command::all();
        return view('scenario.edit')->with(['scenario' => $scenario,
        'scenarios' => $scenarios,
        'commands' => $commands]);
    }

    public function addCommand($id, Request $request)
    {
        $this->validate($request, ['command' => 'required']);
        Scenario::findOrFail($id);
        $sc_command = new ScenarioCommand();
        $sc_command->scenario_id = $id;
        $sc_command->command_id = $request->command;
        $sc_command->ordre = 1;
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
        $scenario->deleteCommand();
        $scenario->delete();
        return redirect()->back();
    }

    public function play($id)
    {
        $scenario = Scenario::findOrFail($id);
        if($scenario->enable)
            $scenario->play();
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

    public function cron($id, Request $request)
    {
        $scenario = Scenario::findOrFail($id);
        $scenario->cron = $request->cron;
        $scenario->save();
        return redirect()->back();
    }

    public function moveUpCommand(Request $request)
    {
        $this->validate($request, [
            'scenario_command' => 'exists:scenario_command,id',
        ]);
        ScenarioCommand::find($request->scenario_command)->moveOrderUp();
        return redirect()->back();
    }

    public function moveDownCommand(Request $request)
    {
        $this->validate($request, [
            'scenario_command' => 'exists:scenario_command,id',
        ]);
        ScenarioCommand::find($request->scenario_command)->moveOrderDown();
        return redirect()->back();
    }

}
