@extends('layouts.master')
@section('content')

<style>

#pagination-controls {
    display: flex;
    justify-content: right;
    align-items: right;
    margin-top: -2px;
    padding-right:50px;
    padding-top:-500px;
    padding-bottom:10px;
    gap: 10px; /* Spacing between buttons */
  }

     #pagination-controls button {
        background-color: #007bff; /* Bootstrap primary color */
        color: white;
        border: none;
        border-radius: 50px;
        padding: 2px 10px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
  }

  #pagination-controls .active {
    background-color: #28a745; /* Green for active page */
  }
</style>

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                </ol>
            </div>
            <h4 class="page-title">Courses</h4>
        </div>
    </div>
</div>
<!-- end page title -->



<div id="response"></div>


@if (session('success'))
    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div id="error-alert"  class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session('error') }}
    </div>
@endif




<div id="message-container" class="mt-3"></div>

<div class="row">
     <div class="col-sm-12">
         <div class="card">
             <div class="card-body">
                <h4 class="header-title">Statistic</h4>
                 <div class="row">
                     <div class="col-sm-4">
                            <div class="alert alert-success" role="alert">
                                <strong>DEBIT (KSH)</strong> 
                                <p id="all_courses">{{$debit??''}}</p>
                            </div>

                     </div>

                     <div class="col-sm-4">

                        <div class="alert alert-warning" role="alert">
                            <strong>CREDIT (KSH)</strong> 
                            <p id="active_courses">{{$credit??''}}</p>
                        </div>

                     </div>
                     <div class="col-sm-4">

                        <div class="alert alert-danger" role="alert">
                            <strong>BALANCE (KSH)</strong>
                            <p id="suspended">{{$balance??''}}</p>
                        </div>

                     </div>

                 </div>
             </div>
         </div>
     </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Payment Record for : ({{$user->firstname??''}} {{$user->secondname??''}} {{$user->lastname??''}})</h5>
                <a type="button" style="float:right" class="btn btn-sm btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#addFeeModal"> <i class="uil-plus"></i>Add New Fee</a>

                <!-- Default Drodown -->


            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-1" style="padding-top:4px">
                         <label for="example-select" class="form-label" style="float:right;">Show</label>
                    </div>
                    <div class="col-sm-2">
                       
                       
                    <select class="form-select" id="select">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>



                    </div>

                    <div class="col-sm-6"></div>

                    <div class="col-sm-1" style="padding-top:6px">
                         <label for="example-select" class="form-label" style="float:right;">Search</label>
                    </div>

                    <div class="col-sm-2">
                          <input type="text" id="search" name="search" class="form-control" placeholder="Search Courses...">
                    </div>

                </div>
                <br>
                <div class="tab-content">
                    <div class="table-responsive">
                        
                        <table id="table1" class="table table-sm table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Amount Paid</th>
                                    <th>Pyment Method</th>
                                    <th>Date Paid</th>
                                    <th>Ref No</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @if(!empty($fees))
                                    @foreach($fees as $key=>$fee)
                                       <tr>
                                           <td>{{$key+1}}</td>
                                           <td>{{$fee->amount_paid}}</td>
                                           <td>{{$fee->payment_method}}</td>
                                           <td>{{$fee->date_paid}}</td>
                                           <td>{{$fee->payment_ref_no}}</td>
                                           <td>

                                                <button class="btn btn-sm btn-success" href="#" data-bs-toggle="modal" data-bs-target="#updateFeeModal{{$fee->id}}" ><i class="fa fa-edit"></i> Edit</button>
                                                <button class="btn btn-sm btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteFeeModal{{$fee->id}}" ><i class="fa fa-trash"></i> Delete</button>
                                                                         
                                                <a href="{{ route('admindownloadReceipt', $fee->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-download"></i> Download Receipt
                                                </a>
                                                           

                                           </td>
                                           
                                       </tr>



                                       
                                        <!-- Add User modal -->
                                        <div id="updateFeeModal{{$fee->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="standard-modalLabel"><i class="uil-user-plus"></i> Add New User</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                    </div>
                                                    <form method="POST" action="{{route('updateFees')}}">
                                                        @csrf
                                                    

                                                        <!-- /.card-header -->
                                                        <div class="card-body">
                                                            <input type="text" class="form-control" name="id" value="{{$fee->id}}" hidden="true">

                                                            <div class="row">

                                                            <div class="col-sm-6">
                                                                    <!-- text input -->
                                                                    <div class="form-group">
                                                                        <label>Amount Paid<sup>*</sup></label>
                                                                        <input type="text" class="form-control" name="amount_paid" value="{{$fee->amount_paid}}" required>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <!-- text input -->
                                                                    <div class="form-group">
                                                                        <label>Date Paid<sup>*</sup></label>
                                                                        <input type="date" class="form-control" name="date_paid" value="{{$fee->date_paid}}"  required>
                                                                    </div>
                                                                </div>

                                                                

                                                            </div>

                                                            <div class="row">

                                                            <div class="col-sm-6">
                                                                    <!-- text input -->
                                                                    <div class="form-group">
                                                                        <label>Payment Method<sup>*</sup></label>
                                                                        <select name="payment_method" class="form-control" required>
                                                                            <option value="{{$fee->payment_method}}">{{$fee->payment_method}}</option>
                                                                            <option value="Mpesa">Mpesa</option>
                                                                            <option value="Cheque">Cheque</option>
                                                                            <option value="Cash">Cash</option>
                                                                            <option value="Bank Deposit">Bank Deposit</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <!-- text input -->
                                                                    <div class="form-group">
                                                                        <label>Reference No<sup>*</sup></label>
                                                                        <input type="text" class="form-control" name="payment_ref_no" value="{{$fee->payment_ref_no}}">
                                                                    </div>
                                                                </div>

                                                                

                                                            </div>



                                                        </div>
                                                        <!-- /.card-body -->


                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-danger rounded-pill"  data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"  class="btn btn-success rounded-pill">Save</button>
                                                    </div>
                                                </form>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                        <!--end of modal-->



                                        <!-- Add User modal -->
                                        <div id="deleteFeeModal{{$fee->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="standard-modalLabel"><i class="uil-user-plus"></i> Are you sure you want to delete this record</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                    </div>
                                                    <form method="POST" action="{{route('deleteFees')}}">
                                                        @csrf
                                              
                                                            <input type="text" class="form-control" name="id" value="{{$fee->id}}" hidden="true">



                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-danger rounded-pill"  data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"  class="btn btn-success rounded-pill">Delete</button>
                                                    </div>
                                                </form>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                        <!--end of modal-->


                                    @endforeach
                                 @endif
                            </tbody>
                        </table>                                           
                    </div> <!-- end preview-->
                
                </div> <!-- end tab-content-->
                
            </div> <!-- end card body-->

            <!--end of card-footer-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div> <!-- end row-->





