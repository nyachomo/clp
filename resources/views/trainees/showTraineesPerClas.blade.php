@extends('layouts.master')
@section('content')

<style>

#pagination-controls {
    display: flex;
    justify-content: right;
    align-items: right;
    margin-top: -2px;
    padding-right:50px;
    padding-top:-500px;
    padding-bottom:10px;
    gap: 10px; /* Spacing between buttons */
  }

     #pagination-controls button {
        background-color: #007bff; /* Bootstrap primary color */
        color: white;
        border: none;
        border-radius: 50px;
        padding: 2px 10px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
  }

  #pagination-controls .active {
    background-color: #28a745; /* Green for active page */
  }
</style>
<!--
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                  <h4 class="page-title">Manage Users</h4>
            </div>
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>-->




<div id="response"></div>


@if (session('success'))
    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div id="error-alert"  class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session('error') }}
    </div>
@endif




<div id="message-container" class="mt-3"></div>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                
                <div class="row">
                      <div class="col-sm-12">
                          <center><h3>CLASS: {{$clas->clas_name ?? 'NA'}}</h3></center>
                      </div>
                </div>
                <br>

                  <a href="{{route('downloadStudentPerClassPdf',['id'=>$clas->id])}}" class="btn btn-secondary btn-sm" style="float:right"><i class="fa fa-download"></i> Download Students</a>
                 

                 <form method="POST" action="{{route('downloadStudentPerClassExcel')}}">
                    @csrf
                    <input type="text" name="excel_clas_id" value="{{$clas->id}}" hidden="true">
                    <!--<button style="float:right" type="submit" class="btn btn-sm btn-warning rounded-pill"><i class=" uil-arrow-down"> Download (Pdf)</i></button>-->
                       
                 </form>


                 <form method="POST" action="{{route('markedStudentAsAlumni')}}" id="markAllStudentAlumniForm">
                    @csrf
                    <input type="text" name="alumni_clas_id" value="{{$clas->id}}" id="alumni_clas_id" hidden="true">
                    <!--<button style="float:right" type="submit" class="btn btn-sm btn-info rounded-pill"><i class=" uil-arrow-down">Mark All Students As Alumni</i></button>-->
                       
                 </form>

                 <form method="POST" action="{{route('suspendAllStudents')}}" id="suspendAllStudentsForm">
                    @csrf
                    <input type="text" name="suspend_all_students_clas_id" value="{{$clas->id}}" id="suspend_all_students_clas_id" hidden="true">
                    <!--<button style="float:right" type="submit" class="btn btn-sm btn-danger rounded-pill"><i class=" uil-arrow-down">Suspend All</i></button>-->
                       
                 </form>

                 <form method="POST" action="{{route('activateAllStudents')}}" id="activateAllStudentsForm">
                    @csrf
                    <input type="text" name="activate_all_students_clas_id" value="{{$clas->id}}" id="activate_all_students_clas_id" hidden="true">
                    <!--<button style="float:right" type="submit" class="btn btn-sm btn-primary rounded-pill"><i class=" uil-arrow-down">Activate All</i></button>-->
                       
                 </form>
                 <!--<a style="float:right"  href="{{ route('users.download') }}" class="btn btn-sm btn-secondary rounded-pill"><i class=" uil-arrow-down"></i> Download</a>-->
                 <!--<a type="button" style="float:right" class="btn btn-sm btn-secondary rounded-pill" data-bs-toggle="modal" data-bs-target="#uploadExcelModal"> <i class="uil-export"></i>Upload</a>-->
                <!-- <a type="button" style="float:right" class="btn btn-sm btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#addUser-modal"> <i class="uil-user-plus"></i>Add</a>-->

                 <a type="button" style="float:right" class="btn btn-sm btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#addUserModal"> <i class="uil-user-plus"></i>Add New Student</a>

            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-1" style="padding-top:4px">
                         <label for="example-select" class="form-label" style="float:right;">Show</label>
                    </div>
                    <div class="col-sm-2">
                       
                       
                    <select class="form-select" id="select">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>



                    </div>

                    <div class="col-sm-6"></div>

                    <div class="col-sm-1" style="padding-top:6px">
                         <label for="example-select" class="form-label" style="float:right;">Search</label>
                    </div>

                    <div class="col-sm-2">
                          <input type="text" id="search" name="search" class="form-control" placeholder="Search users...">
                    </div>

                </div>
                <br>
                <div class="tab-content">
                    <div class="table-responsive">
                       
                        <table id="table1" class="table table-sm table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Student Contact</th>
                                    <th>Parent Contact</th>
                                    <th>Class</th>
                                    <th>Email</th>
                                    <th>School</th>
                                    <th>Type</th>
                                    <!--<th>Prefered Course</th>-->
                                    <th>Course/Program</th>
                                    <th>Downloads</th>
                                    <!--<th>Class</th>-->
                                    <!--<th>Gender</th>-->
                                    <!--<th>Status</th>-->
                                    <th>Action</th>
                                </tr>
                            </thead>
                        
                            <tbody id="table1"></tbody>
                     
                            <tbody id="table2"></tbody>
                            
                        </table>                                           
                    </div> <!-- end preview-->
                
                </div> <!-- end tab-content-->
                
            </div> <!-- end card body-->

            <!--card-footer-->
             <div id="pagination-controls" style="float:right"></div>
            <!--end of card-footer-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div> <!-- end row-->






