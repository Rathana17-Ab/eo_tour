<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\RolePermission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('role.index', compact('roles'));
    }

    public function create()
    {
        $roles = Permission::all();
        return view('role.create', compact('roles'));
    }

    public function store(Request $request)
    {
        
        $role = Role::create(['name' => $request->input('name')]);
        $permissionId = $request->input('permission')
            ? array_map(fn($value) => (int)$value, $request->input('permission'))
            : [];
        $role->syncPermissions($permissionId);


        // Gate:befo
        return redirect()->route('role.index')
            ->with('success', "Role Created Successfully");
    }

    public function edit($id)
    {
        // $user = \App\Models\User::findOrFail($id);
        // $roles = \Spatie\Permission\Models\Role::all();
        $roles = Role::findOrFail($id);
        return view('role.edit', compact('roles')); // បញ្ជូនទាំង user និង roles
    }

    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($role->id)]
        ]);

        $role->update(['name' => $request->name]);
        return redirect()->route('role.index')->with('success', 'Role updated successfully');
    }

    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('role.index')->with('success', 'Role deleted successfully');
    }
}
