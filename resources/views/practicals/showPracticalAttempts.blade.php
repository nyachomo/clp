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
                     <a type="button" style="float:right" class="btn btn-sm btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#addExamModal"> <i class="fa fa-plus"></i> Add New Student Practical Score</a>
                     <a href="{{ url()->previous() }}" type="button" style="float:right" class="btn btn-sm btn-info rounded-pill">Back</a>
                     <a type="button" style="float:right" class="btn btn-sm btn-warning rounded-pill" data-bs-toggle="modal" data-bs-target="#missingStudentsModal">Not Submitted</a>
                     
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
                                                        <th>Comment</th>
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
                <h4 class="modal-title" id="standard-modalLabel">Add Student Practical Score</h4>
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


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Comment<sup>*</sup></label>
                                <input type="text" class="form-control" name="comment" required>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Student Answer (Optional)</label>
                                <input type="file" class="form-control" name="student_answer">

                                <div class="progress mt-2" style="height: 18px; display:none;" id="addAnswerProgressWrap">
                                    <div class="progress-bar" id="addAnswerProgress" role="progressbar" style="width:0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                </div>
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


<!-- Missing Students Modal -->
<div id="missingStudentsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Students Not Submitted</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fullname</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $k => $student)
                                <tr>
                                    <td>{{ $k + 1 }}</td>
                                    <td>{{ $student->firstname }} {{ $student->secondname }} {{ $student->lastname }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->phonenumber }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">All students have submitted</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal">Close</button>
                <div>
                    <a href="{{ route('downloadMissingPracticalStudentsPdf', ['exam_id' => $exam_id]) }}" class="btn btn-success rounded-pill">Download PDF</a>
                    <a href="{{ route('downloadMissingPracticalStudentsExcel', ['exam_id' => $exam_id]) }}" class="btn btn-success rounded-pill">Download Excel</a>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--end of modal-->


