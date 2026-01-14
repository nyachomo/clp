<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Clas;
use App\Models\StudentAnswer;
use App\Models\Question;
use App\Models\Practical;
use App\Models\Practicalanswer;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Setting;
use Dompdf\Dompdf; // Import the Dompdf class
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    //

    public function index(){
        $clas=Clas::select('id','clas_name')->get();
        return view('exams.adminManageExams',compact('clas'));
    }

    public function adminManageCats(){
        $clas=Clas::select('id','clas_name')->get();
        return view('exams.adminManageCats',compact('clas'));
    }

    public function adminManageFinalExam(){
        $clas=Clas::select('id','clas_name')->get();
        return view('exams.adminManageFinalExam',compact('clas'));
    }

    public function addAssignment(Request $request){
        $save=Exam::create($request->all());
        if($save){
            return redirect()->back()->with('success','Data saved succesfully');
        }else{
            return redirect()->back()->with('Failed','Could not saved');
        }
    }

    /*
    public function fetchAssignments(Request $request) {
        $query = Exam::with('clas')->select( 'id',  'exam_type',
        'is_assignment',
        'is_cat',
        'is_final_exam',
        'exam_name',
        'exam_start_date',
        'exam_end_date',
        'exam_duration',
        'exam_instruction',
        'exam_status',
        'course_id',
        'clas_id')
        ->where('is_assignment','Yes')
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

    */


    public function fetchAssignments(Request $request) {
        $query = Exam::with('clas')->select( 'id',  'exam_type',
        'is_assignment',
        'is_cat',
        'is_final_exam',
        'exam_name',
        'exam_start_date',
        'exam_end_date',
        'exam_duration',
        'exam_instruction',
        'exam_status',
        'course_id',
        'clas_id')
        ->where('is_assignment','Yes')
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


    public function fetchCats(Request $request) {
        $query = Exam::with('clas')->select( 'id',  'exam_type',
        'is_assignment',
        'is_cat',
        'is_final_exam',
        'exam_name',
        'exam_start_date',
        'exam_end_date',
        'exam_duration',
        'exam_instruction',
        'exam_status',
        'course_id',
        'clas_id')
        ->where('is_cat','Yes')
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


    public function showExamAttempts(Request $request){

        $exam_id = $request->query('exam_id'); // Get the exam ID from query parameters

        return view('exams.showExamAttempts',compact('exam_id'));
    }



    /*
    public function showPracticalAttempts(Request $request){

        $exam_id = $request->query('exam_id'); // Get the exam ID from query parameters
        $exam=Practical::with(['clas'])->where('id',$exam_id)->first();
        $student_in_practical_answer=Practicalanswer::where('practical_id', $exam_id)->pluck('user_id');
        $students=User::where('clas_id',$exam->clas->id)->get();

        return view('practicals.showPracticalAttempts',compact('exam_id','students'));
    }


    */



    public function showPracticalAttempts(Request $request)
    {
        $exam_id = $request->query('exam_id'); 

        // Get the exam and its class
        $exam = Practical::with('clas')->findOrFail($exam_id);

        // Get IDs of students who have already submitted answers
        $submitted_student_ids = Practicalanswer::where('practical_id', $exam_id)
            ->pluck('user_id')
            ->toArray();

        // Fetch students who belong to the class AND are NOT in submitted list
        $students = User::where('clas_id', $exam->clas->id)
            ->whereNotIn('id', $submitted_student_ids)
            ->get();

        return view('practicals.showPracticalAttempts', compact('exam_id', 'students'));
    }



    public function fetchExamAttempts(Request $request,$exam_id){

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
        $perPage = $request->input('per_page', 1000); // Default is 10
    
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


     public function fetchPracticalAttempts(Request $request,$exam_id){

        $exam=Practical::with(['clas'])->where('id',$exam_id)->first();
        $ovaral_score=Practical::where('id',$exam_id)->sum('marks');
        $query = Practicalanswer::with('user')->where('practical_id', $exam_id)
        ->select('id','user_id', 'practical_id','student_answer','student_score') // Get total score per user
        ->with('user:id,firstname,secondname,lastname') // Ensure user details are fetched
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
        $perPage = $request->input('per_page', 1000); // Default is 10
    
        $users = $query->paginate($perPage);
    
        return response()->json([
            'users' => $users->items(),
            'exam_name'=>$exam->name,
            'ovaral_score'=> $ovaral_score,
            'clas_name'=>$exam->clas->clas_name,
            'pagination' => [
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'total' => $users->total(),
                'per_page' => $users->perPage(),
            ],
            'total_users' => $users->total(),
            
        ]);


    }



    public function fetchFinalExam(Request $request) {
        $query = Exam::with('clas')->select( 'id',  'exam_type',
        'is_assignment',
        'is_cat',
        'is_final_exam',
        'exam_name',
        'exam_start_date',
        'exam_end_date',
        'exam_duration',
        'exam_instruction',
        'exam_status',
        'course_id',
        'clas_id')
        ->where('is_final_exam','Yes')
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



    
    public function updateExams(Request $request)
    {
       
        $validated = $request->validate([
            'exam_id' =>'required|exists:exams,id',
            'exam_name' =>'string|max:255',
            'exam_status' =>'string|max:255',
            'exam_start_date' =>'string|max:255',
            'exam_end_date' =>'string|max:255',
            'exam_duration' =>'string|max:255',
        ]);


        $user = Exam::find($request->exam_id);

        if ($user) {
            // Update user details
            $user->exam_name = $request->exam_name;
            $user->exam_start_date = $request->exam_start_date;
            $user->exam_end_date = $request->exam_end_date;
            $user->exam_duration = $request->exam_duration;
            $user->exam_status = $request->update_exam_status;
            $user->clas_id = $request->update_clas_id;
            $user->update();
            return response()->json(['success' => true, 'message' => 'Assignment updated successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'School not found!'], 404);
   
    }








    
    public function deleteExams(Request $request)
    {
       
        $user = Exam::find($request->delete_exam_id);
        if ($user) {
            $user->delete();
            return response()->json(['success' => true, 'message' => 'Exam deleted successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'Exam not found!'], 404);
   
    }


    public function publishedExams(Request $request)
    {
       
        $user = Exam::find($request->published_exam_id);
        if ($user) {
            $user->update(['exam_status'=>'Published']);
            return response()->json(['success' => true, 'message' => 'Exam published successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'Exam not found!'], 404);
   
    }






    public function notpublishedExams(Request $request)
    {
       
        $user = Exam::find($request->notpublished_exam_id);
        if ($user) {
            $user->update(['exam_status'=>'Not Published']);
            return response()->json(['success' => true, 'message' => 'Exam Unpublished successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'Exam not found!'], 404);
   
    }


    public function adminAddStudentPracticalScore(Request $request){
        $create=Practicalanswer::create([
            'practical_id'=>$request->practical_id,
            'user_id'=>$request->user_id,
            'student_answer'=>$request->student_answer ?? 'NA',
            'student_score'=>$request->student_score,
        ]);
        if ($create) {
            return redirect()->back()->with('success','Score added succesfully');
        }
        return redirect()->back()->with('error','Could not add score');
    }




    
    public function adminDeleteStudentPracticalScore(Request $request)
    {
       
        $user = Practicalanswer::find($request->delete_clas_id);
        if ($user) {
            $user->delete();
            return response()->json(['success' => true, 'message' => 'Class deleted successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'Class not found!'], 404);
   
    }


      
    public function adminUpdateStudentPracticalScore(Request $request)
    {
       
        $user = Practicalanswer::find($request->update_answer_id);
        if ($user) {
            $user->update(['student_score'=>$request->student_score]);
            return response()->json(['success' => true, 'message' => 'Score Updated successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'Could not update!'], 404);
   
    }



     public function downloadPracticalScore($exam_id){
          
                  
                    //GET NAME OF THE PERSON THAT LOGINS 
                    $exam=Practical::with('clas')->where('id',$exam_id)->first();
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


                     $students = Practicalanswer::with('user')->where('practical_id', $exam_id)
                    ->select('id','user_id', 'practical_id','student_answer','student_score') // Get total score per user
                    ->with('user:id,firstname,secondname,lastname,course_id','user.course:id,course_name' ) // Ensure user details are fetched
                    ->orderBy('created_at', 'asc')->get();
                     $ovaral_score=Practical::where('id',$exam_id)->sum('marks');
        
            
                    // Load the view and pass the data
                    $html = View::make('practicals.downloadPracticalScore', compact('ovaral_score','imageSrc','imageSrc2','imageSrc3','exam','students'))->render();
                    //$html = View::make('fees.studentReceipt', compact(['imageSrc' => $imageSrc,'fees'=> $fees]))->render();
            
                    // Convert the view to a PDF
                    $dompdf = new \Dompdf\Dompdf();
                    $dompdf->loadHtml($html);
                    $dompdf->setPaper('A4', 'portrait');
                    $dompdf->render();
            
                    // Stream or download the PDF
                    return response($dompdf->output(), 200, [
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition' => 'attachment; filename="' . $exam->name . '.pdf"',
                    ]);



    }




    public function studentViewPracticalScore(){
        if(Auth::check()){
            $clas=Clas::where('id',Auth::user()->clas_id)->first();
             return view ('practicals.studentViewPracticalScore',compact('clas'));
        }
       
    }


    public function studentFetchPracticalScore_old(Request $request) {
            $classId=Auth::user()->clas_id;
            $query = Practical::with('clas')
            ->select( 'id',  'question','clas_id','marks','status','name')
            ->where('clas_id',$classId)
            ->orderBy('created_at', 'desc');
    
    
            // Apply search filter if provided
            if ($request->has('search') && !empty($request->search)) {
                $query->where(function($q) use ($request) {
                    $q->where('marks', 'like', '%' . $request->search . '%')
                    ->orWhere('clas_id', 'like', '%' . $request->search . '%')
                    ->orWhere('name', 'like', '%' . $request->search . '%')
                    ->orWhere('question', 'like', '%' . $request->search . '%')
                    ->orWhere('status', 'like', '%' . $request->search . '%');
                });
            }
        
            // Get the number of records per page
            $perPage = $request->input('per_page', 10); // Default is 10
        
            $users = $query->paginate($perPage);
    
            // Append the number of students who attempted each exam
            /*
            foreach ($users as $exam) {
                $exam->attempted_students = Practicalanswer::where('practical_id', $exam->id)
                    ->where('user_id',Auth::user()->id)
                   ->first();
            }
             */

            foreach ($users as $exam) {
                $record = Practicalanswer::where('practical_id', $exam->id)
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'asc')   // ensure consistent first record
                    ->first();

                $exam->student_answer = $record ? $record->student_answer : null;
                $exam->student_score = $record ? $record->student_score : null;

                $exam->student_multiple_choice_score=StudentAnswer::where('user_id', Auth::user()->id)->where('practical_id',$exam->id)->sum('score');

                $exam->has_done_practical = Practicalanswer::where('practical_id', $exam->id)
                    ->where('user_id', Auth::id())
                    ->exists();

                $exam->has_done_theory = StudentAnswer::where('practical_id', $exam->id)
                    ->where('user_id', Auth::id())
                    ->exists();
                   
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




        public function studentFetchPracticalScore3(Request $request){

            $userId  = Auth::id();
            $classId = Auth::user()->clas_id;

            $query = Practical::with('clas')
                ->select('id', 'question', 'clas_id', 'marks', 'status', 'name')
                ->where('clas_id', $classId)
                ->orderBy('created_at', 'desc');

            // Search filter
            if (!empty($request->search)) {
                $query->where(function ($q) use ($request) {
                    $q->where('marks', 'like', '%' . $request->search . '%')
                    ->orWhere('name', 'like', '%' . $request->search . '%')
                    ->orWhere('question', 'like', '%' . $request->search . '%')
                    ->orWhere('status', 'like', '%' . $request->search . '%');
                });
            }

            $perPage = $request->input('per_page', 10);
            $users   = $query->paginate($perPage);

            foreach ($users as $exam) {

                // PRACTICAL ANSWER (one record)
                $practical = Practicalanswer::where('practical_id', $exam->id)
                    ->where('user_id', $userId)
                    ->orderBy('id', 'asc')
                    ->first();

                // THEORY SCORE
                $theoryScore = StudentAnswer::where('practical_id', $exam->id)
                    ->where('user_id', $userId)
                    ->sum('score');

                // Attach student data
                $exam->student_answer = $practical?->student_answer;
                $exam->student_score  = $practical?->student_score;
                $exam->student_multiple_choice_score = $theoryScore;

                // Flags
                $exam->has_done_practical = !is_null($practical);
                $exam->has_done_theory    = $theoryScore > 0;

                // FINAL STATUS (used by frontend)
                if ($exam->question) {
                    // Practical exam
                    $exam->student_status = $exam->has_done_practical
                        ? 'Submitted'
                        : 'Pending';
                } else {
                    // Theory exam
                    $exam->student_status = $exam->has_done_theory
                        ? 'Attempted'
                        : 'Pending';
                }
            }

            return response()->json([
                'users' => $users->items(),
                'pagination' => [
                    'current_page' => $users->currentPage(),
                    'last_page'    => $users->lastPage(),
                    'total'        => $users->total(),
                    'per_page'     => $users->perPage(),
                ],
                'total_users' => $users->total(),
            ]);
            }


            public function studentFetchPracticalScore(Request $request)
{
    $userId  = Auth::id();
    $classId = Auth::user()->clas_id;

    $query = Practical::with('clas')
        ->select('id', 'question', 'clas_id', 'marks', 'status', 'name')
        ->where('clas_id', $classId)
        ->orderBy('created_at', 'desc');

    // Search filter
    if (!empty($request->search)) {
        $query->where(function ($q) use ($request) {
            $q->where('marks', 'like', '%' . $request->search . '%')
              ->orWhere('name', 'like', '%' . $request->search . '%')
              ->orWhere('question', 'like', '%' . $request->search . '%')
              ->orWhere('status', 'like', '%' . $request->search . '%');
        });
    }

    $perPage = $request->input('per_page', 10);
    $users   = $query->paginate($perPage);

    foreach ($users as $exam) {

        /*
        |--------------------------------------------------------------------------
        | PRACTICAL ANSWER
        |--------------------------------------------------------------------------
        */
        $practical = Practicalanswer::where('practical_id', $exam->id)
            ->where('user_id', $userId)
            ->orderBy('id', 'asc')
            ->first();

        /*
        |--------------------------------------------------------------------------
        | THEORY ANSWERS
        |--------------------------------------------------------------------------
        */
        $theoryScore = StudentAnswer::where('practical_id', $exam->id)
            ->where('user_id', $userId)
            ->sum('score');

        $hasTheoryAttempt = StudentAnswer::where('practical_id', $exam->id)
            ->where('user_id', $userId)
            ->exists();

        /*
        |--------------------------------------------------------------------------
        | ATTACH STUDENT DATA
        |--------------------------------------------------------------------------
        */
        $exam->student_answer = $practical?->student_answer;
        $exam->student_score  = $practical?->student_score;
        $exam->student_multiple_choice_score = $theoryScore;

        /*
        |--------------------------------------------------------------------------
        | FLAGS
        |--------------------------------------------------------------------------
        */
        $exam->has_done_practical = !is_null($practical);
        $exam->has_done_theory    = $hasTheoryAttempt;

        /*
        |--------------------------------------------------------------------------
        | DETECT THEORY vs PRACTICAL
        |--------------------------------------------------------------------------
        */
        $isTheory = empty($exam->question) || $exam->question === 'NA';

        /*
        |--------------------------------------------------------------------------
        | FINAL STATUS (USED BY FRONTEND)
        |--------------------------------------------------------------------------
        */
        if ($isTheory) {
            // THEORY EXAM
            $exam->student_status = $exam->has_done_theory
                ? 'Attempted'
                : 'Pending';
        } else {
            // PRACTICAL EXAM
            $exam->student_status = $exam->has_done_practical
                ? 'Submitted'
                : 'Pending';
        }
    }

    return response()->json([
        'users' => $users->items(),
        'pagination' => [
            'current_page' => $users->currentPage(),
            'last_page'    => $users->lastPage(),
            'total'        => $users->total(),
            'per_page'     => $users->perPage(),
        ],
        'total_users' => $users->total(),
    ]);
}






        public function studentUploadPracticalWork2(Request $request){

            if ($request->hasFile('student_answer')) {

                // Handle file upload
                $file = $request->file('student_answer');
                $extension = $file->getClientOriginalExtension();
                $student_answer = time().'.'.$extension;
                $file->move(public_path('practicals'), $student_answer);

                // Check if the record exists
                $record = Practicalanswer::where('practical_id', $request->practical_id)
                    ->where('user_id', Auth::user()->id)
                    ->first();

                if ($record) {
                    // Update existing record
                    $record->update([
                        'student_answer' => $student_answer,
                    ]);

                    return redirect()->back()->with('success', 'Practical updated successfully!');
                } else {
                    // Create a new record
                    Practicalanswer::create([
                        'practical_id' => $request->practical_id,
                        'user_id' => Auth::user()->id,
                        'student_answer' => $student_answer,
                    ]);

                    return redirect()->back()->with('success', 'Practical submitted successfully!');
                }

            } else {
                return redirect()->back()->with('error', 'No file selected.');
            }
        }



        public function studentUploadPracticalWork(Request $request){
           
                if ($request->hasFile('student_answer')) {

                    // Handle file upload
                    $file = $request->file('student_answer');
                    $extension = $file->getClientOriginalExtension();
                    $student_answer = time().'.'.$extension;
                    $file->move(public_path('practicals'), $student_answer);

                    // Check if the record exists
                    $record = Practicalanswer::where('practical_id', $request->practical_id)
                        ->where('user_id', Auth::user()->id)
                        ->first();

                    if ($record) {
                        // Delete old file if exists
                        $oldFile = public_path('practicals/'.$record->student_answer);
                        if (file_exists($oldFile)) {
                            unlink($oldFile);
                        }

                        // Update existing record
                        $record->update([
                            'student_answer' => $student_answer,
                        ]);

                        return redirect()->back()->with('success', 'Practical updated successfully!');
                    } else {
                        // Create a new record
                        Practicalanswer::create([
                            'practical_id' => $request->practical_id,
                            'user_id' => Auth::user()->id,
                            'student_answer' => $student_answer,
                        ]);

                        return redirect()->back()->with('success', 'Practical submitted successfully!');
                    }

                } else {
                    return redirect()->back()->with('error', 'No file selected.');
                }
        }







}
