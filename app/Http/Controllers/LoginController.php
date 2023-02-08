<?php

namespace App\Http\Controllers;

use App\Models\Coordinator;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            "email" => ["required", "email"],
            "password" => ["required"],
        ]);

        if (Auth::attempt($validated)) {
            $role = Auth::user()->role;
            $request->session()->regenerate();
            return redirect()->intended('/'.$role);
        }

        return back()->withErrors([
            'email' => 'Le credenziali non sono valide :(',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            "name" => ["required"],
            "surname" => ["required"],
            // "role" => ["required"],
            "email" => ["required", "email"],
            "password" => ["required"],
        ]);
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        // if (isset($validated['role']) && $validated['role']=='coordinator') {
        //         Coordinator::create([
        //             'owner_id' => $user->id,
        //         ]);
        // }
        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
