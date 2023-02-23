<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function valutationDetail($valutation){
        return view('students.valutationDetail', ['valutation' => $valutation]);
    }
}
