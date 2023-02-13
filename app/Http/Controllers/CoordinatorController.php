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
        $students = User::join('students', 'users.id', '=', 'students.owner_id')->join('groups', 'groups.id', '=', 'students.group_id')->join('courses', 'courses.id', '=', 'groups.course_id')->where('role', '=', 'student')
        ->select('users.id', 'users.name', 'users.surname', 'users.email', 'groups.nome as classe', 'courses.nome as corso')->get();
        return view('coordinators.studentSection', ['students' => $students]);
    }

    public function teacherSection()
    {
        $teachers = User::join('teachers', 'teachers.owner_id', '=', 'users.id')->where('role', '=', 'teacher')->select('users.*', 'teachers.materia', 'teachers.id as id_role')->get();
        return view('coordinators.teacherSection', ['teachers' => $teachers]);
    }

    public function classSection()
    {
        $groups = Group::join('courses', 'courses.id', '=', 'groups.course_id')->select('groups.*', 'courses.nome as corso')->get();
        $courses = Course::all();
        $students = User::where('role', '=', 'student')->get();
        $teachers = User::where('role', '=', 'teacher')->get();
        return view('coordinators.classSection', ['groups' => $groups, 'courses' => $courses, 'students' => $students, 'teachers' => $teachers]);
    }
    
    public function classDetail($id)
    {
        $students = User::join('students', 'users.id', '=', 'students.owner_id')->join('groups', 'groups.id', '=', 'students.group_id')->where('students.group_id', '=', $id)
        ->select('students.id', 'users.name', 'users.surname', 'users.email', 'groups.nome as classe')->get();
        return view('coordinators.classDetail', ['students' => $students]);
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
            ])->id;
        } else {
            $course = $request->course_ex;
        }
        $class = Group::create([
            'nome' => $request->name,
            'course_id' => $course,
        ]);
        $teachers = explode(',', $request->teacher);
        foreach ($teachers as $key => $teacher) {
            $teach = Teacher::where('owner_id', '=', $teacher)->first();
            $teach->groups()->attach([$class->id]);
        }
        $students = explode(',', $request->student);
        foreach ($students as $student) {
            Student::where('owner_id', $student)->update(['group_id' => $class->id]);
        }
        return redirect('/class-section');
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
    public function deleteClass($id)
    {
        Group::destroy($id);
        return redirect('/class-section');
    }
}
