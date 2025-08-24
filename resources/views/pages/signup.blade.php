@extends('layouts.website')
@section('content')
<!--====== PAGE BANNER PART START ======-->

<!--
<section id="page-banner" class="pt-50 pb-50 bg_cover" data-overlay="8" style="background-image: url('{{asset('frontend/images/page-banner-2.jpg')}}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Enrol for:   {{$course->course_name ?? 'NA'}} Course</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">{{$course->course_name ?? 'NA'}} </a></li>
                                <li class="breadcrumb-item active" aria-current="page">Enrol</li>
                            </ol>
                           <h1 style="color:#ffc600">Price: Ksh {{$course->course_price}}</h1>
                           <h1 style="color:#ffc600">Duration: {{$course->course_duration}} Weeks</h1>
                        </nav>
                    </div>  
                </div>
            </div> 
        </div> 
    </section>-->
    
    <!--====== PAGE BANNER PART ENDS ======-->

    
   <section id="contact-page" class="pt-40 pb-120 gray-bg">
        <div class="container">
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-from" style="padding-top:5px !important">
                        <div class="section-title" >
                          <!--<h5>Fill the form bellow</h5>-->
                            <center><h2 style="border-bottom:5px solid #ffc600;">Apply for : {{$course->course_name}} Course</h2></center>
                        </div> <!-- section title -->
                       
                        <div class="main-form">
                            <form method="POST" action="{{route('register')}}">
                            @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
                                            <label>Firstname</label>
                                            <input name="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" value="{{ old('firstname') }}" placeholder="Firstname eg John" required="required">
                                            @error('firstname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> <!-- singel form -->
                                    </div>

                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
                                            <label>Lastname</label>
                                            <input name="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" value="{{ old('lastname') }}" placeholder="Lastname eg Doe"  required="required">
                                            @error('lastname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                           
                                        </div> <!-- singel form -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
                                            <label>Phonenumber</label>
                                            <input name="phonenumber" type="text" class="form-control @error('phonenumber') is-invalid @enderror" value="{{ old('phonenumber') }}" placeholder="Phone eg +25470000000"  required="required">
                                           
                                            @error('phonenumber')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div> <!-- singel form -->
                                    </div>

                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
                                            <label>Parent/Sponsor Phonenumber</label>
                                            <input name="parent_phone" type="text" class="form-control @error('parent_phone') is-invalid @enderror" value="{{ old('parent_phone') }}" placeholder="Phone eg +25470000000"  required="required">
                                           
                                            @error('phonenumber')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div> <!-- singel form -->
                                    </div>

                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
                                            <label>Email Address</label>
                                            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email eg johndoe@gmail.com" required="required">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> <!-- singel form -->
                                    </div>
                                   
                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
                                            <label>Password</label> 
                                            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Password" required="required">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> <!-- singel form -->
                                    </div>
                                   
                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
                                            <label>Confirm Password</label>
                                            <input  name="password_confirmation" required autocomplete="new-password" value="{{ old('password_confirmation') }}" type="password" placeholder="Confirm Password" required="required">
                                          
                                        </div> <!-- singel form -->
                                    </div>

                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
                                            <label>Gender</label>
                                            <select class="form-control" name="gender" required style="padding:20px" value="{{ old('gender') }}" >
                                                <option value="">Select Gender ..</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>   
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
                                            <input type="text" name="course_id" class="form-control" value="{{$course->id}}" hidden="true">
                                              
                                        </div>
                                    </div>
                                   
                                   
                                        <div class="col-md-12">
                                            <input type="text" name="has_paid_reg_fee"   class="form-control" value="No" hidden="true">   
                                            <input type="text" name="role"   class="form-control" value="Applicant" hidden="true">
                                        </div>
                                  


                                    <div class="col-md-12">
                                        <div class="singel-form">
                                            <button type="submit" class="main-btn" style="width:100%">Submit</button>
                                        </div> <!-- singel form -->
                                    </div> 
                                </div> <!-- row -->
                            </form>
                        </div> <!-- main form -->
                    </div> <!--  contact from -->
                </div>
               
            </div> <!-- row -->
        </div> <!-- container -->

    </section>
    
    <!--====== CONTACT PART ENDS ======-->
@endsection