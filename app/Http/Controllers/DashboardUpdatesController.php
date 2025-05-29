<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardUpdatesController extends Controller
{
    //

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

}
