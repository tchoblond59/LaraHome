<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        return view('user.index')->with(['users' => $users]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $user->save();
        return redirect('/user');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('edit', $user);
        $roles_array = $user->roles->pluck('id')->toArray();
        $roles = Role::whereNotIn('id', $roles_array)->get();
        return view('user.edit')->with(['user' => $user,
        'roles' => $roles]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required'
        ]);
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->has('password') && !empty($request->password))
            $user->password = \Hash::make($request->password);
        $user->save();
        return redirect()->back();
    }

    public function delete($id, Request $request)
    {
        $user = User::findOrFail($id);
        return redirect()->back();
    }

    public function addRole($id, Request $request)
    {
        $this->authorize('addRole', User::class);
        $this->validate($request, ['role' => 'required|exists:roles,id']);
        $role = Role::findOrFail($request->role);
        $user = User::findOrFail($id);
        $user->assignRole($role->name);
        return redirect()->back();
    }

    public function deleteRole($id, Request $request)
    {
        $this->authorize('deleteRole', User::class);
        $this->validate($request, ['role_id' => 'required|exists:roles,id']);
        $user = User::findOrFail($id);
        $role = Role::find($request->role_id);
        $user->removeRole($role->name);
        return redirect()->back();
    }
}
