<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Clas;
use App\Models\TimeTable;
use App\Models\ClassNotes;
use Carbon\Carbon;
use App\Models\Course;
use App\Models\Fee;
use App\Models\Exam;
use App\Models\StudentAnswer;
use App\Models\Topic;
use App\Models\Question;
use App\Models\CourseModule;
use App\Models\ScholarshipLetter;
use App\Models\Setting;
use App\Models\Leed;

use Dompdf\Dompdf; // Import the Dompdf class
use Illuminate\Support\Facades\View;

class BackendController extends Controller
{
    //
    public function index(){
        $schools=School::select("id","school_name")->get();
        return view('users.showAdministrators',compact('schools'));
    }

    public function fetchUserProfile(){
        $user = Auth::user()->load('course', 'clas'); // Load relationships
        return response()->json([
            'user' => $user
        ]);
        }

    public function userProfile($id){

    }


    
    public function adminFetchUsers1(Request $request) {
        $query = User::with('school')->select('id', 'firstname',
        DB::raw("COALESCE(secondname, '') as secondname"),
        DB::raw("COALESCE(lastname, '') as lastname"),
        'email','phonenumber','role','status','gender','school_id')->orderBy('created_at', 'desc');
    
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
    

    public function adminFetchUsers(Request $request) {
        // Query users with school relationship
        $query = User::with('school') ->where('role','!=','Trainee')
            ->select('users.id', 'users.firstname',
                DB::raw("COALESCE(users.secondname, '') as secondname"),
                DB::raw("COALESCE(users.lastname, '') as lastname"),
                'users.email', 'users.phonenumber', 'users.role', 
                'users.status', 'users.gender', 'users.school_id'
            )
            ->leftJoin('schools', 'users.school_id', '=', 'schools.id') // Join schools table
            ->orderBy('users.created_at', 'desc');
    
        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('users.firstname', 'like', '%' . $request->search . '%')
                    ->orWhere('users.secondname', 'like', '%' . $request->search . '%')
                    ->orWhere('users.lastname', 'like', '%' . $request->search . '%')
                    ->orWhere('users.email', 'like', '%' . $request->search . '%')
                    ->orWhere('schools.school_name', 'like', '%' . $request->search . '%'); // ✅ Search by school name
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

    public function adminAddNewUser2(Request $request){
        $user=new User;
        $user->firstname=$request->firstname;
        $user->secondname=$request->secondname;
        $user->lastname=$request->lastname;
        $user->phonenumber=$request->phonenumber;
        $user->email=$request->email;
        $user->role=$request->role;
        $user->gender=$request->gender;
        $user->is_admin=$request->is_admin;
        $user->is_principal=$request->is_principal;
        $user->is_deputy_principal=$request->is_deputy_principal;
        $user->is_registrar=$request->is_registrar;
        $user->school_id=$request->school_id;
        $user->password=123456;
        $save=$user->save();
        if ($save) {
            return redirect()->back()->with('success', 'User created successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to create user.');
        }

    }
    

    public function update(Request $request)
    {
       

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'firstname' => 'required|string|max:255',
            'email' => 'required|email|max:255' . $request->user_id,
        ]);


        $user = User::find($request->user_id);
        $password=12345678;

        if ($user) {
            // Update user details
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->secondname = $request->secondname;
            $user->phonenumber = $request->phonenumber;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->gender = $request->gender;
            $user->school_id = $request->school_id;
            $user->password =  Hash::make($password);
            $user->update();

            return response()->json(['success' => true, 'message' => 'User updated successfully!']);
        }

           return response()->json(['success' => false, 'message' => 'User not found!'], 404);
   
    }


