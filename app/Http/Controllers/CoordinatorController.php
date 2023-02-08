<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request as HttpRequest;

class CoordinatorController extends Controller
{
    public function show()
    {
        return view('coordinators.home');
    }

    public function guestSection()
    {
        $guests = User::where('role', '=', 'guest')->get();
        return view('coordinators.guestSection', ['guests' => $guests]);
    }

    public function ajaxResponse(HttpRequest $request, $id)
    {
        $validate = $request->validate([
            'name' => ['required'],
            'surname' => ['required'],
            'email' => ['required', 'email'],
            'role' => ['required'],
        ]);
        $user = User::find($id);
        $user->fill($validate);
        $user->save();
        switch ($request->role) {
            case 'teacher':
                Teacher::updateOrCreate(
                    ['id' => 5, 'materia' => 'matematica', 'created_at' => now(), 'update_at' => now(),  'owner_id' => $id],
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
        return response()->json(['success' => $user]);
    }
}
