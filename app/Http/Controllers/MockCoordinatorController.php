<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MockCoordinatorController extends Controller
{
    public function studentSection() {
        // Mock data: dati che vengono passati alla view senza chiamare il backend
        $context = [
            "courses" => [
                (object) [
                    "name" => "Digital",
                ],
                (object) [
                    "name" => "Internaz",
                ],
            ],
            "classes" => [
                (object) [
                    "name" => "Pascal",
                ],
                (object) [
                    "name" => "Praga",
                ],
            ]
        ];

        return view('coordinators.studentSection', $context);
    }
}
