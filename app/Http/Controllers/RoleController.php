<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
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
        $permissions = $role->permissions->pluck('id')->toArray();//Array of all permission of this role
        $permissions = Permission::whereNotIn('id', $permissions)->get();//Get the permissions the role hasnt
        return view('role.update')->with(['role' => $role,
        'permissions' => $permissions]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->update();
        return redirect('/role');
    }

    public function addPermission($id, Request $request)
    {
        $this->validate($request, ['permission' => 'required|exists:permissions,id']);
        $permission = Permission::find($request->permission);
        $role = Role::findOrFail($id);
        $role->givePermissionTo($permission->name);
        return redirect()->back();
    }

    public function deletePermission($id, Request $request)
    {
        $this->validate($request, ['permission_id' => 'required|exists:permissions,id']);
        $permission = Permission::find($request->permission_id);
        Role::findOrFail($id)->revokePermissionTo($permission->name);
        return redirect()->back();
    }
}
