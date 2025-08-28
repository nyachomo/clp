<?php
use App\Models\Course;

$courses=Course::where('course_status','Active')->select('id','course_name')->get();
?>

<!doctype html>
<html lang="en">
<head>
   
    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!--====== Title ======-->
    <title>Techsphere</title>
    
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{asset('frontend/logo/Logo.jpeg')}}" type="image/png">

    <!--====== Slick css ======-->
    <link rel="stylesheet" href="{{asset('frontend/css/slick.css')}}">

    <!--====== Animate css ======-->
    <link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}">
    
    <!--====== Nice Select css ======-->
    <link rel="stylesheet" href="{{asset('frontend/css/nice-select.css')}}">
    
    <!--====== Nice Number css ======-->
    <link rel="stylesheet" href="{{asset('frontend/css/jquery.nice-number.min.css')}}">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="{{asset('frontend/css/magnific-popup.css')}}">

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    
    <!--====== Fontawesome css ======-->
    <link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}">
    
    <!--====== Default css ======-->
    <link rel="stylesheet" href="{{asset('frontend/css/default.css')}}">
    
    <!--====== Style css ======-->
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    
    <!--====== Responsive css ======-->
    <link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">
  
    <!--Google fonts-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Afacad+Flux:wght@100..1000&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">



  <!--BOOTSTRAP LINKS-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="https://use.fontawesome.com/d79a9c14ef.js"></script>
    <style>
       
        
 
     



       .nav-item {
            margin: 0 5px;
            font-weight: 600;
            font-size: 1.9rem;
        }
        
        .nav-item a {
            color: #07294d !important;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        /* Hover effect for navigation links */
        .nav-item a:hover {
            /*background-color: rgba(255, 255, 255, 0.2);*/
            
            color: #07294d !important;
            /*transform: translateY(-2px);*/
        }
        



      .blueColor{
        color:#000033 !important;
      }

      .yellowColor{
        color:#ffc600 !important;
      }

      .maroonColor{
        color:#1ad1ff !important
      }

       .readMore{
        background-color: #ffc600;
        color: #000033;
       }

       .readMore:hover{
        background-color: #000033;
        color: #ffc600;
       }

       .hoverColor:hover{
           color: #ffc600 !important;
       }

       body,h1,h2,h3,h4,h5,h6,p,a,li{
        font-family: "Afacad Flux", sans-serif !important;
        font-optical-sizing: auto;
        font-weight: weight;
        font-style: normal;
        font-variation-settings:
            "slnt" 0;
        }

        /* Zoom In Animation */
            @keyframes zoomIn {
            from {
                transform: scale(0.7);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
            }

            .modal.zoom .modal-dialog {
            animation: zoomIn 0.7s ease;
            }

            .labelFontSize{
                font-size:20px !important;
            }

            .container-fliud{
                padding-left:50px;
                padding-right:50px;
            }

            a{
                text-decoration:none;
            }

            img{
                border-radius:10px !important;
            }
            
            p {
                text-align: justify;         /* spreads words to fit the full width */
                    /* also justifies the last line */
                word-spacing: 0.05em;         /* extra space between words */
                letter-spacing: 0.02em;      /* optional fine-tune between letters */
            }

            .dropdown-menu {
                background-color: #07294d !important; /* your background color */
                }

                .dropdown-menu .dropdown-item {
                color: white; /* change text color for contrast */
                }

               .dropdown-menu .dropdown-item:hover {
                background-color: #1fd1ff;  /*darker on hover */
                }

                /* Show dropdown menu on hover */
                .nav-item.dropdown:hover .dropdown-menu {
                display: block;
                }

                /* Optional: ensure it stays positioned correctly */
                .nav-item.dropdown .dropdown-menu {
                    margin-top: 0; /* remove Bootstrap offset */
                }

                .nav-link {
                    color: #07294d !important; /* dark blue hex */
                    }
                
                    .nav-link:hover {
                    color: #07294d !important; /* yellowish color on hover */
                    }

                    .btnClickToEnrol{
                        background-color: #ffc600 !important;
                        color:white;
                        border-radius:50px;
                        width:200px;

                    }

                    .btnDownloadCourseOutline{
                       background-color: #66e0ff;
                       color:white !important;
                       border-radius:50px;
                       width:200px
                    }




                    .table-container {
                    overflow-x: auto;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        #table2 {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 0;
        }
        #table2 thead th {
            background-color: #07294d;
            color: white;
            font-weight: 600;
            text-align: center;
            padding: 15px;
            border: none;
        }
        #table2 tbody tr:nth-child(odd) {
            background-color: #ffc600;
        }
        #table2 tbody tr:nth-child(even) {
            background-color: #07294d;
            color: white;
        }
        #table2 tbody td {
            padding: 15px;
            vertical-align: top;
            border: none;
        }
        .module-title {
            font-weight: 600;
            width: 25%;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #6c757d;
            font-size: 0.9rem;
        }
        @media (max-width: 768px) {
            .module-title {
                width: 35%;
            }
        }




      
        
      
      
        
       





        
        
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


        .icons-social2{
            position:fixed;
            display: flex;
            flex-direction: column;
            top:35%;
            right:1%;
            z-index:2
        }

        .icons-social2 a{
            display: block;
            text-align: center;
            color: white;
            /*padding:15px 15px;*/
            padding-top:7px !important;
            padding-bottom:7px !important;

            margin-bottom: 5px;
            border-radius:50px;
            width: 40px;           /* equal width */
            height: 40px;          /* equal height */
            border-radius: 50%;
        }
        

        .whatsapp-circle {
        width: 70px;
        height: 70px;
        background-color: #25D366; /* WhatsApp green */
        border-radius: 50%;        /* makes it circular */
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        cursor: pointer;
        transition: transform 0.2s ease;
        position:fixed;
        bottom:2%;
        left:1% !important;
        z-index:200 !important;
        }

        .whatsapp-circle:hover {
        transform: scale(1.1);
        }

        .whatsapp-circle i {
            color: white;
            font-size: 36px;
        }


      

      </style>

  <!-- Smartsupp Live Chat script -->
        <script type="text/javascript">
        var _smartsupp = _smartsupp || {};
        _smartsupp.key = 'b7f9e59215dfeb4a10a833748dc3307a58941cfa';
        window.smartsupp||(function(d) {
        var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
        s=d.getElementsByTagName('script')[0];c=d.createElement('script');
        c.type='text/javascript';c.charset='utf-8';c.async=true;
        c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
        })(document);
        </script>
        <noscript> Powered by <a href=“https://www.smartsupp.com” target=“_blank”>Smartsupp</a></noscript>
      
