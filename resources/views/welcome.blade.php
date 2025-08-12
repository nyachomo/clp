@extends('layouts.website')
@section('content')


<!--====== FOOTER PART START ======-->
    
<footer id="footer-part">
        <div class="footer-top pt-40 pb-70">
            <div class="container-fliud">
                <div class="row">
                    

                <div class="col-lg-6">
                    <div class="section-title">
                        <!--<h5>About us</h5>-->
                        <h2 style="color:#ffc600;border-bottom:3px solid #ffc600;max-width:fit-content">Welcome to <span class="maroonColor">Techsphere</span> </h2>
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
                        <a href="#" class="main-btn mt-55" style="background-color: #ffc600;border:1px solid #ffc600 ;">Explore Courses <i class="fa fa-arrow-right"></i></a> 
                        <a href="#" class="main-btn mt-55" style="background-color: #1ad1ff;border:1px solid#1ad1ff ;"><i class="fa fa-download"></i>Download Brochure</a>
                    </div>



                </div> <!-- about cont -->
                <div class="col-lg-6">

                            <div class="row">
                               
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                    <img src="{{asset('frontend/images/student1.jpeg')}}" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                    <img src="{{asset('frontend/images/student2.jpeg')}}" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                    <img src="{{asset('frontend/images/student1.jpeg')}}" class="d-block w-100" alt="...">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>


                            




                               
                            </div> 
                  


                </div>





                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- footer top -->
        
       
    </footer>
    
    <!--====== FOOTER PART ENDS ======-->
    
   
   
    <!--====== APPLY PART START ======-->
    
    <section id="apply-aprt" class="pt-140 pb-40">
        <div class="container-fliud" style="width:fit">
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
        <div class="container-fliud">
            <div class="row">
                <div class="col-sm-5">
                    <div class="card" style="background-color:#1ad1ff">
                        <div class="card-body">

                             <h1  class="card-title"><b>Launch Your Tech Career Today</b></h1>

                            <p>
                              We offer comprehensive training programs in Full Stack Software Engineering, Data Science, Cyber Security, 
                              Graphic Design, and Mobile Application Development. Designed for learners of all levels, our hands-on courses, 
                              led by expert instructors, equip participants with practical skills to thrive in the tech industry and adapt to 
                              evolving career demands.
                            </p>

                            <h1  class="card-title"><b>Discover Excellence</b></h1>
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
                      <div class="col-sm-6">
                        <div class="card" style="background-color:#07294d">
                            
                            <div class="card-body">
                                <h3  class="card-title" style="color:white;border-bottom:3px solid #ffc600">Hands on skills training</h3>
                                <p style="color:white">
                                    We offer hands-on skill training programs that equip individuals with practical expertise through real-world 
                                    applications, interactive learning, and collaborative projects.
                                </p>

                            </div>
                        </div>

                        
                      </div>
                     
                      <div class="col-sm-6">
                          <div class="card" style="background-color:#07294d;">
                              <div class="card-body">
                                
                               <h3  class="card-title" style="color:white;border-bottom:3px solid #ffc600">Career mentorship</h3>
                                <p style="color:white">
                                    We offer career mentorship programs that connect individuals with experienced professionals, providing guidance, 
                                    support, and tailored insights to achieve their career goals.
                                </p>

                              </div>
                          </div>

                           


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
        <div class="container-fliud">
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
        <div class="container-fliud" >
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

   
    
   
   
   
   
   
    
  