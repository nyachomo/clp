<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseModule;
use App\Models\Topic;
class CourseModuleController extends Controller
{
    //

    public function manageCourseModule(Request $request){
        $course_id = $request->query('course_id'); // Get the exam ID from query parameters

        return view('coursemodules.managecoursemodules',compact('course_id'));
    }

    public function addModule(Request $request){
        $save=CourseModule::create($request->all());
        if($save){
          return redirect()->back()->with('success','Data saved succesfully');
          }else{
              return redirect()->back()->with('Failed','Could not saved');
          }
  
      }


     
    public function fetchModules(Request $request,$course_id) {
        $query = CourseModule::select('id','module_name','module_content','course_id')->where('course_id',$course_id)->orderBy('created_at', 'desc');

        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('module_name', 'like', '%' . $request->search . '%')
                ->orWhere('module_content', 'like', '%' . $request->search . '%');
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





    public function updateModule(Request $request)
    {
       
        $validated = $request->validate([
            'module_id' =>'required|exists:course_modules,id',
            'module_name' =>'required|string|max:255',
            'module_content' => 'nullable|string', // Add validation for this field
        ]);


        $user = CourseModule::find($request->module_id);

        if ($user) {
            // Update user details
            $user->module_name = $request->module_name;
            $user->module_content = $request->module_content;
            $user->update();

            return response()->json(['success' => true, 'message' => 'Module updated successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Module not found!'], 404);
   
    }



    public function deleteModule(Request $request)
    {
       
       

        $user = CourseModule::find($request->delete_question_id);

        if ($user) {
            $user->delete();
            return response()->json(['success' => true, 'message' => 'Module deleted successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Module not found!'], 404);
   
    }




    public function adminManageNotes(Request $request){
        $module_id = $request->query('module_id'); // Get the exam ID from query parameters

        return view('coursemodules.moduleNotes',compact('module_id'));
    }

    public function fetchTopics(Request $request,$module_id) {
        $query = Topic::select('id','topic_name','topic_content','module_id','topic_video_link')->where('module_id',$module_id)->orderBy('created_at', 'desc');

        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('module_name', 'like', '%' . $request->search . '%')
                ->orWhere('module_content', 'like', '%' . $request->search . '%');
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
