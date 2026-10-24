<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HolydayTutionController extends Controller
{
    //
public function showRegisterForm(){
    return view('holydayTutions.registerForm');
}
}