<!-- Add User modal -->
<div id="addUserModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel"><i class="uil-user-plus"></i> Add New Student</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="POST" action="{{route('addTrainee')}}">
                @csrf
               
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-success" role="alert">
                            <strong>Notice ! </strong> 
                            <p>
                                <ol>
                                    <li>The Fields marked <span class="labelSpan">*</span> are mandatory</li>
                                    <li>Email is unique</li>
                                </ol>
                            </p>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                             <label>Firstname <span class="labelSpan">*</span></label>
                             <input type="text"  name="firstname" class="form-control" required>
                        </div>
                    </div>
                   
                   

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Lastname</label>
                             <input type="text" class="form-control" name="lastname">
                        </div>
                    </div>

                    <!--<div class="col-sm-6">
                        <div class="form-group">
                             <label>Secondname</label>
                             <input type="text"  name="secondname" class="form-control">
                        </div>
                    </div>-->

                   


                </div>

                <div class="row">
                   
                   


                   


                    

                </div>

                <div class="row">

                   <!--<div class="col-sm-6">
                        <div class="form-group">
                            <label>Email <span class="labelSpan"></span></label>
                            <input type="email" class="form-control" name="email">
                        </div>
                    </div>-->

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Gender <span class="labelSpan">*</span></label>
                            <select class="form-control" name="gender" required>
                                 <option value="">Select Gender</option>
                                 <option value="Male">Male</option>
                                 <option value="Female">Female</option>
                                 <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Student Phonenumber <span class="labelSpan">*</span></label>
                            <input type="number" class="form-control" name="phonenumber" required>
                        </div>
                    </div>




                </div>

                <div class="row" style="padding-top:10px">

                   <div class="col-sm-6">
                        <div class="form-group">
                            <label>Parent Phonenumber <span class="labelSpan">*</span></label>
                            <input type="number" class="form-control" name="parent_phone" required>
                        </div>
                    </div>

                   
                    <div class="col-sm-6">
                            <label>Course <span class="labelSpan">*</span></label>
                            <select class="form-control" name="course_id">
                               <option value="">Select Course</option>
                                @if(!empty($courses))
                                   @foreach($courses as $key=>$course)
                                      <option value="{{$course->id}}">{{$course->course_name}}</option>
                                   @endforeach
                                @endif
                                 
                            </select>
                    </div>

                    <div class="col-sm-6">
                           <label>Type Of Student</label>
                           <select class="form-control" name="role" required>
                                <option value="">Select</option>
                                <option value="Trainee">Active/Student Ready to take class</option>
                                <option value="Applicant">Student Who Applied From Website</option>
                                <option value="ict_club_student">Ict Club Student</option>
                                <option value="student_from_event">Student From Event</option>
                                <option value="student_from_referal">Student From Referal</option>
                                <option value="scholarship_test_student">Student Who Applied For Scholarship Test</option>

                            </select>
                    </div>

                    <div class="col-sm-6">
                            <label>School <span class="labelSpan">*</span></label>
                            <select class="form-control" name="school_id">
                               <option value="">Select School</option>
                                @if(!empty($schools))
                                   @foreach($schools as $key=>$school)
                                      <option value="{{$school->id}}">{{$school->school_name}}</option>
                                   @endforeach
                                @endif
                                 
                            </select>
                    </div>



                    <div class="col-sm-6">
                            <!--<label>Class <span class="labelSpan">*</span></label>-->
                             <select class="form-control" name="clas_id" required hidden="true">
                                <option value="{{$clas->id}}">{{$clas->clas_name}}</option>
                            </select>
                    </div>
                </div>

                <div class="row" style="padding-top:10px">
                    <div class="col-sm-6">
                           <!--<label>Has Paid Registration Fee</label>-->
                           <select class="form-control" name="has_paid_reg_fee" hidden="true">
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>
                            </select>
                    </div>

                    
                </div>

                <div class="row">
                    
                   
                    
                </div>

                <div class="row">
                    
                    <div class="col-sm-6">
                            <label>Which Class Does this student belongs <span class="labelSpan"></span></label>
                            <select class="form-control" name="clas_category">
                               <option value="">Select Class</option>
                               <option value="Form One">Form One</option>
                               <option value="Form Two">Form Two</option>
                               <option value="Form Three">Form Three</option>
                               <option value="Form Four">Form Four</option>
                            </select>
                    </div>

                    <div class="col-sm-6">
                            <label>Student Prefered Course<span class="labelSpan"></span></label>
                            <select class="form-control" name="prefered_course">
                               <option value="">Select Course</option>
                               <option value="Mobile Application Development">Mobile Application Development</option>
                               <option value="Web Application Development">Web Application Development</option>
                               <option value="Full-Stack Software Development">Full-Stack Software Development</option>
                               <option value="Cyber Security And Ethical Hacking">Cyber Security And Ethical Hacking</option>
                               <option value="Full-Stack Software Development">Full-Stack Software Development</option>
                               <option value="Datascienec Machine Learning And AI">Datascience Machine Learning And AI</option>
                               <option value="Robotics And IOT">Robotics And IOT</option>
                               <option value="Graphic Design">Graphic Design</option>
                               <option value="Digital Marketing">Digital Marketing</option>
                               <option value="Ui/Ux Design">Ui/Ux Design</option>
                            </select>
                    </div>

                </div>




            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger rounded-pill" style="float:left" data-bs-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-success rounded-pill">Save</button>
            </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--end of modal-->











