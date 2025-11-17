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












    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <p style="font-size:20px"><b>Exam Name:</b> <span id="exam_name"> NA</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Class Name:</b>  <span id="clas_name">NA</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Course Name:</b> <span id="course_name"> NA</span> </p>
                    <a href="{{route('downloadPracticalScore',['exam_id'=>$exam_id])}}" type="button" style="float:right" class="btn btn-sm btn-secondary rounded-pill"> <i class="fa fa-plus"></i> Download</a>
                     <a type="button" style="float:right" class="btn btn-sm btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#addExamModal"> <i class="fa fa-plus"></i> Add New Practical</a>
                     
                </div>
                <div class="card-body">

                           <div class="row">
                                <div class="col-12">

                                    <div class="table-responsive">

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




                                        <table class="table table-sm table-striped dt-responsive nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Fullname </th>
                                                        <td>Student Answer</td>
                                                        <th>Score (Row Max)</th>
                                                        <th>Score (30)</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            
                                                <tbody id="table1"></tbody>
                                    
                                        </table> 

                                        

                                    <div id="pagination-controls" style="float:right"></div>
                                    </div>
                                </div>
                            </div>
                </div> 
            </div> 
        </div> 
    </div>
    <!-- end row-->






<!-- Add User modal -->
<div id="addExamModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Add New Practical</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="POST" action="{{route('adminAddStudentPracticalScore')}}" enctype="multipart/form-data">
                @csrf
               

                <!-- /.card-header -->
                <div class="card-body">
                   
                 <div class="row">

                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Exam_id<sup>*</sup></label>
                                <input type="text" class="form-control" name="practical_id" value="{{$exam_id}}" required>
                            </div>
                        </div>

                    </div>


                   

                    <div class="row">

                       
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Select Students<sup>*</sup></label>
                                <select name="user_id" class="form-control">
                                    <option>Select ... </option>
                                    @foreach($students as $key=>$student)
                                     <option value="{{$student->id}}">{{$student->firstname}} {{$student->secondname}} {{$student->lastname}}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>


                    </div>



                   

                    <div class="row">

                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Student Score<sup>*</sup></label>
                                <input type="number" class="form-control" name="student_score" required>
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
<div id="deleteClasModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel"> Are You sure you want to delete this record ?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="POST" id="deleteClasForm">
                @csrf

                <div class="card-body" style="border:1px solid white">
                    <input type="text" class="form-control" name="delete_clas_id" id="delete_clas_id" >
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
<div id="updateClasModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel"> Marks</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="POST" id="updateClasForm">
                @csrf

                <div class="card-body" style="border:1px solid white">
                    <input type="text" class="form-control" name="update_answer_id" id="update_answer_id">
                    <label>Student Score</label>
                     <input type="number" class="form-control"  id="update_student_score">
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


@endsection
@section('scripts')
<script>
    

    $(document).ready(function(){

           // Get the exam_id from the URL query parameters
           const urlParams = new URLSearchParams(window.location.search);
            const exam_id = urlParams.get('exam_id');

            // Fetch questions for this exam
            if (exam_id) {
                fetchUsers(exam_id);
            }


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




            function fetchUsers(exam_id,page = 1, search = '', perPage = 1000) {
                $.ajax({
                    type: 'GET',
                    //url: "{{route('adminManageQuestions')}}",
                    //url: "{{ url('questions/questions') }}/" + exam_id, 
                    url: "{{ route('fetchPracticalAttempts', ['exam_id' => '__exam_id__']) }}".replace('__exam_id__', exam_id),  // Use named route
                    data: { page: page, search: search, per_page: perPage },
                    dataType: "json",
                    success: function(response) {
                        // Update total users
                        $('#total-users').text(response.total_users);
                        $('#exam_name').text(response.exam_name);
                        $('#clas_name').text(response.clas_name);
                        $('#course_name').text(response.course_name);
                        
                        let max_score=response.ovaral_score;
                        // Clear and repopulate the table
                        $('tbody').html("");
                        $.each(response.users, function(key, item) {
                           
                            
                            let fullName = item.user.firstname; // Start with first name
                            let scoreDisplay = item.student_score + " / " + max_score;
                            let scoreOutOfThirty = Math.round((item.student_score / max_score) * 30);
                
                            if (item.user.secondname) {
                                fullName += " " + item.user.secondname; // Add second name if available
                            }
                            
                            if (item.user.lastname) {
                                fullName += " " + item.user.lastname; // Add last name if available
                            }

                            $('#table1').append(
                                '<tr>\
                                    <td>' + (key + 1) + '</td>\
                                    <td>' + fullName + '</td>\
                                     <td><a href="{{ asset('practicals') }}/' + item.student_answer + '" download>' + item.student_answer + ' (Download)</a></td>\
                                     <!--<td><a href="/practicals/' + item.student_answer + '" download>' + item.student_answer + '</a></td>-->\
                                     <td>' + scoreDisplay + '</td>\
                                     <td>' + scoreOutOfThirty + '</td>\
                                     <td>\
                                        <a href="#"><span  class="badge bg-danger deleteBtn" href="#" data-id="' + item.id + '"><i class="uil-trash"></i> Delete</span></a>\
                                        <a href="#"><span  class="badge bg-success updateBtn" href="#" data-id="' + item.id + '"><i class="uil-trash"></i>Grade Student</span></a>\
                                    </a>\
                                </td>\
                                </tr>'
                            );
                        });

                        // Render pagination
                        renderPagination(response.pagination, search, perPage);
                        // Attach event listener to Update button


                         // Attach event listener to Update button
                        $('.deleteBtn').on('click', function() {
                            const delete_clas_id = $(this).data('id');
                            // Populate modal fields
                            $('#delete_clas_id').val(delete_clas_id);
                            // Show the modal
                            $('#deleteClasModal').modal('show');
                        });


                        
                         // Attach event listener to Update button
                        $('.updateBtn').on('click', function() {
                            const update_answer_id = $(this).data('id');
                            // Populate modal fields
                            $('#update_answer_id').val(update_answer_id);
                            // Show the modal
                            $('#updateClasModal').modal('show');
                        });
                       

                    }
                });
            }





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





            $('#deleteClasForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                const formData = {
                    delete_clas_id: $('#delete_clas_id').val(),
                    _token: "{{ csrf_token() }}" // Include CSRF token for security
                };

                $.ajax({
                    type: 'POST',
                    url: "{{ route('adminDeleteStudentPracticalScore') }}",
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert(response.message); // Notify user of success
                            $('#deleteClasModal').modal('hide'); // Hide the modal
                            displaySuccessMessage('Class Deleted Successfully');
                            fetchUsers(exam_id); // Refresh the users table
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




            $('#updateClasForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                const formData = {
                    update_answer_id: $('#update_answer_id').val(),
                    student_score: $('#update_student_score').val(),
                    _token: "{{ csrf_token() }}" // Include CSRF token for security
                };

                $.ajax({
                    type: 'POST',
                    url: "{{ route('adminUpdateStudentPracticalScore') }}",
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert(response.message); // Notify user of success
                            $('#updateClasModal').modal('hide'); // Hide the modal
                            displaySuccessMessage('Score updated Successfully');
                            fetchUsers(exam_id); // Refresh the users table
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






});



</script>
@endsection
















    