    public function delete(Request $request)
    {
       

        $validated = $request->validate([
            'delete_user_id' => 'required|exists:users,id',
        ]);


        $user = User::find($request->delete_user_id);

        if ($user) {
            $user->delete();

            return response()->json(['success' => true, 'message' => 'User delete successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'User not found!'], 404);
   
    }



     public function updateUserPassword(Request $request)
    {
       

        $validated = $request->validate([
            'update_password_user_id' => 'required|exists:users,id',
        ]);


        $user = User::find($request->update_password_user_id);

        if ($user) {
            $user->password = Hash::make(12345678);
            $user->update();

            return response()->json(['success' => true, 'message' => 'User Password updated successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'User not found!'], 404);
   
    }


    public function suspend(Request $request)
    {
       

        $validated = $request->validate([
            'suspend_user_id' => 'required|exists:users,id',
        ]);


        $user = User::find($request->suspend_user_id);

        if ($user) {
            $user->status = "Suspended";
            $user->update();

            return response()->json(['success' => true, 'message' => 'User suspended successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'User not found!'], 404);
   
    }



    public function upload(Request $request)
    {
            $request->validate([
                'file' => 'required|mimes:xlsx,xls,csv',
            ]);

            $file = $request->file('file');

            // You might want to hash or encrypt the password for security
            $password = bcrypt('123456');

            try {
                // Load the spreadsheet
                $spreadsheet = IOFactory::load($file->getPathname());
                $sheet = $spreadsheet->getActiveSheet();
                $rows = $sheet->toArray();

                // Check if rows exist and have data
                if (count($rows) > 1) {
                    // Iterate over rows and save data to the database, starting from the second row
                    foreach ($rows as $index => $row) {
                        // Skip the header row (row 1, index 0)
                        if ($index === 0) {
                            continue;
                        }

                        // Ensure the row has enough data to avoid errors
                        if (count($row) >= 4 && !empty($row[3])) {
                            User::create([
                                'firstname' => $row[0] ?? null,
                                'secondname' => $row[1] ?? null,
                                'lastname' => $row[2] ?? null,
                                'email' => $row[3],
                                'phonenumber' => $row[4],
                                'gender' => $row[5],
                                'role' => $row[6],
                                'password' => $password,
                            ]);
                        }
                    }

                    return redirect()->back()->with('success', 'Data Imported successfully');
                } else {
                    return redirect()->back()->with('error', 'The file contains no data beyond the header.');
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Could not upload data: ' . $e->getMessage());
            }

    }




    public function download()
    {
        $users = User::all();

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


    public function downloadUserFile(){
        $filePath = public_path('downloads/user.xlsx'); // Path to the file
        $fileName = 'user_date.xlsx'; // Name of the file to download
    
        if (file_exists($filePath)) {
            return Response::download($filePath, $fileName);
        }
    
        abort(404, 'File not found.');
    }
   



    public function UserAccount(){
        return view('users.showUserAccount');
    }





      
   public function adminUpdateUserPassword2(Request $request){

    $oldPassword = $request->old_password;
    $newPassword = $request->new_password;
    $confirmPassword = $request->confirm_new_password;

  // Check if the old password matches the hashed password in the database
  if (!Hash::check($request->old_password, Auth::user()->password)) {
      return redirect()->back()->with('error', 'The provided password does not match your current password.');
     //return back()->withErrors(['old_password' => 'The provided password does not match your current password.']);
  }else{
    if ($newPassword !== $confirmPassword) {
      return redirect()->back()->with('error', 'The new password confirmation does not match..');
      //return back()->withErrors(['confirm_new_password' => 'The new password confirmation does not match.']);
    }else{
      // Update the new password
      Auth::user()->update([
        'password' => Hash::make($request->new_password),
      ]);

      return redirect()->back()->with('success', 'Password updated successfully!'); 
    }
  } 

}




public function adminUpdateUserPassword(Request $request){

    $request->validate([
        'old_password' => 'required',
        'new_password' => [
            'required',
            'min:8',
            'confirmed', // Laravel will check new_password === confirm_new_password
        ],
    ]);

    $user = Auth::user();

    // Check if old password matches current password
    if (!Hash::check($request->old_password, $user->password)) {
        return response()->json([
            'message' => 'Old password is incorrect.'
        ], 422);
    }

    // Update with the new password
    $user->password = Hash::make($request->new_password);
    $user->save();

    return response()->json([
        'message' => 'Password updated successfully.'
    ], 200);
}


//STUDENT UPDATE PROFILE IMAGE
    public function adminUpdateUserPicture2(Request $request){

        if($request->hasfile('profile_image')){
            $file=$request->file('profile_image');
            $extension=$file->getClientOriginalExtension();
            $fileName=time().'.'.$extension;
            $file->move('images/profile/',$fileName);
            $id=Auth::user()->id;
            $user=User::find($id);
            $user->profile_image=$fileName;
            $user->update();
            return redirect()->back()->with('success', 'Image updated successfully');


            }else{
            echo"Image id Blank";
        }
    }






    public function UploadImage(Request $request){
        if($request->hasfile('profile_image')){
            $file=$request->file('profile_image');
            $extension=$file->getClientOriginalExtension();
            $fileName=time().'.'.$extension;
            $file->move('images/profile/',$fileName);
        }else{
        echo"Image id Blank";
        }
    }
  




    public function adminUpdateUserPicture(Request $request){
    
            $request->validate([
                'profile_image' => 'required|image|mimes:jpeg,jpg,png|max:2048'
            ]);
        
            if ($request->hasFile('profile_image')) {
                $file = $request->file('profile_image');
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '.' . $extension;
                $file->move(public_path('images/profile'), $fileName);
        
                $user = Auth::user();
                $user->profile_image = $fileName;
                $user->update();
        
                return response()->json(['message' => 'Profile image updated successfully']);
            }
        
            return response()->json(['error' => 'No file uploaded'], 422);
        }
    




    public function userUpdateProfile2(Request $request){
     
            $id=Auth::user()->id;
            $user = User::find($id);

            if ($user) {
                // Update user details
                $user->firstname = $request->firstname;
                $user->lastname = $request->lastname;
                $user->secondname = $request->secondname;
                $user->phonenumber = $request->phonenumber;
                $user->email = $request->email;
                $user->gender = $request->gender;
                $user->update();
                return redirect()->back()->with('success', 'User updated successfully!');

            }
    }


  


    public function  userUpdateProfile(Request $request){

            $validated = $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'secondname' => 'nullable|string|max:255',
                'phonenumber' => 'required|string|max:20',
                'gender' => 'required|in:Male,Female,Other'
            ]);

            $user = auth()->user();
            $user->update($validated);

            return response()->json(['message' => 'Profile updated successfully!']);
    }







    //CONDES FOR TIMETABLE

    public function showTimeTable(){
        $clases=Clas::all();
        $timetables=TimeTable::with('clas')->get();
        return view('timetables.manageTimeTable',compact('clases','timetables'));
    }

    public function addTimeTable(Request $request){
     $create=TimeTable::create($request->all());
        if($create){
            return redirect()->back()->with('success','Data saved succesfully');
        }else{
            return redirect()->back()->with('Failed','Could not saved');
        }

    }

    public function updateTimeTable(Request $request){
        $update=TimeTable::where('id',$request->id)->update(
            [
               'clas_id'=>$request->clas_id,
               'time_table'=>$request->time_table,
            ]
           );

       
           if($update){
               return redirect()->back()->with('success','Data updated succesfully');
           }else{
               return redirect()->back()->with('Failed','Could update');
           }
   
       }




       public function deleteTimeTable(Request $request){
        $delete=TimeTable::where('id',$request->id)->delete();
           if($delete){
               return redirect()->back()->with('success','Data delete succesfully');
           }else{
               return redirect()->back()->with('Failed','Could delete');
           }
   
       }




    //CLASS NOTES CONTROLLERS

    public function showClassNotes(){
        $clases=Clas::all();
        $classNotes=ClassNotes::with('clas')->get();
        return view('classNotes.manageClassNotes',compact('clases','classNotes'));
    }

    public function addClassNotes(Request $request){
        $create=ClassNotes::create($request->all());
           if($create){
               return redirect()->back()->with('success','Data saved succesfully');
           }else{
               return redirect()->back()->with('Failed','Could not saved');
           }
   
    }
   
    public function updateClassNotes(Request $request){
        $update=ClassNotes::where('id',$request->id)->update(
            [
                'clas_id'=>$request->clas_id,
                'date'=>$request->date,
                'notes'=>$request->notes,
                'video_link'=>$request->video_link,
            ]
            );

    
        if($update){
            return redirect()->back()->with('success','Data updated succesfully');
        }else{
            return redirect()->back()->with('Failed','Could update');
        }

    }
   
   
   
   
    public function deleteClassNotes(Request $request){
        $delete=ClassNotes::where('id',$request->id)->delete();
        if($delete){
            return redirect()->back()->with('success','Data delete succesfully');
        }else{
            return redirect()->back()->with('Failed','Could delete');
        }

    }





    public function fetchAdminDashboardUpdates(){
        $totalExpectedFee = DB::table('users')
        ->join('courses', 'users.course_id', '=', 'courses.id')
        ->where('users.role', 'trainee')
        ->sum('courses.course_price');

         $totalFeePaid=DB::table('fees')->sum('amount_paid');
         $balanceToPay=$totalExpectedFee-$totalFeePaid;

         
         //GET THE TOTAL NUMBER OF TRAINEES
         $total_trainees=DB::table('users')->where('users.role','=','Trainee')->count();
         $total_admin=DB::table('users')->where('users.role','=','Admin')->count();
         $total_courses=DB::table('courses')->count();
         $total_trainer=DB::table('users')->where('users.role','=','Trainer')->count();


        return response()->json([
            'totalExpectedFee' => $totalExpectedFee,
            'totalFeePaid'=> $totalFeePaid,
            'balanceToPay'=> $balanceToPay,
            'total_trainees'=>$total_trainees,
            'total_admin'=>$total_admin,
            'total_courses'=>$total_courses,
            'total_trainer'=>$total_trainer,
        ]);
    }


    public function getMonthlyEnrollments()
    {
        $monthlyData = DB::table('users')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%M %Y') as month"),
                DB::raw('COUNT(*) as total')
            )
            ->where('role', 'trainee') // Only students
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->orderBy(DB::raw("MIN(created_at)"))
            ->get();

        return response()->json($monthlyData);
    }










    //CONTROLLER FOR HIGHSCHOOL TEACHER CONTROLLER



    public function fetchHighStudents1(Request $request) {

        if(Auth::check() && Auth::user()->role="High_school_teacher"){
           
         

        // Query users with school relationship
        $query = User::with(['school','course'])
            ->select('users.id', 'users.firstname',
                DB::raw("COALESCE(users.secondname, '') as secondname"),
                DB::raw("COALESCE(users.lastname, '') as lastname"),
                'users.email', 'users.phonenumber', 'users.role', 
                'users.status', 'users.gender', 'users.school_id'
            )

            ->where('role','Trainee')
            ->where('school_id',Auth::user()->school_id)
            ->leftJoin('schools', 'users.school_id', '=', 'schools.id') // Join schools table
            ->orderBy('users.created_at', 'desc');
    
        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('users.firstname', 'like', '%' . $request->search . '%')
                    ->orWhere('users.secondname', 'like', '%' . $request->search . '%')
                    ->orWhere('users.lastname', 'like', '%' . $request->search . '%')
                    ->orWhere('users.email', 'like', '%' . $request->search . '%')
                    ->orWhere('schools.school_name', 'like', '%' . $request->search . '%'); // ✅ Search by school name
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


    }


    public function ViewTraineeProfile(Request $request){

        $student_id = $request->query('student_id'); // Get the exam ID from query parameters

        return view('trainees.traineeProfile',compact('student_id'));

    }


    public function fetchHighStudents(Request $request) {

        if(Auth::check() && Auth::user()->role=="High_school_teacher"){
    
            // Query users with school and course relationships
            $query = User::with(['school', 'course'])
                ->select(
                    'users.id', 
                    'users.firstname',
                    DB::raw("COALESCE(users.secondname, '') as secondname"),
                    DB::raw("COALESCE(users.lastname, '') as lastname"),
                    'users.email', 
                    'users.phonenumber', 
                    'users.role', 
                    'users.status', 
                    'users.gender', 
                    'users.school_id',
                    // Add COALESCE for school name and course name
                    DB::raw("COALESCE(schools.school_name, 'NA') as school_name"),
                    DB::raw("COALESCE(courses.course_name, 'NA') as course_name")
                )
                ->where('role', 'Trainee')
                ->where('school_id', Auth::user()->school_id)
                ->leftJoin('schools', 'users.school_id', '=', 'schools.id') // Join schools table
                ->leftJoin('courses', 'users.course_id', '=', 'courses.id') // Join courses table (assuming there's a `course_id` in `users`)
                ->orderBy('users.created_at', 'desc');
    
            // Apply search filter if provided
            if ($request->has('search') && !empty($request->search)) {
                $query->where(function($q) use ($request) {
                    $q->where('users.firstname', 'like', '%' . $request->search . '%')
                        ->orWhere('users.secondname', 'like', '%' . $request->search . '%')
                        ->orWhere('users.lastname', 'like', '%' . $request->search . '%')
                        ->orWhere('users.email', 'like', '%' . $request->search . '%')
                        ->orWhere('courses.course_name', 'like', '%' . $request->search . '%');
                });
            }
    
            // Get the number of records per page
            $perPage = $request->input('per_page', 20); // Default is 10
    
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
    }
    











    //CONTROLLER FOR TRAINEER


    public function showTrainees(){
        $courses=Course::select('course_name','id')->get();
        $clases=Clas::select('clas_name','id')->get();
        return view('trainees.showTrainees',compact('courses','clases'));
    }

    public function fetchTrainees(Request $request) {
        $query = User::with('course','clas')->select('id', 'firstname',
        DB::raw("COALESCE(secondname, '') as secondname"),
        DB::raw("COALESCE(lastname, '') as lastname"),
        DB::raw("COALESCE(clas_id, '') as clas_id"),
        DB::raw("COALESCE(course_id, '') as course_id"),
        'email','phonenumber','parent_phone','course_id','status','gender','clas_id')->where('has_paid_reg_fee','Yes')->orderBy('created_at', 'desc');
    
        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('firstname', 'like', '%' . $request->search . '%')
                ->orWhere('secondname', 'like', '%' . $request->search . '%')
                ->orWhere('phonenumber', 'like', '%' . $request->search . '%')
                ->orWhere('parent_phone', 'like', '%' . $request->search . '%')
                ->orWhere('lastname', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
    
        // Get the number of records per page
        $perPage = $request->input('per_page', 500); // Default is 10
    
        $users = $query->paginate($perPage);

         // Append the number of students who attempted each exam
         // Append the number of students who attempted each exam
        foreach ($users as $user) {
            $user->total_debit = Course::where('id', $user->course_id)->value('course_price');
            $user->total_credit = Fee::where('user_id',$user->id)->sum('amount_paid');
            $user->balance= $user->total_debit-$user->total_credit;
            
           
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

    public function addTrainee(Request $request){
        do {
            $randomEmail = mt_rand(1000, 9999) . '@tti.co.ke';
        } while (User::where('email', $randomEmail)->exists());

        $user=new User;
        $user->firstname = ucwords(strtolower($request->firstname));
        $user->secondname = ucwords(strtolower($request->secondname));
        $user->lastname = ucwords(strtolower($request->lastname));
        $user->phonenumber=$request->phonenumber;
        $user->email = $randomEmail; // Ensured to be unique
        //$user->role="Trainee";
        $user->role=$request->role ?? null;
        $user->parent_phone=$request->parent_phone ?? null;
        $user->school_id=$request->school_id ?? null;
        $user->clas_category=$request->clas_category ?? null;
        $user->prefered_course=$request->prefered_course ?? null;
        $user->has_paid_reg_fee=$request->has_paid_reg_fee;
        $user->gender=$request->gender;
        $user->course_id=$request->course_id ?? null;
        $user->clas_id=$request->clas_id;
        $user->prefered_course=$request->prefered_course ?? null;
        $user->password = Hash::make('12345678'); 
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


    public function updateTraineePerClas(Request $request)
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
            $user->course_id = $request->update_course_id;
            $user->clas_id = $request->update_clas_id;
            $user->gender = $request->gender;
            $user->role = $request->role;
            $user->clas_category = $request->clas_category;
            $user->school_id = $request->school_id;
            //$user->prefered_course = $request->prefered_course;
           
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

    public function traineeViewFeePayment(){
        if(Auth::check() && Auth::user()->role=='Trainee'){
            $user_id = Auth::user()->id; // Get the exam ID from query parameters
            $user=User::with('course')->find($user_id);
            $fees=Fee::where('user_id',$user_id)->get();
            $debit=$user->course->course_price;
            $credit=Fee::where('user_id',$user_id)->sum('amount_paid');
            $balance=$debit-$credit;
            return view('trainees.traineeViewFeePayment',compact('fees','user_id','user','debit','credit','balance'));
        }else{
            return redirect()->route('login');
        }

       
    }



    //SHOW TRAINEE ASSIGNMENT
    public function traineeViewAssignment(Request $request){
        if(Auth::check() && Auth::user()->role=='Trainee'){
            return view('trainees.traineeViewAssignment');
        }else{
            return redirect()->back();
        }
       
    }


    public function traineeFetchAssignments(Request $request){
        $clas_id=Auth::user()->clas_id;
        $user_id = Auth::user()->id; // Get the logged-in user ID
        $query = Exam::with('clas')->where('clas_id', $clas_id)->where('is_assignment','Yes')->select( 'id',  'exam_type',
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
        'created_at',
        'clas_id')->orderBy('created_at', 'desc');


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

      // Fetch student scores for each exam
      $users->getCollection()->transform(function ($exam) use ($user_id) {
        // Sum student scores for the logged-in user per exam
        $studentScore = DB::table('student_answers')
            ->where('exam_id', $exam->id)
            ->where('user_id', $user_id)
            ->sum('score');

            // Sum the total possible marks from the questions table
            $totalPossibleScore = DB::table('questions')
                ->where('exam_id', $exam->id)
                ->sum('question_mark');



                // Check if the student has answered any question
                    $hasAnswered = DB::table('student_answers')
                    ->where('exam_id', $exam->id)
                    ->where('user_id', $user_id)
                    ->exists(); // Returns true if the student has at least one answer

                // Set exam status based on whether the student has answered or not
                if ($hasAnswered) {
                    $exam->exam_status = "Attempted";
                    $exam->student_score = $studentScore;
                } else {
                    $exam->exam_status = "Pending";
                    $exam->student_score = "N/A";
                }


                // Calculate percentage score only if the student has attempted the exam
                $exam->percentage_score = ($hasAnswered && $totalPossibleScore > 0)
                ? round(($studentScore / $totalPossibleScore) * 30, 0) 
                : "N/A"; // Set to "N/A" if not attempted

                $exam->total_possible_score = $totalPossibleScore;

                return $exam;

             });

    
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


    public function traineeFetchAssignments2(Request $request){
        $clas_id=Auth::user()->clas_id;
        $query = Exam::with('clas')->where('clas_id', $clas_id)->where('is_assignment','Yes')->select( 'id',  'exam_type',
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
        'clas_id')->orderBy('created_at', 'desc');


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



    public function traineeViewCats(){
        if(Auth::check() && Auth::user()->role=='Trainee'){
            return view('trainees.traineeViewCats');
        }else{
            return redirect()->back();
        }
    }




    public function traineeFetchCats(Request $request){
        $clas_id=Auth::user()->clas_id;
        $user_id = Auth::user()->id; // Get the logged-in user ID
        $query = Exam::with('clas')->where('clas_id', $clas_id)->where('is_cat','Yes')->select( 'id',  'exam_type',
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
        'created_at',
        'clas_id')->orderBy('created_at', 'desc');


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

      // Fetch student scores for each exam
      $users->getCollection()->transform(function ($exam) use ($user_id) {
        // Sum student scores for the logged-in user per exam
        $studentScore = DB::table('student_answers')
            ->where('exam_id', $exam->id)
            ->where('user_id', $user_id)
            ->sum('score');

            // Sum the total possible marks from the questions table
            $totalPossibleScore = DB::table('questions')
                ->where('exam_id', $exam->id)
                ->sum('question_mark');



                // Check if the student has answered any question
                    $hasAnswered = DB::table('student_answers')
                    ->where('exam_id', $exam->id)
                    ->where('user_id', $user_id)
                    ->exists(); // Returns true if the student has at least one answer

                // Set exam status based on whether the student has answered or not
                if ($hasAnswered) {
                    $exam->exam_status = "Attempted";
                    $exam->student_score = $studentScore;
                } else {
                    $exam->exam_status = "Pending";
                    $exam->student_score = "N/A";
                }


                // Calculate percentage score only if the student has attempted the exam
                $exam->percentage_score = ($hasAnswered && $totalPossibleScore > 0)
                ? round(($studentScore / $totalPossibleScore) * 30, 0) 
                : "N/A"; // Set to "N/A" if not attempted

                $exam->total_possible_score = $totalPossibleScore;

                return $exam;

             });

    
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


 



    public function traineeViewFinalExam(){

        if(Auth::check() && Auth::user()->role=='Trainee'){
            return view('trainees.traineeViewFinalExam');
        }else{
            return redirect()->back();
        }

    }





    public function traineeFetchFinalExam(Request $request){
        $clas_id=Auth::user()->clas_id;
        $user_id = Auth::user()->id; // Get the logged-in user ID
        $query = Exam::with('clas')->where('clas_id', $clas_id)->where('is_final_exam','Yes')->select( 'id',  'exam_type',
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
        'created_at',
        'clas_id')->orderBy('created_at', 'desc');


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

      // Fetch student scores for each exam
      $users->getCollection()->transform(function ($exam) use ($user_id) {
        // Sum student scores for the logged-in user per exam
        $studentScore = DB::table('student_answers')
            ->where('exam_id', $exam->id)
            ->where('user_id', $user_id)
            ->sum('score');

            // Sum the total possible marks from the questions table
            $totalPossibleScore = DB::table('questions')
                ->where('exam_id', $exam->id)
                ->sum('question_mark');



                // Check if the student has answered any question
                    $hasAnswered = DB::table('student_answers')
                    ->where('exam_id', $exam->id)
                    ->where('user_id', $user_id)
                    ->exists(); // Returns true if the student has at least one answer

                // Set exam status based on whether the student has answered or not
                if ($hasAnswered) {
                    $exam->exam_status = "Attempted";
                    $exam->student_score = $studentScore;
                } else {
                    $exam->exam_status = "Pending";
                    $exam->student_score = "N/A";
                }


                // Calculate percentage score only if the student has attempted the exam
                $exam->percentage_score = ($hasAnswered && $totalPossibleScore > 0)
                ? round(($studentScore / $totalPossibleScore) * 30, 0) 
                : "N/A"; // Set to "N/A" if not attempted

                $exam->total_possible_score = $totalPossibleScore;

                return $exam;

             });

    
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




    public function traineeViewQuestions(Request $request){
        if(Auth::check()){
            if(Auth::user()->role=='Trainee' or Auth::user()->role=='scholarship_test_student' or Auth::user()->role=='ict_club_student'){
                $exam_id = $request->query('exam_id');
                $questions = Question::select('id','question_name','question_mark','question_answer','exam_id')->where('exam_id',$exam_id)->orderBy('created_at', 'desc');
                return view('trainees.traineeViewQuestions',compact('questions'));
            }else{
                
            }
        }else{
            return redirect()->route('login');
        }

       

    }

    public function fetchQuestionsForTrainee_old(Request $request,$exam_id){
        $user_id=Auth::user()->id;
        $query = Question::select('id','question_name','question_mark','question_answer','exam_id')->where('exam_id',$exam_id)->orderBy('created_at', 'ASC');

        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('question_name', 'like', '%' . $request->search . '%')
                ->orWhere('question_mark', 'like', '%' . $request->search . '%')
                ->orWhere('question_answer', 'like', '%' . $request->search . '%');
            });
        }
    
        // Get the number of records per page
        $perPage = $request->input('per_page', 1); // Default is 10
    
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
            'exam_id'=>$exam_id,
            'user_id'=>$user_id,
        ]);
    }





    public function fetchQuestionsForTrainee(Request $request, $exam_id) {
        $user_id = Auth::user()->id;
    
        $total_questions=count(Question::where('exam_id', $exam_id)->get());

        //Answered Questions
        $answered_questions = StudentAnswer::where('user_id', $user_id)
        ->where('exam_id', $exam_id)
        ->count();

        //Active Questions
        $active_questions=$total_questions-$answered_questions;
        //Total question marks
        $total_question_marks = Question::where('exam_id', $exam_id)->sum('question_mark');

        $total_student_score = StudentAnswer::where('user_id', $user_id)
        ->where('exam_id', $exam_id)
        ->sum('score');

        // Get question IDs that the student has already answered
        $answeredQuestionIds = StudentAnswer::where('user_id', $user_id)
            ->where('exam_id', $exam_id)
            ->pluck('question_id');
    
        /*
        $attempts = StudentAnswer::where('user_id', $user_id)
            ->where('exam_id', $exam_id)
            ->get();
         
        */
            $attempts = StudentAnswer::where('user_id', $user_id)
            ->where('exam_id', $exam_id)
            ->with(['user', 'question', 'exam']) // Include user, question, and exam details
            ->get();

        // Fetch only unanswered questions
        $query = Question::select('id', 'question_name', 'question_mark', 'question_answer', 'exam_id')
            ->where('exam_id', $exam_id)
            ->whereNotIn('id', $answeredQuestionIds) // Exclude answered questions
            ->orderBy('created_at', 'ASC');
    
        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('question_name', 'like', '%' . $request->search . '%')
                  ->orWhere('question_mark', 'like', '%' . $request->search . '%')
                  ->orWhere('question_answer', 'like', '%' . $request->search . '%');
            });
        }
    
        // Get the number of records per page
        $perPage = $request->input('per_page', 1); // Default is 1
        
        $users = $query->paginate($perPage);
    
        return response()->json([
            'users' => $users->items(),
            
            'pagination' => [
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'total' => $users->total(),
                'per_page' => $users->perPage(),
            ],
            //'total_users' => $users->total(),
            'total_users'=> $total_questions,
            'answered_questions'=>$answered_questions,
            'total_question_marks'=>$total_question_marks,
            'total_student_score'=>$total_student_score,
            'active_questions'=>$active_questions,
            'exam_id' => $exam_id,
            'user_id' => $user_id,
            'attempts' => $attempts, // Pass attempts data
        ]);
    }
    


    public function storeStudentAnswer(Request $request)
    {
        /*
        $request->validate([
            'user_id' => 'required|integer',
            'exam_id' => 'required|integer',
            'question_id' => 'required|integer',
            'selected_answer' => 'required|string',
            'question_mark' => 'required|integer'
        ]);*/
    
        // Get the correct answer from the database
        $question = Question::find($request->question_id);
        
        if (!$question) {
            return response()->json(['message' => 'Invalid question.'], 404);
        }
    
        // Award the question mark if correct, otherwise 0
        $is_correct = ($request->selected_answer === $question->question_answer);
        $score = $is_correct ? $request->question_mark : 0;
    
        // Save answer in student_answers table
        StudentAnswer::create([
            'user_id' => $request->user_id,
            'exam_id' => $request->exam_id,
            'question_id' => $request->question_id,
            'student_answer'=>$request->selected_answer,
            'score' => $score
        ]);
    
        return response()->json([
            'message' => 'Answer submitted successfully!',
            'correct' => $is_correct,
            'correct_answer' => $question->question_answer
        ]);
    }
    



    public function fetchFeeBalance(Request $request) {
        $coursePrice = auth()->user()->course->course_price;
        $feePaid=Fee::where('user_id',Auth::user()->id)->sum('amount_paid');
        $balance=$coursePrice-$feePaid;
        $payment=($coursePrice-$feePaid)*0.25;
        
        $endOfMonth = Carbon::now()->endOfMonth()->toDateString();
    
        // Check if the record exists
        if ($balance>0) {
            return response()->json([
                'balance' => $balance,
                'payment'=>$payment,
                'endOfMonth'=>$endOfMonth ,
            ]);
        }

    
        // If no record is found, return a default response (optional)
        return response()->json([
            'balance' =>0 ,
        ]);
    }




    public function showClassLink(){
        return view('trainees.showClassLink');
    }

    public function viewClassNotes(){
        return view('trainees.showClassNotes');
    }




    public function showTraineeProfile($id)
        {
            $student = User::with('course')->findOrFail($id); // eager load course relationship

            // If you need fee information, you can also load it:
            $fees = Fee::where('user_id', $id)->get();

            return view('trainees.traineeProfile', compact('student', 'fees'));
        }





    public function markedStudentAsAlumni(Request $request)
    {
        $updatedCount = User::where('clas_id', $request->alumni_clas_id)
            ->update(['status' => 'Alumni']);
        
        if ($updatedCount > 0) {
            return response()->json([
                'success' => true,
                'message' => "$updatedCount students marked as Alumni",
                'count' => $updatedCount
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'No students found for this class'
        ], 404);
    }

    public function suspendAllStudents(Request $request)
    {
        $updatedCount = User::where('clas_id', $request->suspend_all_students_clas_id)
            ->update(['status' => 'Suspended']);
        
        if ($updatedCount > 0) {
            return response()->json([
                'success' => true,
                'message' => "$updatedCount students are suspended",
                'count' => $updatedCount
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'No students found for this class'
        ], 404);
    }


    public function activateAllStudents(Request $request)
    {
        $updatedCount = User::where('clas_id', $request->activate_all_students_clas_id)
            ->update(['status' => 'Active']);
        
        if ($updatedCount > 0) {
            return response()->json([
                'success' => true,
                'message' => "$updatedCount students are Activated",
                'count' => $updatedCount
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'No students found for this class'
        ], 404);
    }


    public function showTraineePerClas(){
        $clas_id=$_GET['clas_id'];
        $courses=Course::select('course_name','id')->get();
        $clases=Clas::select('clas_name','id')->get();
        $schools=School::select('id','school_name')->get();
        $clas=Clas::where('id',$clas_id)->first();
        return View('trainees.showTraineesPerClas',compact('courses','clases','clas','schools'));
    }

    

    public function getStudents(Request $request,$classId) {
        $class=Clas::where('id',$classId)->first();
        $clasName= $class->clas_name;
        $query = User::with('course','clas','school')->select('id', 'firstname',
        DB::raw("COALESCE(secondname, '') as secondname"),
        DB::raw("COALESCE(lastname, '') as lastname"),
        DB::raw("COALESCE(clas_id, '') as clas_id"),
        DB::raw("COALESCE(course_id, '') as course_id"),
        'email','phonenumber','course_id','status','gender','clas_id','parent_phone','clas_category','school_id','role','prefered_course')->where('clas_id', $classId)->orderBy('created_at', 'desc');
    
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




    public function downloadStudentPerClassPdf($id){


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
       $trainees= User::with('course','clas','school')->select('id', 'firstname',
        DB::raw("COALESCE(secondname, '') as secondname"),
        DB::raw("COALESCE(lastname, '') as lastname"),
        DB::raw("COALESCE(clas_id, '') as clas_id"),
        DB::raw("COALESCE(course_id, '') as course_id"),
        'email','phonenumber','course_id','status','gender','clas_id','parent_phone','clas_category','school_id','role','prefered_course')
        ->where('clas_id', $id)
        ->orderBy('created_at', 'desc')
        ->get();
    
        
        $total_students=$trainees->count();
        $clas=Clas::where('id',$id)->first();
       

        // Load the view and pass the data
        $html = View::make('trainees.downloadTraineePerClass', compact('imageSrc', 'trainees','imageSrc2','imageSrc3','total_students','clas'))->render();
        //$html = View::make('fees.studentReceipt', compact(['imageSrc' => $imageSrc,'fees'=> $fees]))->render();

        // Convert the view to a PDF
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Stream or download the PDF
        return response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $clas->clas_name . '_students_Partial_scholarship.pdf"',
        ]);



    }


    public function downloadAllTraineePerClassPdf($id){
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
       $trainees= User::with('course','clas','school')->select('id', 'firstname',
        DB::raw("COALESCE(secondname, '') as secondname"),
        DB::raw("COALESCE(lastname, '') as lastname"),
        DB::raw("COALESCE(clas_id, '') as clas_id"),
        DB::raw("COALESCE(course_id, '') as course_id"),
        'email','phonenumber','course_id','status','gender','clas_id','parent_phone','clas_category','school_id','role','prefered_course')
        ->where('clas_id', $id)
        ->orderBy('created_at', 'desc')
        ->get();
    
        
        $total_students=$trainees->count();
        $clas=Clas::where('id',$id)->first();
       

        // Load the view and pass the data
        $html = View::make('trainees.downloadAllTraineePerClass', compact('imageSrc', 'trainees','imageSrc2','imageSrc3','total_students','clas'))->render();
        //$html = View::make('fees.studentReceipt', compact(['imageSrc' => $imageSrc,'fees'=> $fees]))->render();

        // Convert the view to a PDF
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Stream or download the PDF
        return response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $clas->clas_name . '_students_Partial_scholarship.pdf"',
        ]);

    }



    public function downloadFormFourTraineePerClassPdf($id){
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
       $trainees= User::with('course','clas','school')->select('id', 'firstname',
        DB::raw("COALESCE(secondname, '') as secondname"),
        DB::raw("COALESCE(lastname, '') as lastname"),
        DB::raw("COALESCE(clas_id, '') as clas_id"),
        DB::raw("COALESCE(course_id, '') as course_id"),
        'email','phonenumber','course_id','status','gender','clas_id','parent_phone','clas_category','school_id','role','prefered_course')
        ->where('clas_id', $id)
        ->where('clas_category','Form Four')
        ->orderBy('created_at', 'desc')
        ->get();
    
        
        $total_students=$trainees->count();
        $clas=Clas::where('id',$id)->first();
       

        // Load the view and pass the data
        $html = View::make('trainees.downloadFormFourTraineePerClassPdf', compact('imageSrc', 'trainees','imageSrc2','imageSrc3','total_students','clas'))->render();
        //$html = View::make('fees.studentReceipt', compact(['imageSrc' => $imageSrc,'fees'=> $fees]))->render();

        // Convert the view to a PDF
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Stream or download the PDF
        return response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $clas->clas_name . '_students_Partial_scholarship.pdf"',
        ]);

    }



    public function  downloadLowerFormsTraineePerClassPdf($id){
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
       $trainees= User::with('course','clas','school')->select('id', 'firstname',
        DB::raw("COALESCE(secondname, '') as secondname"),
        DB::raw("COALESCE(lastname, '') as lastname"),
        DB::raw("COALESCE(clas_id, '') as clas_id"),
        DB::raw("COALESCE(course_id, '') as course_id"),
        'email','phonenumber','course_id','status','gender','clas_id','parent_phone','clas_category','school_id','role','prefered_course')
        ->where('clas_id', $id)
        ->whereIn('clas_category',['Form One','Form Two','Form Three'])
        ->orderBy('created_at', 'desc')
        ->get();
    
        
        $total_students=$trainees->count();
        $clas=Clas::where('id',$id)->first();
       

        // Load the view and pass the data
        $html = View::make('trainees.downloadLowerFormsTraineePerClassPdf', compact('imageSrc', 'trainees','imageSrc2','imageSrc3','total_students','clas'))->render();
        //$html = View::make('fees.studentReceipt', compact(['imageSrc' => $imageSrc,'fees'=> $fees]))->render();

        // Convert the view to a PDF
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Stream or download the PDF
        return response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $clas->clas_name . '_students_Partial_scholarship.pdf"',
        ]);

    }


    











    //COURSE CONTROLLER



    //
    public function showCourses(){
        $courses2=Course::where('course_status','Active')->select('id','course_name','course_level','course_duration','course_price')->get();
      return view('courses.adminManageCourses',compact('courses2'));
    }


    public function showSuspendedCourses(){
        $courses2=Course::where('course_status','Active')->select('id','course_name','course_level','course_duration','course_price')->get();
      return view('courses.adminManageSuspendedCourses',compact('courses2'));
    }



    public function addCourse(Request $request){
 
        if($request->hasfile('course_image')){
            $file=$request->file('course_image');
            $extension=$file->getClientOriginalExtension();
            $fileName=time().'.'.$extension;
            if($file->move('images/courses/',$fileName)){
                $save=Course::create([
                    'course_image'=> $fileName,
                    'course_name'=>$request->course_name,
                    'course_level'=>$request->course_level,
                    'course_duration'=>$request->course_duration,
                    'course_price'=>$request->course_price,
                    'course_description'=>$request->course_description,
                    'course_two_like'=>rand(10, 99),
                    'course_leaners_already_enrolled'=>rand(10, 99),
                    'is_scholarship_test_course'=>$request->is_scholarship_test_course,
                ]);

                if($save){
                    return redirect()->back()->with('success','Data saved succesfully');
                }else{
                    return redirect()->back()->with('Failed','Could not saved');
                }
            }
        }

    }

    
    public function fetchCourses(Request $request) {
        $query = Course::where('course_status','Active')->select( 'id', 'course_name', 'course_level','is_scholarship_test_course','course_description','course_duration','course_price','course_status','what_to_learn','course_image')->orderBy('created_at', 'desc');

        $suspended_courses = count(Course::where('course_status','Suspended')->get());
        $active_courses= count(Course::where('course_status','Active')->get());
      

        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('course_name', 'like', '%' . $request->search . '%')
                ->orWhere('course_level', 'like', '%' . $request->search . '%')
                ->orWhere('course_duration', 'like', '%' . $request->search . '%')
                ->orWhere('course_price', 'like', '%' . $request->search . '%');
            });
        }
    
        // Get the number of records per page
        $perPage = $request->input('per_page', 10); // Default is 10
    
        $users = $query->paginate($perPage);

        foreach($users as $user){
             $user->total_students=count(User::where('course_id',$user->id)->get());
        }

    
        return response()->json([
            'users' => $users->items(),
            'pagination' => [
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'total' => $users->total(),
                'per_page' => $users->perPage(),
            ],
            'all_courses' => $users->total(),
            'suspended_courses'=> $suspended_courses,
            'active_courses'=>$active_courses,
           
        ]);
    }


    public function fetchSuspendedCourses(Request $request) {
        $query = Course::where('course_status','Suspended')->select( 'id', 'course_name', 'course_level','is_scholarship_test_course','course_description','course_duration','course_price','course_status','what_to_learn','course_image')->orderBy('created_at', 'desc');

        $suspended_courses = count(Course::where('course_status','Suspended')->get());
        $active_courses= count(Course::where('course_status','Active')->get());
      

        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('course_name', 'like', '%' . $request->search . '%')
                ->orWhere('course_level', 'like', '%' . $request->search . '%')
                ->orWhere('course_duration', 'like', '%' . $request->search . '%')
                ->orWhere('course_price', 'like', '%' . $request->search . '%');
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
            'all_courses' => $users->total(),
            'suspended'=> $suspended_courses,
            'active_courses'=>$active_courses,
           
        ]);
    }


    
    public function updateCourse(Request $request)
    {
       
        $validated = $request->validate([
            'course_id' =>'required|exists:courses,id',
            'course_name' =>'required|string|max:255',
            'course_level' =>'required|string|max:255',
            'course_duration' =>'required|max:255',
            'course_price' =>'required|max:255',
           
        ]);


        $user = Course::find($request->course_id);

        if ($user) {
            // Update user details
            $user->course_name = $request->course_name;
            $user->course_level = $request->course_level;
            $user->course_duration = $request->course_duration;
            $user->course_price = $request->course_price;
           // $user->what_to_learn = $request->what_to_learn;
            $user->is_scholarship_test_course = $request->is_scholarship_test_course;
            $user->course_description=$request->course_description;
            $user->course_status = $request->course_status;
            $user->update();

            return response()->json(['success' => true, 'message' => 'Course updated successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Course not found!'], 404);
   
    }


    public function updateCourseImage(Request $request){
        if($request->hasfile('course_image')){
            $file=$request->file('course_image');
            $extension=$file->getClientOriginalExtension();
            $fileName=time().'.'.$extension;
            if($file->move('images/courses/',$fileName)){
                $save=Course::where('id',$request->course_image_id)->update([
                    'course_image'=> $fileName,
                ]);

                if($save){
                    return redirect()->back()->with('success','Image Updated succesfully');
                }else{
                    return redirect()->back()->with('Failed','Could not Update Image');
                }
            }
        } 
    }




    public function deleteCourse(Request $request)
    {
       
       

        $user = Course::find($request->delete_course_id);

        if ($user) {
            $user->delete();
            return response()->json(['success' => true, 'message' => 'Course deleted successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Course not found!'], 404);
   
    }



    
    public function suspendCourse(Request $request)
    {
       
       

        $user = Course::find($request->suspend_course_id);

        if ($user) {
            $user->update(['course_status'=>'Suspended']);
            return response()->json(['success' => true, 'message' => 'Course suspended successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Course not found!'], 404);
   
    }

    public function adminManageTraineePerCourse(){
        $course_id=$_GET['course_id'];
        $schools=School::select('id','school_name')->get();
        $clases=Clas::select('id','clas_name')->get();
        $course=Course::where('id',$course_id)->first();
        $courses=Course::select('id','course_name')->get();
        return view('courses.adminManageTraineePerCourse',compact('schools','clases','course','courses'));
    }

    





    public function fetchStudentPerCourse(Request $request,$course_id) {
        $course=Course::where('id',$course_id)->first();
        $courseName= $course->course_name;
        $query = User::with('course','clas','school')->select('id', 'firstname',
        DB::raw("COALESCE(secondname, '') as secondname"),
        DB::raw("COALESCE(lastname, '') as lastname"),
        DB::raw("COALESCE(clas_id, '') as clas_id"),
        DB::raw("COALESCE(course_id, '') as course_id"),
        'email','phonenumber','course_id','status','gender','clas_id','parent_phone','clas_category','school_id','role','prefered_course')->where('course_id', $course_id)->orderBy('created_at', 'desc');
    
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
            'course_name'=>$courseName,
        ]);
    }



}




