<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{


    public function index()
    {
        $permissions = Permission::orderBy('id', 'desc')->paginate(10);
        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show form to create permission
     */
    public function create()
    {
        $permissions = Permission::all(); //ទាញយក Permission ទាំងអស់
        return view('permissions.create', compact('permissions'));
    }

    /**
     * Store new permission
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name'
        ]);

        Permission::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);

        return redirect()
            ->route('permissions.index')
            ->with('success', 'Permission created successfully');
    }

    /**
     * Show single permission
     */
    public function show(string $id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.index', compact('permission'));
    }

    /**
     * Show edit form
     */
    public function edit(string $id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update permission
     */
    public function update(Request $request, string $id)
    {
        $permission = Permission::findOrFail($id);

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('permissions')->ignore($permission->id)
            ]
        ]);

        $permission->update([
            'name' => $request->name
        ]);

        return redirect()
            ->route('permissions.index')
            ->with('success', 'Permission updated successfully');
    }

    /**
     * Delete permission
     */
    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);

        // Prevent deleting critical permissions (optional safety)
        if ($permission->name === 'super-admin') {
            return redirect()
                ->route('permissions.index')
                ->with('error', 'Cannot delete system permission');
        }

        $permission->delete();

        return redirect()
            ->route('permissions.index')
            ->with('success', 'Permission deleted successfully');
    }
}