<!-- Modal Template -->

<div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="updateUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateUserModalLabel">Update User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateUserForm">


                   <input type="text" id="user_id" name="user_id" value="" hidden="true">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-success" role="alert">
                                <strong>Notice ! </strong> 
                                <p>
                                    <ol>
                                        <li>The Fields marked <span class="labelSpan">*</span> are mandatory</li>
                                        <li>Email is unique</li>
                                    </ol>
                                </p>
                            </div>

                        </div>
                    </div>


                    <div class="row">

                       

                        <div class="col-sm-6">
                                <div class="form-group mb-2">
                                    <label  for="firstname"> Fullname <span class="labelSpan">*</span></label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" required>
                                </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group mb-2">
                                <label  for="firstname">Email<span class="labelSpan">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>

                        <!--<div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label  for="lastname">Secondname</label>
                                    <input type="text" class="form-control" id="secondname" name="secondname">
                                </div>
                        </div>-->

                        

                    </div>

                    <div class="row">

                        <!--<div class="col-sm-6">
                                <div class="form-group mb-2">
                                    <label  for="lastname">Lastname</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname">
                                </div>
                        </div>-->


                        <div class="col-sm-6">
                            <div class="form-group mb-2">
                                <label  for="firstname">Student Phonenumber<span class="labelSpan">*</span></label>
                                <input type="text" class="form-control" id="phonenumber" name="phonenumber" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group mb-2">
                                <label  for="firstname">Parent Phonenumber<span class="labelSpan"></span></label>
                                <input type="text" class="form-control"  name="parent_phone" id="parent_phone">
                            </div>
                        </div>


                       

                    </div>

                    <div class="row">

                       


                        <div class="col-sm-6">
                            <div class="form-group mb-2">
                                <label  for="firstname">Gender<span class="labelSpan">*</span></label>
                                <select class="form-control" name="gender" id="gender" required>
                                     <option value="">Select Gender</option>
                                     <option value="Male">Male</option>
                                     <option value="Female">Female</option>
                                     <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>


                            <div class="col-sm-6">
                                <label>Course <span class="labelSpan">*</span></label>
                                <select class="form-control" name="course_id" id="update_course_id" required>
                                    <option value="">Select Course</option>
                                    @if(!empty($courses))
                                        @foreach($courses as $key=>$course)
                                        <option value="{{$course->id}}">{{$course->course_name}}</option>
                                        @endforeach
                                    @endif
                                        
                                </select>
                           </div>




                    </div>

                   
                    <div class="row" style="padding-top:10px">
                     
                            <div class="col-sm-6">
                                    <label>Which Class Does this student belongs <span class="labelSpan"></span></label>
                                    <select class="form-control" name="clas_category" id="clas_category">
                                    <option value="">Select Class</option>
                                    <option value="Form One">Form One</option>
                                    <option value="Form Two">Form Two</option>
                                    <option value="Form Three">Form Three</option>
                                    <option value="Form Four">Form Four</option>
                                    </select>
                            </div>

                            <div class="col-sm-6">
                                <label>Type Of Student</label>
                                <select class="form-control" name="role" id="role" required>
                                        <option value="">Select</option>
                                        <option value="Trainee">Active/Student Ready to take class</option>
                                        <option value="Applicant">Student Who Applied From Website</option>
                                        <option value="ict_club_student">Ict Club Student</option>
                                        <option value="student_from_event">Student From Event</option>
                                        <option value="student_from_referal">Student From Referal</option>
                                        <option value="scholarship_test_student">Student Who Applied For Scholarship Test</option>

                                    </select>
                            </div>

                        

                            <div class="col-sm-6">
                                    <!--<label>Class <span class="labelSpan">*</span></label>-->
                                    <select class="form-control" name="clas_id" id="update_clas_id" hidden="true">
                                        <option value="">Select Class</option>
                                        @if(!empty($clases))
                                            @foreach($clases as $key=>$clas)
                                                <option value="{{$clas->id}}">{{$clas->clas_name}}</option>
                                            @endforeach
                                        @endif

                                    </select>
                            </div>

                    </div>

               <div class="row">
                   

                    <!--<div class="col-sm-6">
                            <label>Student Prefered Course<span class="labelSpan">*</span></label>
                            <select class="form-control" name="prefered_course" id="prefered_course">
                               <option value="">Select Class</option>
                               <option value="Mobile Application Development">Mobile Application Development</option>
                               <option value="Web Application Development">Web Application Development</option>
                               <option value="Full-Stack Software Development">Full-Stack Software Development</option>
                               <option value="Cyber Security And Ethical Hacking">Cyber Security And Ethical Hacking</option>
                               <option value="Full-Stack Software Development">Full-Stack Software Development</option>
                               <option value="Datascienec Machine Learning And AI">Datascience Machine Learning And AI</option>
                               <option value="Robotics And IOT">Robotics And IOT</option>
                               <option value="Graphic Design">Graphic Design</option>
                               <option value="Digital Marketing">Digital Marketing</option>
                               <option value="Ui/Ux Design">Ui/Ux Design</option>
                            </select>
                    </div>-->

                        <div class="col-sm-6">
                                <label>School <span class="labelSpan">*</span></label>
                                <select class="form-control" name="school_id" id="school_id">
                                <option value="">Select School</option>
                                    @if(!empty($schools))
                                        @foreach($schools as $key=>$school)
                                            <option value="{{$school->id}}">{{$school->school_name}}</option>
                                        @endforeach
                                    @endif
                                    
                                </select>
                        </div>

                        <div class="col-sm-6">
                                <label>Program<span class="labelSpan">*</span></label>
                                <select class="form-control" name="update_clas_id" id="update_clas_id">
                                <option value="">Select School</option>
                                    @if(!empty($clases))
                                        @foreach($clases as $key=>$clas)
                                            <option value="{{$clas->id}}">{{$clas->clas_name}}</option>
                                        @endforeach
                                    @endif
                                    
                                </select>
                        </div>


                </div>


                  

                   
                    
                   
                   
                   
                   <!-- <button type="submit" class="btn btn-primary">Save Changes</button>-->
               
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger rounded-pill" style="float:left" data-bs-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-success rounded-pill">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border:1px solid white">
                <h5 class="modal-title" id="deleteUserModalLabel">Are you sure you want to delete this record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="border:1px solid white">
                <form id="deleteUserForm">
                   
                
                    <input type="text" id="delete_user_id" name="delete_user_id" hidden="true">
                    <!--<button type="submit" class="btn btn-primary">Delete</button>-->
               
            </div>

            <div class="modal-footer justify-content-between" style="border:1px solid white">
                <button type="button" class="btn btn-danger rounded-pill"  data-bs-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-success rounded-pill">Delete</button>
            </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="suspendUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border:1px solid white">
                <h5 class="modal-title" id="deleteUserModalLabel">Are you sure you want to suspend this Students</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="border:1px solid white">
                <form id="suspendUserForm">
                   
                
                    <input type="text" id="suspend_user_id" name="suspend_user_id" class="form-control" hidden="true">
                   
            </div>

            <div class="modal-footer justify-content-between" style="border:1px solid white">
                <button type="button" class="btn btn-danger rounded-pill"  data-bs-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-success rounded-pill">Suspend</button>
            </div>
            </form>
        </div>
    </div>
