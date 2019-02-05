<?php

namespace App\Http\Controllers;

use App\Events\PluginsEvent;
use App\Plugin;
use App\SensorFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Process;

class PluginController extends Controller
{
    public function index()
    {
        $plugins = DB::table('plugins')->get();
        return view('plugins.index')->with(['plugins' => $plugins]);
    }

    public function update()
    {
        $plugins = json_decode(file_get_contents('http://julien.groupemaurizi.com/larahome-package'), true);//
        $nb_packages_discover = 0;
        foreach ($plugins as $plugin)
        {
            if(!Plugin::where('composer_name', $plugin['composer_name'])->exists())//New Plugin
            {
                Plugin::create([
                    'name' => $plugin['name'],
                    'description' => $plugin['description'],
                    'composer_name' => $plugin['composer_name'],
                    'widget_class_name' => $plugin['widget_class_name'],
                    'provider' => $plugin['provider'],
                    'url' => $plugin['url'],
                    'name' => $plugin['name'],
                    'enable' => 0,
                ]);
                $nb_packages_discover++;
            }
        }
        return view('plugins.update')->with([
            'nb_packages_discover' => $nb_packages_discover,
        ]);
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

    public function enable(Request $request)
    {
        $this->validate($request, [
            'plugin' => 'required|exists:plugins,id',
        ]);
        $plugin = Plugin::findOrFail($request->plugin);
        $plugin->enable = 1;
        $plugin->save();
        Artisan::call('package_event:install', array('--force' => true));
        return redirect()->back();
    }

    public function disable(Request $request)
    {
        $this->validate($request, [
            'plugin' => 'required|exists:plugins,id',
        ]);
        $plugin = Plugin::findOrFail($request->plugin);
        $plugin->enable = 0;
        $plugin->save();
        $sensor = SensorFactory::create($plugin->widget_class_name);
        $sensor->onDisable();
        return redirect()->back();
    }
}
