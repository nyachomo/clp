<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScholarshipTestCourse;


class ScholarshipTestCourseController extends Controller
{
    //

    public function adminManageScholarshipTestCourse(){
        return view('scholarshipcourses.adminManageScholarshipTestCourse');
    }

    public function adminAddScholarshipTestCourse(Request $request){
        $create=ScholarshipTestCourse::create($request->all());
        if ($create) {
            return redirect()->back()->with('success', 'Course created successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to create course.');
        }
    }





    public function fetchScholarshipTestCourses(Request $request) {
        $query = ScholarshipTestCourse::select( 
       'course_code',
       'course_name',
       'course_duration',
       'course_fee',
       'course_scholarship_amount',
       'course_subsidized_fee',
       'course_monthly_installment',
       )->orderBy('created_at', 'desc');


        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('course_name', 'like', '%' . $request->search . '%')
                ->orWhere('course_code', 'like', '%' . $request->search . '%');
            });
        }
    

         
        // Get the number of records per page
        $perPage = $request->input('per_page', 10); // Default is 10
    
        $users = $query->paginate($perPage);
    
        /* Append the number of students who attempted each exam
        foreach ($users as $clas) {
            $clas->total_student = count(User::where('clas_id', $clas->id)->get());
        }*/


        return response()->json([
            'users' => $users->items(),
            'pagination' => [
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'total' => $users->total(),
                'per_page' => $users->perPage(),
            ],
            'total_users' => $users->total(),
        ]);
    }




    
}
