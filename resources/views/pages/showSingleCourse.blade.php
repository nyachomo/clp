@extends('layouts.website')
@section('content')
<!--====== PAGE BANNER PART START ======-->
    
<!--<section id="page-banner" class="pt-50 pb-50 bg_cover" data-overlay="8" style="background-image: url('{{asset('frontend/images/page-banner-2.jpg')}}')">
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
                            <button type="button" class="main-btn" data-toggle="modal"  data-target="#enrolModal">Enrol</button>
                        </nav>
                    </div>  
                </div>
            </div> 
        </div> 
    </section>-->
    
    <!--====== PAGE BANNER PART ENDS ======-->


     <!--====== COURSES SINGEl PART START ======-->
     <section style="background: linear-gradient(135deg, #00cc99 0%, #00cc99 100%);">
         <div class="container-fliud">
            <div class="row">
                        <div class="col-sm-8" style="padding:30px">
                            <div class="row">
                                <div class="col-sm-12">

                                        <div class="course_content">
                                            <h1 style="color:white;border-bottom:5px solid #ffc600;">{{$course->course_name ?? 'NA'}}</h1>
                                            <p style="color:white">{{$course->course_description ?? 'NA'}}</p>
                                        </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btnClickToEnrol"><a href="{{route('apply')}}">Enrol For this Course</a></button>
                                    <!--<button class="btn btnDownloadCourseOutline"> <i class="fa fa-download"></i> Download Course Outline</button>-->
                                </div>
                            </div>
                           
                        </div>
                        <div class="col-sm-4">
                            <div class="course_image">
                                <img src="{{asset('images/courses/'.$course->course_image)}}" alt="Courses">
                            </div>
                        </div>
            </div>
         </div>
     </section>

     <br>  <br><br>

     <section class="bg-light">
         <div class="container-fliud">
            <div class="row">
                <div class="col-sm-8">
                    <div class="card" style="border-radius:20px;background-color:white;">
                         <div class="card-body">

                            <table id="table2" class="table table-sm table-striped table-bordered">
                                <thead>
                                    <th>Module</th>
                                    <th>Outline</th>
                                </thead>
                                <tbody>
                                    @foreach($modules as $key=>$module)
                                    <tr>
                                        <td>{{$module->module_name}}</td>
                                        <td><?php echo$module->module_content?></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                         </div>
                    </div>
                    
                </div>
                <div class="col-sm-4">

                           <div class="course-features">
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
            </div>
         </div>
     </section>

     <br><br><br><br>

    
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