@extends('layouts.website')
@section('content')

<style>
        
 
        
        .card {
            height: 100%;
            border-radius: 15px;
            overflow: hidden;
            border: none;
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            background: #07294d;
        }
        
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 18px 35px rgba(0, 0, 0, 0.4);
        }
        
        .card-header {
            padding: 25px 25px 20px;
            position: relative;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        }
        
        .card-body {
            padding: 25px;
            line-height: 1.7;
        }
        
        .card-body p {
            font-size: 1.1rem;
            color: #e6e6e6;
        }
        
        .card h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
        }
        
        .card h1:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 4px;
            border-radius: 2px;
        }
        
        .icon-container {
            position: absolute;
            top: 25px;
            right: 25px;
            font-size: 2.2rem;
            opacity: 0.8;
        }
        
        /* Mission Card Styling */
        .mission-card .card-header {
            background: #ffc600;
        }
        
        .mission-card h1 {
            color: #07294d;
        }
        
        .mission-card h1:after {
            background: #07294d;
        }
        
        .mission-card .icon-container {
            color: #07294d;
        }
        
        /* Vision Card Styling */
        .vision-card .card-header {
            background: #1fd1ff;
        }
        
        .vision-card h1 {
            color: #07294d;
        }
        
        .vision-card h1:after {
            background: #07294d;
        }
        
        .vision-card .icon-container {
            color: #07294d;
        }
        
        /* Expertise Card Styling */
        .expertise-card .card-header {
            background: #07294d;
        }
        
        .expertise-card h1 {
            color: #ffc600;
        }
        
        .expertise-card h1:after {
            background: #ffc600;
        }
        
        .expertise-card .icon-container {
            color: #ffc600;
        }
        
        .accent-text {
            font-weight: 600;
        }
        
        .mission-card .accent-text {
            color: #ffc600;
        }
        
        .vision-card .accent-text {
            color: #1fd1ff;
        }
        
        .expertise-card .accent-text {
            color: #ffc600;
        }
        
    
        @media (max-width: 992px) {
            .header h1 {
                font-size: 2.4rem;
            }
            
            .card {
                margin-bottom: 25px;
            }
        }
        
        @media (max-width: 576px) {
            .header h1 {
                font-size: 2rem;
            }
            
            .header p {
                font-size: 1.1rem;
            }
            
            .card-header {
                padding: 20px 20px 15px;
            }
            
            .card-body {
                padding: 20px;
            }
            
            .card h1 {
                font-size: 1.6rem;
            }
            
            .icon-container {
                font-size: 1.8rem;
                top: 20px;
                right: 20px;
            }
        }


        .corner-decoration {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 0 100px 100px;
            border-color: transparent transparent #ffc600 transparent;
            opacity: 0.2;
        }
        
        .circle-decoration {
            position: absolute;
            bottom: 20px;
            left: 20px;
            width: 60px;
            height: 60px;
            border: 3px solid #ffc600;
            border-radius: 50%;
            opacity: 0.3;
        }

    </style>

<div class="row" style="max-width:100%; width:100%; margin:0;">
    <div class="col-sm-12" style="background-color:#07294d;padding-top:20px;padding-bottom:20px;">
        <center><h1 style="color:white">About Us</h1></center>
    </div>
</div>
 





<section class="bg-light mt-20">
        <div class="container-fliud">
            <div class="row">
                 <div class="col-sm-12">
                     <p>
                           At Techsphere Training Institute, we are dedicated to equipping young people and professionals with the digital 
                           skills of the future. Established with a vision to bridge the digital skills gap, we specialize in practical, 
                           hands-on training that prepares our students for real-world opportunities in technology and innovation.
                           Our programs are carefully designed to be project-based, ensuring that students not only learn the theory but also build 
                           real-world solutions. We focus on career readiness, empowering learners to become innovators, problem solvers, 
                           and leaders in the digital economy.
                     </p>
                 </div>
            </div>
            <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                 <div class="card mission-card">
                      <div class="card-header">
                         <h1>Our Mission</h1>
                         <div class="icon-container">
                             <i class="fas fa-bullseye"></i>
                         </div>
                      </div>
                      <div class="card-body">
                         <p>
                            At <span class="accent-text">TechSphere</span>, our mission is to empower individuals and organizations with cutting-edge skills and knowledge that 
                            drive success in the ever-evolving world of technology. We are committed to delivering high-quality education and
                            training that bridges the gap between theoretical learning and practical application, ensuring our students are 
                            well-prepared for real-world challenges.
                        </p>
                      </div>
                      <div class="corner-decoration"></div>
                      <div class="circle-decoration"></div>
                 </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                 <div class="card vision-card">
                      <div class="card-header">
                         <h1>Our Vision</h1>
                         <div class="icon-container">
                             <i class="fas fa-eye"></i>
                         </div>
                      </div>
                      <div class="card-body">
                         <p>
                            Our vision is to become a global leader in IT training, setting new standards for excellence in education. 
                            We aim to be the preferred choice for students and professionals seeking to advance their careers and for 
                            organizations looking to enhance the capabilities of their workforce. Through innovative teaching methods and 
                            industry-relevant courses, we aspire to shape the future of technology education.
                        </p>
                      </div>
                      <div class="corner-decoration"></div>
                      <div class="circle-decoration"></div>
                 </div>
            </div>


            <div class="col-lg-4 col-md-6 mb-4">
                 <div class="card expertise-card">
                      <div class="card-header">
                         <h1>Our Expertise</h1>
                         <div class="icon-container">
                             <i class="fas fa-laptop-code"></i>
                         </div>
                      </div>
                      <div class="card-body">
                         <p>
                            <span class="accent-text">TechSphere</span> specializes in a wide range of IT training programs, including AWS, SAP, AutoCAD, DevOps, Advanced Java, 
                            and more. Our courses are designed by industry experts and delivered by experienced instructors who bring real-world 
                            insights to the classroom. We focus on providing both foundational knowledge and hands-on experience, ensuring that our
                            students gain the skills needed to excel.
                        </p>
                      </div>
                      <div class="corner-decoration"></div>
                      <div class="circle-decoration"></div>
                 </div>

              
            </div>

            <br>
         

        </div>
      </section>
      <br>





   




@endsection

	