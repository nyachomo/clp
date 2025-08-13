<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScholarshipLetter;

class ScholarshipLetterController extends Controller
{
    //

    public function adminManageFormFourScholarshipLetters(){
        $letter=ScholarshipLetter::select('id','form_four')->first();
        return view('scholarshipLetters.adminManageFormFourScholarshipLetter',compact('letter'));
    }

    public function adminAddFormFourScholarshipLetters(Request $request){
        $create=ScholarshipLetter::create($request->all());
        if($create){
            return redirect()->back()->with('success', 'Letter created successfully!');
        }else{
            return redirect()->back()->with('error', 'Failed to create ');
        }
    }

    public function adminUpdateFormFourScholarshipLetters(Request $request){
        $update=ScholarshipLetter::where('id',$request->id)->update([
            'form_four'=>$request->form_four,
        ]);
        if($update){
            return redirect()->back()->with('success', 'Letter updated successfully!');
        }else{
            return redirect()->back()->with('error', 'Failed to update ');
        }
    }

    public function adminDeleteFormFourScholarshipLetters(request $request){
        $delete=ScholarshipLetter::where('id',$request->delete_id)->delete();
        if($delete){
            return redirect()->back()->with('success', 'Letter deleted successfully!');
        }else{
            return redirect()->back()->with('error', 'Failed to delete ');
        }

    }
}
