<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::whereNotIn('name', ['admin'])->get();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('role', 'permissions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        Role::create($validated);

        session()->flash('status', 'Papel criado com sucesso.');
        session()->flash('alert', 'success');

        return to_route('roles.index');
    }

    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        $role->update($validated);

        session()->flash('status', 'Papel atualizado com sucesso.');
        session()->flash('alert', 'success');

        return to_route('roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        session()->flash('status', 'Papel deletado.');
        session()->flash('alert', 'success');

        return back();
    }

    public function givePermission(Request $request, Role $role)
    {
        if($role->hasPermissionTo($request->permission)){
            session()->flash('status', 'Permissão existente.');
            session()->flash('alert', 'danger');
            return back();
        }
        $role->givePermissionTo($request->permission);
        session()->flash('status', 'Permissão atribuido.');
        session()->flash('alert', 'success');
        return back();
    }

    public function revokePermission(Role $role, Permission $permission)
    {
        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            session()->flash('status', 'Permissão revogado.');
            session()->flash('alert', 'success');
            return back();
        }

        session()->flash('status', 'Permissão não existente.');
        session()->flash('alert', 'danger');
        return back();
    }
}
