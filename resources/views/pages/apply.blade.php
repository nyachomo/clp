@extends('layouts.website')
@section('content')
<!--====== PAGE BANNER PART START ======-->

<div class="row" style="max-width:100%; width:100%; margin:0;">
    <div class="col-sm-12" style="background-color:#07294d;padding-top:20px;padding-bottom:20px;">
        <center><h1 style="color:white">Apply/Enrol</h1></center>
    </div>
</div>



    <section id="contact-page" class="pt-20 pb-120 gray-bg">
        <div class="container-fliud">
            
            
            <div class="row">
               
                <div class="col-lg-12">





                <div class="card mission-card" style="background-color:#1fd1ff">
                      
                      <div class="card-body">
                           




                      <div class="contact-from" style="padding-top:5px !important">
                        <div class="section-title" >
                          <!--<h5>Fill the form bellow</h5>-->
                           
                        </div> <!-- section title -->
                       
                        <div class="main-form">
                            <form method="POST" action="{{route('register')}}">
                            @csrf
                                <div class="row">
                                  <div class="col-md-12">
                                        <div class="singel-form form-group">
                                            <label>Which Course Are You Interested In</label>
                                            <select class="form-control" name="course_id" required>
                                                <option value="">Select Course</option>
                                                @foreach($courses as $key=>$course)
                                                <option value="{{$course->id}}">{{$course->course_name}}</option>
                                                @endforeach
                                               
                                                
                                            </select>   
                                        </div>
                                    </div>

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
                                            <input name="phonenumber" type="text" class="form-control @error('phonenumber') is-invalid @enderror" value="{{ old('phonenumber') }}"   required="required">
                                           
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
                                            <input name="parent_phone" type="text" class="form-control @error('parent_phone') is-invalid @enderror" value="{{ old('parent_phone') }}"   required="required">
                                           
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
                     
                 </div>




                    
                </div>
                
              
            </div> <!-- row -->
        </div> <!-- container -->

    </section>
    

    
    
    <!--====== CONTACT PART ENDS ======-->
@endsection