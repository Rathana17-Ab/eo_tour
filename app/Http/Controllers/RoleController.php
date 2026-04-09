<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\RolePermission;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        // ✅ $roles = Role list (មិនមែន $q)
        $roles = Role::with('permissions')->get();

        // ✅ $q = search query ពី URL
        $q = $request->input('q');

        // ✅ Query Role ត្រឹមត្រូវ — មិនប្រើ RoleManagement
        $index = Role::with('permissions')
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('id', 'LIKE', "%{$q}%")
                        ->orWhere('name', 'LIKE', "%{$q}%");
                });
            })
            ->latest()
            ->paginate(5);

        return view('role.index', compact('roles', 'index', 'q'));
    }


    public function create()
    {
        $permission = Permission::all();
        return view('role.create', compact('permission'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'nullable|array',
        ]);
        $role = Role::create(['name' => $request->input('name')]);
        $permissionId = $request->input('permission')
            ? array_map(fn($value) => (int)$value, $request->input('permission'))
            : [];
        $role->syncPermissions($permissionId);
        // Gate:befo
        return redirect()->route('role.index')
            ->with('success', "Role Created Successfully");
    }
    // public function store(Request $request)
    // {

    //     $role = Role::create(['name' => $request->input('name')]);
    //     $permissionId = $request->input('permission')
    //         ? array_map(fn($value) => (int)$value, $request->input('permission')): [];
    //     $role->syncPermissions($permissionId);


    //     // Gate:befo
    //     return redirect()->route('role.index')
    //         ->with('success', "Role Created Successfully");
    // }

    public function edit($id)
    {
        $role = Role::findOrFail($id);


        $permission = Permission::all();
        return view('role.edit', compact('role', 'permission'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'nullable|array',
        ]);

        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->save();

        $permissionsId = $request->input('permission')
            ? array_map(fn($value) => (int)$value, $request->input('permission'))
            : [];

        $role->syncPermissions($permissionsId);

        return redirect()->route('role.index')
            ->with('success', 'Role updated successfully');
    }

    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('role.index')->with('success', 'Role deleted successfully');
    }
}
