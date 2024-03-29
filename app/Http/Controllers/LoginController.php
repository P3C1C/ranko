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
        Auth::logout();
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

            // commentare dopo aver creato il coordinatore
            "role" => ["required"],
            // commentare dopo aver creato il coordinatore
            
            "email" => ["required", "email"],
            "password" => ["required"],
        ]);
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        // commentare dopo aver creato il coordinatore
        if (isset($validated['role']) && $validated['role']=='coordinator') {
                Coordinator::create([
                    'owner_id' => $user->id,
                ]);
        }
        // commentare dopo aver creato il coordinatore

        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
