@extends('layouts.master')
@section('content')
<!-- end page title
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Manage Student Cats</li>
                </ol>
            </div>
            <h4 class="page-title">Student Assesment (Cats)</h4>
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
                Test: <span id="total-users">0</span>
               <!-- <a type="button" style="float:right" class="btn btn-sm btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#addExamModal"> <i class="fa fa-plus"></i> Add New Cats</a>-->
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
                                    <th>Exam Name</th>
                                    <th>Status</th>
                                    <th>Attempts</th>
                                    <th>Not Attenpts</th>
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






@endsection


@section('scripts')
<script>
    

    $(document).ready(function(){




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
        url: "{{route('highSchoolTeacherFetchStudentTest')}}",
        data: { page: page, search: search, per_page: perPage },
        dataType: "json",
        success: function(response) {
            // Update total users
            $('#total-users').text(response.total_users);

            // Clear and repopulate the table
            $('tbody').html("");
            $.each(response.users, function(key, item) {
                const baseUrl = "{{ route('adminManageQuestions') }}";
                const attemptsUrl = "{{ route('highSchoolTeacherViewTestAttemptPage') }}";

                // Determine the class based on exam_status
                let statusClass = '';
                let statusText = item.exam_status;

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

                $('#table1').append(
                    '<tr>\
                        <td>' + (key + 1) + '</td>\
                        <td>' + item.clas.clas_name + '</td>\
                        <td>' + item.exam_name + '</td>\
                        <td class="' + statusClass + '">' + statusText + '</td>\ <!-- This is where we add the conditional class for status --> \
                        <!--<td>' + item.attempted_students + '</td>-->\
                        <!--<td>' + item.unattempted_students + '</td>-->\
                        <td>' + item.attempted_students + 'Attempt(s)<a class="text-info" href="' + attemptsUrl + '?exam_id=' + item.id + '" target="_blank"> View</a></td>\
                        <td>' + item.unattempted_students + 'Attempt(s)<a class="text-info" href="' + attemptsUrl + '?exam_id=' + item.id + '" target="_blank"> View</a></td>\
                    </tr>'
                );
            });

            // Render pagination
            renderPagination(response.pagination, search, perPage);

            // Attach event listener to Update button
            $('.updateBtn').on('click', function() {
                //const exam_id = $(this).val();
                const exam_id = $(this).data('id');
                const exam_name = $(this).data('exam_name');
                const exam_start_date = $(this).data('exam_start_date');
                const exam_end_date = $(this).data('exam_end_date');
                const exam_duration = $(this).data('exam_duration');
                const update_exam_status = $(this).data('update_exam_status');
                const exam_instruction = $(this).data('exam_instruction');
                const update_clas_id = $(this).data('update_clas_id');
                // Populate modal fields
                $('#exam_id').val(exam_id);
                $('#exam_name').val(exam_name);
                $('#exam_start_date').val(exam_start_date);
                $('#exam_end_date').val(exam_end_date);
                $('#exam_duration').val(exam_duration);
                $('#update_exam_status').val(update_exam_status);
                $('#exam_instruction').val(exam_instruction);
                $('#update_clas_id').val(update_clas_id);
                // Show the modal
                $('#updateExamModal').modal('show');
            });



            // Attach event listener to Update button
            $('.deleteBtn').on('click', function() {
                const delete_exam_id = $(this).attr('value');
                // Populate modal fields
                $('#delete_exam_id').val(delete_exam_id);
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




});



</script>
@endsection