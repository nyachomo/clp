@extends('layouts.master')
@section('content')

<style>
    .trainee-profile-page {
        background: #f4f7fb;
    }

    .trainee-profile-page .card {
        border-radius: 20px;
        border: none;
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.12);
        margin-bottom: 25px;
    }

    .trainee-profile-page .trainee_profile_header_card {
        background: linear-gradient(135deg, #00264d, #ff0080);
        color: #fff;
    }

    .trainee-profile-page .trainee_profile_header_card p {
        opacity: 0.9;
    }

    .trainee-profile-page .trainee_profile_header_heading {
        font-weight: 800;
        background: linear-gradient(to right, #ffffff, #ffd6ea);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .trainee-profile-page progress {
        width: 100%;
        height: 14px;
        border-radius: 20px;
        overflow: hidden;
    }

    .trainee-profile-page progress::-webkit-progress-bar {
        background-color: rgba(255, 255, 255, 0.3);
    }

    .trainee-profile-page progress::-webkit-progress-value {
        background: linear-gradient(135deg, #00e6ac, #39ac73);
    }

    .trainee-profile-page progress::-moz-progress-bar {
        background: linear-gradient(135deg, #00e6ac, #39ac73);
    }

    .trainee-profile-page .avatar-lg {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border: 4px solid #ff0080;
    }

    .trainee-profile-page .table-bordered {
        border-radius: 14px;
        overflow: hidden;
    }

    .trainee-profile-page .table th {
        background: #00264d;
        color: #fff;
        font-weight: 600;
        width: 40%;
    }

    .trainee-profile-page .table td {
        font-weight: 600;
    }

    .trainee-profile-page .nav-pills {
        background: #f1f3f9;
        padding: 8px;
        border-radius: 50px;
    }

    .trainee-profile-page .nav-pills .nav-link {
        font-weight: 600;
        border-radius: 40px;
        color: #00264d;
        transition: all 0.3s ease;
    }

    .trainee-profile-page .nav-pills .nav-link.active {
        background: linear-gradient(135deg, #00264d, #ff0080);
        color: #fff;
    }

    .trainee-profile-page .btn {
        border-radius: 30px;
        font-weight: 600;
    }

    .trainee-profile-page .btn-success {
        background: linear-gradient(135deg, #00b894, #00cec9);
        border: none;
    }

    .trainee-profile-page .btn-success:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }

    .trainee-profile-page .alert {
        border-radius: 14px;
        border: none;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 768px) {
        .trainee-profile-page .nav-pills {
            flex-direction: column;
            gap: 8px;
        }

        .trainee-profile-page .nav-pills .nav-link {
            text-align: center;
        }

        .trainee-profile-page .avatar-lg {
            width: 100px;
            height: 100px;
        }
    }
</style>

<br>
<div class="trainee-profile-page">

    <div id="message-container" class="mt-3"></div>

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
            <div class="card trainee_profile_header_card">
                <div class="card-body">
                    <h2 class="trainee_profile_header_heading">Trainee Profile</h2>
                    <p>Manage Trainee Details</p>
                    <progress value="70" max="100" style="background-color:#39ac73;border-radius:10px;"></progress>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <div class="card text-center">
                <div class="card-body">
                    <!-- Profile -->
                    <img src="{{ asset('images/profile/' . ($student->profile_image ?? 'profile.png')) }}" alt="" class="rounded-circle avatar-lg img-thumbnail">
                    <div class="text-start mt-3">
                        <table class="table table-sm table-centered mb-0 .table-hover table-bordered">
                            <tbody>
                                <tr>
                                    <th><b style="color:#00264d;">Name</b></th>
                                    <td>{{ $student->firstname }} {{ $student->secondname }} {{ $student->lastname }}</td>
                                </tr>
                                <tr>
                                    <th><b style="color:#00264d;">Course</b></th>
                                    <td>{{ $student->course->course_name ?? 'NA' }}</td>
                                </tr>
                                <tr>
                                    <th><b style="color:#00264d;">Class</b></th>
                                    <td>{{ $student->clas->clas_name ?? 'NA' }}</td>
                                </tr>
                                <tr>
                                    <th><b style="color:#00264d;">Gender</b></th>
                                    <td>{{ $student->gender }}</td>
                                </tr>
                                <tr>
                                    <th><b style="color:#00264d;">Phonenumber</b></th>
                                    <td>{{ $student->phonenumber }}</td>
                                </tr>
                                <tr>
                                    <th><b style="color:#00264d;">Status</b></th>
                                    <td>{{ $student->status }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills nav-justified mb-3" style="background-color:#000033">
                        <li class="nav-item">
                            <a href="#personal" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
                                Personal Info
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#payments" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                Fee Payments
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#assessments" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                Assessments
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#practicals" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                Practicals
                            </a>
                        </li>

                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="personal">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped">
                                    <tbody>
                                        <tr>
                                            <th>Full Name</th>
                                            <td>{{ $student->firstname }} {{ $student->secondname }} {{ $student->lastname }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $student->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <td>{{ $student->phonenumber }}</td>
                                        </tr>
                                        <tr>
                                            <th>Parent Phone</th>
                                            <td>{{ $student->parent_phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>Gender</th>
                                            <td>{{ $student->gender }}</td>
                                        </tr>
                                        <tr>
                                            <th>Course</th>
                                            <td>{{ $student->course->course_name ?? 'NA' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Class</th>
                                            <td>{{ $student->clas->clas_name ?? 'NA' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>{{ $student->status }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane" id="payments">
                            <div class="mb-2">
                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addPaymentModal">Add Payment</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-sm table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Amount Paid</th>
                                            <th>Date Paid</th>
                                            <th>Method</th>
                                            <th>Reference</th>
                                            <th>Receipt</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($fees as $k => $fee)
                                            <tr>
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{ $fee->amount_paid }}</td>
                                                <td>{{ $fee->date_paid }}</td>
                                                <td>{{ $fee->payment_method }}</td>
                                                <td>{{ $fee->payment_ref_no }}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-secondary" href="{{ route('admindownloadReceipt', $fee->id) }}">Download</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="addPaymentModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="addPaymentModalLabel">Add Fee Payment</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                    </div>
                                    <form method="POST" action="{{ route('addFees') }}">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" name="user_id" value="{{ $student->id }}">

                                            <div class="mb-3">
                                                <label class="form-label">Amount Paid</label>
                                                <input type="number" name="amount_paid" class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Date Paid</label>
                                                <input type="date" name="date_paid" class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Payment Method</label>
                                                <input type="text" name="payment_method" class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Payment Reference No</label>
                                                <input type="text" name="payment_ref_no" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="assessments">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Exam</th>
                                            <th>Type</th>
                                            <th>Questions Answered</th>
                                            <th>Total Score</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($examSummaries as $k => $summary)
                                            <tr>
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{ $summary['exam']->exam_name ?? 'NA' }}</td>
                                                <td>{{ $summary['exam']->exam_type ?? 'NA' }}</td>
                                                <td>{{ $summary['questions'] }}</td>
                                                <td>{{ $summary['total_score'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane" id="practicals">
                            <div class="mb-2">
                                <a class="btn btn-sm btn-secondary" href="{{ route('downloadTraineePracticalScoresPdf', $student->id) }}">Download Practical Scores</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-sm table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Practical</th>
                                            <th>Module</th>
                                            <th>Student Answer</th>
                                            <th>Score</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($practicalAnswers as $k => $ans)
                                            <tr>
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{ $ans->practical->name ?? 'NA' }}</td>
                                                <td>{{ $ans->practical->coursemodule->module_name ?? 'NA' }}</td>
                                                <td>
                                                    @if(!empty($ans->student_answer))
                                                        <a href="{{ asset('practicals/' . $ans->student_answer) }}" download>
                                                            {{ $ans->student_answer }}
                                                        </a>
                                                    @else
                                                        <span class="text-muted">NA</span>
                                                    @endif

                                                    @if(Auth::check() && Auth::user()->role != 'Trainee')
                                                        <span role="button"
                                                            class="badge bg-danger ms-1 updateTraineeAnswerBtn"
                                                            data-id="{{ $ans->id }}"
                                                            data-bs-toggle="modal" data-bs-target="#updateTraineeAnswerModal">Update</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $ans->student_score }}
                                                    @if(Auth::check() && Auth::user()->role != 'Trainee')
                                                        <span role="button"
                                                            class="badge bg-secondary ms-1 updateTraineeMarksBtn"
                                                            data-id="{{ $ans->id }}"
                                                            data-score="{{ $ans->student_score }}"
                                                            data-comment="{{ $ans->comment }}"
                                                            data-bs-toggle="modal" data-bs-target="#updateTraineeMarksModal">Update</span>
                                                    @endif
                                                </td>
                                                <td>{{ !empty($ans->comment) ? $ans->comment : 'NA' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div> <!-- end tab-content -->
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
    <!-- end row -->

</div>

@if(Auth::check() && Auth::user()->role != 'Trainee')
    <div id="updateTraineeAnswerModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateTraineeAnswerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="updateTraineeAnswerModalLabel">Update Student Answer</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form method="POST" id="updateTraineeAnswerForm" action="{{ route('adminUpdateStudentPracticalAnswer') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="answer_id" id="update_trainee_answer_id">
                        <div class="mb-3">
                            <label class="form-label">Upload New Answer File</label>
                            <input type="file" class="form-control" name="student_answer" required>
                        </div>

                        <div class="progress mt-2" style="height: 18px; display:none;" id="updateTraineeAnswerProgressWrap">
                            <div class="progress-bar" id="updateTraineeAnswerProgress" role="progressbar" style="width:0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="updateTraineeMarksModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateTraineeMarksModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="updateTraineeMarksModalLabel">Update Marks</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form method="POST" id="updateTraineeMarksForm" action="{{ route('adminUpdateStudentPracticalScore') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="update_answer_id" id="update_trainee_marks_answer_id">

                        <div class="mb-3">
                            <label class="form-label">Student Score</label>
                            <input type="number" class="form-control" name="student_score" id="update_trainee_marks_score" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Comment</label>
                            <input type="text" class="form-control" name="comment" id="update_trainee_marks_comment" required>
                        </div>

                        <div class="progress mt-2" style="height: 18px; display:none;" id="updateTraineeMarksProgressWrap">
                            <div class="progress-bar" id="updateTraineeMarksProgress" role="progressbar" style="width:0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.updateTraineeAnswerBtn');
            const input = document.getElementById('update_trainee_answer_id');

            const messageContainer = document.getElementById('message-container');

            function displayMessage(type, message) {
                if (!messageContainer) return;

                const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
                messageContainer.innerHTML = `
                    <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;

                setTimeout(() => {
                    const alertEl = messageContainer.querySelector('.alert');
                    if (alertEl) {
                        alertEl.classList.remove('show');
                        alertEl.classList.add('hide');
                        setTimeout(() => {
                            if (messageContainer) messageContainer.innerHTML = '';
                        }, 500);
                    }
                }, 6000);
            }

            function extractErrorMessage(payload) {
                if (!payload) return 'Request failed';
                if (payload.message) return payload.message;
                if (payload.errors) {
                    const firstKey = Object.keys(payload.errors)[0];
                    if (firstKey && payload.errors[firstKey] && payload.errors[firstKey][0]) {
                        return payload.errors[firstKey][0];
                    }
                }
                return 'Request failed';
            }

            const marksButtons = document.querySelectorAll('.updateTraineeMarksBtn');
            const marksIdInput = document.getElementById('update_trainee_marks_answer_id');
            const marksScoreInput = document.getElementById('update_trainee_marks_score');
            const marksCommentInput = document.getElementById('update_trainee_marks_comment');
            const marksForm = document.getElementById('updateTraineeMarksForm');
            const answerForm = document.getElementById('updateTraineeAnswerForm');

            buttons.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    if (input) {
                        input.value = this.getAttribute('data-id') || '';
                    }
                });
            });

            marksButtons.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    if (marksIdInput) marksIdInput.value = this.getAttribute('data-id') || '';
                    if (marksScoreInput) marksScoreInput.value = this.getAttribute('data-score') || '';
                    if (marksCommentInput) marksCommentInput.value = this.getAttribute('data-comment') || '';
                });
            });

            if (answerForm) {
                answerForm.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const actionUrl = answerForm.getAttribute('action');
                    const progressWrap = document.getElementById('updateTraineeAnswerProgressWrap');
                    const progressBar = document.getElementById('updateTraineeAnswerProgress');

                    if (progressBar) {
                        progressBar.style.width = '0%';
                        progressBar.setAttribute('aria-valuenow', '0');
                        progressBar.textContent = '0%';
                    }
                    if (progressWrap) progressWrap.style.display = 'block';

                    const xhr = new XMLHttpRequest();
                    const formData = new FormData(answerForm);

                    xhr.open('POST', actionUrl, true);
                    xhr.setRequestHeader('Accept', 'application/json');
                    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

                    xhr.upload.onprogress = function (event) {
                        if (!progressBar) return;
                        if (event.lengthComputable) {
                            const percent = Math.round((event.loaded / event.total) * 100);
                            progressBar.style.width = percent + '%';
                            progressBar.setAttribute('aria-valuenow', String(percent));
                            progressBar.textContent = percent + '%';
                        }
                    };

                    xhr.onreadystatechange = function () {
                        if (xhr.readyState !== 4) return;

                        let payload = null;
                        try {
                            payload = JSON.parse(xhr.responseText);
                        } catch (err) {
                            payload = null;
                        }

                        if (xhr.status >= 200 && xhr.status < 300 && payload && payload.success) {
                            if (progressBar) {
                                progressBar.style.width = '100%';
                                progressBar.setAttribute('aria-valuenow', '100');
                                progressBar.textContent = '100%';
                            }

                            const modalEl = document.getElementById('updateTraineeAnswerModal');
                            if (modalEl && window.bootstrap) {
                                const inst = window.bootstrap.Modal.getInstance(modalEl);
                                if (inst) inst.hide();
                            }

                            displayMessage('success', payload.message || 'Student answer updated successfully');
                            setTimeout(() => window.location.reload(), 600);
                        } else {
                            displayMessage('error', extractErrorMessage(payload));
                        }

                        setTimeout(function () {
                            if (progressWrap) progressWrap.style.display = 'none';
                        }, 700);
                    };

                    xhr.send(formData);
                });
            }

            if (marksForm) {
                marksForm.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const actionUrl = marksForm.getAttribute('action');
                    const progressWrap = document.getElementById('updateTraineeMarksProgressWrap');
                    const progressBar = document.getElementById('updateTraineeMarksProgress');

                    if (progressBar) {
                        progressBar.style.width = '0%';
                        progressBar.setAttribute('aria-valuenow', '0');
                        progressBar.textContent = '0%';
                    }
                    if (progressWrap) progressWrap.style.display = 'block';

                    const xhr = new XMLHttpRequest();
                    const formData = new FormData(marksForm);

                    xhr.open('POST', actionUrl, true);
                    xhr.setRequestHeader('Accept', 'application/json');
                    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

                    xhr.upload.onprogress = function (event) {
                        if (!progressBar) return;
                        if (event.lengthComputable) {
                            const percent = Math.round((event.loaded / event.total) * 100);
                            progressBar.style.width = percent + '%';
                            progressBar.setAttribute('aria-valuenow', String(percent));
                            progressBar.textContent = percent + '%';
                        } else {
                            progressBar.style.width = '60%';
                            progressBar.setAttribute('aria-valuenow', '60');
                            progressBar.textContent = '60%';
                        }
                    };

                    xhr.onreadystatechange = function () {
                        if (xhr.readyState !== 4) return;

                        let payload = null;
                        try {
                            payload = JSON.parse(xhr.responseText);
                        } catch (err) {
                            payload = null;
                        }

                        if (xhr.status >= 200 && xhr.status < 300 && payload && payload.success) {
                            if (progressBar) {
                                progressBar.style.width = '100%';
                                progressBar.setAttribute('aria-valuenow', '100');
                                progressBar.textContent = '100%';
                            }

                            const modalEl = document.getElementById('updateTraineeMarksModal');
                            if (modalEl && window.bootstrap) {
                                const inst = window.bootstrap.Modal.getInstance(modalEl);
                                if (inst) inst.hide();
                            }

                            displayMessage('success', payload.message || 'Marks updated successfully');
                            setTimeout(() => window.location.reload(), 600);
                        } else {
                            displayMessage('error', extractErrorMessage(payload));
                        }

                        setTimeout(function () {
                            if (progressWrap) progressWrap.style.display = 'none';
                        }, 700);
                    };

                    xhr.send(formData);
                });
            }
        });
    </script>
@endsection

