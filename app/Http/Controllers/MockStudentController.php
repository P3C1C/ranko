<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MockStudentController extends Controller
{
    public function index() {
        $context = [
            "students" => [
                (object) [
                    "name" => "Mario",
                ],
                (object) [
                    "name" => "Mauro",
                ],
            ],
        ];

        return view('students.index', $context);
    }
}
