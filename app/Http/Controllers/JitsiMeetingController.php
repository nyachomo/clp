<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JitsiMeeting;
use App\Models\Clas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class JitsiMeetingController extends Controller
{
    //

    public function showJitsiMeetingPerClas(){
        $clas_id=$_GET['clas_id'];
        $clas=Clas::where('id',$clas_id)->select('id','clas_name')->first();
        return view('jitsimeetings.showJitsiMeetingPerClas',compact('clas_id','clas'));
    }

    public function createJitsiMeetingPerClas(Request $request){
        $create=JitsiMeeting::create([
            'clas_id'=>$request->clas_id ?? null,
            'course_id'=>$request->course_id  ?? null,
            'meeting_name'=>$request->meeting_name ?? null,
            'jwt_link'=>$request->jwt_link ?? null,
        ]);

        if($create){
            return response()->json(['success'=>true,'message'=>'Meeting Created Sucessfully']);
        }
    }


    public function updateJitsiMeetingPerClas(Request $request){

        $update=JitsiMeeting::where('id',$request->meeting_id)->update([
            'meeting_name'=>$request->meeting_name,
            'jwt_link'=>$request->jwt_link,
        ]);

        if($update){
            return response()->json(['success'=>true,'message'=>'Meeting Created Sucessfully']);
        }
    }


    public function deleteJitsiMeetingPerClas(Request $request){

         $delete=JitsiMeeting::where('id',$request->delete_meeting_id)->delete();

        if($delete){
            return response()->json(['success'=>true,'message'=>'Meeting deleted Sucessfully']);
        }
    }


    public function suspendJitsiMeetingPerClas(Request $request){

        $suspend=JitsiMeeting::where('id',$request->suspend_meeting_id)->update(['meeting_status'=>'Suspended']);

       if($suspend){
           return response()->json(['success'=>true,'message'=>'Meeting Suspended Sucessfully']);
       }
   }


   public function activateJitsiMeetingPerClas(Request $request){

        $activate=JitsiMeeting::where('id',$request->activate_meeting_id)->update(['meeting_status'=>'Active']);

        if($activate){
            return response()->json(['success'=>true,'message'=>'Meeting Activated Sucessfully']);
        }
    }

    public function joinJitsiMeetingPerClas(){
       $userName=Auth::user()->firstname;
       $userEmail=Auth::user()->email;
       $meeting_id=$_GET['meeting_id'];
       $meeting=JitsiMeeting::where('id',$meeting_id)->select('meeting_name','jwt_link')->first();
       return view('jitsimeetings.classRoom',compact('meeting','userName','userEmail'));

    }


public function fetchJitsiMeetingPerClas(Request $request, $classId) {
    $query = JitsiMeeting::with('clas')
        ->select('id', 'meeting_name', 'jwt_link', 'clas_id', 'meeting_status')
        ->where('clas_id', $classId)
        ->orderBy('created_at', 'desc');

    $total_meetings = JitsiMeeting::where('clas_id', $classId)->count();
    $suspended_meetings = JitsiMeeting::where('clas_id', $classId)
        ->where('meeting_status', 'Suspended')->count();
    $active_meetings = JitsiMeeting::where('clas_id', $classId)
        ->where('meeting_status', 'Active')->count();

    // Apply search filter if provided
    if ($request->has('search') && !empty($request->search)) {
        $query->where(function($q) use ($request) {
            $q->where('meeting_name', 'like', '%' . $request->search . '%')
                ->orWhere('jwt_link', 'like', '%' . $request->search . '%')
                ->orWhere('meeting_status', 'like', '%' . $request->search . '%');
        });
    }

    // Apply status filter if provided
    if ($request->has('status') && !empty($request->status)) {
        $query->where('meeting_status', $request->status);
    }

    // Get the number of records per page
    $perPage = $request->input('per_page', 10);

    $users = $query->paginate($perPage);

    return response()->json([
        'users' => $users->items(),
        'pagination' => [
            'current_page' => $users->currentPage(),
            'last_page' => $users->lastPage(),
            'total' => $users->total(),
            'per_page' => $users->perPage(),
        ],
        'total_meetings' => $total_meetings,
        'suspended_meetings' => $suspended_meetings,
        'active_meetings' => $active_meetings,
    ]);
}



}
