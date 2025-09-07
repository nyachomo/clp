@extends('layouts.website')
@section('content')
<div class="row" style="max-width:100%; width:100%; margin:0;">
    <div class="col-sm-12" style="background-color:#07294d;padding-top:20px;padding-bottom:20px;">
        <center><h1 style="color:white">Digital Hustle</h1></center>
    </div>
</div>

<section class="pt-20 pb-50">
        <div class="container-fliud">
           
           <div class="row">
               <div class="col-sm-6">


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
                                <button  class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span  class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>



               </div>
               <div class="col-sm-6">
                  <p>DigitalAge Hustle is a Techsphere Initiative That aims at addressing the unique challenges and opportunities facing the tech industry in Africa. We’re dedicated to facilitating meaningful trainings and connections that drive innovation and growth. Our program aims to equip 30,000 young individuals with essential 21st-century technology skills by 2030. All of our alumni will gain access to a diverse array of job opportunities with leading tech companies, startups, and organizations worldwide.</p>
                  <p>
                     We’re thrilled to team up with Propel to connect you with transformative job opportunities in Africa and Europe. Access remote tech roles, track your applications, and enjoy additional services. With skills in Software Development, Data Science, AI & ML, Cyber Security and many more we believe Africans can compete globally.
                  </p>
                  <p>
                    Our motivation is to drive positive change in the African tech ecosystem by connecting talent with opportunity. We believe that by facilitating these connections, we can empower individuals to realize their full potential and support the growth and development of Africa’s tech industry.
                  </p>
                  <p>
                       <a href="{{route('login')}}" class="main-btn">Sign Up Now</a>
                  </p>
                </div>
           </div>

        </div> 

    </section>
    
   
@endsection