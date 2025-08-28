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


class ClasController extends Controller
{
    //

    public function index(){
        return view('clas.adminManageClas');
    }

    public function addClas(Request $request){
        $save=Clas::create($request->all());
        if($save){
            return redirect()->back()->with('success','Data saved succesfully');
        }else{
            return redirect()->back()->with('Failed','Could not saved');
        }
    }

    public function fetchClases(Request $request) {
        $query = Clas::select( 'id', 'clas_name','clas_status', 'is_scholarship_test_clas',
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
}
