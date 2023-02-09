<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request as HttpRequest;

class CoordinatorController extends Controller
{
    public function guestSection()
    {
        $guests = User::where('role', '=', 'guest')->get();
        return view('coordinators.guestSection', ['guests' => $guests]);
    }

    public function update(HttpRequest $request, $id)
    {
        $validate = $request->validate([    
            'name' => ['required'],
            'surname' => ['required'],
            'email' => ['required', 'email'],
            'role' => ['required'],
            'materia' => ['required'],
        ]);
        $user = User::find($id);
        $user->fill($validate);
        $user->save();
        switch ($request->role) {
            case 'teacher':
                Teacher::create([
                    'materia' => $request->materia,
                    'owner_id' => $id
                    ],
                );
                break;
            case 'student':
                Student::create([
                    'owner_id' => $id
                ]);
                break;
            default:
                break;
            }
            return redirect('/guest-section');
        // return response()->json(['success' => $user]);
    }
}
