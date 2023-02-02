<?php

namespace App\Http\Controllers;

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
            $request->session()->regenerate();
            return redirect()->intended('/');
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
            "email" => ["required", "email"],
            "password" => ["required", "confirmed"],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