<!-- Add User modal -->
<div id="addFeeModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel"><i class="uil-user-plus"></i> Add Fee</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="POST" action="{{route('addFees')}}">
                @csrf
               

                <!-- /.card-header -->
                <div class="card-body">
                    <input type="text" class="form-control" name="user_id" value="{{$user_id}}" hidden="true">

                    <div class="row">

                       <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Amount Paid<sup>*</sup></label>
                                <input type="text" class="form-control" name="amount_paid" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Date Paid<sup>*</sup></label>
                                <input type="date" class="form-control" name="date_paid" required>
                            </div>
                        </div>

                        

                    </div>

                    <div class="row">

                       <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Payment Method<sup>*</sup></label>
                                <select name="payment_method" class="form-control" required>
                                    <option value="">Select ... </option>
                                    <option value="Mpesa">Mpesa</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Bank Deposit">Bank Deposit</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Reference No<sup>*</sup></label>
                                <input type="text" class="form-control" name="payment_ref_no">
                            </div>
                        </div>

                        

                    </div>



                </div>
                 <!-- /.card-body -->


            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger rounded-pill"  data-bs-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-success rounded-pill">Save</button>
            </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--end of modal-->



@endsection
@section('scripts')
<script>
    

    $(document).ready(function(){




    // Automatically hide success and error messages after 5 seconds
    setTimeout(() => {
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            successAlert.style.transition = "opacity 0.5s";
            successAlert.style.opacity = "0";
            setTimeout(() => successAlert.remove(), 500); // Fully remove the element after fade-out
        }
        
        const errorAlert = document.getElementById('error-alert');
        if (errorAlert) {
            errorAlert.style.transition = "opacity 0.5s";
            errorAlert.style.opacity = "0";
            setTimeout(() => errorAlert.remove(), 500);
        }
    }, 5000); // 5000 milliseconds = 5 seconds


    function displaySuccessMessage(message) {
        let successMessage = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;

        // Append message to a container (e.g., #message-container)
        $('#message-container').html(successMessage);

        // Automatically remove the message after 5 seconds
        setTimeout(() => {
            $('.alert').alert('close');
        }, 5000);
    }


});



</script>
@endsection