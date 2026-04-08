<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        }
        return back()->withErrors(['email' => 'Invalid email or password']);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function store(Request $request)
    {
        // dd(
        //     $request->all()
        // );
        try {
            $data = $request->validate([
                'name' => 'required|string|max:50',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                
            ]);

            // Hash password
            $data['password'] = Hash::make($data['password']);

            // Upload image
            

            // Create user
            $user = User::create($data);
            // Assign roles
           

            if ($request->action === 'save_new') {
                return
                    redirect()->route('user.create')->with('Success', 'User Created Successfully');
            }
            return redirect()->route('users.index')
                ->with('success', 'User Create successfully');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to create user: ' . $e->getMessage());
        }
    }
    
}
