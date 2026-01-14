@extends('layouts.master')
@section('content')

<style>
   





    /* ===== Page background ===== */
body {
    background: #f4f7fb;
}

/* ===== Cards ===== */
.card {
    border-radius: 20px;
    border: none;
    box-shadow: 0 18px 40px rgba(0, 0, 0, 0.12);
    margin-bottom: 25px;
}

/* ===== Main Account Card ===== */
.user_account_card {
    background: linear-gradient(135deg, #00264d, #ff0080);
    color: #fff;
}

.user_account_card p {
    opacity: 0.9;
}

/* Gradient heading */
.user_account_card_heading {
    font-weight: 800;
    background: linear-gradient(to right, #ffffff, #ffd6ea);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* ===== Progress (completion bar) ===== */
progress {
    width: 100%;
    height: 14px;
    border-radius: 20px;
    overflow: hidden;
}

progress::-webkit-progress-bar {
    background-color: rgba(255, 255, 255, 0.3);
}

progress::-webkit-progress-value {
    background: linear-gradient(135deg, #00e6ac, #39ac73);
}

progress::-moz-progress-bar {
    background: linear-gradient(135deg, #00e6ac, #39ac73);
}

/* ===== Profile Image ===== */
.avatar-lg {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border: 4px solid #ff0080;
}

/* ===== User Info Table ===== */
.table-bordered {
    border-radius: 14px;
    overflow: hidden;
}

.table th {
    background: #00264d;
    color: #fff;
    font-weight: 600;
    width: 40%;
}

.table td {
    font-weight: 600;
}

/* ===== Nav Pills (Tabs) ===== */
.nav-pills {
    background: #f1f3f9;
    padding: 8px;
    border-radius: 50px;
}

.nav-pills .nav-link {
    font-weight: 600;
    border-radius: 40px;
    color: #00264d;
    transition: all 0.3s ease;
}

.nav-pills .nav-link.active {
    background: linear-gradient(135deg, #00264d, #ff0080);
    color: #fff;
}

/* ===== Forms ===== */
.form-control,
select.form-control {
    border-radius: 30px;
    padding: 10px 16px;
    border: 1px solid #ddd;
}

.form-control:focus {
    border-color: #ff0080;
    box-shadow: 0 0 0 0.15rem rgba(255, 0, 128, 0.25);
}

/* ===== Buttons ===== */
.btn {
    border-radius: 30px;
    font-weight: 600;
}

.btn-success {
    background: linear-gradient(135deg, #00b894, #00cec9);
    border: none;
}

.btn-success:hover {
    opacity: 0.9;
    transform: translateY(-2px);
}

/* ===== Progress Bars (AJAX) ===== */
.progress {
    height: 16px;
    border-radius: 20px;
    overflow: hidden;
}

.progress-bar {
    font-weight: 600;
}

/* ===== Alerts ===== */
.alert {
    border-radius: 14px;
    border: none;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

/* ===== Mobile optimization ===== */
@media (max-width: 768px) {
    .nav-pills {
        flex-direction: column;
        gap: 8px;
    }

    .nav-pills .nav-link {
        text-align: center;
    }

    .avatar-lg {
        width: 100px;
        height: 100px;
    }
}




</style>

<br>
<!-- start page title -->
<!--<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active"><a href="{{route('home')}}">Dashborad</a></li>
                    <li class="breadcrumb-item active">Manage Account</li>
                </ol>
            </div>
            <h4 class="page-title">My Account</h4>
        </div>
    </div>
</div>-->



<!-- end page title --> 
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
       {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    <div class="col-sm-12">
        <div class="card user_account_card">
            <div class="card-body">
                <h2 class="user_account_card_heading">User Account Management</h2>
                <p>Manage Your Personal Account</p>
               <progress value="70" max="100" style="background-color:#39ac73;border-radius:10px;"></progress>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-4 col-lg-5">
        <div class="card text-center">
            @if(Auth::check())
            <div class="card-body">
            <img id="profile-image" src="{{ asset('images/profile/' . Auth::user()->profile_image) }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">


                <div class="text-start mt-3">
                   




                <table class="table table-sm table-centered mb-0 .table-hover table-bordered">
                   
                    <tbody>
                        <tr><th>Name</th><td id="user-name"></td></tr>

                        @if(Auth::user()->role=="Trainee")
                        <tr><th>Course</th><td id="user-course"></td></tr>
                        <tr><th>Class</th><td id="user-class"></td></tr>
                        @endif

                        <tr><th>Gender</th><td id="user-gender"></td></tr>
                        <tr><th>Phonenumber</th><td id="user-phone"></td></tr>
                        <tr><th>Role</th><td id="user-role"></td></tr>
                    </tbody>

                </table>









                </div>

                
            </div> <!-- end card-body -->
            @endif
        </div> <!-- end card -->

        

    </div> <!-- end col-->

    <div class="col-xl-8 col-lg-7">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills bg-nav-pills nav-justified mb-3 bodyColor" style="border-radius:50px">
                    <li class="nav-item">
                        <a href="#aboutme" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
                            Cahnge Personal Information
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#timeline" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 ">
                            Change Password
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                            Change Profile Image
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                <div class="tab-pane show active" id="aboutme">

                    <!--Update progess bar-->
                       <div id="progressBarContainer" class="my-2" style="display: none;">
                            <div class="progress">
                                <div id="progressBar"
                                    class="progress-bar progress-bar-striped bg-info"
                                    role="progressbar"
                                    style="width: 0%; transition: width 0.4s;"></div>
                            </div>
                        </div>

                        <div id="profileUpdateMsg"></div>

                      
                        <form method="POST"  id="updateProfileForm">
                            @csrf
                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Personal Info</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label for="firstname" class="form-label">Firstname <span style="color:red">*</span></label>
                                        <input type="text" class="form-control" name="firstname">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label for="lastname" class="form-label">Secondname</label>
                                        <input type="text" class="form-control" name="secondname">
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label for="lastname" class="form-label">Lastname <span style="color:red">*</span></label>
                                        <input type="text" class="form-control" name="lastname">
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label for="lastname" class="form-label">Phonenumber <span style="color:red">*</span></label>
                                        <input type="text" class="form-control" name="phonenumber">
                                    </div>
                                </div> <!-- end col -->


                                <div class="col-md-12">
                                    <div class="mb-2">
                                        <label for="lastname" class="form-label">Gender <span style="color:red">*</span></label>
                                         <select class="form-control" name="gender">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                         </select>
                                    </div>
                                </div> <!-- end col -->


                                <div class="col-md-12">
                                    <div class="mb-2">
                                    <button type="submit" id="submitButton" class="btn btn-success" style="width:100%"><i class="mdi mdi-content-save"></i> Save</button>
                                    </div>
                                </div> <!-- end col -->

                            </div> <!-- end row -->

                        </form>
                    </div>

                   

                   <!--end of update progress bar-->

                    <div class="tab-pane" id="timeline">

                    <!-- Progress Bar -->
                        <div id="passwordProgressBarContainer" style="display: none;">
                            <div class="progress my-2">
                                <div id="passwordProgressBar"
                                    class="progress-bar progress-bar-striped bg-info"
                                    role="progressbar"
                                    style="width: 0%; transition: width 0.4s;">
                                </div>
                            </div>
                        </div>
                    <!--end of progress bar-->

                    <!-- Message Area -->
                       <div id="passwordUpdateMsg"></div>


                        <form id="passwordUpdateForm" method="POST">
                            @csrf
                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Change Password</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label">Old Password</label>
                                        <input type="password" class="form-control" name="old_password" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="new_password" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-2">
                                        <label class="form-label">Confirm New Password</label>
                                        <input type="password" class="form-control"  name="new_password_confirmation" required>
                                    </div>
                                </div>

                                <div class="col-md-12" style="padding-top:30px">
                                    <div class="mb-3">
                                        <button id="updatePasswordButton" type="submit" class="btn btn-success" style="width:100%">
                                            <i class="mdi mdi-content-save"></i> Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>





                       
                       

                    </div>
                    <!-- end timeline content-->

                    <div class="tab-pane" id="settings">
                       
                       <!-- Progress bar -->
                            <div class="progress mb-3" style="height: 20px; display: none;">
                                <div id="uploadProgressBar" class="progress-bar" role="progressbar" style="width: 0%">
                                    0%
                                </div>
                            </div>

                            <!-- Response Message -->
                            <div id="uploadMessage" class="mt-3"></div>



                        <!-- Profile Picture Upload -->
                        <form id="profileImageForm" enctype="multipart/form-data">
                            @csrf

                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Change Profile Image</h5>

                            <input id="profileImageInput" name="profile_image" type="file" class="form-control" accept=".png, .jpeg, .jpg">

                            <br>

                           

                            <button type="submit" class="btn btn-success w-100">
                                <i class="mdi mdi-content-save"></i> Save
                            </button>
                        </form>

                       





                    </div>
                   

                </div> 
            </div> 
        </div> 
    </div> 
</div>
<!-- end row-->
@endsection
@section('scripts')
<script>
$(document).ready(function () {



    function fetchUserProfile() {
        $.ajax({
            url: "{{ route('fetchUserProfile') }}",
            type: "GET",
            success: function(response) {
                let user = response.user;

                // Update Table
                $('#user-name').text(user.firstname + ' ' + user.secondname + ' ' + user.lastname);
                $('#user-course').text(user.course?.course_name ?? 'NA');
                $('#user-class').text(user.clas?.clas_name ?? 'NA');
                $('#user-gender').text(user.gender ?? 'NA');
                $('#user-phone').text(user.phonenumber ?? 'NA');
                $('#user-role').text(user.role ?? 'NA');

                // Update Form Inputs
                $('input[name="firstname"]').val(user.firstname);
                $('input[name="secondname"]').val(user.secondname);
                $('input[name="lastname"]').val(user.lastname);
                $('input[name="phonenumber"]').val(user.phonenumber);
                $('select[name="gender"]').val(user.gender);

                //UPDATE PROFILE IMAGE
                $('#profile-image').attr('src', '/images/profile/' + (user.profile_image ?? 'default.png'));

            },
            error: function(err) {
                console.error("Error fetching user profile", err);
            }
        });
    }

    $(document).ready(function() {
        fetchUserProfile(); // Call on page load
    });




   
    let progressInterval;

    $('#updateProfileForm').submit(function (e) {
        e.preventDefault();

        const formData = $(this).serialize();

        // Reset progress bar
        $('#progressBar').css('width', '0%');
        $('#progressBarContainer').show();
        $('#profileUpdateMsg').html('');

        // Simulate progress
        let progress = 0;
        progressInterval = setInterval(function () {
            if (progress < 90) {
                progress += 5;
                $('#progressBar').css('width', progress + '%');
            }
        }, 200); // Adjust speed here

        $.ajax({
            type: 'POST',
            url: "{{ route('userUpdateProfile') }}",
            data: formData,
            dataType: 'json',

            success: function (response) {
               
                clearInterval(progressInterval);
                $('#progressBar').css('width', '100%');

                setTimeout(() => {
                    $('#progressBarContainer').fadeOut();
                    $('#profileUpdateMsg').html(
                        `<div class="alert alert-success"> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> ${response.message}</div>`
                    );
                    fetchUserProfile();
                }, 500);
                
            },

            error: function (xhr) {
                clearInterval(progressInterval);
                $('#progressBar').addClass('bg-danger').removeClass('bg-info');
                $('#progressBar').css('width', '100%');

                let errors = xhr.responseJSON?.errors;
                let errorMessage = 'An error occurred. Please try again.';

                if (errors) {
                    errorMessage = '<ul>';
                    $.each(errors, function (key, value) {
                        errorMessage += `<li>${value[0]}</li>`;
                    });
                    errorMessage += '</ul>';
                }

                $('#profileUpdateMsg').html(
                    `<div class="alert alert-danger" alert-dismissible fade show" role="alert">
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    ${errorMessage}
                    </div>`
                );

                // Optional: Fade out after a while and reset bar color
                setTimeout(() => {
                    $('#progressBarContainer').fadeOut();
                    $('#progressBar').removeClass('bg-danger').addClass('bg-info');
                    $('#progressBar').css('width', '0%');
                }, 2000);
            }
        });
    });




    $('#submitButton').prop('disabled', true); // before AJAX

    // In both success and error:
    $('#submitButton').prop('disabled', false);

    setTimeout(() => {
        $('#progressBarContainer').hide();
    }, 500);






    $('#profileImageForm').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        let progressBar = $('#uploadProgressBar');
        let progressContainer = $('.progress');
        let message = $('#uploadMessage');

        message.html('');
        progressContainer.show();
        progressBar.css('width', '0%').text('0%');

        $.ajax({
            xhr: function () {
                let xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        let percent = Math.round((e.loaded / e.total) * 100);
                        progressBar.css('width', percent + '%').text(percent + '%');
                    }
                });
                return xhr;
            },
            type: 'POST',
            url: "{{ route('adminUpdateUserPicture') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                progressBar.css('width', '100%').text('100%');
                message.html('<div class="alert alert-success"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' + res.message + '</div>');
                setTimeout(() => progressContainer.fadeOut(), 2000);
                fetchUserProfile();
                $('#profileImageInput').val(''); 
            },
            error: function(err) {
                progressContainer.fadeOut();
                if (err.status === 422) {
                    let errors = err.responseJSON.errors;
                    let errorMessages = Object.values(errors).map(msg => `<div class="text-danger">${msg[0]}</div>`).join('');
                    message.html(errorMessages);
                } else {
                    message.html('<div class="alert alert-danger"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> An unexpected error occurred.</div>');
                }
            }
        });
    });







});


$(document).ready(function () {
    let progressInterval;

    $('#passwordUpdateForm').submit(function (e) {
        e.preventDefault();

        const formData = $(this).serialize();

        // Reset progress bar
        $('#passwordProgressBar').css('width', '0%').removeClass('bg-danger').addClass('bg-info');
        $('#passwordProgressBarContainer').show();
        $('#passwordUpdateMsg').html('');
        $('#updatePasswordButton').prop('disabled', true);

        // Simulate progress
        let progress = 0;
        progressInterval = setInterval(() => {
            if (progress < 90) {
                progress += 5;
                $('#passwordProgressBar').css('width', progress + '%');
            }
        }, 200);

        $.ajax({
            type: 'POST',
            url: "{{ route('adminUpdateUserPassword') }}",
            data: formData,
            dataType: 'json',

            success: function (response) {
                clearInterval(progressInterval);
                $('#passwordProgressBar').css('width', '100%');

                setTimeout(() => {
                    $('#passwordProgressBarContainer').fadeOut();
                    $('#passwordUpdateMsg').html(
                        `<div class="alert alert-success">
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        ${response.message}
                        </div>`
                    );
                    $('#updatePasswordButton').prop('disabled', false);
                    $('#passwordUpdateForm')[0].reset();
                }, 500);
            },

            error: function (xhr) {
                clearInterval(progressInterval);
                $('#passwordProgressBar').addClass('bg-danger').removeClass('bg-info');
                $('#passwordProgressBar').css('width', '100%');
                $('#updatePasswordButton').prop('disabled', false);

                let errorMessage = 'An error occurred. Please try again.';
                if (xhr.responseJSON?.errors) {
                    errorMessage = '<ul>';
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        errorMessage += `<li>${value[0]}</li>`;
                    });
                    errorMessage += '</ul>';
                } else if (xhr.responseJSON?.message) {
                    errorMessage = xhr.responseJSON.message;
                }

                $('#passwordUpdateMsg').html(`<div class="alert alert-danger"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>${errorMessage}</div>`);

                setTimeout(() => {
                    $('#passwordProgressBarContainer').fadeOut();
                    $('#passwordProgressBar').removeClass('bg-danger').addClass('bg-info').css('width', '0%');
                }, 2000);
            }
        });
    });






    //UPDATING PROFILE IMAGE





   








    



});




</script>
@endsection
