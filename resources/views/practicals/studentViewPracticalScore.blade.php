@extends('layouts.master')

@section('content')

<style>


    /* ===== Page spacing ===== */
.content-wrapper, body {
    background: #f4f7fb;
}

/* ===== Main card ===== */
.card {
    border: none;
    border-radius: 18px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
    overflow: hidden;
}

/* ===== Card header ===== */
.card-header {
    background: linear-gradient(135deg, #00264d, #ff0080);
    color: #fff;
    padding: 22px;
    text-align: center;
}

.card-header h3 {
    margin-bottom: 6px;
    font-weight: 700;
}

.card-header span {
    font-weight: 600;
    font-size: 15px;
}

/* ===== Card body ===== */
.card-body {
    padding: 25px;
}





/* Controls row */
.form-select,
.form-control {
    border-radius: 30px;
    padding: 10px 16px;
    border: 1px solid #ddd;
    transition: all 0.3s ease;
}

.form-select:focus,
.form-control:focus {
    border-color: #ff0080;
    box-shadow: 0 0 0 0.15rem rgba(255, 0, 128, 0.25);
}






/* Table wrapper */
.table-responsive {
    border-radius: 14px;
    overflow: hidden;
}

/* Table */
.table {
    margin-bottom: 0;
    font-size: 14px;
}

/* Header */
.table thead {
    background: #00264d;
    color: #fff;
}

.table thead th {
    border: none;
    padding: 14px;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 12px;
}

/* Rows */
.table tbody tr {
    transition: background 0.3s ease, transform 0.2s ease;
}

.table tbody tr:hover {
    background: rgba(255, 0, 128, 0.05);
    transform: scale(1.01);
}

/* Cells */
.table td {
    padding: 14px;
    vertical-align: middle;
}

/* Links inside table */
.table a {
    color: #ff0080;
    font-weight: 600;
    text-decoration: none;
}

.table a:hover {
    text-decoration: underline;
}

#pagination-controls {
    margin-top: 20px;
}

.pagination .page-link {
    border-radius: 50%;
    margin: 0 3px;
    border: none;
    color: #00264d;
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #00264d, #ff0080);
    color: #fff;
}







.modal-content {
    border-radius: 18px;
    border: none;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
}

.modal-header {
    background: linear-gradient(135deg, #00264d, #ff0080);
    color: #fff;
    border-bottom: none;
}

.modal-footer .btn {
    border-radius: 30px;
    padding: 8px 18px;
}

</style>

<div id="response"></div>

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show">
    {{ session('error') }}
    <button class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<br>
<div class="row">
<div class="col-12">
<div class="card">

    
    <div class="card-body">

        <!-- Controls -->
        <div class="row mb-3">
            <div class="col-sm-2">
                <select class="form-select" id="select">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                </select>
            </div>

            <div class="col-sm-4 offset-sm-6">
                <input type="text" id="search" class="form-control" placeholder="Search...">
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Class</th>
                        <th>Assessment</th>
                        <th>Question</th>
                        <th>Score</th>
                        <th>Status</th>
                        <th>Your Answer</th>
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

<!-- Upload Modal -->
<div id="updateExamModal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <h4>Upload Practical Work</h4>
        <button class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <form method="POST" action="{{ route('studentUploadPracticalWork') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="practical_id" id="practical_id">
        <div class="modal-body">
            <input type="file" name="student_answer" class="form-control" required>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-success">Upload</button>
        </div>
    </form>
</div>
</div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function () {

    fetchUsers();

    function fetchUsers(page = 1, search = '', perPage = 10) {
        $.get("{{ route('studentFetchPracticalScore') }}", {
            page, search, per_page: perPage
        }, function (response) {

            $('#total-users').text(response.total_users);
            $('#table-body').empty();

            $.each(response.users, function (i, item) {
                $('#table-body').append(buildRow(i, item));
            });

            renderPagination(response.pagination, search, perPage);
        });
    }

    function buildRow(index, item) {

        const attemptUrl   = "{{ route('traineeViewQuestions') }}?exam_id=" + item.id;
        const practicalDir = "{{ asset('practicals') }}";

        let question = '-', score = '-', answer = '-', action = '-';
        let statusClass = item.student_status === 'Pending' ? 'text-warning' : 'text-success';

        const isTheory = !item.question || item.question === 'NA';

        /* ================= THEORY ================= */
        if (isTheory) {

            question = '-';
            score = item.student_multiple_choice_score ?? 0;

            if (item.has_done_theory) {
                action = `<a href="${attemptUrl}" class="badge bg-info" target="_blank">
                            View Answers
                          </a>`;
            } else {
                action = `<a href="${attemptUrl}" class="badge bg-success" target="_blank">
                            Attempt
                          </a>`;
            }
        }

        /* ================= PRACTICAL ================= */
        else {

            question = `<a href="${practicalDir}/${item.question}" download>
                            ${item.question}
                        </a>`;

            if (item.has_done_practical) {
                answer = `<a href="${practicalDir}/${item.student_answer}" download>
                            ${item.student_answer}
                          </a>`;
                score = `${item.student_score} / ${item.marks}`;
            } else {
                action = `<span class="badge bg-success uploadBtn"
                            data-id="${item.id}">
                            Upload Work
                          </span>`;
            }
        }

        return `
        <tr>
            <td>${index + 1}</td>
            <td>${item.clas.clas_name}</td>
            <td>${item.name}</td>
            <td>${question}</td>
            <td>${score}</td>
            <td class="${statusClass}">${item.student_status}</td>
            <td>${answer}</td>
            <td>${action}</td>
        </tr>`;
    }

    $(document).on('click', '.uploadBtn', function () {
        $('#practical_id').val($(this).data('id'));
        $('#updateExamModal').modal('show');
    });

    $('#search').on('input', function () {
        fetchUsers(1, $(this).val(), $('#select').val());
    });

    $('#select').on('change', function () {
        fetchUsers(1, $('#search').val(), $(this).val());
    });

});
</script>
@endsection
