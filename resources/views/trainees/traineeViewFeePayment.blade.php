@extends('layouts.master')
@section('content')

<style>

/* ===== Page background ===== */
body {
    background: #f4f7fb;
}

/* ===== Page title box ===== */
.page-title-box {
    background: linear-gradient(135deg, #00264d, #ff0080);
    padding: 20px 25px;
    border-radius: 16px;
    color: #fff;
    margin-bottom: 25px;
}

.page-title {
    font-weight: 700;
    margin: 0;
}

/* Breadcrumb */
.breadcrumb {
    background: transparent;
    margin-bottom: 0;
}

.breadcrumb-item a {
    color: #fff;
    font-weight: 600;
}

.breadcrumb-item.active {
    color: rgba(255, 255, 255, 0.8);
}

/* ===== Alerts ===== */
.alert {
    border-radius: 14px;
    border: none;
    padding: 18px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

/* ===== Cards ===== */
.card {
    border: none;
    border-radius: 18px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
    margin-bottom: 25px;
}

.card-header {
    background: linear-gradient(135deg, #00264d, #ff0080);
    color: #fff;
    border-bottom: none;
    padding: 18px 22px;
}

.header-title {
    font-weight: 700;
    margin-bottom: 20px;
}

/* ===== Fee summary boxes ===== */
.card-body .alert {
    height: 100%;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-body .alert:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(0, 0, 0, 0.18);
}

.card-body .alert strong {
    display: block;
    font-size: 14px;
    letter-spacing: 1px;
}

.card-body .alert p {
    font-size: 22px;
    font-weight: 800;
    margin-top: 8px;
}

/* ===== Table ===== */
.table {
    font-size: 14px;
}

.table thead {
    background: #00264d;
    color: #fff;
}

.table thead th {
    border: none;
    padding: 14px;
    text-transform: uppercase;
    font-size: 12px;
}

.table tbody tr {
    transition: background 0.3s ease;
}

.table tbody tr:hover {
    background: rgba(255, 0, 128, 0.05);
}

.table td {
    padding: 14px;
    vertical-align: middle;
}

/* ===== Buttons ===== */
.btn {
    border-radius: 30px;
    font-weight: 600;
    padding: 6px 16px;
}

.btn-primary {
    background: linear-gradient(135deg, #00264d, #ff0080);
    border: none;
}

.btn-primary:hover {
    opacity: 0.9;
    transform: translateY(-2px);
}

/* ===== DataTable responsiveness ===== */
.table-responsive {
    border-radius: 14px;
    overflow: hidden;
}

</style>





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
                <h4 class="header-title">Fee Payment Summary</h4>
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
                <h4 class="header-title">Payment Record for : ({{$user->firstname??''}} {{$user->secondname??''}} {{$user->lastname??''}})</h4>
            </div>
            <div class="card-body">

                <div class="tab-content">
                    <div class="tab-pane show active">
                       
                        <table id="selection-datatable" class="table table-sm dt-responsive nowrap w-100">
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
                                                <a href="{{ route('downloadReceipt', $fee->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-download"></i> Download Receipt
                                                </a>
                                            </td>
                                           
                                       </tr>



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



@endsection
