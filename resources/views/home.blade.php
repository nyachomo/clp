@extends('layouts.master')
@section('content')

<?php 
use App\Models\User;
use App\Models\Fee;
use App\Models\StudentAnswer;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Support\Facades\DB;


if(Auth::check() && Auth::user()->role=='Trainee' or Auth::user()->role=='scholarship_test_student' or Auth::user()->role=='ict_club_student'){

    $user_id=Auth::user()->id;
    $fees=Fee::where('user_id',$user_id)->get();
    $debit=Auth::user()->course->course_price?? 0;
    $credit=Fee::where('user_id',$user_id)->sum('amount_paid');
    $balance=$debit-$credit;

    $totalCoursesEnrolled = Auth::user()->course_id ? 1 : 0;
    $totalAssessmentsDone = StudentAnswer::where('user_id', $user_id)
        ->whereNotNull('exam_id')
        ->distinct('exam_id')
        ->count('exam_id');

//Get all the scores of the assignment of the person that logins.
$uniqueQuestions = StudentAnswer::where('user_id', $user_id)
    ->distinct()
    ->pluck('question_id'); // Get unique question IDs only

    $uniqueExamIds = StudentAnswer::where('user_id', $user_id)
    ->distinct()
    ->pluck('exam_id');


    $assignmentExamIds = Exam::whereIn('id', $uniqueExamIds)
    ->where('is_assignment', 'Yes')
    ->pluck('id');

    //Get the total score for assignment

    $total_question_mark = Question::whereIn('exam_id', $assignmentExamIds)
    ->sum('question_mark');

    $total_student_score=StudentAnswer::whereIn('exam_id', $assignmentExamIds)
    ->where('user_id',$user_id)
    ->sum('score');

    $avgAssignment = ($total_question_mark > 0) 
    ? round(($total_student_score / $total_question_mark) * 30) 
    : 0; // Default value if division is not possible


    //GETTING UNIQUE CATS IDS
    $assignmentCatIds = Exam::whereIn('id', $uniqueExamIds)
    ->where('is_cat', 'Yes')
    ->pluck('id');

    $total_cat_question_mark = Question::whereIn('exam_id', $assignmentCatIds)
    ->sum('question_mark');

    $total_student_cat_score=StudentAnswer::whereIn('exam_id', $assignmentCatIds)
    ->where('user_id',$user_id)
    ->sum('score');

    $avgCat = ($total_cat_question_mark > 0) 
    ? round(($total_student_cat_score / $total_cat_question_mark) * 30) 
    : 0; // Default value if division is not possible




    //GETTING UNIQUE FINAL EXAM IDS
    $assignmentFinalExamIds = Exam::whereIn('id', $uniqueExamIds)
    ->where('is_final_exam', 'Yes')
    ->pluck('id');

    $total_final_exam_question_mark = Question::whereIn('exam_id', $assignmentFinalExamIds)
    ->sum('question_mark');

    $total_student_final_exam_score=StudentAnswer::whereIn('exam_id', $assignmentFinalExamIds)
    ->where('user_id',$user_id)
    ->sum('score');

    $avgFinalExam = ($total_final_exam_question_mark > 0) 
    ? round(($total_student_final_exam_score / $total_final_exam_question_mark) * 30) 
    : 0; // Default value if division is not possible


}
?>

<style>
    .welcome-card {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 40px;
    border-radius: 20px;
    color: #fff;
    background: linear-gradient(
        90deg,
        #003366,
        #6a11cb,
        #ff9900,
        #003366
    );
    background-size: 400% 400%;
    animation: gradientMove 10s ease infinite;
    box-shadow: 0 20px 40px rgba(0,0,0,0.25);
    max-width: 100%;
}

/* Gradient animation */
@keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.card-content h1 {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 10px;
}

.card-content p {
    font-size: 1rem;
    opacity: 0.9;
    max-width: 600px;
}

.info-row {
    display: flex;
    gap: 12px;
    margin-top: 18px;
    flex-wrap: wrap;
}

