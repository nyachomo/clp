<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Contactus;
use App\Models\School;
use App\Models\User;
use App\Models\Fee;
use App\Models\Clas;
use App\Models\Exam;
use App\Models\StudentAnswer;
use App\Models\Setting;
use App\Models\Topic;
use App\Models\Question;
use App\Models\CourseModule;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\ScholarshipLetter;
use Dompdf\Dompdf; // Import the Dompdf class
use Illuminate\Support\Facades\View;

class WebsiteController extends Controller
{

    public function aboutUs(){
        return view('pages.aboutUs');
    }


    //NEW WEBSITE CONTROLLER
    public function showSingleCourse($id){
        $course=Course::where('id',$id)->select('id','course_image','course_name',
        'course_duration','course_price','course_level','course_description',
        'course_two_like','course_leaners_already_enrolled')->first();

        $othercourses=Course::where('course_status','Active')->where('course_level','!=', $course->course_level)->whereNotIn('id',[$course->id])->select('id','course_image','course_name',
        'course_duration','course_price','course_level','course_description',
        'course_two_like','course_leaners_already_enrolled')->limit(5)->get();

        $relatedcourses=Course::where('course_status','Active')->where('course_level',$course->course_level)->whereNotIn('id',[$course->id])->select('id','course_image','course_name',
        'course_duration','course_price','course_level','course_description',
        'course_two_like','course_leaners_already_enrolled')->limit(2)->get();

        $modules=CourseModule::where('course_id',$id)->get();

        return view('pages.showSingleCourse',compact('course','othercourses','relatedcourses','modules'));
    }
    //

    public function signup($id){
        $course=Course::where('id',$id)->select('id','course_image','course_name',
        'course_duration','course_price','course_level','course_description',
        'course_two_like','course_leaners_already_enrolled')->first();
        return view('pages.signup',compact('course'));
    }

    public function showAllCourses(){
        $courses=Course::where('course_status','!=','Suspended')->where('is_scholarship_test_course','!=','Yes')->select('id','course_image','course_name',
        'course_duration','course_price','course_level','course_description',
        'course_two_like','course_leaners_already_enrolled')->get();
       
        return view('pages.showAllCourses',compact('courses'));
    }

    public function sendContactMessage(Request $request){
         $create=Contactus::create($request->all());
         if($create){
              //Alert::success('Success','Message Send Successfully. We will get back to us as soon as possible');
              return redirect()->back()->with('success','Message Send Successfully. We will get back to us as soon as possible');
         }else{
              //Alert::error('Failed','Could not send message');
              return redirect()->back()->with('error','Could not send message');
         }
    }

    public function showContactMessages(){
        $messages=Contactus::all();
        return view('contactmessages.showContactMessages',compact('messages'));
    }


    public function enrol_for_scholarship_test(){
        $schools=School::select('id','school_name')->get();
        $course=Course::where('is_scholarship_test_course','Yes')->select('id','course_name')->first();
        $clas=Clas::where('is_scholarship_test_clas','Yes')->first();
        return view('pages.enrol_for_scholarship_test',compact('schools','course','clas'));
    }

    public function showScholarshipTest(Request $request){
        if(Auth::check()){
            if(Auth::user()->role=='scholarship_test_student' OR Auth::user()->role=='ict_club_student'){
                return view('pages.scholarshipTest');
            }
           
        }else{
            return redirect()->back();
        }
       
    }

    public function showFormFourScholarshipLetter(){
        $formFourLetter=ScholarshipLetter::select('id','form_four','date','letter_id','signature','stamp','registration_deadline','category','start_date')->where('category','Form Four')->first();
        $lowerFormsLetter=ScholarshipLetter::select('id','form_four','date','letter_id','signature','stamp','registration_deadline','category','start_date')->where('category','Lower Forms')->first();
        return view('scholarshipLetters.showFormFourScholarshipLetter',compact('formFourLetter','lowerFormsLetter'));
    }





    public function about_us(){
        return view('about_us');
    }

    public function all_courses(){
        return view("all_courses");
    }

   

    public function dataScience(){
          return view('pages.data_science');
    }

    public function androidApplication(){
        return view('pages.android_application');
    }

    public function webApplication(){
        return view('pages.webApplication');
    }

    public function digitalMarketing(){
        return view('pages.digitalMarketing');
    }

    public function cyberSecurity(){
        return view('pages.cyberSecurity');
    }

    public function graphicDesign(){
        return view('pages.graphicDesign');
    }

    public function softwareEngineering(){
        return view('pages.softwareEngineering');
    }

    public function dataAnalysis(){
        return view('pages.dataAnalysis');
    }

   

    public function corporateTraining(){
        return view('pages.corporateTraining');
    }

    public function industrialAttachment(){
        return view('pages.industrialAttachment');
    }

    public function ictHub(){
        return view ('pages.ictHub');
    }

    public function contactUs(){
        return view('pages.contactUs');
    }

    public function enrol(){
        $courses=Course::where('course_status','Active')->select('course_name')->get();
        return view('pages.enrol',compact('courses'));
    }

    public function digitalHustle(){
        return view('pages.digital_hustle');
    }

    public function apply(){
        $courses=Course::where('course_status','Active')->select('id','course_name')->get();
        return view("pages.apply",compact('courses'));
    }

    public function applicantDownloadAdmissionLetter2(){
        
                $imagePath2 = public_path('images/signature/hibrahim_signature.jpeg');
                $imageData2 = base64_encode(file_get_contents($imagePath2));
                $imageSrc2 = 'data:image/jpeg;base64,' . $imageData2;
        
                $imagePath3 = public_path('images/stamp/official_stamp.png');
                $imageData3 = base64_encode(file_get_contents($imagePath3));
                $imageSrc3 = 'data:image/jpeg;base64,' . $imageData3;
        return view('admissionletters.applicantDownloadAdmissionLetter',compact('imageSrc3','imageSrc2'));
    }


    public function applicantDownloadAdmissionLetter(Request $request){
                    $firstname=Auth::user()->firstname;
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
                    $html = View::make('admissionletters.applicantDownloadAdmissionLetter', compact('imageSrc','imageSrc2','imageSrc3'))->render();
                    //$html = View::make('fees.studentReceipt', compact(['imageSrc' => $imageSrc,'fees'=> $fees]))->render();
            
                    // Convert the view to a PDF
                    $dompdf = new \Dompdf\Dompdf();
                    $dompdf->loadHtml($html);
                    $dompdf->setPaper('A4', 'portrait');
                    $dompdf->render();
            
                    // Stream or download the PDF
                    return response($dompdf->output(), 200, [
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition' => 'attachment; filename="' . $firstname . '_admission_letter.pdf"',
                    ]);
    }

    
    public function applicantAdmissionLetter(){
        
                $imagePath2 = public_path('images/signature/hibrahim_signature.jpeg');
                $imageData2 = base64_encode(file_get_contents($imagePath2));
                $imageSrc2 = 'data:image/jpeg;base64,' . $imageData2;
        
                $imagePath3 = public_path('images/stamp/official_stamp.png');
                $imageData3 = base64_encode(file_get_contents($imagePath3));
                $imageSrc3 = 'data:image/jpeg;base64,' . $imageData3;
        return view('admissionletters.applicantAdmissionLetter',compact('imageSrc3','imageSrc2'));
    }
}
