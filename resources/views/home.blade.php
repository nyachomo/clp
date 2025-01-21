@extends('layouts.master')
@section('content')

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
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-account-multiple widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Aministrators</h5>
                        <h3 class="mt-3 mb-3">36,254</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 5.27%</span>
                            <span class="text-nowrap">Since last month</span>  
                        </p>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

            <div class="col-sm-3">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-cart-plus widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Teachers</h5>
                        <h3 class="mt-3 mb-3">5,543</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 1.08%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->


            <div class="col-sm-3">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-account-multiple widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Students</h5>
                        <h3 class="mt-3 mb-3">36,254</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 5.27%</span>
                            <span class="text-nowrap">Since last month</span>  
                        </p>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->


            <div class="col-sm-3">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-cart-plus widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Data Clerk</h5>
                        <h3 class="mt-3 mb-3">5,543</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 1.08%</span>
                            <span class="text-nowrap">More Info</span>
                        </p>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->




        </div> <!-- end row -->

        <div class="row">
            <div class="col-sm-3">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-currency-usd widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Courses</h5>
                        <h3 class="mt-3 mb-3">23</h3>
                        <p class="mb-0 text-muted">
                            <a href="{{route('showCourses')}}"><span class="text-nowrap">More Info</span></a>
                        </p>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

            <div class="col-sm-3">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-pulse widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Growth">Clases</h5>
                        <h3 class="mt-3 mb-3">+ 30.56%</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 4.87%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->





            <div class="col-sm-3">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-currency-usd widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Schools</h5>
                        <h3 class="mt-3 mb-3">$6,254</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->


            <div class="col-sm-3">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-currency-usd widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Leeds</h5>
                        <h3 class="mt-3 mb-3">$6,254</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->


        </div> <!-- end row -->





        <div class="row">
            <div class="col-sm-3">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-account-multiple widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Class Notes</h5>
                        <h3 class="mt-3 mb-3">36,254</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 5.27%</span>
                            <span class="text-nowrap">Since last month</span>  
                        </p>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

            <div class="col-sm-3">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-cart-plus widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Clases</h5>
                        <h3 class="mt-3 mb-3">5,543</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 1.08%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->


            <div class="col-sm-3">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-account-multiple widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Students</h5>
                        <h3 class="mt-3 mb-3">36,254</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 5.27%</span>
                            <span class="text-nowrap">Since last month</span>  
                        </p>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->


            <div class="col-sm-3">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-cart-plus widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Data Clerk</h5>
                        <h3 class="mt-3 mb-3">5,543</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 1.08%</span>
                            <span class="text-nowrap">More Info</span>
                        </p>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
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
                                        <h3 class="mt-3 mb-3 text-white">Ksh 10,245.00</h3>
                                       
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
                                        <h3 class="mt-3 mb-3 text-white">Ksh 10,245.00</h3>
                                        
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-xxl-3 col-sm-3">
                                <div class="card widget-flat bg-danger text-white">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <i class="mdi mdi-currency-usd widget-icon bg-light-lighten rounded-circle text-white"></i>
                                        </div>
                                        <h5 class="fw-normal mt-0" title="Revenue">Course</h5>
                                        <h3 class="mt-3 mb-3 text-white">1</h3>
                                        
                                    </div>
                                </div>
                            </div> <!-- end col-->




</div>
<!-- end row-->

<div class="row">
                           <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-4">Analysis</h4>
                                        

                                        <table class="table table-sm table-centered mb-0">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Amount (Ksh)</th>
                                                        <th>Date Paid</th>
                                                        <th>Menthod</th>
                                                        <th>Payment Ref No</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>11,250</td>
                                                        <td>12/12/2023</td>
                                                        <td>
                                                           Mpesa
                                                        </td>
                                                        <td>TAX45FRTEBT</td>
                                                    </tr>
                                                   
                                                </tbody>
                                        </table>





                                    </div>
                                    <!-- end card body-->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col-->
</div>


@endif








@endsection
