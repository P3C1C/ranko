<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $student_id = Auth::user()->id;
        $richiesta = ModelsRequest::join('groups', 'groups.id', '=', 'requests.group_id')->join('students', 'students.group_id', '=', 'groups.id')->join('users', 'users.id', '=', 'students.owner_id')
        ->where('users.id', '=', $student_id)->select('groups.id as group_id', 'students.id as student_id', 'requests.id as request_id')->get();
        return view('home', ['requests' => $richiesta]);
    }
}
