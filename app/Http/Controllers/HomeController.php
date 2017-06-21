<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sensor;
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
        foreach (Sensor::all() as $sensor)
        {
            $classname = 'App\\Sensors\\'.$sensor->classname.'\\'.$sensor->classname;
            $sensor = new $classname();
            $widgets[] = $sensor->getWidget();
        }


        return view('home')->with(['widgets' => $widgets]);
    }
}
