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
                Practicals - {{ $teacher->clas->clas_name ?? 'NA' }} ({{ $teacher->course->course_name ?? 'NA' }})
                <a type="button" style="float:right" class="btn btn-sm btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#addPracticalModal">
                    Add New Practical
                </a>
                <span style="float:right; margin-right: 12px; padding-top: 5px;">Total Practicals: <span id="total-users">0</span></span>
            </div>
            <div class="card-body">

                <div class="row mb-2">
                    <div class="col-sm-2">
                        <select class="form-select" id="select">
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <div class="col-sm-6"></div>
                    <div class="col-sm-4">
                        <input type="text" id="search" class="form-control" placeholder="Search...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Module</th>
                                <th>Name</th>
                                <th>Is Multiple Choice</th>
                                <th>Question</th>
                                <th>Marks</th>
                                <th>Status</th>
                                <th>Attempts</th>
                                <th>Total Questions</th>
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


<div id="addPracticalModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Practical</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="POST" action="{{ route('teacherAddPractical') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-2">
                                <label>Module <sup>*</sup></label>
                                <select name="course_module_id" class="form-control" required>
                                    <option value="">Select ...</option>
                                    @foreach($course_modules as $m)
                                        <option value="{{ $m->id }}">{{ $m->module_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group mb-2">
                                <label>Practical Name <sup>*</sup></label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group mb-2">
                                <label>Marks <sup>*</sup></label>
                                <input type="number" class="form-control" name="marks" required>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group mb-2">
                                <label>Status <sup>*</sup></label>
                                <select name="status" class="form-control" required>
                                    <option value="Published">Published</option>
                                    <option value="Not Published">Not Published</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group mb-2">
                                <label>Is Multiple Choice</label>
                                <select name="is_multiple_choice" class="form-control">
                                    <option value="No" selected>No</option>
                                    <option value="Yes">Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group mb-2">
                                <label>Question File (optional)</label>
                                <input type="file" class="form-control" name="question">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success rounded-pill">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="updatePracticalModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Practical</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>

            <div class="modal-body">
                <div id="updatePracticalError" class="alert alert-danger" style="display:none"></div>

                <input type="hidden" id="update_practical_id">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group mb-2">
                            <label>Module <sup>*</sup></label>
                            <select id="update_course_module_id" class="form-control" required>
                                <option value="">Select ...</option>
                                @foreach($course_modules as $m)
                                    <option value="{{ $m->id }}">{{ $m->module_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group mb-2">
                            <label>Practical Name <sup>*</sup></label>
                            <input type="text" class="form-control" id="update_name" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group mb-2">
                            <label>Marks <sup>*</sup></label>
                            <input type="number" class="form-control" id="update_marks" required>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group mb-2">
                            <label>Status <sup>*</sup></label>
                            <select id="update_status" class="form-control" required>
                                <option value="Published">Published</option>
                                <option value="Not Published">Not Published</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group mb-2">
                            <label>Is Multiple Choice</label>
                            <select id="update_is_multiple_choice" class="form-control">
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success rounded-pill" id="updatePracticalBtn">Update</button>
            </div>

        </div>
    </div>
</div>


<div id="updatePracticalQuestionModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Practical Question File</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>

            <form method="POST" action="{{ route('teacherUpdatePracticalQuestion') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="practical_id" id="update_question_practical_id">

                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label>Select File <sup>*</sup></label>
                        <input type="file" class="form-control" name="question" required>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success rounded-pill">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function () {

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    const practicalDir = "{{ asset('practicals') }}";

    fetchPracticals();

    function fetchPracticals(page = 1, search = '', perPage = 10) {
        $.get("{{ route('teacherFetchPracticals') }}", { page, search, per_page: perPage }, function (response) {
            $('#total-users').text(response.total_users ?? 0);
            $('#table-body').empty();

            $.each(response.users, function (i, item) {

                const moduleName = item.coursemodule ? (item.coursemodule.module_name ?? 'NA') : 'NA';
                const questionLink = (item.question && item.question !== 'NA')
                    ? `<a href="${practicalDir}/${item.question}" download>${item.question}</a>`
                    : 'NA';

                const editBtn = `<button type="button" class="badge bg-info border-0 editPracticalBtn"
                                    data-id="${item.id}"
                                    data-name="${item.name ?? ''}"
                                    data-course_module_id="${item.course_module_id ?? ''}"
                                    data-marks="${item.marks ?? ''}"
                                    data-status="${item.status ?? ''}"
                                    data-is_multiple_choice="${item.is_multiple_choice ?? 'No'}">
                                    Update
                                </button>`;

                const submissionsBtn = `<a class="badge bg-success text-white" href="{{ url('teachers/practicals') }}/${item.id}/submissions">Submissions</a>`;

                const updateQuestionBtn = `<button type="button" class="badge bg-secondary border-0 updateQuestionBtn" data-id="${item.id}">
                                            Update File
                                        </button>`;

                const deleteBtn = `<button type="button" class="badge bg-danger border-0 deletePracticalBtn" data-id="${item.id}">
                                    Delete
                                </button>`;

                $('#table-body').append(`
                    <tr>
                        <td>${i + 1}</td>
                        <td>${moduleName}</td>
                        <td>${item.name ?? ''}</td>
                        <td>${item.is_multiple_choice ?? ''}</td>
                        <td>${questionLink}</td>
                        <td>${item.marks ?? ''}</td>
                        <td>${item.status ?? ''}</td>
                        <td>${item.attempted_students ?? 0}</td>
                        <td>${item.total_questions ?? 0}</td>
                        <td>${submissionsBtn} ${editBtn} ${updateQuestionBtn} ${deleteBtn}</td>
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
                fetchPracticals(p, search, perPage);
            });
            container.append(btn);
        }
    }

    $('#search').on('input', function () {
        fetchPracticals(1, $(this).val(), $('#select').val());
    });

    $('#select').on('change', function () {
        fetchPracticals(1, $('#search').val(), $(this).val());
    });


    $(document).on('click', '.editPracticalBtn', function () {
        $('#updatePracticalError').hide().text('');
        $('#update_practical_id').val($(this).data('id'));
        $('#update_name').val($(this).data('name'));
        $('#update_course_module_id').val($(this).data('course_module_id'));
        $('#update_marks').val($(this).data('marks'));
        $('#update_status').val($(this).data('status'));
        $('#update_is_multiple_choice').val($(this).data('is_multiple_choice'));
        $('#updatePracticalModal').modal('show');
    });

    $('#updatePracticalBtn').on('click', function () {
        $('#updatePracticalError').hide().text('');

        $.ajax({
            url: "{{ route('teacherUpdatePractical') }}",
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            data: {
                practical_id: $('#update_practical_id').val(),
                name: $('#update_name').val(),
                course_module_id: $('#update_course_module_id').val(),
                marks: $('#update_marks').val(),
                status: $('#update_status').val(),
                is_multiple_choice: $('#update_is_multiple_choice').val(),
            },
            success: function (res) {
                if (res && res.success) {
                    $('#updatePracticalModal').modal('hide');
                    fetchPracticals(1, $('#search').val(), $('#select').val());
                } else {
                    $('#updatePracticalError').show().text(res.message ?? 'Failed');
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
                $('#updatePracticalError').show().text(msg);
            }
        });
    });


    $(document).on('click', '.updateQuestionBtn', function () {
        $('#update_question_practical_id').val($(this).data('id'));
        $('#updatePracticalQuestionModal').modal('show');
    });


    $(document).on('click', '.deletePracticalBtn', function () {
        const id = $(this).data('id');
        if (!confirm('Delete this practical?')) return;

        $.ajax({
            url: "{{ route('teacherDeletePractical') }}",
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            data: { practical_id: id },
            success: function () {
                fetchPracticals(1, $('#search').val(), $('#select').val());
            },
            error: function () {
                fetchPracticals(1, $('#search').val(), $('#select').val());
            }
        });
    });

});
</script>
@endsection
