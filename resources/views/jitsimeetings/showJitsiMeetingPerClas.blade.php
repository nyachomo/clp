
@extends('layouts.master')
@section('content')


<div id="message-container" class="mt-3"></div>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                
                <div class="row">
                      <div class="col-sm-3">
                          <p>Class: {{$clas->clas_name ?? 'NA'}}</p>
                      </div>
                      <div class="col-sm-2">
                          <p>Total Meeting: <span id="total-meetings"></span></p>
                      </div>

                      <div class="col-sm-2">
                          <p>Active Meeting: <span id="active_meetings"></span></p>
                      </div>

                      <div class="col-sm-2">
                          <p>Suspended Meeting: <span id="suspended_meetings"></span></p>
                      </div>

                      <div class="col-sm-3">
                          <button class="btn btn-success btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#createNewMeetingModal">Create New Meeting</button>
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
                                    <th>Meeting Name</th>
                                    <th>Jwt Link</th>
                                    <th>Meeting Status</th>
                                    <th>Join Meeting</th>
                                   
                                   
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










<div class="modal" id="createNewMeetingModal">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Create New Meeting</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal">&times;</button>
               
              </div>
              <form id="create_new_meeting">
              <div class="modal-body">

                       <div id="progressBarContainer" class="my-2" style="display: none;">
                            <div class="progress">
                                <div id="progressBar"
                                    class="progress-bar progress-bar-striped bg-info"
                                    role="progressbar"
                                    style="width: 0%; transition: width 0.4s;"></div>
                            </div>
                        </div>
                

                  <input type="text" name="clas_id" id="create_clas_id" value="{{$clas_id}}" hidden="true">
                  <div class="row">
                      <div class="col-sm-12">
                          <label>Meeting Name</label>
                          <input type="text" name="meeting-name" id="create_meeting_name" class="form-control">
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-sm-12">
                          <label>Jwt Link</label>
                          <input type="text" name="jwt_link" id="create_jwt_link" class="form-control">
                      </div>
                  </div>

              </div>

              
              <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger rounded-pill pull-left" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success rounded-pill">Save</button>
              </div>
            </form>
          </div>
      </div>
  </div>




<!-- Modal Template -->

