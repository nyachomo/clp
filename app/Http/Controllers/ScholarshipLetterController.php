<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScholarshipLetter;
use App\Models\Setting;


use App\Models\School;
use App\Models\Leed;
use App\Models\Course;
use App\Models\User;
use Dompdf\Dompdf; // Import the Dompdf class
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;


class ScholarshipLetterController extends Controller
{
    //

    public function adminManageFormFourScholarshipLetters(){
        $letters=ScholarshipLetter::select('id','form_four','date','letter_id','start_date','registration_deadline','category')->get();
        return view('scholarshipLetters.adminManageFormFourScholarshipLetter',compact('letters'));
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
            //'form_four'=>$request->form_four,
            'date'=>$request->date,
            'start_date'=>$request->start_date,
            'registration_deadline'=>$request->registration_deadline,
            'category'=>$request->category,
            'letter_id'=>$request->letter_id,

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


    public function studentDownloadFormFourScholarshipLetter($id){

        if(Auth::check()){
            if(Auth::user()->role="scholarship_test_student"){
                 if(Auth::user()->clas_category=="Form Four"){

                    $student=User::where('id',$id)->first();
                    $letter=ScholarshipLetter::select('id','form_four','date','letter_id','category','registration_deadline','start_date')->first();
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
                    $html = View::make('scholarshipLetters.studentDownloadFormFourScholarshipLetter', compact('imageSrc','imageSrc2','imageSrc3','letter'))->render();
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

                 if(Auth::user()->clas_category !="Form Four"){

                    $student=User::where('id',$id)->first();
                    $letter=ScholarshipLetter::select('id','form_four','date','letter_id','category','registration_deadline','start_date')->first();
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
                    $html = View::make('scholarshipLetters.studentDownloadLowerFormsScholarshipLetter', compact('imageSrc','imageSrc2','imageSrc3','letter'))->render();
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
                
                

            }else{
                return redirect()->back()->with('error', 'This page can only be accessed by scholarship test students ');
            }
        }else{
            return redirect()->back()->with('error', 'You must login to access this page ');
        }

       


    }
}
