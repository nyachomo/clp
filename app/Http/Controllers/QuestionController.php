<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //

    public function adminManageQuestions(Request $request){
        $examId = $request->query('exam_id'); // Get the exam ID from query parameters
       
        return view('questions.adminManageQuestions');
    }
}
