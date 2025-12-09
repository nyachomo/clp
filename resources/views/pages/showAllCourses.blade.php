@extends('layouts.website')
@section('content')
<!--====== PAGE BANNER PART START ======-->
    
<!--<section id="page-banner" class="pt-50 pb-50 bg_cover" data-overlay="8" style="background-image: url('{{asset('frontend/images/page-banner-2.jpg')}}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Courses</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>-->
                                <!--<li class="breadcrumb-item"><a href="#">Courses</a></li>-->
                                <!--<li class="breadcrumb-item active" aria-current="page">Courses</li>
                            </ol>-->
                            <!--<button type="button" class="main-btn" data-toggle="modal"  data-target="#enrolModal">Enrol</button>-->
                       <!-- </nav>-->
                    <!--</div> 
                </div>
            </div> 
        </div> 
    </section>-->
    

   

     <!--====== COURSES PART START ======-->
     <div class="row" style="max-width:100%; width:100%; margin:0;">
        <div class="col-sm-12" style="background-color:#07294d;padding-top:20px;padding-bottom:20px;">
            <center><h1 style="color:white">Our AI Powered Courses</h1></center>
        </div>
    </div>

    <div class="row" style="max-width:100%; width:100%; margin:0;">
        <div class="col-sm-12" style="padding-top:20px;padding-bottom:20px;">
           <p>
                 At Techsphere Training Institute, we offer a wide range of industry-driven AI powered courses designed to equip learners with practical, in-demand skills. Our programs include Full-Stack Software Engineering, Cybersecurity and Ethical Hacking, Graphic Design and Animation, Digital Marketing, Data Analysis, Data Science, and Machine Learning & Artificial Intelligence. Each course is carefully structured to prepare students for real-world challenges while opening doors to exciting career opportunities in the digital economy.
           </p>
        </div>
    </div>

    
     <section id="apply-aprt" class="pb-40" >
        <div class="container-fliud">

            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="courses-grid" role="tabpanel" aria-labelledby="courses-grid-tab">
                    <div class="row" style="padding-bottom: 20px;border-radius: 10px;">
                        @foreach($courses as $key=>$course)
                        <div class="col-lg-4 col-md-6">
                            <div class="singel-course mt-30">
                                <div class="thum">
                                    <div class="image" style="max-height:180px">
                                        <img src="{{asset('images/courses/'.$course->course_image)}}" alt="Course">
                                    </div>
                                    <div class="price">
                                        <span>50%</span>
                                    </div>
                                </div>
                                <div class="cont">
                                    
                                    <a href="courses-singel.html"><h5>{{$course->course_name ?? 'NA'}}</h5></a>
                                    <!--<p style="text-align:justify">{{$course->course_description ?? 'NA'}}</p>-->
                                    <p style="text-align:justify">
                                        @if(strlen($course->course_description) > 100)
                                            {{ substr($course->course_description, 0, 100) }}...
                                            <span id="more-{{$key}}" style="display:none">{{ substr($course->course_description, 300) }}</span>
                                            <a href="{{route('showSingleCourse',['id'=>$course->id])}}" class="yellowColor">Read More</a>
                                        @else
                                            {{$course->course_description ?? 'NA'}}
                                        @endif
                                    </p>


                                   <!-- <div class="course-teacher">
                                        
                                        <div class="name" style="padding-top: 10px;">
                                            <span style="color:#ffc600"><i class="fa fa-clock-o"></i></span> <a href="#"><h6 style="color:#000033"> &nbsp;{{$course->course_duration ?? 'NA'}} Weeks</h6></a>
                                        </div>
                                        <div class="admin">
                                            <ul>
                                                <li><a href="#"><span style="color:#ffc600"><i class="fa fa-user"></i></span><span><h6 style="color:#001a33"> &nbsp;{{$course->course_leaners_already_enrolled ?? 'NA'}} Enrolled Students</h6></span></a></li>
                                               
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="course-teacher">
                                       
                                        <div class="name" style="padding-top: 10px;">
                                            <span style="color:#ffc600"><i class="fa fa-clone"></i></span> <a href="#"><h6 style="color:#000033"><?php  echo$course->course_duration*5?> &nbsp;Leactures </h6></a>
                                                 
                                                
                                               
                                           
                                        </div>
                                        <div class="admin">
                                            <ul>
                                               <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li> <span style="color:#000033"><h6><b>({{$course->course_two_like}} Reviws)</b></h6></span></li>
                                                
                                            </ul>
                                           
                                        </div>
                                    </div>-->

                                    
                                   
                                   
                                    <div class="course-teacher">
                                       
                                        <div class="name">
                                            <a href="#"><h4><b class="yellowColor">Ksh:</b> <b class="blueColor">{{$course->course_price ?? 'NA'}}</b></h4></a> 
                                        </div>
                                        <div class="admin" style="padding-top: 10px;">
                                            <!--<button type="button" data-toggle="modal" data-target="#enrolModal{{$course->id}}" class="btn readMore" style="border-radius: 50px;"><b>Enrol</b></button>-->
                                            <!--<a href="{{route('pages.signup',['id'=>$course->id])}}" class="btn readMore" style="border-radius: 50px;padding-left:30px;padding-right:30px;"><b>Enrol</b></a>-->
                                            <a href="{{route('apply')}}" class="btn readMore" style="border-radius: 50px;padding-left:30px;padding-right:30px;"><b>Enrol</b></a>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- singel course -->
                        </div>


                        <!--ENROLMENT MODAL-->

                        <div class="modal fade zoom" id="enrolModal{{$course->id}}">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color:#000033;padding:15px 15px">
                                        <h3 style="color:#ffc600;text-align:center;">{{$course->course_name}}</h3>
                                        <!--<p style="color:white;font-size:40px">Enrol</p>-->
                                    </div>
                                    <form method="POST" action="{{route('register')}}">
                                        @csrf
                                    <div class="modal-body">
                                        <input type="password" name="password"  class="form-control" value="12345678" hidden="true">
                                        <div class="row">
                                             <div class="col-sm-12">
                                                <div class="form-group">
                                                     <label class="blueColor labelFontSize">Firstname (eg John)</label>
                                                     <input type="text" name="firstname" class="form-control" required min="3">
                                                </div>
                                             </div>
                                        </div>

                                        <div class="row">
                                             <div class="col-sm-12">
                                                <div class="form-group">
                                                     <label class="blueColor labelFontSize">Lastname (Eg Doe)</label>
                                                     <input type="text" name="lastname" class="form-control" required min="3">
                                                </div>
                                             </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label class="blueColor labelFontSize">Gender</label>
                                                <select class="form-control" name="gender" required>
                                                    <option value="">Select ..</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>   

                                            </div>
                                        </div>

                                        <div class="row">
                                             <div class="col-sm-12">
                                                <div class="form-group">
                                                     <label class="blueColor labelFontSize">Phonenumber (Eg +2547xxxxxxx)</label>
                                                     <input type="text" name="phonenumber" class="form-control" pattern="^\+254\d{9}$"  title="Phone number must start with +254 followed by 9 digits (e.g., +254712345678)" required>
                                                </div>
                                             </div>
                                        </div>

                                        <div class="row">
                                             <div class="col-sm-12">
                                                <div class="form-group">
                                                     <label class="blueColor labelFontSize">Email Address (eg johndoe@example.com)</label>
                                                     <input type="email" name="email" class="form-control"   pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Please enter a valid email (e.g., user@example.com)" required>
                                                </div>
                                             </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" name="has_paid_reg_fee"   class="form-control" value="No" >   
                                                <input type="text" name="role"   class="form-control" value="Trainee" >
                                                <input type="text" name="course_id"   class="form-control" value="{{$course->id}}">  
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer d-flex justify-content-between">
                                        <button type="button" class="btn main-btn" data-dismiss="modal" style="background-color:red;color:white;border-radius:50px;border:1px solid red">Close</button>
                                        <button type="submit" class="btn main-btn" style="border-radius:50px;">Enrol</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>



                        <!--END OF ENROLMENT BUTTON-->
                        @endforeach

                       
                        
                    </div> <!-- row -->
                </div>
                
            </div> <!-- tab content -->
           
        </div> <!-- container -->
    </section>
    
    <!--====== COURSES PART ENDS ======-->


  
    

@endsection