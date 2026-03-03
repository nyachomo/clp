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
                <b>Practical:</b> {{ $practical->name ?? 'NA' }}
                &nbsp;&nbsp;&nbsp;
                <b>Module:</b> {{ $practical->coursemodule->module_name ?? 'NA' }}
                &nbsp;&nbsp;&nbsp;
                <b>Class:</b> {{ $practical->clas->clas_name ?? 'NA' }}
                &nbsp;&nbsp;&nbsp;
                <b>Course:</b> {{ $practical->course->course_name ?? 'NA' }}

                <a href="{{ url()->previous() }}" type="button" style="float:right" class="btn btn-sm btn-info rounded-pill">Back</a>
            </div>

            <div class="card-body">

                <div class="row mb-2">
                    <div class="col-sm-2">
                        <select class="form-select" id="select">
                            <option value="10" selected>10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="col-sm-6"></div>
                    <div class="col-sm-4">
                        <input type="text" id="search" class="form-control" placeholder="Search students...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fullname</th>
                                <th>Student Answer</th>
                                <th>Score (Row Max)</th>
                                <th>Comment</th>
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


<div id="markModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Mark Submission</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>

            <div class="modal-body">
                <div id="markError" class="alert alert-danger" style="display:none"></div>

                <input type="hidden" id="mark_answer_id">

                <div class="mb-2">
                    <label class="form-label">Score <sup>*</sup> (Max: {{ $practical->marks ?? 'NA' }})</label>
                    <input type="number" class="form-control" id="mark_score">
                </div>

                <div class="mb-2">
                    <label class="form-label">Comment <sup>*</sup></label>
                    <textarea class="form-control" id="mark_comment" rows="3"></textarea>
                </div>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success rounded-pill" id="saveMarkBtn">Save</button>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function () {

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    const practicalDir = "{{ asset('practicals') }}";
    const fetchUrl = "{{ url('teachers/practicals/' . $practical->id . '/fetch-submissions') }}";

    fetchSubmissions();

    function fetchSubmissions(page = 1, search = '', perPage = 10) {
        $.get(fetchUrl, { page, search, per_page: perPage }, function (response) {
            $('#table-body').empty();

            $.each(response.users, function (i, item) {
                const fullName = `${item.user?.firstname ?? ''} ${item.user?.secondname ?? ''} ${item.user?.lastname ?? ''}`.trim();
                const answerLink = (item.student_answer && item.student_answer !== 'NA')
                    ? `<a href="${practicalDir}/${item.student_answer}" download>${item.student_answer}</a>`
                    : 'NA';

                const scoreText = (item.student_score !== null && item.student_score !== undefined && item.student_score !== '')
                    ? `${item.student_score} / {{ $practical->marks ?? 0 }}`
                    : `NA / {{ $practical->marks ?? 0 }}`;

                const commentText = item.comment ?? 'NA';

                const markBtn = `<button type="button" class="badge bg-success border-0 markBtn"
                                    data-id="${item.id}"
                                    data-score="${item.student_score ?? ''}"
                                    data-comment="${(item.comment ?? '').replace(/\"/g, '&quot;')}">
                                    Mark
                                </button>`;

                $('#table-body').append(`
                    <tr>
                        <td>${i + 1}</td>
                        <td>${fullName}</td>
                        <td>${answerLink}</td>
                        <td>${scoreText}</td>
                        <td>${commentText}</td>
                        <td>${markBtn}</td>
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
                fetchSubmissions(p, search, perPage);
            });
            container.append(btn);
        }
    }

    $('#search').on('input', function () {
        fetchSubmissions(1, $(this).val(), $('#select').val());
    });

    $('#select').on('change', function () {
        fetchSubmissions(1, $('#search').val(), $(this).val());
    });


    $(document).on('click', '.markBtn', function () {
        $('#markError').hide().text('');
        $('#mark_answer_id').val($(this).data('id'));
        $('#mark_score').val($(this).data('score'));
        $('#mark_comment').val($(this).data('comment'));
        $('#markModal').modal('show');
    });

    $('#saveMarkBtn').on('click', function () {
        $('#markError').hide().text('');

        $.ajax({
            url: "{{ route('teacherMarkPracticalSubmission') }}",
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            data: {
                answer_id: $('#mark_answer_id').val(),
                student_score: $('#mark_score').val(),
                comment: $('#mark_comment').val(),
            },
            success: function (res) {
                if (res && res.success) {
                    $('#markModal').modal('hide');
                    fetchSubmissions(1, $('#search').val(), $('#select').val());
                } else {
                    $('#markError').show().text(res.message ?? 'Failed');
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
                $('#markError').show().text(msg);
            }
        });
    });

});
</script>
@endsection
