<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

    public function updateRole(){
        
    }
}
