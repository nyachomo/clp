<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class WelcomeController extends Controller
{
    //

    public function welcome(){
        $courses=Course::where('course_status','!=','Suspended')->select('id','course_image','course_name',
        'course_duration','course_price','course_level','course_description',
        'course_two_like','course_leaners_already_enrolled')->get();
        return view('welcome',compact('courses'));
    }
}