.info-pill {
    background: rgba(255,255,255,0.15);
    padding: 10px 16px;
    border-radius: 12px;
    font-size: 0.9rem;
    backdrop-filter: blur(10px);
}

.card-actions {
    display: flex;
    gap: 16px;
}

.btn {
    padding: 14px 22px;
    border-radius: 12px;
    font-size: 0.95rem;
    cursor: pointer;
    border: none;
    font-weight: 600;
}

.btn.primary {
    background: #2563eb;
    color: #fff;
}

.btn.primary:hover {
    background: #1d4ed8;
}

.btn.secondary {
    background: #ffffff;
    color: #2563eb;
}

.btn.secondary:hover {
    background: #f1f5f9;
}

.alert-cards{
    border-radius:20px
}

.strong-text{
    font-size:20px;
}

.finance-summary{
    margin-left: 12px;
    margin-right: 12px;
}

.summary-card{
    border-radius: 18px !important;
    border: 1px solid rgba(15, 23, 42, 0.08);
    padding: 18px 18px;
    box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
}

.summary-card .summary-label{
    display: block;
    font-size: 0.95rem;
    font-weight: 700;
    letter-spacing: 0.2px;
    margin-bottom: 10px;
    color: rgba(15, 23, 42, 0.75);
}

.summary-card .summary-value{
    margin: 0;
    font-size: 1.75rem;
    font-weight: 800;
    line-height: 1.1;
    color: #0f172a;
}

.summary-card .summary-value{
    background-clip: text;
    -webkit-background-clip: text;
    color: transparent;
    -webkit-text-fill-color: transparent;
}

