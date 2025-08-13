@extends('layouts.website')
@section('content')
<!--====== PAGE BANNER PART START ======-->
    
<section id="page-banner" class="pt-50 pb-50 bg_cover" data-overlay="8" style="background-image: url('{{asset('frontend/images/page-banner-2.jpg')}}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Scholarship Test</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Scholarship Test </a></li>
                                <li class="breadcrumb-item active" aria-current="page">Enrol</li>
                            </ol>
                        </nav>
                    </div>  <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    
    <!--====== PAGE BANNER PART ENDS ======-->

    
   <section id="contact-page" class="pt-90 pb-120 gray-bg">
        <div class="container">
            
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="contact-from">
                        <div class="section-title">
                           <h5>Fill the form bellow</h5>
                            <!--<h2>Keep in touch</h2>-->
                        </div> <!-- section title -->
                       
                        <div class="main-form">
                            <form method="POST" action="{{route('register')}}">
                            @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
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
                                            <input  name="password_confirmation" required autocomplete="new-password" value="{{ old('password_confirmation') }}" type="password" placeholder="Confirm Password" required="required">
                                          
                                        </div> <!-- singel form -->
                                    </div>

                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
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
                                            <select class="form-control" name="school_id" required>
                                               <option value="">Select ...</option>
                                                @foreach($schools as $key=>$school)
                                                     <option value="{{$school->id}}">{{$school->school_name}}</option>
                                                @endforeach
                                            </select>   
                                        </div>
                                    </div>
                                   
                                   
                                        <div class="col-md-12">
                                            <input type="text" name="has_paid_reg_fee"   class="form-control" value="No" hidden="true">   
                                            <input type="text" name="role"   class="form-control" value="scholarship_test_student" hidden="true" >
                                            <input type="text" name="course_id"   class="form-control" value="{{$course->id}}" hidden="true">
                                            <input type="text" name="clas_id"   class="form-control" value="{{$clas->id}}" hidden="true">
                                        </div>
                                  


                                    <div class="col-md-12">
                                        <div class="singel-form">
                                            <button type="submit" class="main-btn">Submit</button>
                                        </div> <!-- singel form -->
                                    </div> 
                                </div> <!-- row -->
                            </form>
                        </div> <!-- main form -->
                    </div> <!--  contact from -->
                </div>
                <div class="col-lg-1"></div>
              
            </div> <!-- row -->
        </div> <!-- container -->

    </section>
    
    <!--====== CONTACT PART ENDS ======-->
@endsection