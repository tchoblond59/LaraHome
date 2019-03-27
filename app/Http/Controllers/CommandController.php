<?php

namespace App\Http\Controllers;

use App\Command;
use Illuminate\Http\Request;

class CommandController extends Controller
{
    public function index()
    {
        return view('commands.index')->with(['commands' => Command::all()]);
    }

    public function play($id, Request $request)
    {
        $command = Command::findOrFail($id);
        $command->play();
        return json_encode('ok');
    }

    public function createShortcut(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        $command = Command::findOrFail($request->id);
        $command->url = str_random(50);
        $command->save();
        return redirect()->back();
    }

    public function playShortcut($random)
    {
        $command = Command::where('url', '=', $random)->first();
        if($command != null)
        {
            $command->play();
        }
        return json_encode('ok');
    }

    public function delete($id, Request $request)
    {
        $command = Command::findOrFail($id);
        $command->commandable->delete();
        $command->delete();
        return redirect()->back();
    }

    public function enable($id, Request $request)
    {
        $command = Command::findOrFail($id);
        $command->enable = $request->has('enable_command');
        $command->save();
        return json_encode('ok');
    }

    public function edit($id)
    {
        $command = Command::findOrFail($id);
        return view('commands.edit')->with([
            'command' => $command,
        ]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:1|max:255',
        ]);
        $command = Command::findOrFail($id);
        if($request->has('cron') && $request->cron != null)
        {
            $command->cron = $request->cron;
        }
        $command->name = $request->name;
        $command->save();
        return redirect()->back();
    }
}
