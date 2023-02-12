<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Group;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
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
        $teachers = User::join('teachers', 'teachers.owner_id', '=', 'users.id')->where('role', '=', 'teacher')->select('users.*', 'teachers.materia', 'teachers.id as id_role')->get();
        return view('coordinators.teacherSection', ['teachers' => $teachers]);
    }

    public function classSection()
    {
        $groups = Group::all();
        $courses = Course::all();
        $students = User::where('role', '=', 'student')->get();
        $teachers = User::where('role', '=', 'teacher')->get();
        return view('coordinators.classSection', ['groups' => $groups, 'courses' => $courses, 'students' => $students, 'teachers' => $teachers]);
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

    public function teacherCreate(HttpRequest $request)
    {
        $validation = $request->validate([
            'name' => ['required'],
            'surname' => ['required'],
            'materia' => ['required']
        ]);
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => strtolower($request->name) . '.' . strtolower($request->surname) . '@gmail.com',
            'password' => Hash::make(strtolower($request->name) . '.' . strtolower($request->surname)),
            'role' => 'teacher',
        ]);
        Teacher::create([
            'owner_id' => $user->id,
            'materia' => $request->materia,
        ]);
        return redirect('/teacher-section');
    }

    public function classCreate(HttpRequest $request)
    {
        $validation = $request->validate([
            'name' => ['required'],
            // 'course' => ['required'],
            'teacher' => ['required'],
            'student' => ['required']
        ]);
        if ($request->course != 0) {
            $course = Course::create([
                'nome' => $request->course,
                'coordinator_id' => Auth::user()->id,
            ]);
        } else {
            $course = $request->course;
        }
        var_dump($request->student);
        // $class = Group::create([
        //     'name' => $request->name,
        // ]);
        // Teacher::create([
        //     'owner_id' => $user->id,
        //     'materia' => $request->materia,
        // ]);
        // return redirect('/class-section');
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

    public function updateTeacher(HttpRequest $request, $id)
    {
        $validate = $request->validate([
            'name' => ['required'],
            'surname' => ['required'],
            'email' => ['required', 'email'],
            'materia' => ['required'],
        ]);
        $user = User::find($id);
        $user->fill($validate);
        $user->save();
        $teacher = Teacher::where('owner_id', '=', $id)->first();
        $teacher->materia = $request->materia;
        $teacher->save();
        return redirect('/teacher-section');
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

    public function deleteTeacher($id)
    {
        User::destroy($id);
        return redirect('/teacher-section');
    }
}
