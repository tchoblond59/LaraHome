<?php

namespace App\Http\Controllers;

use App\Events\PluginsEvent;
use App\Plugin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Process;

class PluginController extends Controller
{
    public function index()
    {
        $plugins = DB::table('plugins')->get();
        return view('plugins.index')->with(['plugins' => $plugins]);
    }

    public function install(Request $request)
    {
        $plugin = Plugin::findOrFail($request->id);
        $plugin->touch();
        //$plugin->enable = 1;
        //$plugin->save();

        $process = new Process('export COMPOSER_HOME='.base_path().' && cd '.base_path().' && /usr/bin/composer require '.$plugin->composer_name);
        $process->run(function ($type, $buffer) {
            $buffer = nl2br($buffer);
            $plugin_event = new PluginsEvent(($buffer));
            event($plugin_event);
            if (Process::ERR === $type) {
                echo 'ERR > '.$buffer;
            } else {
                echo 'OUT > '.$buffer;
            }
        });
        return 'ok';
    }
}
