<?php

namespace App\Http\Controllers;

use App\Dashboard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
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
        $dashboard->save();
        return redirect('/dashboard/edit/'.$dashboard->id);
    }
}
