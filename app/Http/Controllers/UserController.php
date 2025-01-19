<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('users.showAdministrators');
    }

   

    /**
     * Show the form for creating a new resource.
     */


    public function adminFetchUsers(Request $request) {
        $query = DB::table('users')->select('id', 'firstname','secondname','lastname','email','phonenumber','role','status','gender')->orderBy('created_at', 'desc');
    
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

        if ($user) {
            // Update user details
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->secondname = $request->secondname;
            $user->phonenumber = $request->phonenumber;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->gender = $request->gender;
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
            $password = bcrypt('12345678');

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

        // Fill data from the users table
        $row = 2; // Start from the second row
        foreach ($users as $user) {
            $sheet->setCellValue('A' . $row, $user->firstname);
            $sheet->setCellValue('B' . $row, $user->secondname);
            $sheet->setCellValue('C' . $row, $user->lastname);
            $sheet->setCellValue('D' . $row, $user->email);
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
        $fileName = 'user.xlsx'; // Name of the file to download
    
        if (file_exists($filePath)) {
            return Response::download($filePath, $fileName);
        }
    
        abort(404, 'File not found.');
    }
   



    public function UserAccount(){
        return view('users.showUserAccount');
    }
}
