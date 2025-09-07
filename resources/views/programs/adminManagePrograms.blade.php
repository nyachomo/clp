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
<!--<div class="row">
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
                Total Programs: <span id="total-users">0</span>
                <a type="button" style="float:right" class="btn btn-sm btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#addClasModal"> <i class="fa fa-plus"></i>Add New Program</a>
                <!--<a type="button" style="float:right" class="btn btn-sm btn-warning rounded-pill" data-bs-toggle="modal" data-bs-target="#activateAllClasModal"> <i class="fa fa-plus"></i>Activate All Clases</a>-->
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
                                    <th>Status</th>
                                    <th>Category</th>
                                    <th>Total Students</th>
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
<div id="addClasModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel"><i class="uil-user-plus"></i> Add New Program</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="POST" action="{{route('addClas')}}">
                @csrf
               

                <!-- /.card-header -->
                <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Program Name<sup>*</sup></label>
                                    <input type="text" class="form-control" name="clas_name" required>
                                </div>
                            </div>
                        </div>

                        <!--<div class="row">
                            <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Is Scholarship Test Class ?<sup>*</sup></label>
                                        <select name="is_scholarship_test_clas" class="form-control" required>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                        
                                    </div>
                            </div>
                        </div>-->

                        <!--<div class="row">
                            <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Scholarship Test Category<sup>*</sup></label>
                                        <select name="scholarship_test_category" class="form-control" required>
                                            <option value="None">None</option>
                                            <option value="lower_Forms">Lower Forms</option>
                                            <option value="Form_4">Form 4</option>
                                        </select>
                                        
                                    </div>
                            </div>
                        </div>-->

                        <div class="row">
                            <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Program Category (Describe the type of student in this program)<sup>*</sup></label>
                                        <select name="clas_category" class="form-control" required>
                                            <option value="">Select ....</option>
                                            <option value="ict_club_class">Ict Club Students/class/program</option>
                                            <option value="event_class">Event Class/Program/student</option>
                                            <option value="scholarship_test_class">Scholarship Test Class/event/student</option>
                                            <option value="referal_class">Referall Class/program/student</option>
                                        </select>
                                        
                                    </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                 <input type="text" name="clas_status" value="Active" hidden="true">
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
<div id="updateClasModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel"><i class="uil-user-plus"></i> Update Program</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="POST" id="updateClasForm">
                @csrf
               

                <!-- /.card-header -->
                <div class="card-body">
                    <input type="text" class="form-control" name="course_id" id="clas_id" hidden="true">
                    <div class="row">
                        <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Class Name<sup>*</sup></label>
                                    <input type="text" class="form-control" name="clas_name" id="clas_name" required>
                                </div>
                        </div>
                    </div>

                       <div class="row">
                            <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Class Category<sup>*</sup></label>
                                        <select name="clas_category" id="clas_category" class="form-control" required>
                                            <option value="">Select ....</option>
                                            <option value="ict_club_class">Ict Club Students/class/program</option>
                                            <option value="event_class">Event Class/Program/student</option>
                                            <option value="scholarship_test_class">Scholarship Test Class/event/student</option>
                                            <option value="referal_class">Referall Class/program/student</option>
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
                    <input type="text" class="form-control" name="delete_clas_id" id="delete_clas_id" hidden="true">
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
<div id="suspendClasModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel"> Are You sure you want to suspend this course ?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="POST" id="suspendClasForm">
                @csrf

                <div class="card-body" style="border:1px solid white">
                    <input type="text" class="form-control" name="suspend_clas_id" id="suspend_clas_id" hidden="true">
                   
                </div>


            <div class="modal-footer justify-content-between" style="border:1px solid white">
                <button type="button" class="btn btn-danger rounded-pill"  data-bs-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-success rounded-pill">Suspend</button>
            </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--end of modal-->

