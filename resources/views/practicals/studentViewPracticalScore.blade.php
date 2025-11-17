@extends('layouts.master')
@section('content')



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
                                    <th>Assesment Name</th>
                                    <th>Question</th>
                                    <th>Total Marks</th>
                                    <th>Status</th>
                                    <th>Your Answer</th>
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
                            <!-- text input -->
                            <div class="form-group">
                                <label>Practical Name<sup>*</sup></label>
                                <input type="text" name="name" class="form-control">
                                
                            </div>
                        </div>


                    </div>



                    <div class="row">

                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Question<sup>*</sup></label>
                                <input type="file" class="form-control" name="question" required>
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
                                    <option value="Not Published">Not Published</option>
                                     <option value="Published">Published</option>
                                    
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
            <form method="POST" action="studentUploadPracticalWork" enctype="multipart/form-data">
                @csrf
               

                <!-- /.card-header -->
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Practical Id</label>
                            <input type="text" class="form-control" name="practical_id" id="practical_id" readonly="true">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <label>Student Answer</label>
                            <input type="file" class="form-control" name="student_answer" required>
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
       
        url: "{{ route('studentFetchPracticalScore')}}",
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

                $('#table1').append(
                    '<tr>\
                        <td>' + (key + 1) + '</td>\
                        <td>' + item.clas.clas_name + '</td>\
                        <td>' + item.name + '</td>\
                        <!-- <td>' + item.question + '</td>-->\
                       <td><a href="{{ asset('practicals') }}/' + item.question + '" download>' + item.question + ' (Download)</a></td>\
                        <td>' + item.student_score + '/' + item.marks + '</td>\
                        <td class="' + statusClass + '">' + statusText + '</td>\ <!-- This is where we add the conditional class for status --> \
                        <td><a href="{{ asset('practicals') }}/' + item.student_answer + '" download>' + item.student_answer + ' (Download)</a></td>\
                        <td> <a href="#"><span  class="badge bg-success updateBtn" href="#" data-id="' + item.id + '"><i class="uil-trash"></i> Upload</span></a>\</td>\
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