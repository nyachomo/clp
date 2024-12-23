<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leed;

class LeedController extends Controller
{
    //
    public function index(){
        return view('leeds.adminManageLeeds');
    }

    public function addLeeds(Request $request){
        $save=Leed::create($request->all());
        if($save){
            return redirect()->back()->with('success','Data saved succesfully');
        }else{
            return redirect()->back()->with('Failed','Could not saved');
        }
    }

    public function fetchLeeds(Request $request) {
        $query = Leed::select( 'id',  'student_firstname',
        'student_lastname',
        'student_email',
        'student_phone',
        'student_gender',
        'student_school',
        'student_form',
        'comment',
        'year_data_captured',
        'parent_name',
        'parent_phone',
        'parent_email', )->orderBy('created_at', 'desc');


        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('topic_name', 'like', '%' . $request->search . '%')
                ->orWhere('topic_content', 'like', '%' . $request->search . '%')
                ->orWhere('topic_status', 'like', '%' . $request->search . '%');
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


    
    public function updateLeeds(Request $request)
    {
       
        $validated = $request->validate([
            'leed_id' =>'required|exists:leeds,id',
            'student_firstname' =>'string|max:255',
            'student_lastname' =>'string|max:255',
            'student_email' =>'email|max:255',
            'student_phone' =>'string|max:255',
            'student_gender' =>'string|max:255',
            'student_form' =>'string|max:255',
            'parent_name' =>'string|max:255',
            'parent_email' =>'email|max:255',
            'parent_phone' =>'string|max:255',
        ]);


        $user = Leed::find($request->leed_id);

        if ($user) {
            // Update user details
            $user->student_firstname = $request->student_firstname;
            $user->student_lastname = $request->student_lastname;
            $user->student_email = $request->student_email;

            $user->student_phone = $request->student_phone;
            $user->student_gender = $request->student_gender;
            $user->student_form = $request->student_form;
            $user->parent_name = $request->parent_name;
            $user->parent_email = $request->parent_email;
            $user->parent_phone = $request->parent_phone;
            $user->update();
            return response()->json(['success' => true, 'message' => 'Leed updated successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Leed not found!'], 404);
   
    }








    
    public function deleteLeeds(Request $request)
    {
       
        $user = Leed::find($request->delete_leed_id);
        if ($user) {
            $user->delete();
            return response()->json(['success' => true, 'message' => 'Leed deleted successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'Leed not found!'], 404);
   
    }



}
