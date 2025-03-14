@extends('layouts.master')
@section('content')

<?php 
use App\Models\User;
use App\Models\Fee;
use App\Models\StudentAnswer;
use App\Models\Exam;
use App\Models\Question;

if(Auth::check() && Auth::user()->role=='Trainee'){

    $user_id=Auth::user()->id;
    $fees=Fee::where('user_id',$user_id)->get();
    $debit=Auth::user()->course->course_price?? 0;
    $credit=Fee::where('user_id',$user_id)->sum('amount_paid');
    $balance=$debit-$credit;

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
<!-- start page title -->
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
<!-- end page title --> 





 <!-- end page title -->
 @if(Auth::check() && Auth::user()->role=='Admin')

 <div class="row">
    <div class="col-xl-12 col-lg-12">

        <div class="row">
            <div class="col-sm-3">
                <a href="{{route('showTrainees')}}">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-account-multiple widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Number of Customers">TRAINEES</h5>
                        <h3 class="mt-3 mb-3">36,254</h3>
                        
                    </div>
                </div>
                </a>
            </div> <!-- end col-->

            <div class="col-sm-3">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-cart-plus widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Number of Orders">TRAINERS</h5>
                        <h3 class="mt-3 mb-3">5,543</h3>
                        
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->


            <div class="col-sm-3">
                <a href="{{route('showClases')}}">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-account-multiple widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Number of Customers">CLASES</h5>
                        <h3 class="mt-3 mb-3">36,254</h3>
                        
                    </div> <!-- end card-body-->
                </a>
                </div> <!-- end card-->
            </div> <!-- end col-->


            <div class="col-sm-3">
                <a href="{{route('showCourses')}}">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-cart-plus widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Number of Orders">COURSES</h5>
                        <h3 class="mt-3 mb-3">5,543</h3>
                        
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
                </a>
            </div> <!-- end col-->




        </div> <!-- end row -->






    </div> <!-- end col -->

   
</div>
<!-- end row -->
 @endif




@if(Auth::check() && Auth::user()->role=='Trainee')

<!-- end page title --> 

<div class="row">
                           <div class="col-xxl-3 col-sm-3">
                                <div class="card widget-flat bg-success text-white">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <i class="mdi mdi-account-multiple widget-icon bg-white text-success"></i>
                                        </div>
                                        <h6 class="text-uppercase mt-0" title="Customers">Debit</h6>
                                        <h3 class="mt-3 mb-3">Ksh {{Auth::user()->course->course_price?? '0'}}.00</h3>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-xxl-3 col-sm-3">
                                <div class="card widget-flat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <i class="mdi mdi-currency-usd widget-icon bg-light-lighten rounded-circle text-white"></i>
                                        </div>
                                        <h5 class="fw-normal mt-0" title="Revenue">Credit</h5>
                                        <h3 class="mt-3 mb-3 text-white">{{$credit ?? 'NA'}}</h3>
                                       
                                    </div>
                                </div>
                            </div> <!-- end col-->


                            <div class="col-xxl-3 col-sm-3">
                                <div class="card widget-flat bg-warning text-white">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <i class="mdi mdi-currency-usd widget-icon bg-light-lighten rounded-circle text-white"></i>
                                        </div>
                                        <h5 class="fw-normal mt-0" title="Revenue">Balance</h5>
                                        <h3 class="mt-3 mb-3 text-white">{{$balance ?? 'NA'}}</h3>
                                        
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-xxl-3 col-sm-3">
                                <a href="{{route('traineeViewCourse')}}">
                                <div class="card widget-flat bg-danger text-white">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <i class="mdi mdi-currency-usd widget-icon bg-light-lighten rounded-circle text-white"></i>
                                        </div>
                                        <h5 class="fw-normal mt-0" title="Revenue">Course</h5>
                                        <h3 class="mt-3 mb-3 text-white">1</h3>
                                        
                                    </div>
                                </div>
                               </a>
                            </div> <!-- end col-->




</div>
<!-- end row-->

<div class="row">

        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                        <h4 class="header-title mb-4">Fee Payments</h4>
                        @if(Auth::user()->has_paid_reg_fee=='Yes')
                        <a style="float:right" href="{{ route('traineePrintingReceiptForRegistration') }}" class="btn btn-sm btn-primary"><i class="fa fa-download"></i> Download Receipt For Registraion</a>
                        @endif
                </div>
                <div class="card-body">
                    
                    

                    <table class="table table-sm table-centered mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Amount (Ksh)</th>
                                    <th>Date Paid</th>
                                    <th>Menthod</th>
                                    <th>Payment Ref No</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($fees))
                                    @foreach($fees as $key=>$fee)
                                        <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$fee->amount_paid}}</td>
                                        <td>{{$fee->date_paid}}</td>
                                        <td>{{$fee->payment_method}}</td>
                                        <td>{{$fee->payment_ref_no}}</td>
                                        
                                        <td>
                                            <a href="{{ route('downloadReceipt', $fee->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-download"></i> Download Receipt
                                            </a>
                                        </td>
                                    </tr>
                                        
                                    @endforeach
                                @endif
                                
                            </tbody>
                    </table>





                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->


        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                        <h4 class="header-title mb-4">Assesment Analysis</h4>
                        <p>This is your Avarage Assesment</p>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Assignemt</td>
                                <td>{{$avgAssignment ?? 'NA'}}  ( <a href="{{route('traineeViewAssignment')}}"> View </a>)</td>
                            </tr>

                            <tr>
                                <td>Cats</td>
                                <td>{{$avgCat}} (<a href="{{route('traineeViewCats')}}">View</a>) </td>
                            </tr>

                            <tr>
                                <td>Final Exam</td>
                                <td>{{$avgFinalExam}} ( <a href="{{route('traineeViewFinalExam')}}"> View</a>)</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
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
</script>



@endsection