<?php

namespace App\Http\Controllers;

use App\Message;
use App\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'sensor' => 'nullable|exists:sensors,id',
            'command' => 'nullable|exists:messages,command']);
        $sensor = Sensor::find($request->sensor);
        $sensors = Sensor::all();

        $messages = new Message();
        if($request->exists('sensor') && $request->sensor != null)
        {
            $messages = $messages->where('node_address', $sensor->node_address);
        }
        if ($request->exists('command') && $request->command != null && $request->sensor != null)
        {
            $messages = $messages->where('command', $request->command);
        }
        if ($request->exists('type') && $request->type != null && $request->command != null && $request->sensor != null)
        {
            $messages = $messages->where('type', $request->type);
        }
        $messages = $messages->orderBy('created_at', 'desc')->paginate(50);

        return view('message.index')->with([
            'messages' => $messages->appends(Input::except('page')),
            'sensors'=>$sensors,

        ]);

    }
}