<!-- Update Answer modal -->
<div id="updateAnswerModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Update Student Answer</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="POST" id="updateAnswerForm" action="{{ route('adminUpdateStudentPracticalAnswer') }}" enctype="multipart/form-data">
                @csrf

                <div class="card-body" style="border:1px solid white">
                    <input type="hidden" class="form-control" name="answer_id" id="update_answer_file_id">
                    <label>Upload New Answer File</label>
                    <input type="file" class="form-control" name="student_answer" required>

                    <div class="progress mt-2" style="height: 18px; display:none;" id="updateAnswerProgressWrap">
                        <div class="progress-bar" id="updateAnswerProgress" role="progressbar" style="width:0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between" style="border:1px solid white">
                    <button type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success rounded-pill">Update</button>
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

                     <label class="mt-2">Comment</label>
                     <input type="text" class="form-control" id="update_comment" required>

                     <div class="progress mt-2" style="height: 18px; display:none;" id="updateMarksProgressWrap">
                        <div class="progress-bar" id="updateMarksProgress" role="progressbar" style="width:0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                     </div>
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


            $('#addExamModal form').on('submit', function(e) {
                e.preventDefault();

                const form = this;
                const actionUrl = $(form).attr('action');
                const progressWrap = document.getElementById('addAnswerProgressWrap');
                const progressBar = document.getElementById('addAnswerProgress');

                progressBar.style.width = '0%';
                progressBar.setAttribute('aria-valuenow', '0');
                progressBar.textContent = '0%';
                progressWrap.style.display = 'block';

                const xhr = new XMLHttpRequest();
                const formData = new FormData(form);

                xhr.open('POST', actionUrl, true);
                xhr.setRequestHeader('Accept', 'application/json');

                xhr.upload.onprogress = function (event) {
                    if (event.lengthComputable) {
                        const percent = Math.round((event.loaded / event.total) * 100);
                        progressBar.style.width = percent + '%';
                        progressBar.setAttribute('aria-valuenow', String(percent));
                        progressBar.textContent = percent + '%';
                    }
                };

                xhr.onreadystatechange = function () {
                    if (xhr.readyState !== 4) return;

                    let payload = null;
                    try {
                        payload = JSON.parse(xhr.responseText);
                    } catch (err) {
                        payload = null;
                    }

                    if (xhr.status >= 200 && xhr.status < 300 && payload && payload.success) {
                        progressBar.style.width = '100%';
                        progressBar.setAttribute('aria-valuenow', '100');
                        progressBar.textContent = '100%';
                        $('#addExamModal').modal('hide');
                        displaySuccessMessage(payload.message || 'Score added succesfully');
                        fetchUsers(exam_id);
                        form.reset();
                    } else {
                        let msg = 'Upload failed';
                        if (payload && payload.message) msg = payload.message;
                        if (payload && payload.errors) {
                            const firstKey = Object.keys(payload.errors)[0];
                            if (firstKey && payload.errors[firstKey] && payload.errors[firstKey][0]) {
                                msg = payload.errors[firstKey][0];
                            }
                        }
                        alert(msg);
                    }

                    setTimeout(function () {
                        progressWrap.style.display = 'none';
                    }, 600);
                };

                xhr.send(formData);
            });




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
                        $('#table1').html("");
                        $.each(response.users, function(key, item) {
                           
                            
                            let fullName = item.user.firstname; // Start with first name
                            let hasScore = item.student_score !== null && item.student_score !== undefined && String(item.student_score).trim() !== '';
                            let scoreDisplay = hasScore ? (item.student_score + " / " + max_score) : ('null/' + max_score + ' (Not yet marked)');
                            let scoreOutOfThirty = hasScore ? Math.round((item.student_score / max_score) * 30) : 'NA';
                
                            if (item.user.secondname) {
                                fullName += " " + item.user.secondname; // Add second name if available
                            }
                            
                            if (item.user.lastname) {
                                fullName += " " + item.user.lastname; // Add last name if available
                            }

                            let commentText = 'NA';
                            if (item.comment) {
                                commentText = item.comment;
                            }

                            let gradeButtonText = 'Grade Student';
                            if (item.student_score !== null && item.student_score !== undefined && String(item.student_score).trim() !== '') {
                                gradeButtonText = 'Update Marks/Grade';
                            }

                            let gradeButtonClass = 'bg-success';
                            if (gradeButtonText === 'Update Marks/Grade') {
                                gradeButtonClass = 'bg-secondary';
                            }

                            $('#table1').append(
                                '<tr>\
                                    <td>' + (key + 1) + '</td>\
                                    <td>' + fullName + '</td>\
                                     <td>\
                                        <a href="{{ asset('practicals') }}/' + item.student_answer + '" download>' + item.student_answer + ' (Download)</a>\
                                        <button type="button" class="btn btn-sm btn-warning ms-1 updateAnswerBtn" data-id="' + item.id + '">Update</button>\
                                     </td>\
                                     <!--<td><a href="/practicals/' + item.student_answer + '" download>' + item.student_answer + '</a></td>-->\
                                     <td>' + scoreDisplay + '</td>\
                                     <td>' + scoreOutOfThirty + '</td>\
                                     <td>' + commentText + '</td>\
                                     <td>\
                                        <a href="#"><span  class="badge bg-danger deleteBtn" href="#" data-id="' + item.id + '"><i class="uil-trash"></i> Delete</span></a>\
                                        <a href="#"><span  class="badge ' + gradeButtonClass + ' updateBtn" href="#" data-id="' + item.id + '" data-student-score="' + (item.student_score ?? '') + '" data-comment="' + (item.comment ?? '') + '"><i class="uil-trash"></i>' + gradeButtonText + '</span></a>\
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
                            const existingScore = $(this).data('student-score');
                            const existingComment = $(this).data('comment');
                            // Populate modal fields
                            $('#update_answer_id').val(update_answer_id);
                            $('#update_student_score').val(existingScore !== null && existingScore !== undefined ? existingScore : '');
                            $('#update_comment').val(existingComment ? existingComment : '');
                            // Show the modal
                            $('#updateClasModal').modal('show');
                        });

                        $('.updateAnswerBtn').on('click', function() {
                            const answer_id = $(this).data('id');
                            $('#update_answer_file_id').val(answer_id);
                            $('#updateAnswerModal').modal('show');
                        });
                       

                    }
                });
            }


            $('#updateAnswerForm').on('submit', function(e) {
                e.preventDefault();

                const form = this;
                const actionUrl = $(form).attr('action');
                const progressWrap = document.getElementById('updateAnswerProgressWrap');
                const progressBar = document.getElementById('updateAnswerProgress');

                progressBar.style.width = '0%';
                progressBar.setAttribute('aria-valuenow', '0');
                progressBar.textContent = '0%';
                progressWrap.style.display = 'block';

                const xhr = new XMLHttpRequest();
                const formData = new FormData(form);

                xhr.open('POST', actionUrl, true);
                xhr.setRequestHeader('Accept', 'application/json');

                xhr.upload.onprogress = function (event) {
                    if (event.lengthComputable) {
                        const percent = Math.round((event.loaded / event.total) * 100);
                        progressBar.style.width = percent + '%';
                        progressBar.setAttribute('aria-valuenow', String(percent));
                        progressBar.textContent = percent + '%';
                    }
                };

                xhr.onreadystatechange = function () {
                    if (xhr.readyState !== 4) return;

                    let payload = null;
                    try {
                        payload = JSON.parse(xhr.responseText);
                    } catch (err) {
                        payload = null;
                    }

                    if (xhr.status >= 200 && xhr.status < 300 && payload && payload.success) {
                        $('#updateAnswerModal').modal('hide');
                        displaySuccessMessage(payload.message || 'Student answer updated successfully');
                        fetchUsers(exam_id);
                        form.reset();
                    } else {
                        let msg = 'Upload failed';
                        if (payload && payload.message) msg = payload.message;
                        if (payload && payload.errors) {
                            const firstKey = Object.keys(payload.errors)[0];
                            if (firstKey && payload.errors[firstKey] && payload.errors[firstKey][0]) {
                                msg = payload.errors[firstKey][0];
                            }
                        }
                        alert(msg);
                    }

                    setTimeout(function () {
                        progressWrap.style.display = 'none';
                    }, 600);
                };

                xhr.send(formData);
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

                const progressWrap = document.getElementById('updateMarksProgressWrap');
                const progressBar = document.getElementById('updateMarksProgress');

                progressBar.style.width = '0%';
                progressBar.setAttribute('aria-valuenow', '0');
                progressBar.textContent = '0%';
                progressWrap.style.display = 'block';

                const xhr = new XMLHttpRequest();
                const formData = new FormData();
                formData.append('update_answer_id', $('#update_answer_id').val());
                formData.append('student_score', $('#update_student_score').val());
                formData.append('comment', $('#update_comment').val());
                formData.append('_token', "{{ csrf_token() }}");

                xhr.open('POST', "{{ route('adminUpdateStudentPracticalScore') }}", true);
                xhr.setRequestHeader('Accept', 'application/json');

                xhr.upload.onprogress = function (event) {
                    if (event.lengthComputable) {
                        const percent = Math.round((event.loaded / event.total) * 100);
                        progressBar.style.width = percent + '%';
                        progressBar.setAttribute('aria-valuenow', String(percent));
                        progressBar.textContent = percent + '%';
                    } else {
                        progressBar.style.width = '60%';
                        progressBar.setAttribute('aria-valuenow', '60');
                        progressBar.textContent = '60%';
                    }
                };

                xhr.onreadystatechange = function () {
                    if (xhr.readyState !== 4) return;

                    let payload = null;
                    try {
                        payload = JSON.parse(xhr.responseText);
                    } catch (err) {
                        payload = null;
                    }

                    if (xhr.status >= 200 && xhr.status < 300 && payload && payload.success) {
                        progressBar.style.width = '100%';
                        progressBar.setAttribute('aria-valuenow', '100');
                        progressBar.textContent = '100%';

                        alert(payload.message || 'Score Updated successfully!');
                        $('#updateClasModal').modal('hide');
                        displaySuccessMessage('Score updated Successfully');
                        fetchUsers(exam_id);
                    } else {
                        let msg = 'An error occurred.';
                        if (payload && payload.message) msg = payload.message;
                        if (payload && payload.errors) {
                            const firstKey = Object.keys(payload.errors)[0];
                            if (firstKey && payload.errors[firstKey] && payload.errors[firstKey][0]) {
                                msg = payload.errors[firstKey][0];
                            }
                        }
                        alert(msg);
                    }

                    setTimeout(function () {
                        progressWrap.style.display = 'none';
                    }, 600);
                };

                xhr.send(formData);

           });






});



</script>
@endsection
















    