<div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="updateUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateUserModalLabel">Update Jitsi Meeting</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!--PROGRESS BAR-->
                      <div id="updateprogressBarContainer" class="my-2" style="display: none;">
                            <div class="progress">
                                <div id="updateprogressBar"
                                    class="progress-bar progress-bar-striped bg-info"
                                    role="progressbar"
                                    style="width: 0%; transition: width 0.4s;"></div>
                            </div>
                        </div>
                <!--PROGRESS BAR-->

               <form id="updateUserForm">
                 <input type="text" name="meeting_id" id="update_meeting_id" hidden="true">
                  <div class="row">
                      <div class="col-sm-12">
                          <label>Meeting Name</label>
                          <input type="text" name="meeting-name" id="update_meeting_name" class="form-control">
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-sm-12">
                          <label>Jwt Link</label>
                          <input type="text" name="jwt_link" id="update_jwt_link" class="form-control">
                      </div>
                  </div>


               
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
                <h5 class="modal-title" id="deleteUserModalLabel">Are you sure you want to delete this meeting</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="border:1px solid white">

                <!--PROGRESS BAR-->
                    <div id="deleteprogressBarContainer" class="my-2" style="display: none;">
                            <div class="progress">
                                <div id="deleteprogressBar"
                                    class="progress-bar progress-bar-striped bg-info"
                                    role="progressbar"
                                    style="width: 0%; transition: width 0.4s;"></div>
                            </div>
                    </div>
                <!--END OF PROGRESS BAR-->

                <form id="deleteUserForm">
                   
                
                    <input type="text" id="delete_meeting_id" name="delete_meeting_id" class="form-control" hidden="true">
                   
               
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
                <h5 class="modal-title" id="deleteUserModalLabel">Are you sure you want to suspend this meeting</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="border:1px solid white">
                <!--PROGRESS BAR-->

                <div id="suspendprogressBarContainer" class="my-2" style="display: none;">
                    <div class="progress">
                        <div id="suspendprogressBar"
                            class="progress-bar progress-bar-striped bg-info"
                            role="progressbar"
                            style="width: 0%; transition: width 0.4s;"></div>
                    </div>
                </div>

                <!--END OF PROGRESS BAR-->
                <form id="suspendUserForm">
                    <input type="text" id="suspend_meeting_id" name="suspend_meeting_id" class="form-control" hidden="true">
            </div>

            <div class="modal-footer justify-content-between" style="border:1px solid white">
                <button type="button" class="btn btn-danger rounded-pill"  data-bs-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-success rounded-pill">Suspend</button>
            </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="activateUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border:1px solid white">
                <h5 class="modal-title" id="deleteUserModalLabel">Are you sure you want to activate this meeting</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="border:1px solid white">
                <!--PROGRESS BAR-->

                <div id="activateprogressBarContainer" class="my-2" style="display: none;">
                    <div class="progress">
                        <div id="activateprogressBar"
                            class="progress-bar progress-bar-striped bg-info"
                            role="progressbar"
                            style="width: 0%; transition: width 0.4s;"></div>
                    </div>
                </div>

                <!--END OF PROGRESS BAR-->
                <form id="activateUserForm">
                    <input type="text" id="activate_meeting_id" name="activate_meeting_id" class="form-control" hidden="true">
            </div>

            <div class="modal-footer justify-content-between" style="border:1px solid white">
                <button type="button" class="btn btn-danger rounded-pill"  data-bs-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-success rounded-pill">Activate</button>
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
            let progressInterval;
            fetchUsers();

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

            

          function resetCreateMeetingForm(){
            $('#create_meeting_name').val("");
            $('#create_jwt_link').val("");
          }





            function fetchUsers(page = 1, search = '', perPage = 10) {
                $.ajax({
                    type: 'GET',
                    url: "{{ route('fetchJitsiMeetingPerClas', ['classId' => ':classId']) }}".replace(':classId', clas_id),
                    data: { page: page, search: search, per_page: perPage },
                    dataType: "json",
                    success: function(response) {
                        // Update total users
                        $('#total-meetings').text(response.total_meetings);
                        $('#suspended_meetings').text(response.suspended_meetings);
                        $('#active_meetings').text(response.active_meetings);
                      

                        // Clear and repopulate the table
                        $('tbody').html("");
                        $.each(response.users, function(key, item) {
                            // Use fallback values for all potentially null properties
                            const meeting_name = item.meeting_name || 'N/A';
                            const jwt_link = item.jwt_link || 'NA';
                            const meeting_status = item.meeting_status || 'NA';
                            
                            
                            const meetingClassUrl = "{{ route('joinJitsiMeetingPerClas') }}";
                            // truncate jwt_link if longer than 100 characters
                            let truncatedJwtLink = jwt_link.length > 30 ? jwt_link.substring(0, 30) + "..." : jwt_link;
                            let truncatedMeetingName = meeting_name.length > 30 ? meeting_name.substring(0, 30) + "..." : meeting_name;

                            $('#table1').append(
                                '<tr>\
                                    <td>' + (key + 1) + '</td>\
                                    <td>' + truncatedMeetingName + '</td>\
                                    <td>' + truncatedJwtLink + '</td>\
                                    <td><span class="' + (meeting_status === 'Active' ? 'text-success' : 'text-danger') + '">' + meeting_status + '</span></td>\
                                    <td><span class="badge bg-success"><a href="'+ meetingClassUrl +'?meeting_id='+item.id+'" style="color:white;">Join Meeting</a></span></td>\
                                   <td>\
                                        <div class="dropdown">\
                                            <button class="btn btn-success btn-sm rounded-pill dropdown-toggle action-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">More Actions</button>\
                                            <ul class="dropdown-menu">\
                                                <li><a class="dropdown-item updateBtn text-success" href="#" \
                                                    data-id="' + item.id + '" \
                                                    data-meeting_status="' + item.meeting_status + '" \
                                                    data-meeting_name="' + item.meeting_name + '" \
                                                    data-jwt_link="' + item.jwt_link + '"><i class="bi bi-pencil"></i> Update Meeting</a></li>\
                                                <li><a class="dropdown-item deleteBtn text-danger" href="#" data-id="' + item.id + '"><i class="bi bi-trash"></i> Delete Meeting</a></li>' +
                                                    (item.meeting_status && item.meeting_status.toLowerCase() === 'active' ? 
                                                        '<li><a class="dropdown-item suspendBtn text-warning" href="#" data-id="' + item.id + '"><i class="bi bi-pause"></i> Suspend Meeting</a></li>' : 
                                                        '') +
                                                    (item.meeting_status && item.meeting_status.toLowerCase() === 'suspended' ? 
                                                        '<li><a class="dropdown-item activateBtn text-success" href="#" data-id="' + item.id + '"><i class="bi bi-play"></i> Activate Meeting</a></li>' : 
                                                        '') +
                                            '</ul>\
                                        </div>\
                                    </td>\
                                </tr>'
                            );
                        });

                        // Render pagination
                        renderPagination(response.pagination, search, perPage);

                        // Attach event listeners for the dropdown actions
                        $('.updateBtn').on('click', function() {
                            const meetingId = $(this).data('id');
                            const update_meeting_name = $(this).data('meeting_name') || '';
                            const update_jwt_link = $(this).data('jwt_link') || '';
                           
                            // Populate modal fields
                            $('#update_meeting_id').val(meetingId);
                            $('#update_meeting_name').val(update_meeting_name);
                            $('#update_jwt_link').val(update_jwt_link);
                           

                            // Show the modal
                            $('#updateUserModal').modal('show');
                        });

                        $('.deleteBtn').on('click', function() {
                            const delete_meeting_id = $(this).data('id');
                            // Populate modal fields
                            $('#deleteUserModal #delete_meeting_id').val(delete_meeting_id);
                            // Show the modal
                            $('#deleteUserModal').modal('show');
                        });

                        $('.suspendBtn').on('click', function() {
                            const suspend_meeting_id = $(this).data('id');
                            // Populate modal fields
                            $('#suspend_meeting_id').val(suspend_meeting_id);
                            // Show the modal
                            $('#suspendUserModal').modal('show');
                        });

                        $('.activateBtn').on('click', function() {
                            const activate_meeting_id = $(this).data('id');
                            // Populate modal fields
                            $('#activate_meeting_id').val(activate_meeting_id);
                            // Show the modal
                            $('#activateUserModal').modal('show');
                        });


                    }
                });
            }




            $('#updateUserForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                const formData = {
                    meeting_id: $('#update_meeting_id').val(),
                    meeting_name: $('#update_meeting_name').val(),
                    jwt_link: $('#update_jwt_link').val(),
                    _token: "{{ csrf_token() }}" // Include CSRF token for security
                };

               
                 // Reset progress bar
                    $('#updateprogressBar').css('width', '0%');
                    $('#updateprogressBarContainer').show();

                    // Simulate progress
                    let progress = 0;
                    progressInterval = setInterval(function () {
                        if (progress < 90) {
                            progress += 5;
                            $('#updateprogressBar').css('width', progress + '%');
                        }
                    }, 200); // Adjust speed here



                $.ajax({
                    type: 'POST',
                    url: "{{ route('updateJitsiMeetingPerClas') }}",
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                           
                            clearInterval(progressInterval);
                            $('#updateprogressBar').css('width', '100%');

                            setTimeout(() => {
                                $('#updateprogressBarContainer').fadeOut();
                            }, 500);
                    
                            
                            $('#updateUserModal').modal('hide'); // Hide the modal
                            displaySuccessMessage('Meeting Created Successfully');
                            fetchUsers();

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
                    delete_meeting_id: $('#delete_meeting_id').val(),
                    _token: "{{ csrf_token() }}" // Include CSRF token for security
                };

                 // Reset progress bar
                $('#deleteprogressBar').css('width', '0%');
                $('#deleteprogressBarContainer').show();

                // Simulate progress
                let progress = 0;
                progressInterval = setInterval(function () {
                    if (progress < 90) {
                        progress += 5;
                        $('#deleteprogressBar').css('width', progress + '%');
                    }
                }, 200); // Adjust speed here



                $.ajax({
                    type: 'POST',
                    url: "{{ route('deleteJitsiMeetingPerClas') }}",
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            
                            clearInterval(progressInterval);
                            $('#deleteprogressBar').css('width', '100%');

                            setTimeout(() => {
                                $('#deleteprogressBarContainer').fadeOut();
                            }, 500);
                    
                            $('#deleteUserModal').modal('hide'); // Hide the modal
                            displaySuccessMessage('Meeting deleted Successfully');
                            fetchUsers();

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
                    suspend_meeting_id: $('#suspend_meeting_id').val(),
                    _token: "{{ csrf_token() }}" // Include CSRF token for security
                };

                 // Reset progress bar
                $('#suspendprogressBar').css('width', '0%');
                $('#suspendprogressBarContainer').show();

                // Simulate progress
                let progress = 0;
                progressInterval = setInterval(function () {
                    if (progress < 90) {
                        progress += 5;
                        $('#suspendprogressBar').css('width', progress + '%');
                    }
                }, 200); // Adjust speed here



                $.ajax({
                    type: 'POST',
                    url: "{{ route('suspendJitsiMeetingPerClas') }}",
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                          
                            clearInterval(progressInterval);
                            $('#suspendprogressBar').css('width', '100%');

                            setTimeout(() => {
                                $('#suspendprogressBarContainer').fadeOut();
                            }, 500);
                    
                            
                            $('#suspendUserModal').modal('hide'); // Hide the modal
                            displaySuccessMessage('Meeting Suspended Successfully');
                            fetchUsers();


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
                            //alert(errorMessages); // Display validation errors
                        } else {
                            alert('An error occurred.');
                        }
                    }
                });

            
            });


            $('#activateUserForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                const formData = {
                    activate_meeting_id: $('#activate_meeting_id').val(),
                    _token: "{{ csrf_token() }}" // Include CSRF token for security
                };

                 // Reset progress bar
                $('#activateprogressBar').css('width', '0%');
                $('#activateprogressBarContainer').show();

                // Simulate progress
                let progress = 0;
                progressInterval = setInterval(function () {
                    if (progress < 90) {
                        progress += 5;
                        $('#activateprogressBar').css('width', progress + '%');
                    }
                }, 200); // Adjust speed here



                $.ajax({
                    type: 'POST',
                    url: "{{ route('activateJitsiMeetingPerClas') }}",
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                          
                            clearInterval(progressInterval);
                            $('#activateprogressBar').css('width', '100%');

                            setTimeout(() => {
                                $('#activateprogressBarContainer').fadeOut();
                            }, 500);
                    
                            
                            $('#activateUserModal').modal('hide'); // Hide the modal
                            displaySuccessMessage('Meeting Activated Successfully');
                            fetchUsers();


                        } else {
                            alert('Failed to Activate user.');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            let errorMessages = '';
                            $.each(errors, function(key, value) {
                                errorMessages += value[0] + '\n';
                            });
                            //alert(errorMessages); // Display validation errors
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

            // Status filter change
             // Status filter change
            $('#dropDownStatus').on('change', function() {
                fetchUsers(1);
            });
            // Handle pagination button click with updated perPage
            $(document).on('click', '.pagination-btn', function() {
                const page = $(this).data('page');
                const search = $(this).data('search');
                const perPage = $(this).data('per-page');
                fetchUsers(page, search, perPage);
            });






         

       
        //Listen to form submission
         $('#create_new_meeting').on('submit',function(e){
            e.preventDefault();//Prevent page referesh
            const formData={
                clas_id:$('#create_clas_id').val(),
                meeting_name:$('#create_meeting_name').val(),
                jwt_link:$('#create_jwt_link').val(),
                _token:"{{csrf_token()}}",
            };

            // Reset progress bar
            $('#progressBar').css('width', '0%');
            $('#progressBarContainer').show();

            // Simulate progress
            let progress = 0;
            progressInterval = setInterval(function () {
                if (progress < 90) {
                    progress += 5;
                    $('#progressBar').css('width', progress + '%');
                }
            }, 200); // Adjust speed here

           // console.log("formData:",formData);

           //CALL AJAX RQUEST TO CREATE DATA
           $.ajax({
                method:"POST",
                url:"{{route('createJitsiMeetingPerClas')}}",
                data:formData,
                dataType:"json",
                success:function(response){
                    if(response.success){

                        clearInterval(progressInterval);
                        $('#progressBar').css('width', '100%');

                        setTimeout(() => {
                            $('#progressBarContainer').fadeOut();
                        }, 500);
                
                        
                        $('#createNewMeetingModal').modal('hide');
                        displaySuccessMessage('Meeting Created Successfully');
                         resetCreateMeetingForm();
                        fetchUsers();
                    }
                },
                error:function(error){console.log('could not saved');},
           });


         });






    });
</script>
@endsection