.summary-card.alert-success .summary-value{ background-image: linear-gradient(90deg, #15803d, #22c55e, #4ade80); }
.summary-card.alert-info .summary-value{ background-image: linear-gradient(90deg, #1d4ed8, #3b82f6, #60a5fa); }
.summary-card.alert-danger .summary-value{ background-image: linear-gradient(90deg, #b91c1c, #ef4444, #fb7185); }
.summary-card.alert-warning .summary-value{ background-image: linear-gradient(90deg, #b45309, #f59e0b, #fbbf24); }

.summary-card.alert-success{ background: linear-gradient(180deg, rgba(34,197,94,0.18), rgba(34,197,94,0.10)); }
.summary-card.alert-info{ background: linear-gradient(180deg, rgba(59,130,246,0.18), rgba(59,130,246,0.10)); }
.summary-card.alert-danger{ background: linear-gradient(180deg, rgba(239,68,68,0.18), rgba(239,68,68,0.10)); }
.summary-card.alert-warning{ background: linear-gradient(180deg, rgba(245,158,11,0.20), rgba(245,158,11,0.10)); }

.summary-card:hover{
    transform: translateY(-2px);
    transition: transform 160ms ease, box-shadow 160ms ease;
    box-shadow: 0 16px 34px rgba(15, 23, 42, 0.12);
}
</style>

<!--
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                </ol>
            </div>
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>
 
-->
<br>






 <!-- end page title -->
 @if(Auth::check() && Auth::user()->role=='Admin')


<div class="row">
    <div class="col-sm-4">
            <div class="alert alert-success" role="alert">
                <strong>Total Debit (Ksh)</strong> 
                <h1 id="totalExpectedFee">Loading ...</h1>
            </div>
    </div>

    <div class="col-sm-4">
            <div class="alert alert-info" role="alert">
                <strong>Total Credit  (Ksh)</strong> 
                <h1 id="totalFeePaid">Loading ..</h1>
            </div>
    </div>


    <div class="col-sm-4">
            <div class="alert alert-danger" role="alert">
                <strong>Balance (Ksh)</strong> 
                <h1 id="balanceToPay">Loading ....</h1>
            </div>
    </div>


</div>
 <!-- end page title -->

   <div class="row">
        <div class="col-xl-5 col-lg-6">

            <div class="row">
                <div class="col-sm-6">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-account-multiple widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Administrators</h5>
                            <h3 class="mt-3 mb-3" id="total_admin">Loading ...</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 5.27%</span>
                               <span class="text-nowrap">
                                     <a href="{{route('showAdministrator')}}">More Info </a>
                               </span>
                            </p>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-sm-6">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-cart-plus widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Trainees</h5>
                            <h3 class="mt-3 mb-3" id="total_trainees">Loading ...</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-danger me-2" ><i class="mdi mdi-arrow-down-bold"></i> 1.08%</span>
                                <span class="text-nowrap">
                                     <a href="{{route('showTrainees')}}">More Info</a>
                                </span>
                            </p>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div> <!-- end row -->

            <div class="row">
                <div class="col-sm-6">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-currency-usd widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Traineer</h5>
                            <h3 class="mt-3 mb-3" id="total_trainer">Loading ...</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                                <span class="text-nowrap"> <a href="{{route('showTrainees')}}">More Info</a></span>
                            </p>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-sm-6">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-pulse widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Growth">Courses</h5>
                            <h3 class="mt-3 mb-3" id="total_courses">Loading ...</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 4.87%</span>
                                <span class="text-nowrap">
                                      <a href="{{route('showCourses')}}">More Info</a>
                                </span>
                               
                            </p>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div> <!-- end row -->

        </div> <!-- end col -->

        <div class="col-xl-7 col-lg-6">
        <canvas id="enrollmentChart" width="400" height="200"></canvas>

        </div> <!-- end col -->
    </div>
    <!-- end row -->


 @endif


 @if(Auth::check() && Auth::user()->role=='High_school_teacher')

   <?php
    $student=count(User::where('school_id', Auth::user()->school_id)
    ->whereIn('clas_category', ['Form One', 'Form Two', 'Form Three', 'Form Four'])->get());
   ?>
    <div class="row">

        <div class="col-xxl-3 col-sm-3">
            <div class="card widget-flat bg-success text-white">
                <div class="card-body">
                    <div class="float-end">
                        <i class="mdi mdi-account-multiple widget-icon bg-white text-success"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Total Students</h6>
                    <h3 class="mt-3 mb-3">{{$student ?? 'NA'}}</h3>

                    <a href="{{route('highSchoolTeacherViewStudent')}}" class="btn btn-sm">Click Here to Enrol Student</a>
                </div>
            </div>
        </div> <!-- end col-->

       

    </div>
    <!-- end row-->



 @endif

 @if(Auth::check() && Auth::user()->role=='scholarship_test_student' or Auth::user()->role=='ict_club_student')


 <div class="row">
    <div class="col-sm-8">

        <div class="alert alert-success" role="alert">
            <strong> <h3>Dear {{Auth::user()->firstname ?? ''}} {{Auth::user()->lastname ?? ''}}</strong></h3>
            <p>
                Techsphere Training Institute congratulates you for showing interest to be admitted this year student partial 
                scholarship test. The test question are simple and any students can do it. After the test kindly remember to
                download your scholarship letter.

                
            </p>
            <a href="{{route('showScholarshipTest')}}" class="btn btn-danger">Click Here to begin the test</a>  <a href="{{route('showFormFourScholarshipLetter')}}" class="btn btn-success">Click Here to download scholarship Letter</a>
        </div>

    </div>

       <!-- end col-->
       <div class="col-sm-4">
             <div class="card">
                 <div class="card-header">
                         <h4 class="header-title mb-4">Assesment Analysis</h4>
                         <!--<p>This is your Avarage Assesment</p>-->
                 </div>

                 <div class="card-body">
                     <table class="table table-bordered">
                         <tbody>
                            
                             <tr>
                                 <td><h2>Score</h2></td>
                                 <td><h2>{{$avgCat}} (<a href="{{route('showScholarshipTest')}}">View</a>) </h2></td>
                             </tr>

                         </tbody>

                     </table>
                 </div>
             </div>
         </div>






</div>





@endif



@if(Auth::check() && Auth::user()->role=='Trainee' && Auth::user()->has_paid_reg_fee=='Yes')

<div class="row">
    <div class="col-sm-12">
         
    <div class="welcome-card">
        <div class="card-content">
            <h1>Welcome back, {{Auth::user()->firstname}} 👋</h1>
            <p>Techsphere wishes to congratulate you on your 2025 KCSE results and thanks you for expressing interest in learning with us. We wish you a great learning experience with us.</p>

            <div class="info-row">
                @php
                    $clockTimeId = 'clock-time-' . (Auth::id() ?? 'guest');
                    $clockDateId = 'clock-date-' . (Auth::id() ?? 'guest');
                    $now = now();
                @endphp
                <span class="info-pill" id="{{ $clockTimeId }}">🟢 {{ $now->format('h:i:s A') }}</span>
                <span class="info-pill" id="{{ $clockDateId }}">📅 {{ $now->format('l, F j') }}</span>
            </div>

            <script>
                (function () {
                    var timeEl = document.getElementById(@json($clockTimeId));
                    var dateEl = document.getElementById(@json($clockDateId));
                    if (!timeEl || !dateEl) return;

                    function pad(n) { return String(n).padStart(2, '0'); }

                    function update() {
                        var d = new Date();
                        var hours = d.getHours();
                        var ampm = hours >= 12 ? 'PM' : 'AM';
                        hours = hours % 12;
                        hours = hours ? hours : 12;

                        timeEl.textContent = '🟢 ' + pad(hours) + ':' + pad(d.getMinutes()) + ':' + pad(d.getSeconds()) + ' ' + ampm;
                        dateEl.textContent = '📅 ' + d.toLocaleDateString(undefined, { weekday: 'long', month: 'long', day: 'numeric' });
                    }

                    update();
                    setInterval(update, 1000);
                })();
            </script>

            <div class="info-row">
                <span class="info-pill">🧳 {{ $totalCoursesEnrolled }} Course(s)</span>
                <span class="info-pill">👥 {{ $totalAssessmentsDone }} Assesment(s)</span>
            </div>
        </div>

        <div class="card-actions">
            @if(Auth::user()->has_paid_reg_fee=='Yes')
            <a href="{{ route('traineePrintingReceiptForRegistration') }}" class="btn primary"><i class="fa fa-download"></i> Download Payment Receipt for Registration </a>
            @endif
            <a href="{{ route('userAccount') }}" class="btn secondary">⚙️Settings</a>
        </div>
    </div>



    </div>
</div>


<br>

<div class="finance-summary">
    <div class="card" style="border-radius:20px">
            <div class="card-body">
                  
                 <div class="row">
                    <div class="col-12 col-sm-6 col-lg-3 mb-3">
                        <div class="alert alert-success alert-cards summary-card" role="alert">
                            <span class="summary-label">Total Debit (Ksh)</span>
                            <h1 class="summary-value">Ksh {{ Auth::user()->course->course_price ?? '0' }}.00</h1>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-3 mb-3">
                        <div class="alert alert-info alert-cards summary-card" role="alert">
                            <span class="summary-label">Total Credit (Ksh)</span>
                            <h1 class="summary-value">{{ $credit ?? 'NA' }}.00</h1>
                        </div>
                    </div>


                    <div class="col-12 col-sm-6 col-lg-3 mb-3">
                        <div class="alert alert-danger alert-cards summary-card" role="alert">
                            <span class="summary-label">Balance (Ksh)</span>
                            <h1 class="summary-value">{{ $balance ?? 'NA' }}.00</h1>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-3 mb-3">
                        <div class="alert alert-warning alert-cards summary-card" role="alert">
                            <span class="summary-label">Total Course</span>
                            <h1 class="summary-value">{{ $totalCoursesEnrolled ?? 0 }}</h1>
                        </div>
                    </div>



                   </div>




             </div>

        </div> <!-- end col -->

</div>



   
@endif

@if(Auth::check() && Auth::user()->role=='Applicant')
<div class="row">
    
    <div class="col-sm-12">

        <div class="alert alert-success" role="alert">
             <strong> <h3>Dear {{Auth::user()->firstname ?? 'NA'}} {{Auth::user()->lastname ?? 'NA'}}</strong></h3>

             <h3 style="text-transform:uppercase"><u>RE: ADMISSION INTO {{Auth::user()->course->course_name ?? 'NA'}} COURSE !</u></h3>

             <p>
                Congratulations on being awarded a scholarship to join Techsphere Training Institute and For
                expressing interest in our <b>{{Auth::user()->course->course_name}} COURSE !</b> . We are
                excited about the possibility of having you in our learning community and commend your
                enthusiasm to gain valuable programming skills.
            </p>

           
            <strong> <h3>How to pay registration Fee (Ksh 1000)</strong></h3>
            <p>Pay Ksh 1000 to techsphere training institute and send the payment details to : +254768919307. Choose one payment option</p>
            
            <p><b>Mpesa</b></p>
            <ul>

                <li>Business Name: Techsphere Institute</li>
                <li>Paybill: 522533</li>
                <li>Acc No: 7855887</li>

            </ul>
           

            <p><b>Bank</b></p>

            <ul>
                <li>Bank: Kenya Comercial Bank</li>
                <li>Acc Name: Techsphere Institute</li>
                <li>Acc No: 1327338564</li>
            </ul>
           

           <br>
            <a href="{{route('applicantDownloadAdmissionLetter')}}" class="btn btn-warning">Download Admission Letter</a>
        </div>

    </div>



</div>
@endif



<!-- Add User modal -->
<div id="feeReminderModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Fee Reminder</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form>
                @csrf
               

                <!-- /.card-header -->
                <div class="card-body">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-success" role="alert">
                                    <strong>Notice ! </strong> 
                                    <p>
                                        <ol>
                                            <li>You have fee balance of  Ksh<span id="feeBalance" style="color:red;font-size:20px"> </span></li>
                                            <li> Pay at least Ksh <span id="payment" style="color:red;font-size:20px">*</span> by <span id="endOfMonth" style="color:red;font-size:20px"></span> to avoid interuption</li>
                                        </ol>
                                    </p>
                                </div>

                            </div>
                        </div>

                     
                </div>
                 <!-- /.card-body -->


            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger rounded-pill"  data-bs-dismiss="modal">Close</button>
                
            </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--end of modal-->




@endsection

@section('scripts')


<script>
        /*Function to check company settings and show modal if necessary
        function fetchFeeBalance() {
            $.ajax({
                url: "{{ route('fetchFeeBalance') }}",
                method: 'GET',
                success: function(response) {
                    // Check the conditions for showing the modal
                    if (response.balance > 0) {
                        $('#feeBalance').text(response.balance);
                        $('#payment').text(response.payment);
                        $('#endOfMonth').text(response.endOfMonth);
                        // Show the modal if both statuses are 1
                        $('#feeReminderModal').modal('show');
                    }
                },
                error: function(error) {
                    console.log('Error fetching company details:', error);
                }
            });
        }

        // Call the function immediately when the page loads
        fetchFeeBalance();

        // Set an interval to run the check every 5 seconds (5000 milliseconds)
        setInterval(fetchFeeBalance, 5000);
        */





        $(document).ready(function(){

            fetchadminDashboardUpdates();


            function fetchadminDashboardUpdates(){
                    $.ajax({
                        type:'GET',
                        url:"{{route('fetchAdminDashboardUpdates')}}",
                        dataType:'json',
                        success:function(response){

                            //Update ui with the fee collected
                            $('#totalExpectedFee').text('Ksh ' + response.totalExpectedFee);
                            $('#totalFeePaid').text('Ksh ' + response.totalFeePaid);
                            $('#balanceToPay').text('Ksh '+  response.balanceToPay);
                            $('#total_trainees').text(response.total_trainees);
                            $('#total_admin').text(response.total_admin);
                            $('#total_courses').text(response.total_courses);
                            $('#total_trainer').text(response.total_trainer);
                        },

                        error:function(err){
                            console.error('Error fetching total fee:', err);
                        }
                    });
            }

            setInterval(fetchadminDashboardUpdates, 3000);
            fetchadminDashboardUpdates();


    });








</script>



@endsection