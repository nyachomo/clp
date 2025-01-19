<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\Course;
use App\Models\Clas;
use App\Models\Topic;
use App\Models\CourseModule;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class TraineeController extends Controller
{
    //

    public function index(){
        $courses=Course::select('course_name','id')->get();
        $clases=Clas::select('clas_name','id')->get();
        return view('trainees.showTrainees',compact('courses','clases'));
    }

    public function fetchTrainees(Request $request) {
        $query = User::with('course','clas')->select('id', 'firstname',
        DB::raw("COALESCE(secondname, '') as secondname"),
        DB::raw("COALESCE(lastname, '') as lastname"),
        'email','phonenumber','course_id','status','gender','clas_id')->where('role','Trainee')->orderBy('created_at', 'desc');
    
        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('firstname', 'like', '%' . $request->search . '%')
                ->orWhere('secondname', 'like', '%' . $request->search . '%')
                ->orWhere('lastname', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
    
        // Get the number of records per page
        $perPage = $request->input('per_page', 10); // Default is 10
    
        $users = $query->paginate($perPage);
    
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

    public function addTrainee(Request $request){
        $user=new User;
        $user->firstname=$request->firstname;
        $user->secondname=$request->secondname;
        $user->lastname=$request->lastname;
        $user->phonenumber=$request->phonenumber;
        $user->email=$request->email;
        $user->role="Trainee";
        $user->has_paid_reg_fee=$request->has_paid_reg_fee;
        $user->gender=$request->gender;
        $user->course_id=$request->course_id;
        $user->clas_id=$request->clas_id;
        $user->password=123456;
        $save=$user->save();
        if ($save) {
            return redirect()->back()->with('success', 'Trainee created successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to create trainee.');
        }

    }




    public function updateTrainee(Request $request)
    {
       

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'firstname' => 'required|string|max:255',
            'email' => 'required|email|max:255' . $request->user_id,
        ]);


        $user = User::find($request->user_id);

        if ($user) {
            // Update user details
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->secondname = $request->secondname;
            $user->phonenumber = $request->phonenumber;
            $user->email = $request->email;
            $user->course_id = $request->update_course_id;
            $user->clas_id = $request->update_clas_id;
            $user->gender = $request->gender;
            $user->update();

            return response()->json(['success' => true, 'message' => 'User updated successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'User not found!'], 404);
   
    }




    public function traineeViewCourse(){
        if(Auth::check()&&Auth::user()->role=='Trainee'){
          $user=Auth::user();
          $course=$user->course;
          $modules=CourseModule::select('id','module_name','module_content')->where('course_id',$course->id)->get();
          return view('trainees.traineeViewCourse',compact('course','modules'));
        }
        return redirect()->route('login');
       
    }

    public function traineeViewNotes($id){
        $module=CourseModule::where('id',$id)->select('module_name')->first();
        $topics=Topic::with('coursemodule')->select('id','topic_name','topic_content')->where('module_id',$id)->get();
        return view('trainees.traineeViewNotes',compact('topics','module'));
    }

}
