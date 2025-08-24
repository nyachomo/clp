<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\User;
use App\Models\Course;
use App\Models\Clas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam;
use App\Models\StudentAnswer;

use App\Models\ScholarshipLetter;
use App\Models\Setting;
use App\Models\Leed;
use Dompdf\Dompdf; // Import the Dompdf class
use Illuminate\Support\Facades\View;




class SchoolController extends Controller
{
    //

    public function index(){
        return view('schools.adminManageSchools');
    }

    public function addSchools(Request $request){
        $save=School::create($request->all());
        if($save){
            return redirect()->back()->with('success','Data saved succesfully');
        }else{
            return redirect()->back()->with('Failed','Could not saved');
        }
    }

    public function fetchSchools(Request $request) {
        $query = School::select( 'id', 'school_name','school_location','school_status')->orderBy('created_at', 'desc');


        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('school_name', 'like', '%' . $request->search . '%')
                ->orWhere('school_location', 'like', '%' . $request->search . '%')
                ->orWhere('school_status', 'like', '%' . $request->search . '%');
            });
        }
    
        // Get the number of records per page
        $perPage = $request->input('per_page', 10); // Default is 10
    
        $users = $query->paginate($perPage);
        // Append the number of students who in each school
        foreach ($users as $school) {
            $school->total_form_four_student = count(User::where('school_id', $school->id)->get());
        }

        
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


    
    public function updateSchools(Request $request)
    {
       
        $validated = $request->validate([
            'school_id' =>'required|exists:schools,id',
            'school_name' =>'string|max:255',
            'school_location' =>'string|max:255',
        ]);


        $user = School::find($request->school_id);

        if ($user) {
            // Update user details
            $user->school_name = $request->school_name;
            $user->school_location = $request->school_location;
            $user->update();
            return response()->json(['success' => true, 'message' => 'School updated successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'School not found!'], 404);
   
    }








    
    public function deleteSchools(Request $request)
    {
       
        $user = School::find($request->delete_school_id);
        if ($user) {
            $user->delete();
            return response()->json(['success' => true, 'message' => 'School deleted successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'School not found!'], 404);
   
    }


    public function suspendSchools(Request $request)
    {
       
        $user = School::find($request->suspend_school_id);
        if ($user) {
            $user->update(['school_status'=>'Suspended']);
            return response()->json(['success' => true, 'message' => 'School suspended successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'School not found!'], 404);
   
    }

    public function showFormFourLeedPerSchool(){
        $school_id=$_GET['clas_id'];
        $school=School::where('id',$school_id)->first();
        $clas_id=$_GET['clas_id'];
        $courses=Course::select('id','course_name')->get();
        $clases=Clas::select('clas_name','id')->get();
        $clas=Clas::where('is_scholarship_test_clas','Yes')->first();
        return View('schools.showFormFourLeedPerSchool',compact('courses','clases','clas','school'));

       
    }

    public function fetchFormFourLeedPerSchool(Request $request,$classId){

        $class=Clas::where('id',$classId)->first();
        $clasName= $class->clas_name;
        $query = User::with('course','clas','school')->select('id', 'firstname',
        DB::raw("COALESCE(secondname, '') as secondname"),
        DB::raw("COALESCE(lastname, '') as lastname"),
        DB::raw("COALESCE(clas_id, '') as clas_id"),
        DB::raw("COALESCE(course_id, '') as course_id"),
        'email','phonenumber','parent_phone','course_id','status','gender','clas_id','clas_category')
        ->where('school_id', $classId)
        ->whereIn('clas_category', ['Form One', 'Form Two', 'Form Three', 'Form Four'])  ->orderBy('created_at', 'desc')
        ->orderBy('created_at', 'desc');
    
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
            'clas_name'=>$clasName,
        ]);
    }



    
    public function addScholarshipTestStudentPerSchool(Request $request){
        // Generate a unique random email (retry if duplicate)
        do {
            $randomEmail = mt_rand(1000, 9999) . '@tti.co.ke';
        } while (User::where('email', $randomEmail)->exists());

        // Create and save the user
        $user = new User;
        $user->firstname = ucfirst(strtolower($request->firstname));
        $user->secondname = ucfirst(strtolower($request->secondname));
        $user->lastname = ucfirst(strtolower($request->lastname));
        $user->phonenumber = $request->phonenumber;
        $user->parent_phone = $request->parent_phone;
        $user->email = $randomEmail; // Ensured to be unique
        $user->role = "scholarship_test_student";
        $user->has_paid_reg_fee = $request->has_paid_reg_fee;
        $user->gender = $request->gender;
        $user->course_id = $request->course_id;
        $user->clas_id = $request->clas_id;
        $user->school_id = $request->school_id;
        $user->clas_category = $request->clas_category;
        $user->password = Hash::make('12345679'); 
        $save = $user->save();
        if ($save) {
            return redirect()->back()->with('success', 'Trainee created successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to create trainee.');
        }

    }


    public function updateScholarshipTestStudentPerSchool(Request $request)
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
            $user->parent_phone = $request->parent_phone;
            $user->email = $request->email;
            $user->gender = $request->gender;
            $user->clas_id = $request->update_clas_id;
            $user->course_id =$request->update_course_id;
            $user->clas_category =$request->clas_category;
            $user->update();

            return response()->json(['success' => true, 'message' => 'User updated successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'User not found!'], 404);
   
    }

    public function highSchoolTeacherViewStudent(){
        /*
        if(Auth::check()){
            if(Auth::user()->role='high_school_teacher'){
                $schools=School::where('id',Auth::user()->school_id)->select('id','school_name')->get();
                $courses=Course::where('is_scholarship_test_course','Yes')->select('course_name','id')->get();
                $clases=Clas::where('is_scholarship_test_clas','Yes')->select('clas_name','id')->get();
                return view('schools.highSchoolTeacherViewStudent',compact('courses','clases','schools'));
            }

        }*/

        if(Auth::check()&& Auth::user()->role=='High_school_teacher'){
            $schools=School::where('id',Auth::user()->school_id)->select('id','school_name')->get();
            $courses=Course::where('is_scholarship_test_course','Yes')->select('course_name','id')->get();
            $clases=Clas::where('is_scholarship_test_clas','Yes')->select('clas_name','id')->get();
            return view('schools.highSchoolTeacherViewStudent',compact('courses','clases','schools'));
        }else{
            return redirect()->route('login');
        }

        
        
    }

    public function highSchoolTeacherFetchStudent(Request $request) {
        if(Auth::check()){
             if(Auth::user()->role=="High_school_teacher"){
                $school_id=Auth::user()->school_id;

                $query = User::with('course','clas','school')->select('id', 'firstname',
                DB::raw("COALESCE(secondname, '') as secondname"),
                DB::raw("COALESCE(lastname, '') as lastname"),
                DB::raw("COALESCE(clas_id, '') as clas_id"),
                DB::raw("COALESCE(course_id, '') as course_id"),
                'email','phonenumber','parent_phone','clas_category','course_id','status','gender','clas_id','school_id')
                ->where('school_id',$school_id)->orderBy('created_at', 'desc')
                ->whereIn('clas_category', ['Form One', 'Form Two', 'Form Three', 'Form Four'])  ->orderBy('created_at', 'desc');
            
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
                foreach ($users as $student) {
                    $hasAttempted = StudentAnswer::where('user_id', $student->id)->exists();
                    
                    if ($hasAttempted) {
                        $student->total_score = StudentAnswer::where('user_id', $student->id)->sum('score');
                    } else {
                        $student->total_score = 'Not yet attempted exam';
                    }
                }
        
            
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
        }else{

        }


        
    }







    public function highSchoolTeacherEnrolStudent(Request $request){
        // Generate a unique random email (retry if duplicate)
        do {
            $randomEmail = mt_rand(1000, 9999) . '@tti.co.ke';
        } while (User::where('email', $randomEmail)->exists());

        // Create and save the user
        $user = new User;
        $user->firstname = ucfirst(strtolower($request->firstname));
        $user->secondname = ucfirst(strtolower($request->secondname));
        $user->lastname = ucfirst(strtolower($request->lastname));
        $user->phonenumber = $request->phonenumber;
        $user->parent_phone = $request->parent_phone;
        $user->email = $randomEmail; // Ensured to be unique
        $user->role = "scholarship_test_student";
        $user->has_paid_reg_fee = $request->has_paid_reg_fee;
        $user->gender = $request->gender;
        $user->course_id = $request->course_id;
        $user->clas_id = $request->clas_id;
        $user->school_id = $request->school_id;
        $user->clas_category = $request->clas_category;
        $user->password = Hash::make('12345678'); 
        $save = $user->save();
        if ($save) {
            return redirect()->back()->with('success', 'Student created successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to create student.');
        }

    }






    public function highSchoolTeacherUpdateStudent(Request $request)
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
            //$user->secondname = $request->secondname;
            $user->phonenumber = $request->phonenumber;
            $user->parent_phone = $request->parent_phone;
            $user->email = $request->email;
            //$user->course_id = $request->update_course_id;
            //$user->clas_id = $request->update_clas_id;
            $user->gender = $request->gender;
            $user->clas_category = $request->clas_category;
            $user->update();

            return response()->json(['success' => true, 'message' => 'Student updated successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'User not found!'], 404);
   
    }

    public function highSchoolTeacherViewingStudentTest(){
        return view('schools.highSchoolTeacherViewingStudentScores');
    }


    public function highSchoolTeacherFetchStudentTest(Request $request) {
        $query = Exam::with(['clas' => function($query) {
            $query->where('is_scholarship_test_clas', 'Yes');
        }])
        ->whereHas('clas', function($query) {
            $query->where('is_scholarship_test_clas', 'Yes');
        })
        ->select('id', 'exam_type', 'is_assignment', 'is_cat', 'is_final_exam', 
                 'exam_name', 'exam_start_date', 'exam_end_date', 'exam_duration', 
                 'exam_instruction', 'exam_status', 'course_id', 'clas_id')
        ->orderBy('created_at', 'desc');


        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('exam_name', 'like', '%' . $request->search . '%')
                ->orWhere('clas_id', 'like', '%' . $request->search . '%')
                ->orWhere('exam_status', 'like', '%' . $request->search . '%');
            });
        }
    
        // Get the number of records per page
        $perPage = $request->input('per_page', 10); // Default is 10
    
        $users = $query->paginate($perPage);

       
        // Append the number of students who attempted each exam
        foreach ($users as $exam) {
            $exam->attempted_students = StudentAnswer::where('exam_id', $exam->id)
                ->distinct('user_id')
                ->count();

               
            $classStudentIds = DB::table('users')
                ->where('clas_id', $exam->clas_id)
                ->where('role', 'Trainee')
                ->pluck('id'); // List of student user IDs

                // Step 2: Get IDs of students who attempted the exam
                $attemptedStudentIds = StudentAnswer::where('exam_id', $exam->id)
                ->distinct()
                ->pluck('user_id');

                // Step 3: Count students who attempted the exam
                $exam->attempted_students = $attemptedStudentIds->count();

                // Step 4: Count students who did not attempt the exam
                $unattemptedStudentIds = $classStudentIds->diff($attemptedStudentIds);
                $exam->unattempted_students = $unattemptedStudentIds->count();

        }

        //GET STUDENTS THAT HAVE NOT ATTEMPTED EXAMS
        
    
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

    public function highSchoolTeacherViewTestAttemptPage(Request $request){
        $exam_id = $request->query('exam_id'); // Get the exam ID from query parameters

        return view('schools.highSchoolTeacherViewTestAttemptPage',compact('exam_id'));
    }


    public function highSchoolTeacherFetchTestAttemptStudent(Request $request,$exam_id){

        $exam=Exam::with(['clas','course'])->where('id',$exam_id)->first();
        $ovaral_score=Question::where('exam_id',$exam_id)->sum('question_mark');
        $query = StudentAnswer::where('exam_id', $exam_id)
        ->select('user_id', 'exam_id', \DB::raw('SUM(score) as total_score')) // Get total score per user
        ->with('user:id,firstname,secondname,lastname') // Ensure user details are fetched
        ->groupBy('user_id', 'exam_id') // Group by user_id and exam_id to remove duplicates
        ->orderBy('created_at', 'asc');
   



        //$query = Question::select('id','question_name','question_mark','question_answer','exam_id')->where('exam_id',$exam_id)->orderBy('created_at', 'asc');

        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('user.firstname', 'like', '%' . $request->search . '%')
                ->orWhere('user.secondname', 'like', '%' . $request->search . '%')
                ->orWhere('user.lastname', 'like', '%' . $request->search . '%');
            });
        }
    
        // Get the number of records per page
        $perPage = $request->input('per_page', 10); // Default is 10
    
        $users = $query->paginate($perPage);
    
        return response()->json([
            'users' => $users->items(),
            'ovaral_score'=> $ovaral_score,
            'exam_name'=>$exam->exam_name,
            'clas_name'=>$exam->clas->clas_name,
            'course_name'=>$exam->course->course_name?? 'NA',
            'pagination' => [
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'total' => $users->total(),
                'per_page' => $users->perPage(),
            ],
            'total_users' => $users->total(),
            
        ]);


    }





    public function downloadPdf(Request $request)
    {
        $student = User::findOrFail($request->id);
        
        $pdf = PDF::loadView('students.pdf', compact('student'));
        return $pdf->download('student_'.$student->id.'_details.pdf');
    }


    public function highSchoolTeacherDownloadStudentScholarshipLetter(Request $request){

                //$student = User::findOrFail($request->id);
                $student=User::where('id',$request->id)->first();
                if($student->clas_category=="Form Four"){


                    $formFourLetter=ScholarshipLetter::where('category','Form Four')->select('id','form_four','date','letter_id','category','registration_deadline','start_date')->first();
                    //GET NAME OF THE PERSON THAT LOGINS 
                    $setting=Setting::latest()->first();
                    $imagePath = public_path('images/logo/' . $setting->company_logo);
                    $imageData = base64_encode(file_get_contents($imagePath));
                    $imageSrc = 'data:image/jpeg;base64,' . $imageData;
            
            
                    $imagePath2 = public_path('images/signature/hibrahim_signature.jpeg');
                    $imageData2 = base64_encode(file_get_contents($imagePath2));
                    $imageSrc2 = 'data:image/jpeg;base64,' . $imageData2;
            
                    $imagePath3 = public_path('images/stamp/official_stamp.png');
                    $imageData3 = base64_encode(file_get_contents($imagePath3));
                    $imageSrc3 = 'data:image/jpeg;base64,' . $imageData3;
            
            
                    // Load the view and pass the data
                    $html = View::make('scholarshipLetters.highSchoolTeacherDownloadFormFourScholarshipLetter', compact('imageSrc','imageSrc2','imageSrc3','formFourLetter','student'))->render();
                    //$html = View::make('fees.studentReceipt', compact(['imageSrc' => $imageSrc,'fees'=> $fees]))->render();
            
                    // Convert the view to a PDF
                    $dompdf = new \Dompdf\Dompdf();
                    $dompdf->loadHtml($html);
                    $dompdf->setPaper('A4', 'portrait');
                    $dompdf->render();
            
                    // Stream or download the PDF
                    return response($dompdf->output(), 200, [
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition' => 'attachment; filename="' . $student->firstname . '_Partial_scholarship_Letter.pdf"',
                    ]);

                    
                }else{
                    $formFourLetter=ScholarshipLetter::where('category','Lower Forms')->select('id','form_four','date','letter_id','category','registration_deadline','start_date')->first();
                    //GET NAME OF THE PERSON THAT LOGINS 
                    $setting=Setting::latest()->first();
                    $imagePath = public_path('images/logo/' . $setting->company_logo);
                    $imageData = base64_encode(file_get_contents($imagePath));
                    $imageSrc = 'data:image/jpeg;base64,' . $imageData;
            
            
                    $imagePath2 = public_path('images/signature/hibrahim_signature.jpeg');
                    $imageData2 = base64_encode(file_get_contents($imagePath2));
                    $imageSrc2 = 'data:image/jpeg;base64,' . $imageData2;
            
                    $imagePath3 = public_path('images/stamp/official_stamp.png');
                    $imageData3 = base64_encode(file_get_contents($imagePath3));
                    $imageSrc3 = 'data:image/jpeg;base64,' . $imageData3;
            
            
                    // Load the view and pass the data
                    $html = View::make('scholarshipLetters.highSchoolTeacherDownloadLowerFormsScholarshipLetter', compact('imageSrc','imageSrc2','imageSrc3','formFourLetter','student'))->render();
                    //$html = View::make('fees.studentReceipt', compact(['imageSrc' => $imageSrc,'fees'=> $fees]))->render();
            
                    // Convert the view to a PDF
                    $dompdf = new \Dompdf\Dompdf();
                    $dompdf->loadHtml($html);
                    $dompdf->setPaper('A4', 'portrait');
                    $dompdf->render();
            
                    // Stream or download the PDF
                    return response($dompdf->output(), 200, [
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition' => 'attachment; filename="' . $student->firstname . '_Partial_scholarship_Letter.pdf"',
                    ]);
    
                }
               

        }

  

}
