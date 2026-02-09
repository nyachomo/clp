@extends('layouts.master')
@section('content')
<!-- end page title
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Manage Student Assignment</li>
                </ol>
            </div>
            <h4 class="page-title">Student Assesment (Assignments)</h4>
        </div>
    </div>
</div>
 -->


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
                        <center></h3>{{$clas->clas_name ?? 'NA'}}</h3></center>
                      </div>
                </div>
                <div class="row">
                      <div class="col-sm-12">
                         Total Assignment: <span id="total-users">0</span>
                          <a type="button" style="float:right" class="btn btn-sm btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#addExamModal"> <i class="fa fa-plus"></i> Add New Practical</a>
                      </div>
                </div>
                
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
                                    <th>Class</th>
                                    <th>Course Name</th>
                                    <th>Module Name</th>
                                    <th>Name</th>
                                     <th>Is Multiple Choice</th>
                                    <th>Question</th>
                                    <th>Marks</th>
                                    <th>Status</th>
                                    <th>Attempts</th>
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
<div id="addExamModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Add New Practical</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="POST" action="{{route('addPracticalPerClas')}}" enctype="multipart/form-data">
                @csrf
               

                <!-- /.card-header -->
                <div class="card-body">
                   

                    <div class="row">

                       
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Select Class<sup>*</sup></label>
                                <select class="form-control" name="clas_id" required>
                                     <option value="{{$clas->id}}">{{$clas->clas_name}}</option>
                                </select>
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <label>Select Course <sup>*</sup></label>
                            <select class="form-control" name="course_id" id="course_id" required>
                                <option value="">Select Course</option>
                                @foreach($courses as $course)
                                     <option value="{{$course->id}}">{{$course->course_name ?? 'NA'}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <label>Course Module</label>
                             <select class="form-control" name="course_module_id" id="course_module_id" required>
                            <option value="">Select Course Module</option>
                        </select>
                        </div>
                    </div>
                   


                    <!--<div class="row">
                        <div class="col-sm-12">
                            <label>Select Course <sup>*</sup></label>
                            <select class="form-control" name="course_module_id" required>
                                <option value="">Select Course Module</option>
                                @foreach($course_modules as $course_module)
                                     <option value="{{$course_module->id}}">{{$course_module->module_name ?? 'NA'}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>-->


                    <div class="row">

                       
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Practical Name<sup>*</sup></label>
                                <input type="text" name="name" class="form-control">
                                
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                 <label>Is Multiple Choice</label>
                                 <select name="is_multiple_choice" id="is_multiple_choice" class="form-control">
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>



                    <div class="row" id="questionRow">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Question<sup>*</sup></label>
                                <input type="file" class="form-control" name="question" id="questionInput">
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Marks<sup>*</sup></label>
                                <input type="number" class="form-control" name="marks" required>
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Exam Status<sup>*</sup></label>
                                <select name="status" class="form-control">
                                    <option value="Published">Published</option>
                                    <option value="Not Published">Not Published</option> 
                                </select>
                            </div>
                        </div>

                    </div>



                </div>
                 <!-- /.card-body -->


            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger rounded-pill"  data-bs-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-success rounded-pill">Save</button>
            </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--end of modal-->


<!-- Add User modal -->
<div id="updateExamModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Update Practical</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="POST" id="updateExamForm">
                @csrf
               

                <!-- /.card-header -->
                <div class="card-body">
                    
                    <div class="row">
                        
                        <input type="text" class="form-control" name="practical_id" id="practical_id" hidden=true>
                       
                        <div class="col-sm-12">
                             <label>Name</label>
                             <input type="text" class="form-control"   id="practical_name" required>
                        </div>

                         <div class="col-sm-12">
                             <label>Marks</label>
                             <input type="number" class="form-control" name="marks"  id="marks" required>
                        </div>

                    </div>

                </div>
                 <!-- /.card-body -->


            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger rounded-pill"  data-bs-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-success rounded-pill">Save</button>
            </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--end of modal-->


<!-- Add User modal -->
<div id="updateQuestionModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Update Practical Question</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="POST" action="updatePracticalQuestion" enctype="multipart/form-data">
                @csrf
               

                <!-- /.card-header -->
                <div class="card-body">
                    
                    <div class="row">
                        <label>Choose File</label>
                        <input type="file" name="update_question" class="form-control" required>
                        <input type="text" class="form-control" name="update_question_id" id="update_question_id" hidden="true">
                    </div>

                </div>
                 <!-- /.card-body -->


            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger rounded-pill"  data-bs-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-success rounded-pill">Save</button>
            </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--end of modal-->






<!-- Add User modal -->
<div id="deleteExamModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel"> Are You sure you want to delete this record ?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="POST" id="deleteExamForm">
                @csrf

                <div class="card-body" style="border:1px solid white">
                    <input type="text" class="form-control"  id="delete_practical_id" >
                </div>


            <div class="modal-footer justify-content-between" style="border:1px solid white">
                <button type="button" class="btn btn-danger rounded-pill"  data-bs-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-success rounded-pill">Delete</button>
            </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--end of modal-->




<!-- Add User modal -->
<div id="publishedExamModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel"> Are You sure you want to published this exam ?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="POST" id="publishedExamForm">
                @csrf

                <div class="card-body" style="border:1px solid white">
                    <input type="text" class="form-control" name="published_exam_id" id="published_exam_id">
                   
                </div>


            <div class="modal-footer justify-content-between" style="border:1px solid white">
                <button type="button" class="btn btn-danger rounded-pill"  data-bs-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-success rounded-pill">Published</button>
            </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--end of modal-->

<!-- Add User modal -->
<div id="notpublishedExamModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel"> Are You sure you want to Un published this exam ?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="POST" id="notpublishedExamForm">
                @csrf

                <div class="card-body" style="border:1px solid white">
                    <input type="text" class="form-control" name="notpublished_exam_id" id="notpublished_exam_id">
                   
                </div>


            <div class="modal-footer justify-content-between" style="border:1px solid white">
                <button type="button" class="btn btn-danger rounded-pill"  data-bs-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-success rounded-pill">Un Published</button>
            </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--end of modal-->




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
       
        url: "{{ route('fetchPracticalPerClas', ['classId' => ':classId']) }}".replace(':classId', clas_id),
        data: { page: page, search: search, per_page: perPage },
        dataType: "json",
        success: function(response) {
            // Update total users
            $('#total-users').text(response.total_users);

            // Clear and repopulate the table
            $('tbody').html("");
            $.each(response.users, function(key, item) {
                const baseUrl = "{{ route('adminManageQuestions') }}";
                const attemptsUrl = "{{ route('showPracticalAttempts') }}";

                // Determine the class based on exam_status
                let statusClass = '';
                let statusText = item.status;

                if (statusText === "Published") {
                    statusClass = 'text-success'; // Green
                } else if (statusText === "Not Published") {
                    statusClass = 'text-danger'; // Red
                } else if (statusText === "Suspended") {
                    statusClass = 'text-warning'; // Yellow
                }


                // Add the row with necessary content
                let publishedBtn = '';
                let notPublishedBtn = '';
                
                // Conditionally show buttons based on exam status
                if (statusText === "Published") {
                    publishedBtn = 'd-none'; // Hide the "Published" button
                    notPublishedBtn = ''; // Show the "Not Published" button
                } else if (statusText === "Not Published") {
                    publishedBtn = ''; // Show the "Published" button
                    notPublishedBtn = 'd-none'; // Hide the "Not Published" button
                }

                let questionColumn = '';

                if (item.is_multiple_choice === "Yes") {
                    questionColumn =
                        '<a class="text-success" href="' + baseUrl + '?exam_id=' + item.id + '" target="_blank">' +
                            '(' + item.total_questions + ' Questions) Manage  ' +
                        '</a>';
                } else {
                    questionColumn =
                        '<a href="{{ asset('practicals') }}/' + item.question + '" download>' +
                            item.question + ' (Download)</a> ' +
                        '<a href="#">' +
                            '<span class="badge bg-danger updateQuestionBtn" data-id="' + item.id + '">' +
                                '<i class="uil-trash"></i> Update Question' +
                            '</span>' +
                        '</a>';
                }''

                $('#table1').append(
                    '<tr>\
                        <td>' + (key + 1) + '</td>\
                        <td>' + item.clas.clas_name + '</td>\
                        <td>' + (item.course?.course_name ?? 'N/A') + '</td>\
                        <td>' + (item.coursemodule?.module_name ?? 'N/A') + '</td>\
                         <td>' + item.name + '</td>\
                        <td>' + item.is_multiple_choice + '</td>\
                        <!-- <td>' + item.question + '</td>-->\
                        <td>' + questionColumn + '</td>\
                        <!--<td><a href="{{ asset('practicals') }}/' + item.question + '" download>' + item.question + ' (Download) <a href="#"><span  class="badge bg-danger updateQuestionBtn" href="#" data-id="' + item.id + '"><i class="uil-trash"></i> Update Question</span></a></td>-->\
                        <!--<td><a href="/practicals/' + item.question + '" download>' + item.question + '</a></td>-->\
                        <td>' + item.marks + '</td>\
                        <td class="' + statusClass + '">' + statusText + '</td>\ <!-- This is where we add the conditional class for status --> \
                        <td>' + item.attempted_students + '<a href="' + attemptsUrl + '?exam_id=' + item.id + '"><i class="fa fa-eye-slash" aria-hidden="true"></i> View </a> </td>\
                       <td>\
                            <div class="dropdown">\
                                <button class="btn btn-success btn-sm rounded-pill dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">More Action</button>\
                                <ul class="dropdown-menu">\
                                    <li><a  class="text-success dropdown-item updateBtn" href="#" \
                                        data-id="' + item.id + '" \
                                        data-practical_name="' + item.name + '" \
                                        data-marks="' + item.marks + '" \
                                        data-update_clas_id="' + item.clas.id + '"> <i class="fa fa-edit"></i> Update</a></li>\
                                    <li><a  class="text-danger dropdown-item deleteBtn" href="#" data-id="' + item.id + '"><i class="fa fa-trash"></i>Delete</a></li>\
                                    <li><a class="text-info dropdown-item publishedBtn ' + publishedBtn + '" href="#" value="' + item.id + '"><i class="fa fa-check" aria-hidden="true"></i> Published</a></li>\
                                    <li><a class="text-success dropdown-item notpublishedBtn ' + notPublishedBtn + '" href="#" value="' + item.id + '"><i class="fa fa-check" aria-hidden="true"></i> Un Published</a></li>\
                                    <!--<li><a class="text-warning dropdown-item " href="' + baseUrl + '?exam_id=' + item.id + '" target="_blank"><i class="fa fa-eye-slash" aria-hidden="true"></i> Manage Questions</a></li>-->\
                                   <li><a class="text-info dropdown-item viewQuestionsBtn" href="' + attemptsUrl + '?exam_id=' + item.id + '"><i class="fa fa-eye-slash" aria-hidden="true"></i> View Attempts</a></li>\
                                </ul>\
                            </div>\
                        </td>\
                    </tr>'
                );
            });

            // Render pagination
            renderPagination(response.pagination, search, perPage);

            // Attach event listener to Update button
            $('.updateBtn').on('click', function() {
                //const exam_id = $(this).val();
                const practical_id = $(this).data('id');
                 const practical_name = $(this).data('practical_name');
                const marks = $(this).data('marks');
                // Populate modal fields
                $('#practical_id').val(practical_id);
                $('#practical_name').val(practical_name);
                $('#marks').val(marks);
                // Show the modal
                $('#updateExamModal').modal('show');
            });

            // Attach event listener to Update button
            $('.updateQuestionBtn').on('click', function() {
                const update_question_id = $(this).data('id');
                // Populate modal fields
                $('#update_question_id').val(update_question_id);
                // Show the modal
                $('#updateQuestionModal').modal('show');
            });


            // Attach event listener to Update button
            $('.deleteBtn').on('click', function() {
                const delete_practical_id = $(this).data('id');
                // Populate modal fields
                $('#delete_practical_id').val(delete_practical_id);
                // Show the modal
                $('#deleteExamModal').modal('show');
            });


            // Attach event listener to Update button
            $('.publishedBtn').on('click', function() {
                const published_exam_id = $(this).attr('value');
                // Populate modal fields
                $('#published_exam_id').val(published_exam_id);
                // Show the modal
                $('#publishedExamModal').modal('show');
            });


             // Attach event listener to Update button
             $('.notpublishedBtn').on('click', function() {
                const notpublished_exam_id = $(this).attr('value');
                // Populate modal fields
                $('#notpublished_exam_id').val(notpublished_exam_id);
                // Show the modal
                $('#notpublishedExamModal').modal('show');
            });

            //ONCLICK FOR VIEW STUDENTS ATTEMPTS








        }
    });
}



