<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return view('role.index')->with(['roles' => $roles]);
    }
    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,['name' => 'required']);
        $role = new Role();
        $role->name = $request->name;
        $role->save();
        return redirect('/role');
    }

    public function delete($id)
    {
        $role =  Role::findOrFail($id);
        $role->delete();
        return redirect()->back();
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('role.update')->with(['role' => $role]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->update();
        return redirect('/role');
    }
}
