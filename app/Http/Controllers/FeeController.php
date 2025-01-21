<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fee;
use App\Models\User;
use App\Models\Course;
use Dompdf\Dompdf; // Import the Dompdf class
use Illuminate\Support\Facades\View;

class FeeController extends Controller
{
    //
    public function showFees(Request $request){
        $user_id = $request->query('user_id'); // Get the exam ID from query parameters
        $user=User::with('course')->find($user_id);
        $fees=Fee::where('user_id',$user_id)->get();
        $debit=$user->course->course_price;
        $credit=Fee::where('user_id',$user_id)->sum('amount_paid');
        $balance=$debit-$credit;
        return view('fees.showFees',compact('fees','user_id','user','debit','credit','balance'));
        
    }

    public function addFees(Request $request){
        $add=Fee::create($request->all());
        if($add){
            return redirect()->back()->with('success','Data saved succesfully');
            }else{
                return redirect()->back()->with('Failed','Could not  saved');
            }
    }

    public function updateFees(Request $request){
        
        $fee=Fee::find($request->id);
        $update=$fee->update($request->all());
        if($update){
            return redirect()->back()->with('success','Data updated succesfully');
            }else{
                return redirect()->back()->with('Failed','Could not  update');
            }
    }

    
    public function deleteFees(Request $request){
        
        $fee=Fee::find($request->id);
        $delete=$fee->delete();
        if($delete){
            return redirect()->back()->with('success','Data deleted succesfully');
            }else{
                return redirect()->back()->with('Failed','Could not  delete');
            }
    }

    public function downloadReceipt(){
        // Fetch all records from the `fees` table
        $fees = Fee::all();

        // Load the view and pass the data
        $html = View::make('fees.studentReceipt', compact('fees'))->render();

        // Convert the view to a PDF
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Stream or download the PDF
        return response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="Receipt.pdf"',
        ]);


    }
}