</div>




<!-- Upload Excel Modal -->
<div class="modal fade" id="uploadExcelModal" tabindex="-1" aria-labelledby="uploadExcelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form  enctype="multipart/form-data" method="post" action="{{route('users.upload')}}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadExcelLabel">Upload User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-success" role="alert">
                                <strong>Notice ! </strong> 
                                <p>
                                    <ol>
                                        <li>The file fields is mandatory</li>
                                        <li>Email is unique</li>
                                        <li>Download the template, fill with data and upload back</li>
                                    </ol>
                                </p>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                             <p>Click download</p>
                        </div>
                        <div class="col-sm-6">
                              <a style="float:right"  href="{{ route('downloadUserFile') }}" class="btn btn-sm btn-info rounded-pill"><i class=" uil-arrow-down"></i> Download</a>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="excelFile">Choose Excel File</label>
                        <input type="file" class="form-control"  required name="file" accept=".xlsx, .xls">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success rounded-pill">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>






@endsection
@section('scripts')
<script>
    $(document).ready(function(){

        const urlParams = new URLSearchParams(window.location.search);
        const clas_id = urlParams.get('clas_id');



            // Automatically hide success and error messages after 5 seconds
            setTimeout(() => {
                const successAlert = document.getElementById('success-alert');
                if (successAlert) {
                    successAlert.style.transition = "opacity 0.5s";
                    successAlert.style.opacity = "0";
                    setTimeout(() => successAlert.remove(), 500); // Fully remove the element after fade-out
                }
                
                const errorAlert = document.getElementById('error-alert');
                if (errorAlert) {
                    errorAlert.style.transition = "opacity 0.5s";
                    errorAlert.style.opacity = "0";
                    setTimeout(() => errorAlert.remove(), 500);
                }
            }, 5000); // 5000 milliseconds = 5 seconds



    
            fetchUsers();


            function displaySuccessMessage(message) {
                let successMessage = `
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;

                // Append message to a container (e.g., #message-container)
                $('#message-container').html(successMessage);

                // Automatically remove the message after 5 seconds
                setTimeout(() => {
                    $('.alert').alert('close');
                }, 5000);
            }


            // Initial call to fetch users
            fetchUsers();


   



            function fetchUsers(page = 1, search = '', perPage = 10) {
                $.ajax({
                    type: 'GET',
                    url: "{{ route('getStudentsPerClass', ['classId' => ':classId']) }}".replace(':classId', clas_id),
                    data: { page: page, search: search, per_page: perPage },
                    dataType: "json",
                    success: function(response) {
                        // Update total users
                        $('#total-users').text(response.total_users || 0);
                        $('#clas_name').text(response.clasName || 'N/A');

                        // Clear and repopulate the table
                        $('tbody').html("");
                        $.each(response.users, function(key, item) {
                            // Use fallback values for all potentially null properties
                            const firstname = item.firstname || 'N/A';
                            const secondname = item.secondname || '';
                            const lastname = item.lastname || '';
                            const phonenumber = item.phonenumber || 'N/A';
                            const parent_phone = item.parent_phone || 'N/A';
                            const clas_category = item.clas_category || 'N/A';
                            const email = item.email || 'N/A';
                            const school_name = (item.school && item.school.school_name) ? item.school.school_name : 'N/A';
                            const role = item.role || 'N/A';
                            const course_name = (item.course && item.course.course_name) ? item.course.course_name : 'N/A';
                            const prefered_course = item.prefered_course || 'N/A';
                            const gender = item.gender || 'N/A';
                            const status = item.status || 'N/A';
                            const school_id = (item.school && item.school.id) ? item.school.id : '';
                            const course_id = (item.course && item.course.id) ? item.course.id : '';
                            const clas_id_val = (item.clas && item.clas.id) ? item.clas.id : '';
                            
                            const baseUrl = "{{ route('showFees') }}";

                            $('#table1').append(
                                '<tr>\
                                    <td>' + (key + 1) + '</td>\
                                    <td>' + firstname + ' ' + secondname + ' ' + lastname + '</td>\
                                    <td>' + phonenumber + '</td>\
                                    <td>' + parent_phone + '</td>\
                                    <td>' + clas_category + '</td>\
                                    <td>' + email + '</td>\
                                    <td>' + school_name + '</td>\
                                    <td>' + role + '</td>\
                                    <!--<td>' + prefered_course + '</td>-->\
                                    <td>' + course_name + '</td>\
                                    <td>\
                                        <a href="{{ route('highSchoolTeacherDownloadStudentScholarshipLetter') }}?id=' + item.id + '" class="text-success" data-id="' + item.id + '">\
                                            <i class="fa fa-download"></i> Download Scholarship Letter\
                                        </a>\
                                    </td>\
                                    <!--<td>' + (item.clas ? item.clas.clas_name : 'N/A') + '</td>-->\
                                <!-- <td>' + gender + '</td>-->\
                                <!-- <td>' + status + '</td>-->\
                                    <td>\
                                        <div class="dropdown">\
                                            <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton_' + item.id + '" data-bs-toggle="dropdown" aria-expanded="false">\
                                                Actions\
                                            </button>\
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton_' + item.id + '">\
                                                <li>\
                                                    <span type="button" \
                                                        data-id="' + item.id + '" \
                                                        data-firstname="' + firstname + '" \
                                                        data-secondname="' + secondname + '" \
                                                        data-lastname="' + lastname + '" \
                                                        data-phonenumber="' + phonenumber + '" \
                                                        data-parent_phone="' + parent_phone + '" \
                                                        data-email="' + email + '" \
                                                        data-update_course_id="' + course_id + '" \
                                                        data-update_clas_id="' + clas_id_val + '" \
                                                        data-school_id="' + school_id + '" \
                                                        data-role="' + role + '" \
                                                        data-clas_category="' + clas_category + '" \
                                                        data-prefered_course="' + prefered_course + '" \
                                                        data-gender="' + gender + '" \
                                                        data-status="' + status + '" \
                                                        class="text-success dropdown-item jobDesBtn"><i class="fa fa-edit"></i>Update Student</span>\
                                                </li>\
                                                <li>\
                                                    <span type="button" data-id="' + item.id + '" \
                                                        class="text-warning dropdown-item suspendBtn"><i class="fa fa-trash"></i> Suspend Student</span>\
                                                </li>\
                                                <li>\
                                                    <span type="button" value="' + item.id + '" \
                                                        class="text-danger dropdown-item deleteBtn"><i class="fa fa-trash"></i> Delete Student</span>\
                                                </li>\
                                                <li>\
                                                    <a class="dropdown-item viewQuestionsBtn text-info" href="' + baseUrl + '?user_id=' + item.id + '" target="_blank">\
                                                        <i class="fa fa-bars" aria-hidden="true"></i> Manage Fee\
                                                    </a>\
                                                </li>\
                                            </ul>\
                                        </div>\
                                    </td>\
                                </tr>'
                            );
                        });

                        // Render pagination
                        renderPagination(response.pagination, search, perPage);

                        // Attach event listeners for the dropdown actions
                        $('.jobDesBtn').on('click', function() {
                            const userId = $(this).data('id');
                            const firstname = $(this).data('firstname') || '';
                            const secondname = $(this).data('secondname') || '';
                            const lastname = $(this).data('lastname') || '';
                            const phonenumber = $(this).data('phonenumber') || '';
                            const parent_phone = $(this).data('parent_phone') || '';
                            const email = $(this).data('email') || '';
                            const school_id = $(this).data('school_id') || '';
                            const update_course_id = $(this).data('update_course_id') || '';
                            const update_clas_id = $(this).data('update_clas_id') || '';
                            const role = $(this).data('role') || '';
                            const clas_category = $(this).data('clas_category') || '';
                            const gender = $(this).data('gender') || '';
                            const prefered_course = $(this).data('prefered_course') || '';
                            const status = $(this).data('status') || '';

                            // Populate modal fields
                            $('#user_id').val(userId);
                            $('#updateUserModal #firstname').val(firstname);
                            $('#updateUserModal #secondname').val(secondname);
                            $('#updateUserModal #lastname').val(lastname);
                            $('#updateUserModal #phonenumber').val(phonenumber);
                            $('#updateUserModal #parent_phone').val(parent_phone);
                            $('#updateUserModal #email').val(email);
                            $('#updateUserModal #school_id').val(school_id);
                            $('#updateUserModal #update_course_id').val(update_course_id);
                            $('#updateUserModal #update_clas_id').val(update_clas_id);
                            $('#updateUserModal #role').val(role);
                            $('#updateUserModal #clas_category').val(clas_category);
                            $('#updateUserModal #gender').val(gender);
                            $('#updateUserModal #prefered_course').val(prefered_course);
                            $('#updateUserModal #status').val(status);

                            // Show the modal
                            $('#updateUserModal').modal('show');
                        });

                        $('.deleteBtn').on('click', function() {
                            const delete_user_id = $(this).data('id');
                            // Populate modal fields
                            $('#delete_user_id').val(delete_user_id);
                            // Show the modal
                            $('#deleteUserModal').modal('show');
                        });

                        $('.suspendBtn').on('click', function() {
                            const suspend_user_id = $(this).data('id');
                            // Populate modal fields
                            $('#suspend_user_id').val(suspend_user_id);
                            // Show the modal
                            $('#suspendUserModal').modal('show');
                        });
                    }
                });
            }




            $('#updateUserForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                const formData = {
                    user_id: $('#user_id').val(),
                    firstname: $('#firstname').val(),
                    secondname: $('#secondname').val(),
                    lastname: $('#lastname').val(),
                    phonenumber: $('#phonenumber').val(),
                    school_id: $('#school_id').val(),
                    //prefered_course: $('#prefered_course').val(),
                    parent_phone: $('#parent_phone').val(),
                    email: $('#email').val(),
                    update_course_id: $('#update_course_id').val(),
                    update_clas_id: $('#update_clas_id').val(),
                    role: $('#role').val(),
                    clas_category: $('#clas_category').val(),
                    gender: $('#gender').val(),
                    _token: "{{ csrf_token() }}" // Include CSRF token for security
                };

                //console.log('Form Data:', formData); // Log serialized data

            

                $.ajax({
                    type: 'POST',
                    url: "{{ route('updateTraineePerClas') }}",
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert(response.message); // Notify user of success
                            $('#updateUserModal').modal('hide'); // Hide the modal
                            displaySuccessMessage('User Updated Successfully');
                            fetchUsers(); // Refresh the users table
                        } else {
                            alert('Failed to update user.');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            let errorMessages = '';
                            $.each(errors, function(key, value) {
                                errorMessages += value[0] + '\n';
                            });
                            alert(errorMessages); // Display validation errors
                        } else {
                            alert('An error occurred.');
                        }
                    }
                });

            
            });




            $('#deleteUserForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                const formData = {
                    delete_user_id: $('#delete_user_id').val(),
                    _token: "{{ csrf_token() }}" // Include CSRF token for security
                };

                $.ajax({
                    type: 'POST',
                    url: "{{ route('deleteUser') }}",
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert(response.message); // Notify user of success
                            $('#deleteUserModal').modal('hide'); // Hide the modal
                            displaySuccessMessage('User Deleted Successfully');
                            fetchUsers(); // Refresh the users table
                        } else {
                            alert('Failed to update user.');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            let errorMessages = '';
                            $.each(errors, function(key, value) {
                                errorMessages += value[0] + '\n';
                            });
                            alert(errorMessages); // Display validation errors
                        } else {
                            alert('An error occurred.');
                        }
                    }
                });

            
            });


            $('#suspendUserForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                const formData = {
                    suspend_user_id: $('#suspend_user_id').val(),
                    _token: "{{ csrf_token() }}" // Include CSRF token for security
                };

                $.ajax({
                    type: 'POST',
                    url: "{{ route('suspendUser') }}",
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert(response.message); // Notify user of success
                            $('#suspendUserModal').modal('hide'); // Hide the modal
                            displaySuccessMessage('User Suspended Successfully');
                            fetchUsers(); // Refresh the users table
                        } else {
                            alert('Failed to suspend user.');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            let errorMessages = '';
                            $.each(errors, function(key, value) {
                                errorMessages += value[0] + '\n';
                            });
                            alert(errorMessages); // Display validation errors
                        } else {
                            alert('An error occurred.');
                        }
                    }
                });

            
            });



            $('#suspendUserForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                const formData = {
                    suspend_user_id: $('#suspend_user_id').val(),
                    _token: "{{ csrf_token() }}" // Include CSRF token for security
                };

                $.ajax({
                    type: 'POST',
                    url: "{{ route('suspendUser') }}",
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert(response.message); // Notify user of success
                            $('#suspendUserModal').modal('hide'); // Hide the modal
                            displaySuccessMessage('User Suspended Successfully');
                            fetchUsers(); // Refresh the users table
                        } else {
                            alert('Failed to suspend user.');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            let errorMessages = '';
                            $.each(errors, function(key, value) {
                                errorMessages += value[0] + '\n';
                            });
                            alert(errorMessages); // Display validation errors
                        } else {
                            alert('An error occurred.');
                        }
                    }
                });

            
            });




            function renderPagination(pagination, search, perPage) {
                let paginationHTML = "";

                if (pagination.current_page > 1) {
                    paginationHTML += '<button class="pagination-btn" data-page="' + (pagination.current_page - 1) + '" data-search="' + search + '" data-per-page="' + perPage + '">Previous</button>';
                }

                for (let i = 1; i <= pagination.last_page; i++) {
                    const activeClass = pagination.current_page === i ? 'active' : '';
                    paginationHTML += '<button class="pagination-btn ' + activeClass + '" data-page="' + i + '" data-search="' + search + '" data-per-page="' + perPage + '">' + i + '</button>';
                }

                if (pagination.current_page < pagination.last_page) {
                    paginationHTML += '<button class="pagination-btn" data-page="' + (pagination.current_page + 1) + '" data-search="' + search + '" data-per-page="' + perPage + '">Next</button>';
                }

                $('#pagination-controls').html(paginationHTML);
            }


            // Live search functionality
            $('#search').on('input', function() {
                const search = $(this).val();
                fetchUsers(1, search); // Always reset to page 1 when searching
            });


            $('#select').on('change', function() {
                const perPage = $(this).val();
                const search = $('#search').val(); // Get current search term, if any
                fetchUsers(1, search, perPage); // Reset to page 1 with new perPage value
            });

            // Handle pagination button click with updated perPage
            $(document).on('click', '.pagination-btn', function() {
                const page = $(this).data('page');
                const search = $(this).data('search');
                const perPage = $(this).data('per-page');
                fetchUsers(page, search, perPage);
            });






        $('#markAllStudentAlumniForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            const formData = {
                alumni_clas_id: $('#alumni_clas_id').val(),
                _token: "{{ csrf_token() }}" // Include CSRF token for security
            };

            $.ajax({
                type: 'POST',
                url: "{{ route('markedStudentAsAlumni') }}",
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.message); // Notify user of success
                        displaySuccessMessage('All Students are marked As allumni');
                        fetchUsers(); // Refresh the users table
                    } else {
                        alert('Failed to update user.');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessages = '';
                        $.each(errors, function(key, value) {
                            errorMessages += value[0] + '\n';
                        });
                        alert(errorMessages); // Display validation errors
                    } else {
                        alert('An error occurred.');
                    }
                }
            });  
        });







        $('#suspendAllStudentsForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            const formData = {
                suspend_all_students_clas_id: $('#suspend_all_students_clas_id').val(),
                _token: "{{ csrf_token() }}" // Include CSRF token for security
            };

            $.ajax({
                type: 'POST',
                url: "{{ route('suspendAllStudents') }}",
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.message); // Notify user of success
                        displaySuccessMessage('All Students Are suspended');
                        fetchUsers(); // Refresh the users table
                    } else {
                        alert('Failed to suspend.');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessages = '';
                        $.each(errors, function(key, value) {
                            errorMessages += value[0] + '\n';
                        });
                        alert(errorMessages); // Display validation errors
                    } else {
                        alert('An error occurred.');
                    }
                }
            });  
        });




        $('#activateAllStudentsForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            const formData = {
                activate_all_students_clas_id: $('#activate_all_students_clas_id').val(),
                _token: "{{ csrf_token() }}" // Include CSRF token for security
            };

            $.ajax({
                type: 'POST',
                url: "{{ route('activateAllStudents') }}",
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.message); // Notify user of success
                        displaySuccessMessage('All Students Are Activated');
                        fetchUsers(); // Refresh the users table
                    } else {
                        alert('Failed to Activate Students.');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessages = '';
                        $.each(errors, function(key, value) {
                            errorMessages += value[0] + '\n';
                        });
                        alert(errorMessages); // Display validation errors
                    } else {
                        alert('An error occurred.');
                    }
                }
            });  
        });











    });
</script>
@endsection