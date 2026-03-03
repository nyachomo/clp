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

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Total Teachers: <span id="total-users">0</span>
                <a type="button" style="float:right;font-size:18px;" data-bs-toggle="modal" data-bs-target="#addTeacherModal">
                    <span class="badge bg-success" style="height:30px;padding-top:7px;margin-left:2px">
                        <i class="uil-user-plus"></i>Add
                    </span>
                </a>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-1" style="padding-top:4px">
                         <label class="form-label" style="float:right;">Show</label>
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
                         <label class="form-label" style="float:right;">Search</label>
                    </div>

                    <div class="col-sm-2">
                          <input type="text" id="search" name="search" class="form-control" placeholder="Search teachers...">
                    </div>
                </div>

                <br>

                <div class="table-responsive">
                    <table class="table table-sm table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Course</th>
                                <th>Class</th>
                                <th>Gender</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="table-body"></tbody>
                    </table>
                </div>

                <div id="pagination-controls" class="float-end"></div>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addTeacherModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Teacher</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="addTeacherError" class="alert alert-danger" style="display:none"></div>

                <div class="mb-2">
                    <label class="form-label">First name</label>
                    <input type="text" id="add_firstname" class="form-control">
                </div>
                <div class="mb-2">
                    <label class="form-label">Second name</label>
                    <input type="text" id="add_secondname" class="form-control">
                </div>
                <div class="mb-2">
                    <label class="form-label">Last name</label>
                    <input type="text" id="add_lastname" class="form-control">
                </div>
                <div class="mb-2">
                    <label class="form-label">Phone</label>
                    <input type="text" id="add_phonenumber" class="form-control">
                </div>
                <div class="mb-2">
                    <label class="form-label">Email</label>
                    <input type="email" id="add_email" class="form-control">
                </div>
                <div class="mb-2">
                    <label class="form-label">Gender</label>
                    <select id="add_gender" class="form-select">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label">Course</label>
                    <select id="add_course_id" class="form-select">
                        <option value="">Select</option>
                        @foreach($courses as $c)
                            <option value="{{ $c->id }}">{{ $c->course_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label">Class</label>
                    <select id="add_clas_id" class="form-select">
                        <option value="">Select</option>
                        @foreach($clases as $cl)
                            <option value="{{ $cl->id }}">{{ $cl->clas_name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="saveTeacherBtn">Save</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="updateTeacherModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Teacher</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="updateTeacherError" class="alert alert-danger" style="display:none"></div>

                <input type="hidden" id="update_user_id">

                <div class="mb-2">
                    <label class="form-label">First name</label>
                    <input type="text" id="update_firstname" class="form-control">
                </div>
                <div class="mb-2">
                    <label class="form-label">Second name</label>
                    <input type="text" id="update_secondname" class="form-control">
                </div>
                <div class="mb-2">
                    <label class="form-label">Last name</label>
                    <input type="text" id="update_lastname" class="form-control">
                </div>
                <div class="mb-2">
                    <label class="form-label">Phone</label>
                    <input type="text" id="update_phonenumber" class="form-control">
                </div>
                <div class="mb-2">
                    <label class="form-label">Email</label>
                    <input type="email" id="update_email" class="form-control">
                </div>
                <div class="mb-2">
                    <label class="form-label">Gender</label>
                    <select id="update_gender" class="form-select">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label">Course</label>
                    <select id="update_course_id" class="form-select">
                        <option value="">Select</option>
                        @foreach($courses as $c)
                            <option value="{{ $c->id }}">{{ $c->course_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label">Class</label>
                    <select id="update_clas_id" class="form-select">
                        <option value="">Select</option>
                        @foreach($clases as $cl)
                            <option value="{{ $cl->id }}">{{ $cl->clas_name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="updateTeacherBtn">Update</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function () {

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    fetchTeachers();

    function fetchTeachers(page = 1, search = '', perPage = 10) {
        $.get("{{ route('fetchTeachers') }}", { page, search, per_page: perPage }, function (response) {
            $('#total-users').text(response.total_users);
            $('#table-body').empty();

            $.each(response.users, function (i, u) {
                const fullName = `${u.firstname ?? ''} ${u.secondname ?? ''} ${u.lastname ?? ''}`.trim();
                const courseName = u.course ? (u.course.course_name ?? 'NA') : 'NA';
                const className = u.clas ? (u.clas.clas_name ?? 'NA') : 'NA';

                const editBtn = `<button type="button" class="badge bg-info border-0 editTeacherBtn"
                                    data-id="${u.id}"
                                    data-firstname="${u.firstname ?? ''}"
                                    data-secondname="${u.secondname ?? ''}"
                                    data-lastname="${u.lastname ?? ''}"
                                    data-phonenumber="${u.phonenumber ?? ''}"
                                    data-email="${u.email ?? ''}"
                                    data-gender="${u.gender ?? ''}"
                                    data-course_id="${u.course_id ?? ''}"
                                    data-clas_id="${u.clas_id ?? ''}">
                                    Update
                                </button>`;

                const deleteBtn = `<button type="button" class="badge bg-danger border-0 deleteTeacherBtn" data-id="${u.id}">
                                    Delete
                                </button>`;

                $('#table-body').append(`
                    <tr>
                        <td>${i + 1}</td>
                        <td>${fullName}</td>
                        <td>${u.email ?? ''}</td>
                        <td>${u.phonenumber ?? ''}</td>
                        <td>${courseName}</td>
                        <td>${className}</td>
                        <td>${u.gender ?? ''}</td>
                        <td>${u.status ?? ''}</td>
                        <td>${editBtn} ${deleteBtn}</td>
                    </tr>
                `);
            });

            renderPagination(response.pagination, search, perPage);
        });
    }

    function renderPagination(pagination, search, perPage) {
        const container = $('#pagination-controls');
        container.empty();

        if (!pagination || pagination.last_page <= 1) return;

        for (let p = 1; p <= pagination.last_page; p++) {
            const btn = $(`<button class="btn btn-sm ${p === pagination.current_page ? 'btn-primary' : 'btn-light'} me-1">${p}</button>`);
            btn.on('click', function () {
                fetchTeachers(p, search, perPage);
            });
            container.append(btn);
        }
    }

    $('#search').on('input', function () {
        fetchTeachers(1, $(this).val(), $('#select').val());
    });

    $('#select').on('change', function () {
        fetchTeachers(1, $('#search').val(), $(this).val());
    });

    $('#saveTeacherBtn').on('click', function () {
        $('#addTeacherError').hide().text('');

        $.ajax({
            url: "{{ route('addTeacher') }}",
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            data: {
                firstname: $('#add_firstname').val(),
                secondname: $('#add_secondname').val(),
                lastname: $('#add_lastname').val(),
                phonenumber: $('#add_phonenumber').val(),
                email: $('#add_email').val(),
                gender: $('#add_gender').val(),
                course_id: $('#add_course_id').val(),
                clas_id: $('#add_clas_id').val(),
            },
            success: function (res) {
                if (res && res.success) {
                    $('#addTeacherModal').modal('hide');
                    fetchTeachers(1, $('#search').val(), $('#select').val());
                    $('#add_firstname,#add_secondname,#add_lastname,#add_phonenumber,#add_email').val('');
                    $('#add_gender,#add_course_id,#add_clas_id').val('');
                } else {
                    $('#addTeacherError').show().text(res.message ?? 'Failed');
                }
            },
            error: function (xhr) {
                let msg = 'Failed';
                if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const firstKey = Object.keys(xhr.responseJSON.errors)[0];
                    if (firstKey && xhr.responseJSON.errors[firstKey] && xhr.responseJSON.errors[firstKey][0]) {
                        msg = xhr.responseJSON.errors[firstKey][0];
                    }
                }
                $('#addTeacherError').show().text(msg);
            }
        });
    });

    $(document).on('click', '.editTeacherBtn', function () {
        $('#updateTeacherError').hide().text('');
        $('#update_user_id').val($(this).data('id'));
        $('#update_firstname').val($(this).data('firstname'));
        $('#update_secondname').val($(this).data('secondname'));
        $('#update_lastname').val($(this).data('lastname'));
        $('#update_phonenumber').val($(this).data('phonenumber'));
        $('#update_email').val($(this).data('email'));
        $('#update_gender').val($(this).data('gender'));
        $('#update_course_id').val($(this).data('course_id'));
        $('#update_clas_id').val($(this).data('clas_id'));
        $('#updateTeacherModal').modal('show');
    });

    $('#updateTeacherBtn').on('click', function () {
        $('#updateTeacherError').hide().text('');

        $.ajax({
            url: "{{ route('updateTeacher') }}",
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            data: {
                user_id: $('#update_user_id').val(),
                firstname: $('#update_firstname').val(),
                secondname: $('#update_secondname').val(),
                lastname: $('#update_lastname').val(),
                phonenumber: $('#update_phonenumber').val(),
                email: $('#update_email').val(),
                gender: $('#update_gender').val(),
                course_id: $('#update_course_id').val(),
                clas_id: $('#update_clas_id').val(),
            },
            success: function (res) {
                if (res && res.success) {
                    $('#updateTeacherModal').modal('hide');
                    fetchTeachers(1, $('#search').val(), $('#select').val());
                } else {
                    $('#updateTeacherError').show().text(res.message ?? 'Failed');
                }
            },
            error: function (xhr) {
                let msg = 'Failed';
                if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const firstKey = Object.keys(xhr.responseJSON.errors)[0];
                    if (firstKey && xhr.responseJSON.errors[firstKey] && xhr.responseJSON.errors[firstKey][0]) {
                        msg = xhr.responseJSON.errors[firstKey][0];
                    }
                }
                $('#updateTeacherError').show().text(msg);
            }
        });
    });

    $(document).on('click', '.deleteTeacherBtn', function () {
        const id = $(this).data('id');
        if (!confirm('Delete this teacher?')) return;

        $.ajax({
            url: "{{ route('deleteTeacher') }}",
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            data: { user_id: id },
            success: function (res) {
                fetchTeachers(1, $('#search').val(), $('#select').val());
            },
            error: function () {
                fetchTeachers(1, $('#search').val(), $('#select').val());
            }
        });
    });

});
</script>
@endsection
