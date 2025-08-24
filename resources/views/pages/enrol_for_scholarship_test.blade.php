@extends('layouts.website')
@section('content')
<!--====== PAGE BANNER PART START ======-->
 
<!--
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
                    </div>  
                </div>
            </div> 
        </div> 
    </section>-->
    
    <!--====== PAGE BANNER PART ENDS ======-->

    
   <section id="contact-page" class="pt-20 pb-120 gray-bg">
        <div class="container">
            
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="contact-from" style="padding-top:5px">
                        <div class="section-title">
                         
                            <center><h2 style="border-bottom:5px solid #ffc600">Enrol for Scholarship Test</h2></center>
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
                                            <label>Student Phonenumber</label>
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
                                            <label>Parent Phonenumber</label>
                                            <input name="parent_phone" type="text" class="form-control @error('parent_phone') is-invalid @enderror" value="{{ old('parent_phone') }}" placeholder="Phone eg +25470000000">
                                           
                                            @error('parent_phone')
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
                                            <label>School</label>
                                            <select class="form-control" name="school_id" required>
                                               <option value="">Select ...</option>
                                                @foreach($schools as $key=>$school)
                                                     <option value="{{$school->id}}">{{$school->school_name}}</option>
                                                @endforeach
                                            </select>   
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <div class="singel-form form-group">
                                            <label>Class</label>
                                            <select class="form-control" name="clas_category" required>
                                               <option value="">Select ...</option>
                                                <option value="Form Two">Form Two</option>
                                                <option value="Form Three">Form Three</option>
                                                <option value="Form Four">Form Four</option>
                                            </select>   
                                        </div>

                                    </div>


                                    <div class="col-md-12">

                                        <div class="singel-form form-group">
                                            <label>Should You Pass Partial Scholarship test, which course would you like to study with us<span class="labelSpan">*</span></label>
                                            <select class="form-control" name="prefered_course" required>
                                                <option value="">Select Course</option>
                                                <option value="Full-Stack Software Development">Full-Stack Software Development</option>
                                                <option value="Cyber Security And Ethical Hacking">Cyber Security And Ethical Hacking</option>
                                                <option value="Datascienec Machine Learning And AI">Datascience Machine Learning And AI</option>
                                                <option value="Graphic Design">Graphic Design</option>
                                                <option value="Digital Marketing And Search Engine Optimization">Digital Marketing And Search Engine Optimization</option>
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
                                            <button type="submit" class="main-btn" style="width:100%">Submit</button>
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