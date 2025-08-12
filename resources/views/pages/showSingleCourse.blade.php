@extends('layouts.website')
@section('content')
<!--====== PAGE BANNER PART START ======-->
    
<section id="page-banner" class="pt-50 pb-50 bg_cover" data-overlay="8" style="background-image: url('{{asset('frontend/images/page-banner-2.jpg')}}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Learn:  {{$course->course_name ?? 'NA'}}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Courses</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{$course->course_name ?? 'NA'}}</li>
                            </ol>
                            <a href="{{route('pages.signup',['id'=>$course->id])}}" type="button" class="main-btn">Enrol</a>
                            <!--<button type="button" class="main-btn" data-toggle="modal"  data-target="#enrolModal">Enrol</button>-->
                        </nav>
                    </div>  <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    
    <!--====== PAGE BANNER PART ENDS ======-->


     <!--====== COURSES SINGEl PART START ======-->
    
     <section id="corses-singel" class="pt-30 pb-120 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="corses-singel-left mt-30">
                                <div class="title">
                                    <h3>{{$course->course_name ?? 'NA'}}</h3>
                                </div> <!-- title -->
                                <div class="course-terms">
                                    <ul>
                                        <!--<li>
                                            <div class="teacher-name">
                                                <div class="thum">
                                                    <img src="{{asset('frontend/images/course/teacher/t-1.jpg')}}" alt="Teacher">
                                                </div>
                                                <div class="name">
                                                    <span>Teacher</span>
                                                    <h6>Mark anthem</h6>
                                                </div>
                                            </div>
                                        </li>-->
                                        <li>
                                            <div class="course-category">
                                                <span>Level</span>
                                                <h6>{{$course->course_level ?? 'NA'}}</h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="review">
                                                <span>Review</span>
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li class="rating">({{$course->course_two_like ?? 'NA'}} Reviws)</li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div> <!-- course terms -->
                                
                                <div class="corses-singel-image pt-50">
                                    <img src="{{asset('images/courses/'.$course->course_image)}}" alt="Courses">
                                </div> <!-- corses singel image -->
                                
                                <div class="corses-tab mt-30">
                                    <ul class="nav nav-justified" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                                        </li>
                                        <li class="nav-item">
                                            <a id="curriculam-tab" data-toggle="tab" href="#curriculam" role="tab" aria-controls="curriculam" aria-selected="false">Curriculam</a>
                                        </li>
                                        <!--<li class="nav-item">
                                            <a id="instructor-tab" data-toggle="tab" href="#instructor" role="tab" aria-controls="instructor" aria-selected="false">Instructor</a>
                                        </li>
                                        <li class="nav-item">
                                            <a id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
                                        </li>-->
                                    </ul>
                                    
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                            <div class="overview-description">
                                                <div class="singel-description pt-40">
                                                    <h6>Course Summery</h6>
                                                    <p>Lorem ipsum gravida nibh vel velit auctor aliquetn sollicitudirem quibibendum auci elit cons equat ipsutis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus .</p>
                                                </div>
                                                <div class="singel-description pt-40">
                                                    <h6>Requrements</h6>
                                                    <p>Lorem ipsum gravida nibh vel velit auctor aliquetn sollicitudirem quibibendum auci elit cons equat ipsutis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus .</p>
                                                </div>
                                            </div> <!-- overview description -->
                                        </div>
                                        <div class="tab-pane fade" id="curriculam" role="tabpanel" aria-labelledby="curriculam-tab">
                                            <div class="curriculam-cont">
                                                <div class="title">
                                                    <h6>Learn basis javascirpt Lecture Started</h6>
                                                </div>
                                                <div class="accordion" id="accordionExample">
                                                   
                                                </div>
                                            </div> <!-- curriculam cont -->
                                        </div>
                                        <div class="tab-pane fade" id="instructor" role="tabpanel" aria-labelledby="instructor-tab">
                                            <div class="instructor-cont">
                                                <div class="instructor-author">
                                                    <div class="author-thum">
                                                        <img src="images/instructor/i-1.jpg" alt="Instructor">
                                                    </div>
                                                    <div class="author-name">
                                                        <a href="#"><h5>Sumon Hasan</h5></a>
                                                        <span>Senior WordPress Developer</span>
                                                        <ul class="social">
                                                            <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="instructor-description pt-25">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus fuga ratione molestiae unde provident quibusdam sunt, doloremque. Error omnis mollitia, ex dolor sequi. Et, quibusdam excepturi. Animi assumenda, consequuntur dolorum odio sit inventore aliquid, optio fugiat alias. Veritatis minima, dicta quam repudiandae repellat non sit, distinctio, impedit, expedita tempora numquam?</p>
                                                </div>
                                            </div> <!-- instructor cont -->
                                        </div>
                                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                            <div class="reviews-cont">
                                                <div class="title">
                                                    <h6>Student Reviews</h6>
                                                </div>
                                                <ul>
                                                <li>
                                                    <div class="singel-reviews">
                                                            <div class="reviews-author">
                                                                <div class="author-thum">
                                                                    <img src="images/review/r-1.jpg" alt="Reviews">
                                                                </div>
                                                                <div class="author-name">
                                                                    <h6>Bobby Aktar</h6>
                                                                    <span>April 03, 2019</span>
                                                                </div>
                                                            </div>
                                                            <div class="reviews-description pt-20">
                                                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which.</p>
                                                                <div class="rating">
                                                                    <ul>
                                                                        <li><i class="fa fa-star"></i></li>
                                                                        <li><i class="fa fa-star"></i></li>
                                                                        <li><i class="fa fa-star"></i></li>
                                                                        <li><i class="fa fa-star"></i></li>
                                                                        <li><i class="fa fa-star"></i></li>
                                                                    </ul>
                                                                    <span>/ 5 Star</span>
                                                                </div>
                                                            </div>
                                                        </div> <!-- singel reviews -->
                                                </li>
                                                <li>
                                                    <div class="singel-reviews">
                                                            <div class="reviews-author">
                                                                <div class="author-thum">
                                                                    <img src="images/review/r-2.jpg" alt="Reviews">
                                                                </div>
                                                                <div class="author-name">
                                                                    <h6>Humayun Ahmed</h6>
                                                                    <span>April 13, 2019</span>
                                                                </div>
                                                            </div>
                                                            <div class="reviews-description pt-20">
                                                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which.</p>
                                                                <div class="rating">
                                                                    <ul>
                                                                        <li><i class="fa fa-star"></i></li>
                                                                        <li><i class="fa fa-star"></i></li>
                                                                        <li><i class="fa fa-star"></i></li>
                                                                        <li><i class="fa fa-star"></i></li>
                                                                        <li><i class="fa fa-star"></i></li>
                                                                    </ul>
                                                                    <span>/ 5 Star</span>
                                                                </div>
                                                            </div>
                                                        </div> <!-- singel reviews -->
                                                </li>
                                                <li>
                                                    <div class="singel-reviews">
                                                            <div class="reviews-author">
                                                                <div class="author-thum">
                                                                    <img src="images/review/r-3.jpg" alt="Reviews">
                                                                </div>
                                                                <div class="author-name">
                                                                    <h6>Tania Aktar</h6>
                                                                    <span>April 20, 2019</span>
                                                                </div>
                                                            </div>
                                                            <div class="reviews-description pt-20">
                                                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which.</p>
                                                                <div class="rating">
                                                                    <ul>
                                                                        <li><i class="fa fa-star"></i></li>
                                                                        <li><i class="fa fa-star"></i></li>
                                                                        <li><i class="fa fa-star"></i></li>
                                                                        <li><i class="fa fa-star"></i></li>
                                                                        <li><i class="fa fa-star"></i></li>
                                                                    </ul>
                                                                    <span>/ 5 Star</span>
                                                                </div>
                                                            </div>
                                                        </div> <!-- singel reviews -->
                                                </li>
                                                </ul>
                                                <div class="title pt-15">
                                                    <h6>Leave A Comment</h6>
                                                </div>
                                                <div class="reviews-form">
                                                    <form action="#">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-singel">
                                                                    <input type="text" placeholder="Fast name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-singel">
                                                                    <input type="text" placeholder="Last Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-singel">
                                                                    <div class="rate-wrapper">
                                                                        <div class="rate-label">Your Rating:</div>
                                                                        <div class="rate">
                                                                            <div class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                            <div class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                            <div class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                            <div class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                            <div class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-singel">
                                                                    <textarea placeholder="Comment"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-singel">
                                                                    <button type="button" class="main-btn">Post Comment</button>
                                                                </div>
                                                            </div>
                                                        </div> <!-- row -->
                                                    </form>
                                                </div>
                                            </div> <!-- reviews cont -->
                                        </div>
                                    </div> <!-- tab content -->
                                </div>
                            </div> <!-- corses singel left -->
                        </div>
                    </div>


                        <div class="row">
                           
                        @foreach($relatedcourses as $course)
                        <div class="col-lg-6 col-md-6">
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
                                            <a href="{{route('showSingleCourse',['id'=>$course->id])}}" class="btn readMore" style="border-radius: 50px;"><b>Enrol</b></a>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- singel course -->
                        </div>
                        @endforeach

                        </div>





                   
                    
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12 col-md-6">
                            <div class="course-features mt-30">
                               <h4>Course Features </h4>
                                <ul>
                                    <li><i class="fa fa-clock-o"></i>Duaration : <span>{{$course->course_duration ?? 'NA'}} Weeks</span></li>
                                    <li><i class="fa fa-clone"></i>Leactures : <span><?php  echo$course->course_duration*5?></span></li>
                                    <li><i class="fa fa-beer"></i>Quizzes :  <span><?php  echo$course->course_duration*5?></span></li>
                                    <li><i class="fa fa-user-o"></i>Students :  <span>{{$course->course_leaners_already_enrolled ?? 'NA'}}</span></li>
                                </ul>
                                <div class="price-button pt-10">
                                    <span>Price : <b>Ksh{{$course->course_price}}</b></span>
                                    <a href="{{route('pages.signup',['id'=>$course->id])}}" type="button" class="main-btn">Enrol</a>
                                    <!--<a href="#" class="main-btn" data-toggle="modal" data-target="#enrolModal">Enroll Now</a>-->
                                </div>
                            </div> <!-- course features -->
                        </div>
                        <div class="col-lg-12 col-md-6">
                            <div class="You-makelike mt-30">
                                <h4>You make like </h4> 
                                @foreach($othercourses as $othercourse)
                                <div class="singel-makelike mt-20">
                                    <div class="image">
                                        <img src="{{asset('frontend/images/your-make/y-1.jpg')}}" alt="Image">
                                    </div>
                                    <div class="cont">
                                        <a href="{{route('showSingleCourse',['id'=>$othercourse->id])}}"><h4>{{$othercourse->course_name ?? 'NA'}}</h4></a>
                                        <ul>
                                            <li><a href="#"><i class="fa fa-user"></i>{{$othercourse->course_leaners_already_enrolled ?? 'NA'}}</a></li>
                                            <li>Ksh:{{$othercourse->course_price ?? 'NA'}}</li>
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- row -->
           
        </div> <!-- container -->
    </section>


    <!--ENROLMENT MODAL-->
    <div class="modal fade zoom" id="enrolModal">
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
                                    <input type="text" name="phonenumber" class="form-control" pattern="^\+254\d{8}$"  title="Phone number must start with +254 followed by 9 digits (e.g., +254712345678)" required>
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
                            <input type="text" name="has_paid_reg_fee"   class="form-control" value="No" hidden="true">   
                            <input type="text" name="role"   class="form-control" value="Trainee" hidden="true" >
                            <input type="text" name="course_id"   class="form-control" value="{{$course->id}}" hidden="true">  
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
    

@endsection