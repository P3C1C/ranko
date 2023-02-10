<?php

namespace App\Http\Controllers;

use App\Models\Group;
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
    
    public function teacherSection()
    {
        $teachers = User::where('role', '=', 'teacher')->get();
        // $a = $teachers->teacher();
        return view('coordinators.teacherSection', ['teachers' => $teachers]);
    }

    public function classSection()
    {
        $groups = Group::all();
        $students = User::where('role', '=', 'student')->get();
        $teachers = User::where('role', '=', 'teacher')->get();
        return view('coordinators.classSection', ['groups' => $groups, 'students' => $students, 'teachers' => $teachers]);
    }

    public function studentCreate(HttpRequest $request)
    {
        $validation = $request->validate([
            'name' => ['required'],
            'surname' => ['required']
        ]);
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => strtolower($request->name) . '.' . strtolower($request->surname) . '@gmail.com',
            'password' => Hash::make(strtolower($request->name) . '.' . strtolower($request->surname)),
            'role' => 'student',
        ]);
        Student::create([
            'owner_id' => $user->id,
        ]);
        return redirect('/student-section');
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
