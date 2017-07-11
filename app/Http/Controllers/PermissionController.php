<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('permission.index')->with(['permissions' => $permissions]);
    }
    public function create()
    {
        return view('permission.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,['name' => 'required']);
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->save();
        return redirect('/permission');
    }

    public function delete($id)
    {
        $permission =  Permission::findOrFail($id);
        $permission->delete();
        return redirect()->back();
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permission.update')->with(['permission' => $permission]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        $permission = Permission::findOrFail($id);
        $permission->name = $request->name;
        $permission->update();
        return redirect('/permission');
    }
}
