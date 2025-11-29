<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clas;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\School;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Course;
use App\Models\Setting;
use App\Models\Exam;
use App\Models\Fee;
use App\Models\Practical;
use App\Models\StudentAnswer;
use App\Models\JitsiMeeting;
use App\Models\Practicalanswer;
use Illuminate\Support\Facades\File;

use Dompdf\Dompdf; // Import the Dompdf class
use Illuminate\Support\Facades\View;



class ClasController extends Controller
{
    //

    public function index(){
        $suspendedClases=Clas::where('clas_status','suspended')->select('id','clas_name','clas_status');
        $allclases=Clas::select('id','clas_name')->orderBy('id','DESC')->get();
        return view('clas.adminManageClas',compact('suspendedClases','allclases'));
    }

   
    public function showSuspendedClases(){
        $suspendedClases=Clas::where('clas_status','suspended')->select('id','clas_name','clas_status');
        return view('clas.adminManageSuspendedClases',compact('suspendedClases'));
    }

    public function addClas(Request $request){
        $save=Clas::create($request->all());
        if($save){
            return redirect()->back()->with('success','Data saved succesfully');
        }else{
            return redirect()->back()->with('Failed','Could not saved');
        }
    }


    public function fetchSuspendedClases(Request $request) {
        $query = Clas::where('clas_status','Suspended')->whereIn('clas_category', ['training_class',])->select( 'id', 'clas_name','clas_status', 'is_scholarship_test_clas',
       'scholarship_test_category','clas_category')->orderBy('created_at', 'desc');


        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('clas_name', 'like', '%' . $request->search . '%')
                ->orWhere('clas_status', 'like', '%' . $request->search . '%');
            });
        }
    

         
        // Get the number of records per page
        $perPage = $request->input('per_page', 10); // Default is 10
    
        $users = $query->paginate($perPage);
    
        // Append the number of students who attempted each exam
        foreach ($users as $clas) {
            $clas->total_student = count(User::where('clas_id', $clas->id)->get());
            $clas->total_assignment=count(Exam::where('clas_id',$clas->id)->where('is_assignment','Yes')->get());
            $clas->total_cats=count(Exam::where('clas_id',$clas->id)->where('is_cat','Yes')->get());
            $clas->total_final_exam=count(Exam::where('clas_id',$clas->id)->where('is_final_exam','Yes')->get());
        }

        $suspendedClases=count(Clas::where('clas_status','Suspended')->get());


        return response()->json([
            'users' => $users->items(),
            'pagination' => [
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'total' => $users->total(),
                'per_page' => $users->perPage(),
            ],
            'total_users' => $users->total(),
            'suspendedClases'=> $suspendedClases,
        ]);
    }


    public function fetchClases(Request $request) {
        $query = Clas::where('clas_status','Active')->whereIn('clas_category', ['training_class',])->select( 'id', 'clas_name','clas_status', 'is_scholarship_test_clas',
       'scholarship_test_category','clas_category')->orderBy('created_at', 'desc');


        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('clas_name', 'like', '%' . $request->search . '%')
                ->orWhere('clas_status', 'like', '%' . $request->search . '%');
            });
        }
    

         
        // Get the number of records per page
        $perPage = $request->input('per_page', 10); // Default is 10
    
        $users = $query->paginate($perPage);
    
       
         foreach ($users as $clas) {
            $clas->total_student = count(User::where('clas_id', $clas->id)->get());
            $clas->total_practical = count(Practical::where('clas_id', $clas->id)->get());
            $clas->total_assignment=count(Exam::where('clas_id',$clas->id)->where('is_assignment','Yes')->get());
            $clas->total_cats=count(Exam::where('clas_id',$clas->id)->where('is_cat','Yes')->get());
            $clas->total_final_exam=count(Exam::where('clas_id',$clas->id)->where('is_final_exam','Yes')->get());
            $clas->total_jitsi_meeting=count(JitsiMeeting::where('clas_id',$clas->id)->get());
        }

        $suspendedClases=count(Clas::where('clas_status','Suspended')->get());


        return response()->json([
            'users' => $users->items(),
            'pagination' => [
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'total' => $users->total(),
                'per_page' => $users->perPage(),
            ],
            'total_users' => $users->total(),
            'suspendedClases'=> $suspendedClases,
          
        ]);
    }


    
    public function updateClas(Request $request)
    {
       
        $validated = $request->validate([
            'clas_id' =>'required|exists:clas,id',
            'clas_name' =>'required|string|max:255',
        ]);


        $user = Clas::find($request->clas_id);

        if ($user) {
            // Update user details
            $user->clas_name = $request->clas_name;
            $user->clas_category = $request->clas_category;
            $user->update();
            return response()->json(['success' => true, 'message' => 'Clas updated successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Clas not found!'], 404);
   
    }








    
    public function deleteClas(Request $request)
    {
       
        $user = Clas::find($request->delete_clas_id);
        if ($user) {
            $user->delete();
            return response()->json(['success' => true, 'message' => 'Class deleted successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'Class not found!'], 404);
   
    }


    public function suspendClas(Request $request)
    {
       
        $user = Clas::find($request->suspend_clas_id);
        if ($user) {
            $user->update(['clas_status'=>'Suspended']);
            return response()->json(['success' => true, 'message' => 'Class suspended successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'Class not found!'], 404);
   
    }

    public function activateClas(Request $request)
    {
       
        $user = Clas::find($request->activate_clas_id);
       
        if ($user) {
           
            $user->update(['clas_status'=>'Active']);
            return response()->json(['success' => true, 'message' => 'Class Activated successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'Class not found!'], 404);
   
    }

    public function activateAllClas2(Request $request)
    {
            Clas::update(['clas_status'=>'Active']);
            return response()->json(['success' => true, 'message' => 'All Classes Activated successfully!']);
    }


    public function activateAllClas(Request $request)
{
    try {
        // Verify CSRF token
        if (!hash_equals($request->_token, csrf_token())) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid CSRF token'
            ], 403);
        }

        // Start database transaction
        DB::beginTransaction();

        // Update all classes
        $affectedRows = Clas::query()->update(['clas_status' => 'Active']);

        // Commit transaction
        DB::commit();

        return response()->json([
            'success' => true,
            'message' => "Successfully activated {$affectedRows} classes!",
            'affected_rows' => $affectedRows
        ]);

    } catch (\Exception $e) {
        // Rollback transaction on error
        DB::rollBack();
        
        return response()->json([
            'success' => false,
            'message' => 'Failed to activate classes: ' . $e->getMessage()
        ], 500);
    }
}



    public function getStudents2(Request $request,$classId)
        {
         
               $clas=Clas::where('id',$classId)->first();
               $clasName=$clas->clas_name;
                // Query users with school relationship
                $query = User::with('school') ->where('role','=','Trainee')->where('clas_id', $classId)
                ->select('users.id', 'users.firstname',
                    DB::raw("COALESCE(users.secondname, '') as secondname"),
                    DB::raw("COALESCE(users.lastname, '') as lastname"),
                    'users.email', 'users.phonenumber', 'users.role', 
                    'users.status', 'users.gender', 'users.school_id'
                )
                ->leftJoin('schools', 'users.school_id', '=', 'schools.id') // Join schools table
                ->orderBy('users.created_at', 'desc')->get();


                $total_students=$query->count();
                return response()->json([
                'users' => $query,
                'clasName'=>$clasName,
                'total_students'=>$total_students,
                'alumni_clas_id'=>$classId,
                ]);




        }





public function getStudents(Request $request,$classId) {
    $class=
    $query = User::with('course','clas')->select('id', 'firstname',
    DB::raw("COALESCE(secondname, '') as secondname"),
    DB::raw("COALESCE(lastname, '') as lastname"),
    DB::raw("COALESCE(clas_id, '') as clas_id"),
    DB::raw("COALESCE(course_id, '') as course_id"),
    'email','phonenumber','course_id','status','gender','clas_id')->where('role','Trainee') ->where('has_paid_reg_fee','Yes')->where('clas_id', $classId)->orderBy('created_at', 'desc');

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







        //DOWNLOAD STUDENTS PER CLASS EXCEL
        public function downloadStudentPerClassExcel(Request $request){

            $users = User::where('role','Trainee')->where('clas_id',$request->excel_clas_id)->get();

            // Create a new spreadsheet
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Set the header row
            $sheet->setCellValue('A1', 'Firstname');
            $sheet->setCellValue('B1', 'Secondname');
            $sheet->setCellValue('C1', 'Lastname');
            $sheet->setCellValue('D1', 'Email');
            $sheet->setCellValue('E1', 'Phonenumber');
            $sheet->setCellValue('F1', 'Gender');
            $sheet->setCellValue('G1', 'Role');

            // Fill data from the users table
            $row = 2; // Start from the second row
            foreach ($users as $user) {
                $sheet->setCellValue('A' . $row, $user->firstname);
                $sheet->setCellValue('B' . $row, $user->secondname);
                $sheet->setCellValue('C' . $row, $user->lastname);
                $sheet->setCellValue('D' . $row, $user->email);
                $sheet->setCellValue('E' . $row, $user->phonenumber);
                $sheet->setCellValue('F' . $row, $user->gender);
                $sheet->setCellValue('G' . $row, $user->role);
                $row++;
            }

            // Write to a temporary file
            $writer = new Xlsx($spreadsheet);
            $fileName = 'users.xlsx';
            $tempFilePath = sys_get_temp_dir() . '/' . $fileName;
            $writer->save($tempFilePath);

            // Return the file as a download
            return Response::download($tempFilePath, $fileName)->deleteFileAfterSend(true);

            

        }


        public function markedStudentAsAlumni(Request $request){
            $user = User::where('clas_id',$request->alumni_clas_id)->update(['status'=>'Alumni']);
            if ($user) {
                return response()->json(['success' => true, 'message' => 'All Students Are Marked Allumni']);
            }
            return response()->json(['success' => false, 'message' => 'Class not found!'], 404);
            
        }

        public function classRoom(){
            return view('clas.classRoom');
        }


        public function adminManagePrograms(){
            return view('programs.adminManagePrograms');
        }


        public function fetchPrograms(Request $request) {
            $query = Clas::whereIn('clas_category',['ict_club_class','scholarship_test_class','event_class','referal_class'])->select( 'id', 'clas_name','clas_status', 'is_scholarship_test_clas',
           'scholarship_test_category','clas_category')->orderBy('created_at', 'desc');
    
    
            // Apply search filter if provided
            if ($request->has('search') && !empty($request->search)) {
                $query->where(function($q) use ($request) {
                    $q->where('clas_name', 'like', '%' . $request->search . '%')
                    ->orWhere('clas_status', 'like', '%' . $request->search . '%');
                });
            }
        
    
             
            // Get the number of records per page
            $perPage = $request->input('per_page', 10); // Default is 10
        
            $users = $query->paginate($perPage);
        
            // Append the number of students who attempted each exam
            foreach ($users as $clas) {
                $clas->total_student = count(User::where('clas_id', $clas->id)->get());
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


        public function showAssignmentPerClas(){
            $clas_id=$_GET['clas_id'];
            $clas=Clas::where('id',$clas_id)->select('id','clas_name')->first();
            $clases=Clas::select('id','clas_name')->get();
            return view('exams.showAssignmentPerClas',compact('clas','clases'));
        }

           public function showPracticalPerClas(){
            $clas_id=$_GET['clas_id'];
            $clas=Clas::where('id',$clas_id)->select('id','clas_name')->first();
            $clases=Clas::select('id','clas_name')->get();
            return view('practicals.showPracticalPerClas',compact('clas','clases'));
        }

        public function addPracticalPerClas(Request $request){
            /*
            $create=Practical::create([
                'clas_id'=>$request->clas_id,
                'marks'=>$request->marks,
                'question'=>$request->question,
                'status'=>$request->status
            ]);

            if ($create) {
                return redirect()->back()->with('success', 'Practical created successfully!');
                } else {
                return redirect()->back()->with('error', 'Failed to create .');
            }
            */


            if($request->hasFile('question')){
             $file=$request->file('question');
             $extension=$file->getClientOriginalExtension();
             $question=time().'.'.$extension;
             $file->move(public_path('practicals'),$question);
             
                $create=Practical::create([
                    'clas_id'=>$request->clas_id,
                    'marks'=>$request->marks,
                    'question'=>$question,
                    'name'=>$request->name,
                    'status'=>$request->status
                ]);

                if($create){
                    return redirect()->back()->with('success', 'Practical created successfully!');
                }else{
                    return redirect()->back()->with('error', 'Failed to create .');
                }
         }else{
             return redirect()->back()->with('error', 'No file selected .');
         }


        }

       


        public function showCatsPerClas(){
            $clas_id=$_GET['clas_id'];
            $clas=Clas::where('id',$clas_id)->select('id','clas_name')->first();
            $clases=Clas::select('id','clas_name')->get();
            return view('exams.showCatsPerClas',compact('clas','clases'));
        }

        public function showFinalExamPerClas(){
            $clas_id=$_GET['clas_id'];
            $clas=Clas::where('id',$clas_id)->select('id','clas_name')->first();
            $clases=Clas::select('id','clas_name')->get();
            return view('exams.showFinalExamPerClas',compact('clas','clases'));
        }


        public function fetchPracticalPerClas(Request $request,$classId) {
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
            foreach ($users as $exam) {
                $exam->attempted_students = Practicalanswer::where('practical_id', $exam->id)
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


        public function fetchAssignmentPerClas(Request $request,$classId) {
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
            ->where('clas_id',$classId)
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


        public function fetchCatsPerClas(Request $request,$classId) {
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
            ->where('clas_id',$classId)
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


        public function fetchFinalExamPerClas(Request $request,$classId) {
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
            ->where('clas_id',$classId)
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




    public function updatePracticalPerClas(Request $request)
    {
       
        $validated = $request->validate([
            'practical_id' =>'required|exists:practicals,id',
            'marks' =>'string|max:255',
             'practical_name' =>'string|max:255',
        ]);


        $user = Practical::find($request->practical_id);

        if ($user) {
            // Update user details
            $user->marks = $request->marks;
            $user->name = $request->practical_name;
           
            $user->update();
            return response()->json(['success' => true, 'message' => 'Exam updated successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Could not update !'], 404);
   
    }



  



    public function deletePracticalPerClas(Request $request)
    {
        $validated = $request->validate([
            'delete_practical_id' =>'required|exists:practicals,id',
        ]);

        $practical = Practical::find($request->delete_practical_id);

        if ($practical) {

            // Get the file name stored in DB (question column)
            $fileName = $practical->question;

            // Full path to the file inside public/practical/
            $filePath = public_path('practicals/' . $fileName);

            // Delete file if it exists
            if (file_exists($filePath)) {
                File::delete($filePath);
            // unlink($filePath);  // OR use File::delete()
            }

            // Delete the database row
            $practical->delete();

            return response()->json(['success' => true, 'message' => 'Practical and PDF deleted successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Could not delete!'], 404);
    }

    public function updatePracticalQuestion(Request $request)
    {
        $validated = $request->validate([
            'update_question_id' =>'required|exists:practicals,id',
        ]);

        $practical = Practical::find($request->update_question_id);

        if ($practical) {

            // Get the file name stored in DB (question column)
            $fileName = $practical->question;

            // Full path to the file inside public/practical/
            $filePath = public_path('practicals/' . $fileName);

            // Delete file if it exists
            if (file_exists($filePath)) {
                File::delete($filePath);
            
            }

            if($request->hasFile('update_question')){
                $file=$request->file('update_question');
                $extension=$file->getClientOriginalExtension();
                $question=time().'.'.$extension;
                $file->move(public_path('practicals'),$question);
                
                $delete=Practical::where('id',$request->update_question_id)->update([
                    'question'=>$question,
                ]);

                if($delete){
                    return redirect()->back()->with('success', 'Practical updated successfully!');
                }else{
                    return redirect()->back()->with('error', 'Failed to update .');
                }
            }else{
                return redirect()->back()->with('error', 'No file selected .');
            }



            // Delete the database row
            //$practical->delete();

            return response()->json(['success' => true, 'message' => 'Practical and PDF deleted successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Could not delete!'], 404);
    }

    




     public function downloadFeeBalance(Request $request){

        //Validate at least one checkbox is selected
            $request->validate([
                'clas_id' => 'required|array',
            ]);

            // Get selected class IDs
            $classIds = $request->clas_id;

            // Fetch students whose class_id is in the selected list
           // $students = User::with('clas')->whereIn('clas_id', $classIds)->get();

          


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


        // Fetch all records from the `fees` table
       $trainees= User::with('course','clas','school')->whereIn('clas_id', $classIds)->select('id', 'firstname',
        DB::raw("COALESCE(secondname, '') as secondname"),
        DB::raw("COALESCE(lastname, '') as lastname"),
        DB::raw("COALESCE(clas_id, '') as clas_id"),
        DB::raw("COALESCE(course_id, '') as course_id"),
        'email','phonenumber','course_id','gender','clas_id','parent_phone','clas_category')
        ->orderBy('created_at', 'desc')
        ->get();
    
        
        $total_students=$trainees->count();
       
        

        // Load the view and pass the data
        $html = View::make('clas.downloadFeeBalancePerClas', compact('imageSrc', 'trainees','imageSrc2','imageSrc3','total_students'))->render();
        //$html = View::make('fees.studentReceipt', compact(['imageSrc' => $imageSrc,'fees'=> $fees]))->render();

        // Convert the view to a PDF
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Stream or download the PDF
        return response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="students_Fee.pdf"',
        ]);




        

    }




}
