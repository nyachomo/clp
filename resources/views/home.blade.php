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




@if(Auth::check() && Auth::user()->role=='Student')

<!-- end page title --> 

<div class="row">
    <div class="col-xl-4 col-lg-5">
        <div class="card text-center">
            @if(Auth::check())
            <div class="card-body">
                <img src="{{asset('images/profile/profile.png')}}" class="rounded-circle avatar-lg img-thumbnail"
                alt="profile-image">
                 
                
              
                <div class="text-start mt-3">
                   




                <table class="table table-sm table-centered mb-0 .table-hover table-bordered">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{Auth::user()->firstname}} {{Auth::user()->secondname}} {{Auth::user()->lastname}}</td>
                        </tr>

                        <tr>
                            <th>Course</th>
                            <td> {{Auth::user()->course->course_name ?? 'NA'}}</td>
                        </tr>

                        <tr>
                            <th>Class</th>
                            <td> {{Auth::user()->clas->clas_name ?? 'NA'}}</td>
                        </tr>


                        <tr>
                            <th>Gender</th>
                            <td> {{Auth::user()->gender ?? 'NA'}}</td>
                        </tr>

                        <tr>
                            <th>Role</th>
                            <td> {{Auth::user()->role ?? 'NA'}}</td>
                        </tr>
                    </tbody>
                </table>









                </div>

                
            </div> <!-- end card-body -->
            @endif
        </div> <!-- end card -->

        

    </div> <!-- end col-->

    <div class="col-xl-8 col-lg-7">
      




    <div class="row">
        <div class="col-sm-4">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="mdi mdi-account-multiple widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">TOTAL DEBIT</h5>
                    <h3 class="mt-3 mb-3">36,254</h3>
                    
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> 

        <div class="col-sm-4">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="mdi mdi-cart-plus widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-normal mt-0" title="Number of Orders">TOTAL CREDIT</h5>
                    <h3 class="mt-3 mb-3">5,543</h3>
                   
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> 

        <div class="col-sm-4">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="mdi mdi-account-multiple widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">BALANCE</h5>
                    <h3 class="mt-3 mb-3">36,254</h3>
                  
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>

    </div> 





    </div> <!-- end col -->
</div>
<!-- end row-->


@endif








@endsection
