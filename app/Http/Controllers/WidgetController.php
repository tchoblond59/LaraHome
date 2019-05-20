<?php

namespace App\Http\Controllers;

use App\Widget;
use Illuminate\Http\Request;

class WidgetController extends Controller
{
    public function edit($id)
    {
        $widget = Widget::findOrFail($id);
        return view('widgets.edit')->with([
            'widget' => $widget,
        ]);
    }

    public function update($id, Request $request)
    {
        $widget = Widget::findOrFail($id);
        $widget->name = $request->name;
        $widget->save();
        return redirect()->back();
    }
}