<!-- Add User modal -->
<div id="activateClasModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel"> Are You sure you want to activate this course ?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="POST" id="activateClasForm">
                @csrf

                <div class="card-body" style="border:1px solid white">
                    <input type="text" class="form-control" name="activate_clas_id" id="activate_clas_id" >
                   
                </div>


            <div class="modal-footer justify-content-between" style="border:1px solid white">
                <button type="button" class="btn btn-danger rounded-pill"  data-bs-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-success rounded-pill">Activate</button>
            </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--end of modal-->


<!-- Add User modal -->
<div id="activateAllClasModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="standard-modalLabel"> You are about to activate all the clases ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="POST" id="activateAllClasForm">
                @csrf
            <div class="modal-footer justify-content-between" style="border:1px solid white">
                <button type="button" class="btn btn-danger rounded-pill"  data-bs-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-success rounded-pill">Activate</button>
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
        url: "{{route('fetchPrograms')}}",
        data: { page: page, search: search, per_page: perPage },
        dataType: "json",
        success: function(response) {
            // Update total users
            $('#total-users').text(response.total_users);

            // Clear and repopulate the table
            $('tbody').html("");
            $.each(response.users, function(key, item) {
                const baseUrl = "{{ route('showTraineePerClas') }}";
               
                // Inside the $.each(response.users, function(key, item) { ... }) loop
                $('#table1').append(
                   '<tr>\
                        <td>' + (key + 1) + '</td>\
                        <td>' + item.clas_name + '</td>\
                        <td><span class="' + (item.clas_status && item.clas_status.toLowerCase() === 'active' ? 'text-success' : 'text-danger') + '">' + item.clas_status + '</span></td>\
                        <td>' + item.clas_category + '</td>\
                        <td>' + item.total_student + 'Student(s)<a class="text-info" href="' + baseUrl + '?clas_id=' + item.id + '" target="_blank"> View</a>\
                        <td>\
                            <div class="dropdown">\
                                <button class="btn btn-success btn-sm rounded-pill dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">More Actions</button>\
                                <ul class="dropdown-menu">\
                                    <li><a class="dropdown-item updateBtn text-success" href="#" \
                                        data-id="' + item.id + '" \
                                        data-clas_status="' + item.clas_status + '" \
                                        data-clas_category="' + item.clas_category + '" \
                                        data-clas_name="' + item.clas_name + '"><i class="uil-edit"></i> Update Class</a></li>\
                                    <li><a class="dropdown-item deleteBtn text-danger" href="#" data-id="' + item.id + '"><i class="fa fa-edit"></i> Delete Class</a></li>' +
                                        (item.clas_status && item.clas_status.toLowerCase() === 'active' ? 
                                            '<li><a class="dropdown-item suspendBtn text-warning" href="#" data-id="' + item.id + '"><i class="uil-cancel"> </i>Suspend Class</a></li>' : 
                                            '') +
                                        (item.clas_status && item.clas_status.toLowerCase() === 'suspended' ? 
                                            '<li><a class="dropdown-item activateBtn text-success" href="#" data-id="' + item.id + '"><i class="uil-cancel"> </i>Activate Class</a></li>' : 
                                            '') +
                                '</ul>\
                            </div>\
                        </td>\
                    </tr>'
                );



            });

            // Render pagination
            renderPagination(response.pagination, search, perPage);

            // Attach event listener to Update button
            $('.updateBtn').on('click', function() {
                const clas_id = $(this).data('id');
                const clas_name = $(this).data('clas_name');
                const clas_category = $(this).data('clas_category');
                const clas_status = $(this).data('clas_status');
                // Populate modal fields
                $('#clas_id').val(clas_id);
                $('#clas_name').val(clas_name);
                $('#clas_category').val(clas_category);
                $('#updateClasModal #clas_status').val(clas_status);

                // Show the modal
                $('#updateClasModal').modal('show');
            });



            // Attach event listener to Update button
            $('.deleteBtn').on('click', function() {
                const delete_clas_id = $(this).data('id');
                // Populate modal fields
                $('#delete_clas_id').val(delete_clas_id);
                // Show the modal
                $('#deleteClasModal').modal('show');
            });


            // Attach event listener to Update button
            $('.suspendBtn').on('click', function() {
                const suspend_clas_id = $(this).data('id');
                // Populate modal fields
                $('#suspend_clas_id').val(suspend_clas_id);
                // Show the modal
                $('#suspendClasModal').modal('show');
            });


            // Attach event listener to Update button
            $('.activateBtn').on('click', function() {
                const activate_clas_id = $(this).data('id');
                // Populate modal fields
                $('#activate_clas_id').val(activate_clas_id);
                // Show the modal
                $('#activateClasModal').modal('show');
            });


            // Attach event listener to Update button
            $('.downloadStudentExcel').on('click', function() {
                const excel_clas_id = $(this).data('id');
                // Populate modal fields
                $('#excel_clas_id').val(excel_clas_id);
                // Show the modal
                $('#downloadStudentExcel').modal('show');
            });

           

            // Attach event listener to Update button
            $('.viewStudentsBtn').on('click', function() {
                const classId = $(this).val();
                const getStudentsPerClassRoute = "{{ route('getStudentsPerClass', ['classId' => ':classId']) }}";
                // Replace :classId in the route
                const url = getStudentsPerClassRoute.replace(':classId', classId);

                $('#viewStudentPerClassModal').modal('show');
                $.ajax({
                    type: 'GET',
                    url:url,
                    //url: '/clases/get-students/' + classId, // Adjust this route to your backend
                    dataType: 'json',
                    success: function(response) {
                        // Show the modal

                        $('#clasName').text(response.clasName);
                        $('#total_students').text(response.total_students)
                        $('#excelStudents').text(response.total_students)
                        $('#alumni_clas_id').val(response.alumni_clas_id)
                        $('#table3').html("");
                        $.each(response.users, function(key, item) {
                            // Use fallback values for null secondname and lastname
                            const secondname = item.secondname || ''; // Fallback for null or undefined
                            const lastname = item.lastname || ''; // Fallback for null or undefined
                            $('#table3').append(
                                '<tr>\
                                    <td>' + (key + 1) + '</td>\
                                    <td>' + item.firstname + ' ' + secondname + ' ' + lastname + '</td>\
                                    <td>' + item.phonenumber + '</td>\
                                    <td>' + item.email + '</td>\
                                    <td>' + item.status + '</td>\
                                    <td> <button type="button" data-id="' + item.id + '" class="alumniBtn btn btn-outline-success btn-sm">Make Alumni</button></td>\
                                </tr>'
                            );
                        });

                      
                    },
                    error: function(xhr) {
                        
                    }
                });

                
                
            });


            // Attach event listener to Update button
             $('.viewStudentsBtn2').on('click', function() {
                const classId = $(this).data('id');
                const getStudentsPerClassRoute = "{{ route('getStudentsPerClass', ['classId' => ':classId']) }}";
                // Replace :classId in the route
                const url = getStudentsPerClassRoute.replace(':classId', classId);
                $('#viewStudentPerClassModal').modal('show');
                $.ajax({
                    type: 'GET',
                    url:url,
                    //url: '/clases/get-students/' + classId, // Adjust this route to your backend
                    dataType: 'json',
                    success: function(response) {
                        // Show the modal

                        $('#clasName').text(response.clasName);
                        $('#total_students').text(response.total_students)
                        $('#alumni_clas_id').val(response.alumni_clas_id)
                        $('#table3').html("");
                        $.each(response.users, function(key, item) {
                            // Use fallback values for null secondname and lastname
                            const secondname = item.secondname || ''; // Fallback for null or undefined
                            const lastname = item.lastname || ''; // Fallback for null or undefined
                            $('#table3').append(
                                '<tr>\
                                    <td>' + (key + 1) + '</td>\
                                    <td>' + item.firstname + ' ' + secondname + ' ' + lastname + '</td>\
                                    <td>' + item.phonenumber + '</td>\
                                    <td>' + item.email + '</td>\
                                    <td>' + item.status + '</td>\
                                    <td> <button type="button" data-id="' + item.id + '" class="alumniBtn btn btn-outline-success btn-sm">Make Alumni</button></td>\
                                </tr>'
                            );
                        });

                      
                    },
                    error: function(xhr) {
                        
                    }
                });

                
                
            });




            //DOWNLOAD STUDENTS RECORDS AS EXCEL

            



        }
    });
}







