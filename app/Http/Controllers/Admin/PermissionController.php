<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required']);

        Permission::create($validated);

        session()->flash('status', 'Permissão criada.');
        session()->flash('alert', 'success');

        return to_route('permissions.index');
    }

    public function show(Permission $permission)
    {
        return view('permissions.show', compact('permission'));
    }

    public function edit(Permission $permission)
    {
        $roles = Role::all();
        return view('permissions.edit', compact('permission', 'roles'));
    }

    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate(['name' => 'required']);
        $permission->update($validated);

        session()->flash('status', 'Permissão atualizada.');
        session()->flash('alert', 'success');

        return to_route('permissions.index');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        session()->flash('status', 'Permissão removida.');
        session()->flash('alert', 'success');

        return redirect()->back();
    }

    public function assignRole(Request $request, Permission $permission)
    {
        if ($permission->hasRole($request->role)) {
            session()->flash('status', 'Papel existente.');
            session()->flash('alert', 'danger');
            return back();
        }

        $permission->assignRole($request->role);
        session()->flash('status', 'Papel atribuido.');
        session()->flash('alert', 'success');

        return back();
    }

    public function removeRole(Permission $permission, Role $role)
    {
        if ($permission->hasRole($role)) {
            $permission->removeRole($role);
            session()->flash('status', 'Papel removido.');
            session()->flash('alert', 'success');
            return back();
        }

        session()->flash('status', 'Papel não existente.');
        session()->flash('alert', 'danger');

        return back();
    }
}
