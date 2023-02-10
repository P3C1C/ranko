<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Hash;

class CoordinatorController extends Controller
{
    public function guestSection()
    {
        $guests = User::where('role', '=', 'guest')->get();
        return view('coordinators.guestSection', ['guests' => $guests]);
    }

    public function studentSection()
    {
        $students = User::where('role', '=', 'student')->get();
        return view('coordinators.studentSection', ['students' => $students]);
    }
    public function studentCreate(HttpRequest $request)
    {
        $validation = $request->validate([
            'name' => ['required'],
            'surname' => ['required']
        ]);
        User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->name.'.'.$request->surname.'@gmail.com',
            'password' => Hash::make($request->name.'.'.$request->surname),
            'role' => 'student',
        ]);
        $students = User::where('role', '=', 'student')->get();
        return view('coordinators.studentSection', ['students' => $students]);
    }

    public function updateGuest(HttpRequest $request, $id)
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
                Teacher::create(
                    [
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

    public function updateStudent(HttpRequest $request, $id)
    {
        $validate = $request->validate([
            'name' => ['required'],
            'surname' => ['required'],
            'email' => ['required', 'email'],
        ]);
        $user = User::find($id);
        $user->fill($validate);
        $user->save();
        return redirect('/student-section');
        // return response()->json(['success' => $user]);
    }

    public function deleteGuest($id)
    {
        User::destroy($id);
        return redirect('/guest-section');
    }
    public function deleteStudent($id)
    {
        User::destroy($id);
        return redirect('/student-section');
    }
}
