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
        <div class="container-fliud">
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



    <section class="cardSection" style="padding-bottom: 40px;">
        <div class="container-fliud">
            <div class="row">
                <div class="col-sm-5">
                    <div class="card" style="background-color:#ffc600">
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

                    <!--<div class="row">
                         <div class="col-sm-12">
                           
                            <center><h2 class="card-title"><b>Our Training Model</h2></b></center>
                         </div>
                    </div>-->
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
    
    <section id="apply-aprt" class="pb-50" >
        <div class="container-fliud">
            <div class="apply">
                <div class="row no-gutters apply-color-2" style="border-radius:7px">
                    <div class="col-lg-3 col-sm-6">
                        <div class="singel-counter text-center mt-40 mb-40">
                            <span><span class="counter">30,000</span>+</span>
                            <p style="text-align:center">Students enrolled</p>
                        </div> <!-- singel counter -->
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="singel-counter text-center mt-40">
                            <span><span class="counter">41,000</span>+</span>
                            <p style="text-align:center">Courses Uploaded</p>
                        </div> <!-- singel counter -->
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="singel-counter text-center mt-40">
                            <span><span class="counter">11,000</span>+</span>
                            <p style="text-align:center">People certifie</p>
                        </div> <!-- singel counter -->
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="singel-counter text-center mt-40">
                            <span><span class="counter">39,000</span>+</span>
                            <p style="text-align:center">Global Teachers</p>
                        </div> <!-- singel counter -->
                    </div>
                   
                </div>
            </div> <!-- row -->
        </div> <!-- container -->

 
    </section>
    
    <!--====== APPLY PART ENDS ======-->

   



@endsection

   
    
   
   
   
   
   
    
  