</head>

<body class="bg-light">
   
    <!--====== PRELOADER PART START ======-->
    
    <div class="preloader">
        <div class="loader rubix-cube">
            <div class="layer layer-1"></div>
            <div class="layer layer-2"></div>
            <div class="layer layer-3 color-1"></div>
            <div class="layer layer-4"></div>
            <div class="layer layer-5"></div>
            <div class="layer layer-6"></div>
            <div class="layer layer-7"></div>
            <div class="layer layer-8"></div>
        </div>
    </div>


    

    <section class="iconsSection">
        <div class="icons-social2">
            <a href="#" style="background-color: #1877F2">
                <i class="fa fa-facebook"></i>
            </a>

            <a href="#" style="background-color: #1DA1F2">
                <i class="fa fa-twitter"></i>
            </a>

            <a href="#" style="background-color:#FF0000">
                <i class="fa fa-youtube-play"></i>
            </a>

            <a href="#" style="background-color:#F58529">
                <i class="fa fa-instagram"></i>
            </a>

            <a href="#" style="background-color:#010101">
                <i class="fa-brands fa-tiktok"></i>
            </a>
        </div>
    </section>


    <!--WATSUP SECTION-->

    <div class="whatsapp-circle">
        <a href="https://wa.me/+254768919307?text=I'm%20interested%20in%20your%20Courses" target="_blank"> <i class="fab fa-whatsapp"></i></a>
    </div>

    <!--END OF WATSUP SECTION-->


    
    <!--====== PRELOADER PART START ======-->
    
    <!--====== HEADER PART START ======-->
    
    <!--<header id="header-part">
       
        <div class="header-top d-none d-lg-block">
            <div class="container-fliud">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header-contact text-lg-left text-center">
                            <ul>
                                <li><img src="{{asset('frontend/images/all-icon/map.png')}}" alt="icon"><span><b>View Park Towers, University Way , Nairobi</b></span></li>
                                <li><img src="{{asset('frontend/images/all-icon/email.png')}}" alt="icon"><span><b>info@techsphereinstitute.co.ke</b></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="header-opening-time text-lg-right text-center">
                            <p><b>Opening Hours : Monday to Saturay - 8 Am to 5 Pm</b></p>
                        </div>
                    </div>
                </div> 
            </div> 
        </div>  -->
       


        <div class="header-logo-support pt-3">
            <div class="container-fliud">
                <div class="row">
                    <div class="col-lg-7 col-md-7">
                        <div class="logo">
                            <div class="row">
                                <div class="col-sm-2"> <img src="{{asset('frontend/logo/Logo.jpeg')}}"  style="width: 80px;"></div>
                                <div class="col-sm-10">
                                        <span style="font-size: 30px;font-weight: bold; color:#000033">TECHSPHERE TRAINING INSTITUTE</span>
                                        <span><b style="color:#ffc600"><i>Software Development, Training and Capacity Bilding Center</i></b></span>
                                </div>
                            </div>
                           
                            
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5">
                        <div class="support-button float-right d-none d-md-block">
                            <div class="support float-left">
                                <div class="icon">
                                    <img src="{{asset('frontend/images/all-icon/support.png')}}" alt="icon" height="50">
                                </div>
                                <div class="cont">
                                    <p class="blueColor" style="font-size:15px"><b>Need Help? call us free</b></p>
                                    <span class="yellowColor">+254768919307</span>
                                </div>
                            </div>
                           <div class="button float-left">
                                <a href="{{route('apply')}}" class="main-btn"  style="padding-bottom:10px;padding-top:10px;">APPLY NOW</a>
                            </div>
                        </div>
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- header logo support -->


      
      


        <!--<nav class="navbar navbar-expand-lg navbar-light bg-white" style="background-color:#ffc600 !important">
            <div class="container">
              <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                         <a class="nav-link active" aria-current="page" href="{{route('welcome')}}"><b>HOME</b></a>
                    </li>

                    <li class="nav-item">
                         <a class="nav-link active" aria-current="page" href="{{route('showAllCourses')}}"><b>COURSES</b></a>
                    </li>
                    
                   <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <b>COURSES</b>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{route('showAllCourses')}}"><b>All Courses</b></a></li>
                            <li><hr class="dropdown-divider"></li>
                            @foreach($courses as $key=>$course)
                            <li><a class="dropdown-item" href="{{route('showSingleCourse',['id'=>$course->id])}}">{{$course->course_name}}</a></li>
                            <li><hr class="dropdown-divider"></li>
                            @endforeach
                        </ul>
                    </li>

                  

                    <li class="nav-item">
                         <a class="nav-link active" aria-current="page" href="{{route('enrol_for_scholarship_test')}}"><b>SCHOLARSHIP TEST</b></a>
                    </li>
                   
                    <li class="nav-item">
                         <a class="nav-link active" aria-current="page" href="{{route('contactUs')}}"><b>CONTACT US</b></a>
                    </li>

                </ul>
               
                </div>
            </div>
        </nav>-->



        <div class="navigation" style="background-color:#ffc600 !important">
            <div class="container-fliud">
                <div class="row">
                   <div class="col-lg-10 col-md-10 col-sm-9 col-8">
                        <nav class="navbar navbar-expand-lg">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                    
                                    <li class="nav-item">
                                        <a href="{{route('welcome')}}">HOME</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{route('aboutUs')}}">ABOUT US</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{route('showAllCourses')}}">COURSES</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{route('digitalHustle')}}">DIGITAL HUSTLE </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{route('enrol_for_scholarship_test')}}">SCHOLARSHIP </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('contactUs')}}">CONTACT US</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{route('login')}}">My Account (Login)</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{route('login')}}">E-learning</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{route('apply')}}">Enrol</a>
                                    </li>
                                   
                                   
                                </ul>
                            </div>
                        </nav> <!-- nav -->
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-3 col-4">
                        <div class="right-icon text-right">
                            <ul>
                                <li><a href="#" id="search"><i class="fa fa-search"></i></a></li>
                                <!--<li><a href="#"><i class="fa fa-shopping-bag"></i><span>0</span></a></li>-->
                            </ul>
                        </div> <!-- right icon -->
                    </div>
                   
                </div> <!-- row -->
            </div> <!-- container -->
        </div>


        
    </header>
    
     @yield('content')
    <!--====== FOOTER PART START ======-->
    
    <footer id="footer-part">
        <div class="footer-top pt-40 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-about mt-40">
                          
                            <div class="logo">
                                <a href="#"><img src="{{asset('frontend/logo/Logo.jpeg')}}" alt="Logo" class="rounded-circle" style="height: 100px;"></a>
                            </div>
                            <!--<p>Gravida nibh vel velit auctor aliquetn quibibendum auci elit cons equat ipsutis sem nibh id elit. Duis sed odio sit amet nibh vulputate.</p>-->
                            <ul class="mt-20">
                                <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <!--<li><a href="#"><i class="fa fa-google-plus"></i></a></li>-->
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div> <!-- footer about -->
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="footer-link mt-40">
                            <div class="footer-title pb-25">
                                <h6>QUICK LINKS</h6>
                            </div>
                            <ul>
                                <li><a href="index-2.html"><i class="fa fa-angle-right"></i>Home</a></li>
                                <li><a href="about.html"><i class="fa fa-angle-right"></i>About us</a></li>
                                <li><a href="courses.html"><i class="fa fa-angle-right"></i>Ict Club</a></li>
                                <li><a href="blog.html"><i class="fa fa-angle-right"></i>Attachment</a></li>
                                <!--<li><a href="events.html"><i class="fa fa-angle-right"></i>Event</a></li>-->
                            </ul>
                            <ul>
                                <li><a href="#"><i class="fa fa-angle-right"></i>Softwares</a></li>
                                <li><a href="#"><i class="fa fa-angle-right"></i>Contact</a></li>
                                <li><a href="#"><i class="fa fa-angle-right"></i>Scholarship Test</a></li>
                                <li><a href="#"><i class="fa fa-angle-right"></i>FAQs</a></li>
                                <!--<li><a href="#"><i class="fa fa-angle-right"></i>Documentation</a></li>-->
                            </ul>
                        </div> <!-- footer link -->
                    </div>
                   <!---<div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="footer-link support mt-40">
                            <div class="footer-title pb-25">
                                <h6>Support</h6>
                            </div>
                            <ul>
                                <li><a href="#"><i class="fa fa-angle-right"></i>Softwares</a></li>
                                <li><a href="#"><i class="fa fa-angle-right"></i>Contact</a></li>
                                <li><a href="#"><i class="fa fa-angle-right"></i>Scholarship Test</a></li>
                                <li><a href="#"><i class="fa fa-angle-right"></i>FAQs</a></li>
                                <li><a href="#"><i class="fa fa-angle-right"></i>Documentation</a></li>
                            </ul>
                        </div> 
                    </div>-->
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-address mt-40">
                            <div class="footer-title pb-25">
                                <h6>GET IN TOUCH</h6>
                            </div>
                            <ul>
                                <li>
                                    <div class="icon">
                                        <i class="fa fa-home"></i>
                                    </div>
                                    <div class="cont">
                                        <p>View Park Towers, University Way , Nairobi</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="cont">
                                        <p>+254768919307</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="fa fa-envelope-o"></i>
                                    </div>
                                    <div class="cont">
                                        <p>info@techsphereinstitute.co.ke</p>
                                    </div>
                                </li>
                            </ul>
                        </div> <!-- footer address -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- footer top -->
        
       <!--- <div class="footer-copyright pt-10 pb-25">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="copyright text-md-left text-center pt-15">
                            <p><a target="_blank" href="https://www.templateshub.net">Templates Hub</a> </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="copyright text-md-right text-center pt-15">
                           
                        </div>
                    </div>
                </div>  -->
            </div> 
        </div> 
    </footer>
    
    <!--====== FOOTER PART ENDS ======-->
   
    <!--====== BACK TO TP PART START ======-->
    
    <!--<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>-->
    
    <!--====== BACK TO TP PART ENDS ======-->
   
    
    
    
    
    
    
    
    <!--====== jquery js ======-->
    <script src="{{asset('frontend/js/vendor/modernizr-3.6.0.min.js')}}"></script>
    <script src="{{asset('frontend/js/vendor/jquery-1.12.4.min.js')}}"></script>

    <!--====== Bootstrap js ======-->
    <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
    
    <!--====== Slick js ======-->
    <script src="{{asset('frontend/js/slick.min.js')}}"></script>
    
    <!--====== Magnific Popup js ======-->
    <script src="{{asset('frontend/js/jquery.magnific-popup.min.js')}}"></script>
    
    <!--====== Counter Up js ======-->
    <script src="{{asset('frontend/js/waypoints.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.counterup.min.js')}}"></script>
    
    <!--====== Nice Select js ======-->
   <!-- <script src="{{asset('frontend/js/jquery.nice-select.min.js')}}"></script>-->
    
    <!--====== Nice Number js ======-->
    <script src="{{asset('frontend/js/jquery.nice-number.min.js')}}"></script>
    
    <!--====== Count Down js ======-->
    <script src="{{asset('frontend/js/jquery.countdown.min.js')}}"></script>
    
    <!--====== Validator js ======-->
    <script src="{{asset('frontend/js/validator.min.js')}}"></script>
    
    <!--====== Ajax Contact js ======-->
    <script src="{{asset('frontend/js/ajax-contact.js')}}"></script>
    
    <!--====== Main js ======-->
    <script src="{{asset('frontend/js/main.js')}}"></script>
    
    <!--====== Map js ======-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDC3Ip9iVC0nIxC6V14CKLQ1HZNF_65qEQ"></script>
    <script src="{{asset('frontend/js/map-script.js')}}"></script>


    <!--BOOTSTRAP JAVASCRIPT LINKS-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script>
    document.querySelector('form').addEventListener('submit', function(e) {
        const phoneInput = document.getElementById('phonenumber');
        const phoneRegex = /^\+254\d{9}$/;
        
        if (!phoneRegex.test(phoneInput.value)) {
        alert('Phone number must start with +254 followed by 9 digits (e.g., +254712345678)');
        e.preventDefault(); // Prevent form submission
        }
    });
</script>

</body>
</html>
