@extends('layouts.website')
@section('content')
    <!--====== ABOUT PART START ======-->
    
    <section id="about-part">
        <div class="container-fliud" style="padding-left:80px;padding-right:0px">
            <div class="row">
                <div class="col-lg-5" style="background: linear-gradient(to right,#000033, #000033);">
                    <div class="section-title">
                        <!--<h5>About us</h5>-->
                        <h2 style="color:#ffc600">Techsphere </h2>
                    </div> <!-- section title -->

                    <div class="about-cont">
                        <p style="color:white">We are committed to delivering high-quality education and training that bridges the gap between theoretical learning and practical application, ensuring our students are well-prepared for real-world challenges. <br> </p>
                       <!----<a href="#" class="main-btn mt-55">Learn More</a>-->
                        <!--<a href="#" class="main-btn mt-55">Learn More</a>-->
                    </div>
                   

                    <div class="slider-feature pt-30 d-none d-md-block">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-6">
                                <div class="singel-slider-feature justify-content-center mt-30">
                                    <div class="icon">
                                        <img src="{{asset('frontend/images/all-icon/man.png')}}" alt="icon">
                                    </div>
                                    <div class="cont">
                                        <h3>1300+</h3>
                                        <span>Students </span>
                                    </div>
                                </div> <!-- singel slider feature -->
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="singel-slider-feature justify-content-center mt-30">
                                    <div class="icon">
                                        <img src="{{asset('frontend/images/all-icon/book.png')}}" alt="icon">
                                    </div>
                                    <div class="cont">
                                        <h3>10+</h3>
                                        <span>Courses </span>
                                    </div>
                                </div> <!-- singel slider feature -->
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="singel-slider-feature justify-content-center mt-30">
                                    <div class="icon">
                                        <img src="{{asset('frontend/images/all-icon/expert.png')}}" alt="icon">
                                    </div>
                                    <div class="cont">
                                        <h3>23</h3>
                                        <span>Instructors </span>
                                    </div>
                                </div> <!-- singel slider feature -->
                            </div>
                        </div> <!-- row -->
                    </div> <!-- slider feature -->



                    <div class="about-cont">
                        <a href="#" class="main-btn mt-55">Learn More</a> 
                        <a href="#" class="main-btn mt-55" style="background-color: #1ad1ff;border:1px solid#1ad1ff ;">Learn More</a>
                    </div>



                </div> <!-- about cont -->
                <div class="col-lg-6" style="background: linear-gradient(to right,#000033, #000033);">
                   

                    <section id="slider-part" class="slider-active" >
                        <div class="single-slider bg_cover pt-150" style="background-image: url(logo/marketing1.jpg);" data-overlay="4">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12">
                                        <div class="slider-cont">
                                            <!--<h1 data-animation="bounceInLeft" data-delay="1s" style="font-size:55px">Choose the right theme for education</h1>-->
                                            <!--<p data-animation="fadeInUp" data-delay="1.3s">Donec vitae sapien ut libearo venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt  Sed fringilla mauri amet nibh.</p>-->
                                            <ul>
                                                <li><a data-animation="fadeInUp" data-delay="1.6s" class="main-btn" href="#">Read More</a></li>
                                                <li><a data-animation="fadeInUp" data-delay="1.9s" class="main-btn main-btn-2" href="#">Get Started</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div> <!-- row -->
                            </div> <!-- container -->
                        </div> <!-- single slider -->

                        <div class="single-slider bg_cover pt-150" style="background-image: url(logo/maketing2.png);height:100px;" data-overlay="4">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12">
                                        <div class="slider-cont">
                                            <h1 data-animation="bounceInLeft" data-delay="1s" style="font-size:55px">Choose the right theme for education</h1>
                                            <!--<p data-animation="fadeInUp" data-delay="1.3s">Donec vitae sapien ut libearo venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt  Sed fringilla mauri amet nibh.</p>-->
                                            <ul>
                                                <li><a data-animation="fadeInUp" data-delay="1.6s" class="main-btn" href="#">Read More</a></li>
                                                <li><a data-animation="fadeInUp" data-delay="1.9s" class="main-btn main-btn-2" href="#">Get Started</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div> <!-- row -->
                            </div> <!-- container -->
                        </div> <!-- single slider -->

                        
                        <div class="single-slider bg_cover pt-150" style="background-image: url(images/slider/s-3.jpg);height:100px" data-overlay="4">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12">
                                        <div class="slider-cont">
                                            <h1 data-animation="bounceInLeft" data-delay="1s" style="font-size:55px">Choose the right theme for education</h1>
                                            <!--<p data-animation="fadeInUp" data-delay="1.3s">Donec vitae sapien ut libearo venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt  Sed fringilla mauri amet nibh.</p>-->
                                            <ul>
                                                <li><a data-animation="fadeInUp" data-delay="1.6s" class="main-btn" href="#">Read More</a></li>
                                                <li><a data-animation="fadeInUp" data-delay="1.9s" class="main-btn main-btn-2" href="#">Get Started</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div> <!-- row -->
                            </div> <!-- container -->
                        </div> <!-- single slider -->
                        
                      
                        
                        
                    </section>





                </div>
            </div> <!-- row -->
        </div> <!-- container -->
       
    </section>
    
    <!--====== ABOUT PART ENDS ======-->
   
    <!--====== APPLY PART START ======-->
    
    <section id="apply-aprt" class="pb-40">
        <div class="container">
            <div class="apply">
                <div class="row no-gutters">
                    <div class="col-lg-6">
                        <div class="apply-cont apply-color-1">
                            <h3 style="border-bottom:4px solid #ffc600">Mission</h3>
                            <p style="text-align: justify;">At techsphere, our mission is to empower individuals and organizations with cutting-edge skills and knowledge that drive success in the ever-evolving world of technology. We are committed to delivering high-quality education and training that bridges the gap between theoretical learning and ....</p>
                            <a href="#" class="main-btn" data-toggle="modal" data-target="#mission">Read More</a>
                        </div> <!-- apply cont -->
                    </div>
                    <div class="col-lg-6">
                        <div class="apply-cont apply-color-2">
                            <h3 style="border-bottom:4px solid #ffc600">Vission</h3>
                            <p style="text-align: justify;">Our vision is to become a global leader in IT training, setting new standards for excellence in education. We aim to be the preferred choice for students and professionals seeking to advance their careers and for organizations looking to enhance the capabilities of their workforce...</p>
                            <a href="#" class="main-btn" data-toggle="modal" data-target="#vission">Read More</a>
                        </div> <!-- apply cont -->
                    </div> 
                </div>
            </div> <!-- row -->
        </div> <!-- container -->

        <div class="modal fade zoom" id="mission">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header" style="background-color:#ffc600;padding:50px 50px">
                          <center><h1 style="color:#000033;text-align: justify;">Mission</h1></center>
                      </div>
                      <div class="modal-body">
                          <p style="text-align: justify;">
                            At techsphere, our mission is to empower individuals and organizations with cutting-edge skills and knowledge that drive success in the ever-evolving world of technology. We are committed to delivering high-quality education and training that bridges the gap between theoretical learning and practical application, ensuring our students are well-prepared for real-world challenges
                            We believe in a student-centric approach to education. Our training programs are flexible, allowing students to choose between online and offline modes of learning. Whether you are a beginner looking to start a career in IT or a professional seeking to upgrade your skills, our courses are tailored to meet your specific needs. We emphasize interactive learning, with a blend of lectures, practical sessions, and real-world projects.
                          </p>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn main-btn" data-dismiss="modal">Close</button>
                      </div>
                  </div>
              </div>
        </div>


        <div class="modal fade zoom" id="vission">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#ffc600;padding:50px 50px">
                        <center><h1 style="color:#000033;text-align: justify;">Vission</h1></center>
                    </div>
                    <div class="modal-body">
                        <p style="text-align: justify;">
                          At techsphere, our mission is to empower individuals and organizations with cutting-edge skills and knowledge that drive success in the ever-evolving world of technology. We are committed to delivering high-quality education and training that bridges the gap between theoretical learning and practical application, ensuring our students are well-prepared for real-world challenges
                          We believe in a student-centric approach to education. Our training programs are flexible, allowing students to choose between online and offline modes of learning. Whether you are a beginner looking to start a career in IT or a professional seeking to upgrade your skills, our courses are tailored to meet your specific needs. We emphasize interactive learning, with a blend of lectures, practical sessions, and real-world projects.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn main-btn" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


    </section>
    
    <!--====== APPLY PART ENDS ======-->



    <section class="cardSection bg-white" style="padding-bottom: 40px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <div class="card">
                        <div class="card-body  bg-light">

                             <h1  class="card-title"><b>Welcome to Techsphere Training Institute</b></h1>

                            <p>
                              We offer comprehensive training programs in Full Stack Software Engineering, Data Science, Cyber Security, 
                              Graphic Design, and Mobile Application Development. Designed for learners of all levels, our hands-on courses, 
                              led by expert instructors, equip participants with practical skills to thrive in the tech industry and adapt to 
                              evolving career demands.
                            </p>

                            <h1  class="card-title"><b>Start Your digital Skills Career Today</b></h1>
                            <p>
                              Ready to break into tech? Techsphere Training Institute offers intensive bootcamps covering foundational concepts 
                              and industry best practices, equipping you with the skills to tackle real-world challenges and secure a fulfilling 
                              career.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="row">
                        <div class="col-sm-6">
                            <img src="{{asset('frontend/images/student1.jpeg')}}" class="img-rounded">
                        </div>
                        <div class="col-sm-6">
                          <img src="{{asset('frontend/images/student2.jpeg')}}" class="img-rounded">
                        </div>
                    </div>

                    <div class="row">
                         <div class="col-sm-12">
                            <center><h2 class="card-title"><b>Our Training Model</h2></b></center>
                         </div>
                    </div>
                    <div class="row" style="padding-top: 30px;">
                      <div class="col-sm-4">

                        <h5  class="card-title">Hands on skills training</h5>
                        <p>
                          We offer hands-on skill training programs that equip individuals with practical expertise through real-world 
                          applications, interactive learning, and collaborative projects.
                        </p>

                      </div>
                      <div class="col-sm-4">

                        <h5  class="card-title">Industrial Attachment</h5>
                         <p>
                          We offer project-based attachments where participants gain industry experience by working on real-world projects, 
                          applying academic knowledge in practical settings.
                         </p>

                        


                      </div>
                      <div class="col-sm-4">

                        <h5  class="card-title">Career mentorship</h5>
                       <p>
                        We offer career mentorship programs that connect individuals with experienced professionals, providing guidance, 
                        support, and tailored insights to achieve their career goals.
                       </p>


                      </div>
                    </div>
                </div>
            </div>
        </div>
      </section>
 


    <br></br>
    <br></br>
    <!--====== APPLY PART START ======-->
    
    <section id="apply-aprt" class="pb-0">
        <div class="container">
            <div class="apply">
                <div class="row no-gutters apply-color-2">
                    <div class="col-lg-3 col-sm-6">
                        <div class="singel-counter text-center mt-40 mb-40">
                            <span><span class="counter">30,000</span>+</span>
                            <p>Students enrolled</p>
                        </div> <!-- singel counter -->
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="singel-counter text-center mt-40">
                            <span><span class="counter">41,000</span>+</span>
                            <p>Courses Uploaded</p>
                        </div> <!-- singel counter -->
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="singel-counter text-center mt-40">
                            <span><span class="counter">11,000</span>+</span>
                            <p>People certifie</p>
                        </div> <!-- singel counter -->
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="singel-counter text-center mt-40">
                            <span><span class="counter">39,000</span>+</span>
                            <p>Global Teachers</p>
                        </div> <!-- singel counter -->
                    </div>
                   
                </div>
            </div> <!-- row -->
        </div> <!-- container -->

 
    </section>
    
    <!--====== APPLY PART ENDS ======-->

   



     <!--====== COURSES PART START ======-->
    
     <section id="apply-aprt" class="pb-40">
        <div class="container" >
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title pb-0">
                        <h2>Featured courses </h2>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
           
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="courses-grid" role="tabpanel" aria-labelledby="courses-grid-tab">
                    <div class="row bg-light" style="padding-bottom: 20px;border-radius: 10px;">
                        @foreach($courses as $key=>$course)
                        <div class="col-lg-4 col-md-6">
                            <div class="singel-course mt-30" style="border:1px solid #ffc600">
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


                                    <div class="course-teacher">
                                        <!--<div class="thum">
                                            <a href="#"><img src="logo/Logo.jpeg" alt="teacher"></a>
                                        </div>-->
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
                                                <!--<li><i class="fa fa-star"></i></li>-->
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li> <span style="color:#000033"><h6><b>({{$course->course_two_like}} Reviws)</b></h6></span></li>
                                                
                                            </ul>
                                           
                                        </div>
                                    </div>

                                    
                                   
                                   
                                    <div class="course-teacher">
                                       
                                        <div class="name">
                                            <a href="#"><h4><b class="yellowColor">Ksh:</b> <b class="blueColor">{{$course->course_price ?? 'NA'}}</b></h4></a> 
                                        </div>
                                        <div class="admin" style="padding-top: 10px;">
                                            <!--<button type="button" data-toggle="modal" data-target="#enrolModal{{$course->id}}" class="btn readMore" style="border-radius: 50px;"><b>Enrol</b></button>-->
                                            <a href="{{route('pages.signup',['id'=>$course->id])}}" class="btn readMore" style="border-radius: 50px;"><b>Enrol</b></a>
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

   
    
   
   
   
   
   
    
  