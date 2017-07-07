<?php

namespace App\Http\Controllers;

use App\MSCommand;
use App\ScenarioMSCommand;
use App\ScenarioWidget;
use Illuminate\Http\Request;
use App\Scenario;

class ScenarioController extends Controller
{
    public function index()
    {
        $scenarios = Scenario::all();
        return view('scenario.create')->with(['scenarios' => $scenarios]);
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
        $mscommands=  MSCommand::all();
        return view('scenario.edit')->with(['scenario' => $scenario,
        'mscommands' => $mscommands]);
    }

    public function addCommand($id, Request $request)
    {
        $this->validate($request, ['mscommand' => 'required']);
        Scenario::findOrFail($id);
        $sc_command = new ScenarioMSCommand();
        $sc_command->scenario_id = $id;
        $sc_command->mscommands_id = $request->mscommand;
        $sc_command->save();
        return redirect()->back();
    }

    public function deleteCommand($id, Request $request)
    {
        $this->validate($request, ['mscommand' => 'required']);
        Scenario::findOrFail($id);
        $sc_command = ScenarioMSCommand::where('scenario_id', '=', $id)->where('mscommands_id', '=', $request->mscommand)->first();
        if($sc_command!=null)
            $sc_command->delete();
        return redirect()->back();
    }

    public function delete($id, Request $request)
    {
        $scenario = Scenario::findOrFail($id);
        ScenarioMSCommand::where('scenario_id', '=', $id)->delete();
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
}