$('#updateClasForm').on('submit', function(e) {
    e.preventDefault(); // Prevent the default form submission

    const formData = {
        clas_id: $('#clas_id').val(),
        clas_name: $('#clas_name').val(),
        clas_category: $('#clas_category').val(),
        _token: "{{ csrf_token() }}" // Include CSRF token for security
    };

    

    $.ajax({
        type: 'POST',
        url: "{{ route('updateClas') }}",
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert(response.message); // Notify user of success
                $('#updateClasModal').modal('hide'); // Hide the modal
                displaySuccessMessage('Class Updated Successfully');
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




$('#deleteClasForm').on('submit', function(e) {
    e.preventDefault(); // Prevent the default form submission

    const formData = {
        delete_clas_id: $('#delete_clas_id').val(),
        _token: "{{ csrf_token() }}" // Include CSRF token for security
    };

    $.ajax({
        type: 'POST',
        url: "{{ route('deleteClas') }}",
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert(response.message); // Notify user of success
                $('#deleteClasModal').modal('hide'); // Hide the modal
                displaySuccessMessage('Class Deleted Successfully');
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


$('#suspendClasForm').on('submit', function(e) {
    e.preventDefault(); // Prevent the default form submission

    const formData = {
        suspend_clas_id: $('#suspend_clas_id').val(),
        _token: "{{ csrf_token() }}" // Include CSRF token for security
    };

    $.ajax({
        type: 'POST',
        url: "{{ route('suspendClas') }}",
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert(response.message); // Notify user of success
                $('#suspendClasModal').modal('hide'); // Hide the modal
                displaySuccessMessage('Class Suspended Successfully');
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


$('#activateClasForm').on('submit', function(e) {
    e.preventDefault(); // Prevent the default form submission

    const formData = {
        activate_clas_id: $('#activate_clas_id').val(),
        _token: "{{ csrf_token() }}" // Include CSRF token for security
    };

    $.ajax({
        type: 'POST',
        url: "{{ route('activateClas') }}",
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert(response.message); // Notify user of success
                $('#activateClasModal').modal('hide'); // Hide the modal
                displaySuccessMessage('Class Activated Successfully');
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

$('#activateAllClasForm2').on('submit', function(e) {
    e.preventDefault(); // Prevent the default form submission

    const formData = {
        activate_all_clas_id: 2,
        _token: "{{ csrf_token() }}" // Include CSRF token for security
    };

    $.ajax({
        type: 'POST',
        url: "{{ route('activateAllClas') }}",
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert(response.message); // Notify user of success
                $('#activateAllClasModal').modal('hide'); // Hide the modal
                displaySuccessMessage('All Classes Activated Successfully');
                fetchUsers(); // Refresh the users table
            } else {
                alert('Failed to update Clases.');
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






$('#activateAllClasForm').on('submit', function(e) {
    e.preventDefault();

    // Show loading state
    const submitBtn = $(this).find('[type="submit"]');
    submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');

    $.ajax({
        type: 'POST',
        url: "{{ route('activateAllClas') }}",
        data: {
            _token: "{{ csrf_token() }}"
        },
        dataType: 'json',
        success: function(response) {
            $('#activateAllClasModal').modal('hide');
            
            // Show success notification (using Toastr)
            toastr.success(response.message, 'Success', {
                timeOut: 3000,
                progressBar: true
            });
            
            // Refresh the table
            fetchUsers();
        },
        error: function(xhr) {
            let errorMessage = 'An error occurred';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            }
            
            toastr.error(errorMessage, 'Error', {
                timeOut: 5000
            });
        },
        complete: function() {
            submitBtn.prop('disabled', false).text('Activate');
        }
    });
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
                $('#viewStudentPerClassModal').modal('hide'); // Hide the modal
                displaySuccessMessage('All Students are marked As allumni');
                //fetchUsers(); // Refresh the users table
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






//FUNCTION FOR PULLING DATA FOR EACH CLASS










});



</script>
@endsection