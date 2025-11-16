<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PracticalController extends Controller
{
    //
    public function managePracticals(){
        return view('practicals.managePracticals');
    }
}
