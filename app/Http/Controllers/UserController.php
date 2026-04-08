<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::all();
        return view("users.index", compact("users"));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $roles = Role::all();
        return view("users.create", compact("roles"));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name'     => 'required|string|max:50',
                'email'    => 'required|email|max:255|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                'status'   => 'required|boolean',
                'role'     => 'required',
            ]);

            // Create the user
            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
                'status'   => $data['status'],
            ]);

            // Assign the Spatie role
            $user->assignRole($request->role);

            return redirect()->route('users.index')
                ->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to create user: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified user.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view("users.show", compact("user"));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view("users.edit", compact("user", "roles"));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name'     => 'required|string|max:50',
            'email'    => 'required|email|max:255|unique:users,email,' . $user->id,
            'status'   => 'required|boolean',
            'role'     => 'required',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update User Profile
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->status = $data['status'];

        // Update password only if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        // Sync Spatie Roles (removes old, adds new)
        $user->syncRoles($request->role);

        return redirect()->route('users.index')
            ->with('success', 'User and Role updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting yourself to avoid lockout
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}
