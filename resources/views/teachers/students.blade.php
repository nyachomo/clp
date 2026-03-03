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
                Students in {{ $teacher->clas->clas_name ?? 'NA' }} ({{ $teacher->course->course_name ?? 'NA' }})
                <span style="float:right;">Total Students: <span id="total-users">0</span></span>
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
                        <input type="text" id="search" class="form-control" placeholder="Search students...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
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

@endsection

@section('scripts')
<script>
$(document).ready(function () {

    fetchStudents();

    function fetchStudents(page = 1, search = '', perPage = 10) {
        $.get("{{ route('teacherFetchStudents') }}", { page, search, per_page: perPage }, function (response) {
            $('#total-users').text(response.total_users ?? 0);
            $('#table-body').empty();

            $.each(response.users, function (i, u) {
                const fullName = `${u.firstname ?? ''} ${u.secondname ?? ''} ${u.lastname ?? ''}`.trim();
                const viewUrl = "{{ url('teachers/students') }}/" + u.id + "/progress-report";

                $('#table-body').append(`
                    <tr>
                        <td>${i + 1}</td>
                        <td>${fullName}</td>
                        <td>${u.email ?? ''}</td>
                        <td>${u.phonenumber ?? ''}</td>
                        <td>${u.gender ?? ''}</td>
                        <td>${u.status ?? ''}</td>
                        <td>
                            <a class="btn btn-sm btn-secondary" href="${viewUrl}">Progress Report</a>
                        </td>
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
                fetchStudents(p, search, perPage);
            });
            container.append(btn);
        }
    }

    $('#search').on('input', function () {
        fetchStudents(1, $(this).val(), $('#select').val());
    });

    $('#select').on('change', function () {
        fetchStudents(1, $('#search').val(), $(this).val());
    });

});
</script>
@endsection