$('#updateExamForm').on('submit', function(e) {
    e.preventDefault(); // Prevent the default form submission

    const formData = {
        practical_id: $('#practical_id').val(),
        marks: $('#marks').val(),
        practical_name: $('#practical_name').val(),
        _token: "{{ csrf_token() }}" // Include CSRF token for security
    };

    

    $.ajax({
        type: 'POST',
        url: "{{ route('updatePracticalPerClas') }}",
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert(response.message); // Notify user of success
                $('#updateExamModal').modal('hide'); // Hide the modal
                displaySuccessMessage('Exam Updated Successfully');
                fetchUsers(); // Refresh the users table
            } else {
                alert('Failed to update exam.');
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






$('#deleteExamForm').on('submit', function(e) {
    e.preventDefault(); // Prevent the default form submission

    const formData = {
        delete_practical_id: $('#delete_practical_id').val(),
        _token: "{{ csrf_token() }}" // Include CSRF token for security
    };

    $.ajax({
        type: 'POST',
        url: "{{ route('deletePracticalPerClas') }}",
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert(response.message); // Notify user of success
                $('#deleteExamModal').modal('hide'); // Hide the modal
                displaySuccessMessage('Exam Deleted Successfully');
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


$('#publishedExamForm').on('submit', function(e) {
    e.preventDefault(); // Prevent the default form submission

    const formData = {
        published_exam_id: $('#published_exam_id').val(),
        _token: "{{ csrf_token() }}" // Include CSRF token for security
    };

    $.ajax({
        type: 'POST',
        url: "{{ route('publishedExams') }}",
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert(response.message); // Notify user of success
                $('#publishedExamModal').modal('hide'); // Hide the modal
                displaySuccessMessage('Exam Published Successfully');
                fetchUsers(); // Refresh the users table
            } else {
                alert('Failed to published Exam.');
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




$('#notpublishedExamForm').on('submit', function(e) {
    e.preventDefault(); // Prevent the default form submission

    const formData = {
        notpublished_exam_id: $('#notpublished_exam_id').val(),
        _token: "{{ csrf_token() }}" // Include CSRF token for security
    };

    $.ajax({
        type: 'POST',
        url: "{{ route('notpublishedExams') }}",
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert(response.message); // Notify user of success
                $('#notpublishedExamModal').modal('hide'); // Hide the modal
                displaySuccessMessage('Exam UnPublished Successfully');
                fetchUsers(); // Refresh the users table
            } else {
                alert('Failed to Unpublished Exam.');
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









        //HANDLING COURSE, WHEN SELECTED DISPLAY MODULE AS PER THE COURSE

       document.getElementById('course_id').addEventListener('change', function () {
            let courseId = this.value;
            let moduleSelect = document.getElementById('course_module_id');

            moduleSelect.innerHTML = '<option value="">Loading...</option>';

            if (courseId) {
                fetch(`{{ url('get-course-modules') }}/${courseId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Request failed');
                        }
                        return response.json();
                    })
                    .then(data => {
                        moduleSelect.innerHTML = '<option value="">Select Course Module</option>';
                        data.forEach(module => {
                            moduleSelect.innerHTML += 
                                `<option value="${module.id}">${module.module_name}</option>`;
                        });
                    })
                    .catch(() => {
                        moduleSelect.innerHTML = '<option value="">Failed to load modules</option>';
                    });
            } else {
                moduleSelect.innerHTML = '<option value="">Select Course Module</option>';
            }
        });



        //HANDLING IS MULTIPLE CHOICE FEATURE, WHEN CLICKED DISABLE FILE TEXT FIELD


            document.addEventListener('change', function (e) {

                if (e.target.id === 'is_multiple_choice') {
                    const questionRow = document.getElementById('questionRow');
                    const questionInput = document.getElementById('questionInput');

                    if (e.target.value === 'Yes') {
                        questionRow.style.display = 'none';
                        questionInput.required = false;
                    } else {
                        questionRow.style.display = 'block';
                        questionInput.required = true;
                    }
                }

            });






});



</script>
@endsection