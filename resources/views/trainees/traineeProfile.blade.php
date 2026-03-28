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

    .trainee-profile-page .practicals-table-wrap {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .trainee-profile-page .practicals-table {
        min-width: 820px;
    }

    .trainee-profile-page .trainee-switch-wrap {
        position: relative;
        max-width: 520px;
    }

    .trainee-profile-page .trainee-switch-dropdown {
        position: absolute;
        top: calc(100% + 6px);
        left: 0;
        right: 0;
        z-index: 20;
        max-height: 320px;
        overflow: auto;
        border-radius: 14px;
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.18);
        display: none;
    }

    .trainee-profile-page .trainee-switch-dropdown a {
        text-decoration: none;
    }

    .trainee-profile-page .practicals-table th,
    .trainee-profile-page .practicals-table td {
        vertical-align: middle;
    }

    .trainee-profile-page .practicals-table td {
        padding-top: 0.35rem;
        padding-bottom: 0.35rem;
        line-height: 1.15;
    }

    .trainee-profile-page .practicals-table .badge {
        padding: 0.28em 0.55em;
        font-size: 11px;
        line-height: 1.1;
        border-radius: 14px;
    }

    .trainee-profile-page .practicals-table .answer-link {
        display: inline-block;
        max-width: 260px;
        overflow: hidden;
        text-overflow: ellipsis;
        vertical-align: middle;
    }

    .trainee-profile-page .practicals-table .cell-nowrap {
        white-space: nowrap;
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
<div class="trainee-profile-page" id="traineeProfileAjaxRoot">

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
        <div class="col-sm-12 mb-3">
            <div class="row g-2 align-items-start">
                <div class="col-lg-7">
                    <div class="trainee-switch-wrap">
                        <div class="input-group">
                            <input type="text" class="form-control" id="traineeSwitchInput" placeholder="Search trainee (name / class)..." autocomplete="off">
                            <span class="input-group-text" id="traineeSwitchLoading" style="display:none;">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </span>
                        </div>
                        <div class="list-group trainee-switch-dropdown" id="traineeSwitchDropdown">
                            @foreach(($traineeSwitchList ?? collect()) as $ts)
                                <a
                                    href="{{ route('showTraineeProfile', $ts->id) }}"
                                    class="list-group-item list-group-item-action trainee-switch-link {{ (isset($student) && $student->id == $ts->id) ? 'active' : '' }}"
                                    data-search="{{ strtolower(trim(($ts->firstname ?? '') . ' ' . ($ts->secondname ?? '') . ' ' . ($ts->lastname ?? '') . ' ' . ($ts->clas->clas_name ?? ''))) }}"
                                >
                                    <div class="d-flex justify-content-between">
                                        <span>{{ $ts->firstname }} {{ $ts->secondname }} {{ $ts->lastname }}</span>
                                        <span class="ms-3">{{ $ts->clas->clas_name ?? 'NA' }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    @php
                        $quickNav = collect();
                        if (Auth::check() && Auth::user()->role == 'Admin') {
                            $quickNav = collect([
                                ['label' => 'Administrators', 'route' => 'showAdministrator'],
                                ['label' => 'Applicants', 'route' => 'showApplicants'],
                                ['label' => 'Assignments', 'route' => 'showExams'],
                                ['label' => 'Cats', 'route' => 'adminManageCats'],
                                ['label' => 'Class Room', 'route' => 'classRoom'],
                                ['label' => 'Classes', 'route' => 'showClases'],
                                ['label' => 'Contact Messages', 'route' => 'showContactMessages'],
                                ['label' => 'Courses', 'route' => 'showCourses'],
                                ['label' => 'Dashboard', 'route' => 'home'],
                                ['label' => 'Final Exam', 'route' => 'adminManageFinalExam'],
                                ['label' => 'Manage Account', 'route' => 'userAccount'],
                                ['label' => 'Manage Settings', 'route' => 'ShowSettings'],
                                ['label' => 'Practicals', 'route' => 'showPracticalPerClas'],
                                ['label' => 'Programs', 'route' => 'adminManagePrograms'],
                                ['label' => 'Scholarship Letters', 'route' => 'adminManageFormFourScholarshipLetter'],
                                ['label' => 'Scholarship Test Courses', 'route' => 'adminManageScholarshipTestCourse'],
                                ['label' => 'Schools', 'route' => 'showSchools'],
                                ['label' => 'Suspended Classes', 'route' => 'showSuspendedClases'],
                                ['label' => 'Suspended Courses', 'route' => 'showSuspendedCourses'],
                                ['label' => 'Teachers', 'route' => 'showTeachers'],
                                ['label' => 'Trainees', 'route' => 'showTrainees'],
                            ])->filter(function ($x) {
                                return isset($x['route']) && \Illuminate\Support\Facades\Route::has($x['route']);
                            })->map(function ($x) {
                                return ['label' => $x['label'], 'url' => route($x['route'])];
                            })->sortBy('label')->values();
                        } elseif (Auth::check() && Auth::user()->role == 'Trainee') {
                            $quickNav = collect([
                                ['label' => 'Assesment', 'route' => 'studentViewPracticalScore'],
                                ['label' => 'Course Notes', 'route' => 'traineeCourseNotes'],
                                ['label' => 'Dashboard', 'route' => 'home'],
                                ['label' => 'Fee Payment', 'route' => 'traineeViewFeePayment'],
                                ['label' => 'My Account', 'route' => 'userAccount'],
                                ['label' => 'Progress Report', 'route' => 'traineeProgressReport'],
                            ])->filter(function ($x) {
                                return isset($x['route']) && \Illuminate\Support\Facades\Route::has($x['route']);
                            })->map(function ($x) {
                                return ['label' => $x['label'], 'url' => route($x['route'])];
                            })->sortBy('label')->values();
                        } elseif (Auth::check() && Auth::user()->role == 'techsphere_teacher') {
                            $quickNav = collect([
                                ['label' => 'Dashboard', 'route' => 'teacherDashboard'],
                                ['label' => 'Modules & Notes', 'route' => 'teacherModules'],
                                ['label' => 'My Account', 'route' => 'userAccount'],
                                ['label' => 'Practicals', 'route' => 'teacherPracticals'],
                                ['label' => 'Students', 'route' => 'teacherStudents'],
                            ])->filter(function ($x) {
                                return isset($x['route']) && \Illuminate\Support\Facades\Route::has($x['route']);
                            })->map(function ($x) {
                                return ['label' => $x['label'], 'url' => route($x['route'])];
                            })->sortBy('label')->values();
                        }
                    @endphp

                    <div class="trainee-switch-wrap">
                        <input type="text" class="form-control" id="quickNavInput" placeholder="Search module..." autocomplete="off">
                        <div class="list-group trainee-switch-dropdown" id="quickNavDropdown">
                            @foreach($quickNav as $item)
                                <a
                                    href="{{ $item['url'] }}"
                                    class="list-group-item list-group-item-action quick-nav-link"
                                    data-search="{{ strtolower(trim($item['label'] ?? '')) }}"
                                >
                                    {{ $item['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-lg-4">
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

        <div class="col-xl-9 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills nav-justified mb-3" style="background-color:#000033">
                        <li class="nav-item">
                            <a href="#practicals" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
                                Practicals
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#payments" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                Fee Payments
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#personal" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                Personal Info
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#assessments" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                Assessments
                            </a>
                        </li>

                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="practicals">
                            <div class="mb-2">
                                <a class="btn btn-sm btn-secondary" href="{{ route('downloadTraineePracticalScoresPdf', $student->id) }}">Download Practical Scores</a>
                            </div>
                            <div class="table-responsive practicals-table-wrap">
                                <table class="table table-sm table-striped practicals-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Module</th>
                                            <th>Practical</th>
                                            <th>Student Answer</th>
                                            <th>Row Marks</th>
                                            <th>Score</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(($practicalItems ?? []) as $k => $row)
                                            <tr data-practical-id="{{ $row->practical->id }}">
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{ $row->practical->coursemodule->module_name ?? 'NA' }}</td>
                                                <td>{{ $row->practical->name ?? 'NA' }}</td>
                                                <td class="cell-nowrap">
                                                    <span class="js-practical-answer" data-practical-id="{{ $row->practical->id }}" data-answer-id="{{ $row->answer_id }}">
                                                        @if(!empty($row->student_answer))
                                                            <a class="answer-link" href="{{ asset('practicals/' . $row->student_answer) }}" download>
                                                                {{ $row->student_answer }}
                                                            </a>
                                                        @else
                                                            @if(!empty($row->answer_id))
                                                                <span class="text-muted">NA</span>
                                                            @else
                                                                <span class="text-muted">Not Submitted</span>
                                                            @endif
                                                        @endif
                                                    </span>

                                                    @if(Auth::check() && Auth::user()->role != 'Trainee')
                                                        <span class="js-practical-answer-actions" data-practical-id="{{ $row->practical->id }}">
                                                            @if(!empty($row->answer_id))
                                                                <span role="button"
                                                                    class="badge bg-danger ms-1 updateTraineeAnswerBtn"
                                                                    data-id="{{ $row->answer_id }}"
                                                                    data-bs-toggle="modal" data-bs-target="#updateTraineeAnswerModal">Update</span>
                                                            @else
                                                                <span role="button"
                                                                    class="badge bg-success ms-1 submitTraineeAnswerBtn"
                                                                    data-practical-id="{{ $row->practical->id }}"
                                                                    data-user-id="{{ $student->id }}"
                                                                    data-bs-toggle="modal" data-bs-target="#submitTraineeAnswerModal">Submit</span>
                                                            @endif
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>{{ $row->practical->marks ?? 'NA' }}</td>
                                                <td class="cell-nowrap">
                                                    <span class="js-practical-score" data-answer-id="{{ $row->answer_id }}">{{ $row->student_score }}</span>

                                                    @if(Auth::check() && Auth::user()->role != 'Trainee')
                                                        @if(!empty($row->answer_id))
                                                            @php
                                                                $marksNotSet = is_null($row->student_score) && (is_null($row->comment) || $row->comment === '');
                                                                $answerSubmitted = !empty($row->student_answer);
                                                            @endphp

                                                            @if($answerSubmitted && $marksNotSet)
                                                                <button type="button"
                                                                    class="badge bg-success ms-1 border-0 addTraineeMarksBtn"
                                                                    data-id="{{ $row->answer_id }}"
                                                                    data-bs-toggle="modal" data-bs-target="#updateTraineeMarksModal">Add New Mark</button>
                                                            @else
                                                                <button type="button"
                                                                    class="badge bg-primary ms-1 border-0 updateTraineeMarksBtn"
                                                                    data-id="{{ $row->answer_id }}"
                                                                    data-score="{{ $row->student_score }}"
                                                                    data-comment="{{ $row->comment }}"
                                                                    data-bs-toggle="modal" data-bs-target="#updateTraineeMarksModal">Marks</button>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="js-practical-comment" data-answer-id="{{ $row->answer_id }}">{{ $row->comment }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Not-attempted exams for this student's class --}}
                            @if(!empty($pendingSummaries) && $pendingSummaries->count())
                                <div class="mt-3">
                                    <h6 class="fw-bold text-danger mb-2">Exams Not Yet Attempted</h6>
                                    <div class="table-responsive practicals-table-wrap">
                                        <table class="table table-sm table-bordered practicals-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Exam Name</th>
                                                    <th>Type</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pendingSummaries as $k => $ps)
                                                    <tr class="table-warning">
                                                        <td>{{ $k + 1 }}</td>
                                                        <td>{{ $ps['exam']->exam_name ?? 'NA' }}</td>
                                                        <td>{{ $ps['exam']->exam_type ?? 'NA' }}</td>
                                                        <td>{{ $ps['exam']->exam_start_date ?? '—' }}</td>
                                                        <td>{{ $ps['exam']->exam_end_date ?? '—' }}</td>
                                                        <td><span class="badge bg-danger">Not Attempted</span></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="tab-pane" id="payments">
                            <div class="row g-2 mb-2">
                                <div class="col-md-4">
                                    <div class="card mb-0">
                                        <div class="card-body p-2">
                                            <div class="text-muted">Total Fee</div>
                                            <div class="fw-bold" id="summary_total_fee">{{ $debit ?? 0 }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card mb-0">
                                        <div class="card-body p-2">
                                            <div class="text-muted">Total Paid</div>
                                            <div class="fw-bold" id="summary_total_paid">{{ $credit ?? 0 }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card mb-0">
                                        <div class="card-body p-2">
                                            <div class="text-muted">Balance</div>
                                            <div class="fw-bold" id="summary_balance">{{ $balance ?? 0 }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($fees as $k => $fee)
                                            <tr data-fee-id="{{ $fee->id }}">
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{ $fee->amount_paid }}</td>
                                                <td>{{ $fee->date_paid }}</td>
                                                <td>{{ $fee->payment_method }}</td>
                                                <td>{{ $fee->payment_ref_no }}</td>
                                                <td style="white-space:nowrap;">
                                                    <a class="btn btn-secondary" href="{{ route('admindownloadReceipt', $fee->id) }}" title="Download receipt" style="padding:3px 7px;font-size:0.75rem;line-height:1;"><i class="mdi mdi-download"></i></a>
                                                    <button type="button"
                                                        class="btn btn-warning btn-edit-fee"
                                                        style="padding:3px 7px;font-size:0.75rem;line-height:1;"
                                                        title="Edit payment"
                                                        data-id="{{ $fee->id }}"
                                                        data-amount="{{ $fee->amount_paid }}"
                                                        data-date="{{ $fee->date_paid }}"
                                                        data-method="{{ $fee->payment_method }}"
                                                        data-ref="{{ $fee->payment_ref_no }}"
                                                        data-bs-toggle="modal" data-bs-target="#editPaymentModal">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                    <button type="button"
                                                        class="btn btn-danger btn-delete-fee"
                                                        style="padding:3px 7px;font-size:0.75rem;line-height:1;"
                                                        title="Delete payment"
                                                        data-id="{{ $fee->id }}"
                                                        data-amount="{{ $fee->amount_paid }}"
                                                        data-bs-toggle="modal" data-bs-target="#deletePaymentModal">
                                                        <i class="mdi mdi-trash-can-outline"></i>
                                                    </button>
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
                                    <div class="modal-body">
                                        <div id="addProgressWrap" style="display:none;margin-bottom:12px;">
                                            <div class="progress" style="height:6px;border-radius:4px;">
                                                <div id="addProgressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                                    role="progressbar" style="width:0%"></div>
                                            </div>
                                            <small class="text-muted">Saving payment…</small>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Amount Paid</label>
                                            <input type="number" id="add_amount_paid" class="form-control" placeholder="e.g. 5000">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Date Paid</label>
                                            <input type="date" id="add_date_paid" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Payment Method</label>
                                            <input type="text" id="add_payment_method" class="form-control" placeholder="e.g. Mpesa">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Payment Reference No</label>
                                            <input type="text" id="add_payment_ref_no" class="form-control" placeholder="e.g. TH21LCKHC9">
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success" id="btnSaveAddFee">Save Payment</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Edit Fee Payment Modal --}}
                        <div id="editPaymentModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Fee Payment</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{-- Progress bar --}}
                                        <div id="editProgressWrap" style="display:none;margin-bottom:12px;">
                                            <div class="progress" style="height:6px;border-radius:4px;">
                                                <div id="editProgressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-warning"
                                                    role="progressbar" style="width:0%"></div>
                                            </div>
                                            <small class="text-muted" id="editProgressLabel">Saving…</small>
                                        </div>
                                        <input type="hidden" id="edit_fee_id">
                                        <div class="mb-3">
                                            <label class="form-label">Amount Paid</label>
                                            <input type="number" id="edit_amount_paid" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Date Paid</label>
                                            <input type="date" id="edit_date_paid" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Payment Method</label>
                                            <input type="text" id="edit_payment_method" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Payment Reference No</label>
                                            <input type="text" id="edit_payment_ref_no" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-warning" id="btnSaveEditFee">Update Payment</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Delete Fee Payment Modal --}}
                        <div id="deletePaymentModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title text-danger">Delete Payment</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        {{-- Progress bar --}}
                                        <div id="deleteProgressWrap" style="display:none;margin-bottom:12px;">
                                            <div class="progress" style="height:6px;border-radius:4px;">
                                                <div id="deleteProgressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                                                    role="progressbar" style="width:0%"></div>
                                            </div>
                                            <small class="text-muted">Deleting…</small>
                                        </div>
                                        <input type="hidden" id="delete_fee_id">
                                        <p class="mb-1">Are you sure you want to delete this payment?</p>
                                        <p class="fw-bold text-danger fs-5 mb-0">Ksh <span id="delete_fee_amount"></span></p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger" id="btnConfirmDeleteFee">Yes, Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="personal">
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
                                        @forelse($examSummaries as $k => $summary)
                                            <tr>
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{ $summary['exam']->exam_name ?? 'NA' }}</td>
                                                <td>{{ $summary['exam']->exam_type ?? 'NA' }}</td>
                                                <td>{{ $summary['questions'] }}</td>
                                                <td>{{ $summary['total_score'] }}</td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="5" class="text-center text-muted">No assessments attempted.</td></tr>
                                        @endforelse
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
    <div id="submitTraineeAnswerModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="submitTraineeAnswerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="submitTraineeAnswerModalLabel">Submit Student Answer</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form method="POST" id="submitTraineeAnswerForm" action="{{ route('adminSubmitStudentPracticalAnswer') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="practical_id" id="submit_trainee_practical_id">
                        <input type="hidden" name="user_id" id="submit_trainee_user_id">
                        <div class="mb-3">
                            <label class="form-label">Upload Answer File</label>
                            <input type="file" class="form-control" name="student_answer">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Student Score</label>
                            <input type="number" class="form-control" name="student_score" id="submit_trainee_student_score">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Comment</label>
                            <input type="text" class="form-control" name="comment" id="submit_trainee_comment">
                        </div>

                        <div class="progress mt-2" style="height: 18px; display:none;" id="submitTraineeAnswerProgressWrap">
                            <div class="progress-bar" id="submitTraineeAnswerProgress" role="progressbar" style="width:0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

                        <div id="updateTraineeAnswerProgressWrap" style="display:none;margin-top:10px;">
                            <div class="progress" style="height:8px;border-radius:6px;">
                                <div id="updateTraineeAnswerProgress"
                                    class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                    role="progressbar" style="width:0%;transition:width 0.2s ease;">
                                </div>
                            </div>
                            <small class="text-muted mt-1 d-block" id="updateTraineeAnswerProgressLabel">Uploading…</small>
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

                        <div id="updateTraineeMarksProgressWrap" style="display:none;margin-top:10px;">
                            <div class="progress" style="height:8px;border-radius:6px;">
                                <div id="updateTraineeMarksProgress"
                                    class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                    role="progressbar" style="width:0%;transition:width 0.2s ease;">
                                </div>
                            </div>
                            <small class="text-muted mt-1 d-block">Saving marks…</small>
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
        function initTraineeProfilePage() {
            const root = document.getElementById('traineeProfileAjaxRoot');
            if (!root) return;

            const practicalBaseUrl = "{{ asset('practicals') }}";

            const buttons = root.querySelectorAll('.updateTraineeAnswerBtn');
            const input = document.getElementById('update_trainee_answer_id');

            const messageContainer = root.querySelector('#message-container');

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

            const marksButtons = root.querySelectorAll('.updateTraineeMarksBtn, .addTraineeMarksBtn');
            const marksIdInput = document.getElementById('update_trainee_marks_answer_id');
            const marksScoreInput = document.getElementById('update_trainee_marks_score');
            const marksCommentInput = document.getElementById('update_trainee_marks_comment');
            const marksForm = document.getElementById('updateTraineeMarksForm');
            const marksModalTitle = document.getElementById('updateTraineeMarksModalLabel');
            const answerForm = document.getElementById('updateTraineeAnswerForm');

            const submitButtons = root.querySelectorAll('.submitTraineeAnswerBtn');
            const submitForm = document.getElementById('submitTraineeAnswerForm');
            const submitPracticalInput = document.getElementById('submit_trainee_practical_id');
            const submitUserInput = document.getElementById('submit_trainee_user_id');
            const submitScoreInput = document.getElementById('submit_trainee_student_score');
            const submitCommentInput = document.getElementById('submit_trainee_comment');

            const quickNavInput = root.querySelector('#quickNavInput');
            const quickNavDropdown = root.querySelector('#quickNavDropdown');

            const traineeSwitchInput = root.querySelector('#traineeSwitchInput');
            const traineeSwitchDropdown = root.querySelector('#traineeSwitchDropdown');
            const traineeSwitchLoading = root.querySelector('#traineeSwitchLoading');

            function setTraineeSwitchDropdownVisible(visible) {
                if (!traineeSwitchDropdown) return;
                traineeSwitchDropdown.style.display = visible ? 'block' : 'none';
            }

            function filterTraineeSwitchList(query) {
                if (!traineeSwitchDropdown) return;
                const q = String(query || '').trim().toLowerCase();
                const items = traineeSwitchDropdown.querySelectorAll('a[data-search]');
                let visibleCount = 0;
                items.forEach(function (a) {
                    const hay = (a.getAttribute('data-search') || '').toLowerCase();
                    const show = q.length === 0 ? true : hay.indexOf(q) !== -1;
                    a.style.display = show ? '' : 'none';
                    if (show) visibleCount++;
                });
                setTraineeSwitchDropdownVisible(visibleCount > 0);
            }

            function setQuickNavDropdownVisible(visible) {
                if (!quickNavDropdown) return;
                quickNavDropdown.style.display = visible ? 'block' : 'none';
            }

            function filterQuickNavList(query) {
                if (!quickNavDropdown) return;
                const q = String(query || '').trim().toLowerCase();
                const items = quickNavDropdown.querySelectorAll('a[data-search]');
                let visibleCount = 0;
                items.forEach(function (a) {
                    const hay = (a.getAttribute('data-search') || '').toLowerCase();
                    const show = q.length === 0 ? true : hay.indexOf(q) !== -1;
                    a.style.display = show ? '' : 'none';
                    if (show) visibleCount++;
                });
                setQuickNavDropdownVisible(visibleCount > 0);
            }

            async function ajaxSwitchTrainee(url) {
                if (traineeSwitchLoading) traineeSwitchLoading.style.display = 'flex';
                setTraineeSwitchDropdownVisible(false);

                try {
                    const joiner = url.indexOf('?') === -1 ? '?' : '&';
                    const res = await fetch(url + joiner + 'ajax=1', {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        credentials: 'same-origin',
                    });

                    const payload = await res.json().catch(() => null);
                    if (!res.ok || !payload || !payload.success || !payload.html) {
                        displayMessage('error', extractErrorMessage(payload));
                        return;
                    }

                    const parser = new DOMParser();
                    const doc = parser.parseFromString(payload.html, 'text/html');
                    const nextRoot = doc.querySelector('#traineeProfileAjaxRoot');
                    if (!nextRoot) {
                        displayMessage('error', 'Failed to load trainee profile');
                        return;
                    }

                    root.outerHTML = nextRoot.outerHTML;
                    window.history.pushState({ traineeUrl: url }, '', url);
                    initTraineeProfilePage();
                } catch (e) {
                    displayMessage('error', 'Request failed');
                } finally {
                    const currentRoot = document.getElementById('traineeProfileAjaxRoot');
                    const loader = currentRoot ? currentRoot.querySelector('#traineeSwitchLoading') : null;
                    if (loader) loader.style.display = 'none';
                }
            }

            if (traineeSwitchInput && traineeSwitchDropdown) {
                traineeSwitchInput.addEventListener('focus', function () {
                    filterTraineeSwitchList(traineeSwitchInput.value);
                });

                traineeSwitchInput.addEventListener('input', function () {
                    filterTraineeSwitchList(traineeSwitchInput.value);
                });

                document.addEventListener('click', function (e) {
                    const currentRoot = document.getElementById('traineeProfileAjaxRoot');
                    if (!currentRoot) return;
                    const dd = currentRoot.querySelector('#traineeSwitchDropdown');
                    const inp = currentRoot.querySelector('#traineeSwitchInput');
                    if (!dd || !inp) return;
                    const target = e.target;
                    if (dd.contains(target) || inp.contains(target)) return;
                    dd.style.display = 'none';
                });

                traineeSwitchDropdown.querySelectorAll('a.trainee-switch-link').forEach(function (a) {
                    a.addEventListener('click', function (e) {
                        e.preventDefault();
                        const href = this.getAttribute('href');
                        if (!href) return;
                        ajaxSwitchTrainee(href);
                    });
                });
            }

            if (quickNavInput && quickNavDropdown) {
                quickNavInput.addEventListener('focus', function () {
                    filterQuickNavList(quickNavInput.value);
                });

                quickNavInput.addEventListener('input', function () {
                    filterQuickNavList(quickNavInput.value);
                });

                document.addEventListener('click', function (e) {
                    const currentRoot = document.getElementById('traineeProfileAjaxRoot');
                    if (!currentRoot) return;
                    const dd = currentRoot.querySelector('#quickNavDropdown');
                    const inp = currentRoot.querySelector('#quickNavInput');
                    if (!dd || !inp) return;
                    const target = e.target;
                    if (dd.contains(target) || inp.contains(target)) return;
                    dd.style.display = 'none';
                });

                quickNavDropdown.querySelectorAll('a.quick-nav-link').forEach(function (a) {
                    a.addEventListener('click', function () {
                        setQuickNavDropdownVisible(false);
                    });
                });
            }

            buttons.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    if (input) {
                        input.value = this.getAttribute('data-id') || '';
                    }
                });
            });

            root.addEventListener('click', function (e) {
                const btn = e.target && e.target.closest ? e.target.closest('.updateTraineeMarksBtn, .addTraineeMarksBtn') : null;
                if (!btn) return;

                e.preventDefault();

                const answerId = btn.getAttribute('data-id') || '';
                const isAdd = btn.classList.contains('addTraineeMarksBtn');
                const score = isAdd ? '' : (btn.getAttribute('data-score') || '');
                const comment = isAdd ? '' : (btn.getAttribute('data-comment') || '');

                if (marksIdInput) marksIdInput.value = answerId;
                if (marksScoreInput) marksScoreInput.value = score;
                if (marksCommentInput) marksCommentInput.value = comment;

                const existingScore = String(score || '').trim();
                const existingComment = String(comment || '').trim();
                if (marksModalTitle) {
                    marksModalTitle.textContent = (existingScore === '' && existingComment === '') ? 'Add Marks' : 'Update Marks';
                }

                const modalEl = document.getElementById('updateTraineeMarksModal');
                if (modalEl && window.bootstrap) {
                    const inst = window.bootstrap.Modal.getInstance(modalEl) || new window.bootstrap.Modal(modalEl);
                    inst.show();
                }
            });

            marksButtons.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    if (marksIdInput) marksIdInput.value = this.getAttribute('data-id') || '';

                    const isAdd = this.classList.contains('addTraineeMarksBtn');
                    if (marksScoreInput) marksScoreInput.value = isAdd ? '' : (this.getAttribute('data-score') || '');
                    if (marksCommentInput) marksCommentInput.value = isAdd ? '' : (this.getAttribute('data-comment') || '');

                    const existingScore = isAdd ? '' : (this.getAttribute('data-score') || '').toString().trim();
                    const existingComment = isAdd ? '' : (this.getAttribute('data-comment') || '').toString().trim();
                    if (marksModalTitle) {
                        marksModalTitle.textContent = (existingScore === '' && existingComment === '') ? 'Add Marks' : 'Update Marks';
                    }
                });
            });

            submitButtons.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    if (submitPracticalInput) submitPracticalInput.value = this.getAttribute('data-practical-id') || '';
                    if (submitUserInput) submitUserInput.value = this.getAttribute('data-user-id') || '';
                    if (submitScoreInput) submitScoreInput.value = '';
                    if (submitCommentInput) submitCommentInput.value = '';
                });
            });

            function updateAnswerDisplay(practicalId, answerId, filename) {
                const wrap = root.querySelector('.js-practical-answer[data-practical-id="' + practicalId + '"]');
                if (!wrap) return;
                if (answerId !== null && answerId !== undefined) {
                    wrap.setAttribute('data-answer-id', String(answerId));
                }
                if (filename) {
                    wrap.innerHTML = '<a class="answer-link" href="' + practicalBaseUrl + '/' + encodeURIComponent(filename) + '" download>' + filename + '</a>';
                } else {
                    wrap.innerHTML = '<span class="text-muted">NA</span>';
                }
            }

            function ensureUpdateAnswerButton(practicalId, answerId) {
                const actions = root.querySelector('.js-practical-answer-actions[data-practical-id="' + practicalId + '"]');
                if (!actions) return;
                const updateBtn = actions.querySelector('.updateTraineeAnswerBtn');
                if (updateBtn) {
                    if (answerId) updateBtn.setAttribute('data-id', String(answerId));
                    return;
                }

                actions.innerHTML = '<span role="button" class="badge bg-danger ms-1 updateTraineeAnswerBtn" data-id="' + String(answerId) + '" data-bs-toggle="modal" data-bs-target="#updateTraineeAnswerModal">Update</span>';

                const newBtn = actions.querySelector('.updateTraineeAnswerBtn');
                if (newBtn) {
                    newBtn.addEventListener('click', function () {
                        if (input) input.value = this.getAttribute('data-id') || '';
                    });
                }
            }

            if (submitForm) {
                submitForm.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const actionUrl = submitForm.getAttribute('action');
                    const progressWrap = document.getElementById('submitTraineeAnswerProgressWrap');
                    const progressBar = document.getElementById('submitTraineeAnswerProgress');

                    if (progressBar) {
                        progressBar.style.width = '0%';
                        progressBar.setAttribute('aria-valuenow', '0');
                        progressBar.textContent = '0%';
                    }
                    if (progressWrap) progressWrap.style.display = 'block';

                    const xhr = new XMLHttpRequest();
                    const formData = new FormData(submitForm);

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

                            const modalEl = document.getElementById('submitTraineeAnswerModal');
                            if (modalEl && window.bootstrap) {
                                const inst = window.bootstrap.Modal.getInstance(modalEl);
                                if (inst) inst.hide();
                            }

                            displayMessage('success', payload.message || 'Student answer submitted successfully');

                            const practicalId = submitPracticalInput ? String(submitPracticalInput.value || '') : '';
                            const answerId = payload.answer_id ? String(payload.answer_id) : '';
                            const filename = payload.student_answer ? String(payload.student_answer) : '';

                            if (practicalId) {
                                updateAnswerDisplay(practicalId, answerId, filename);
                                if (answerId) {
                                    ensureUpdateAnswerButton(practicalId, answerId);
                                }
                            }

                            if (practicalId && answerId) {
                                const row = root.querySelector('tr[data-practical-id="' + practicalId + '"]');
                                const scoreWrap = row ? row.querySelector('.js-practical-score') : null;
                                const commentWrap = row ? row.querySelector('.js-practical-comment') : null;

                                if (scoreWrap) {
                                    scoreWrap.setAttribute('data-answer-id', answerId);
                                    if (submitScoreInput) {
                                        scoreWrap.textContent = submitScoreInput.value;
                                    }
                                }
                                if (commentWrap) {
                                    commentWrap.setAttribute('data-answer-id', answerId);
                                    if (submitCommentInput) {
                                        commentWrap.textContent = submitCommentInput.value;
                                    }
                                }

                                const scoreTd = scoreWrap ? scoreWrap.closest('td') : null;
                                if (scoreTd) {
                                    const existing = scoreTd.querySelector('.updateTraineeMarksBtn, .addTraineeMarksBtn');
                                    if (!existing) {
                                        const scoreVal = submitScoreInput ? String(submitScoreInput.value || '').trim() : '';
                                        const commentVal = submitCommentInput ? String(submitCommentInput.value || '').trim() : '';
                                        const hasMarks = scoreVal !== '' || commentVal !== '';

                                        const btn = document.createElement('span');
                                        btn.setAttribute('role', 'button');
                                        btn.setAttribute('data-id', answerId);
                                        btn.setAttribute('data-bs-toggle', 'modal');
                                        btn.setAttribute('data-bs-target', '#updateTraineeMarksModal');

                                        if (hasMarks) {
                                            btn.className = 'badge bg-primary ms-1 updateTraineeMarksBtn';
                                            btn.textContent = 'Marks';
                                            btn.setAttribute('data-score', scoreVal);
                                            btn.setAttribute('data-comment', commentVal);
                                        } else {
                                            btn.className = 'badge bg-success ms-1 addTraineeMarksBtn';
                                            btn.textContent = 'Add New Mark';
                                        }

                                        btn.addEventListener('click', function () {
                                            if (marksIdInput) marksIdInput.value = answerId;
                                            const isAdd = btn.classList.contains('addTraineeMarksBtn');
                                            if (marksScoreInput) marksScoreInput.value = isAdd ? '' : (btn.getAttribute('data-score') || '');
                                            if (marksCommentInput) marksCommentInput.value = isAdd ? '' : (btn.getAttribute('data-comment') || '');
                                            const existingScore = isAdd ? '' : (btn.getAttribute('data-score') || '').toString().trim();
                                            const existingComment = isAdd ? '' : (btn.getAttribute('data-comment') || '').toString().trim();
                                            if (marksModalTitle) {
                                                marksModalTitle.textContent = (existingScore === '' && existingComment === '') ? 'Add Marks' : 'Update Marks';
                                            }
                                        });

                                        scoreTd.appendChild(btn);
                                    }
                                }
                            }
                        } else {
                            if (!payload) {
                                displayMessage('error', 'Request failed (' + xhr.status + ')');
                            } else {
                                displayMessage('error', extractErrorMessage(payload));
                            }
                        }

                        setTimeout(function () {
                            if (progressWrap) progressWrap.style.display = 'none';
                        }, 700);
                    };

                    xhr.send(formData);
                });
            }

            if (answerForm) {
                answerForm.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const actionUrl  = answerForm.getAttribute('action');
                    const progressWrap  = document.getElementById('updateTraineeAnswerProgressWrap');
                    const progressBar   = document.getElementById('updateTraineeAnswerProgress');
                    const progressLabel = document.getElementById('updateTraineeAnswerProgressLabel');
                    const uploadBtn     = answerForm.querySelector('button[type="submit"]');

                    if (progressBar)   progressBar.style.width = '0%';
                    if (progressWrap)  progressWrap.style.display = 'block';
                    if (progressLabel) progressLabel.textContent = 'Uploading…';
                    if (uploadBtn)     uploadBtn.disabled = true;

                    const xhr      = new XMLHttpRequest();
                    const formData = new FormData(answerForm);

                    xhr.open('POST', actionUrl, true);
                    xhr.setRequestHeader('Accept', 'application/json');
                    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

                    /* real upload progress for file uploads */
                    xhr.upload.onprogress = function (event) {
                        if (!progressBar) return;
                        var percent = event.lengthComputable
                            ? Math.min(Math.round((event.loaded / event.total) * 90), 90)
                            : 50;
                        progressBar.style.width = percent + '%';
                        if (progressLabel) progressLabel.textContent = 'Uploading… ' + percent + '%';
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
                            if (progressBar)   progressBar.style.width    = '100%';
                            if (progressLabel) progressLabel.textContent  = 'Upload complete!';

                            const modalEl = document.getElementById('updateTraineeAnswerModal');
                            if (modalEl && window.bootstrap) {
                                const inst = window.bootstrap.Modal.getInstance(modalEl);
                                if (inst) inst.hide();
                            }

                            displayMessage('success', payload.message || 'Student answer updated successfully');
                            const answerId = payload.answer_id ? String(payload.answer_id) : (input ? String(input.value || '') : '');
                            const filename = payload.student_answer ? String(payload.student_answer) : '';
                            if (answerId) {
                                const practicalWrap = root.querySelector('.js-practical-answer[data-answer-id="' + answerId + '"]');
                                if (practicalWrap) {
                                    const practicalId = practicalWrap.getAttribute('data-practical-id');
                                    if (practicalId) {
                                        updateAnswerDisplay(practicalId, answerId, filename);
                                        ensureUpdateAnswerButton(practicalId, answerId);
                                    }
                                }
                                /* flash updated row */
                                const tr = (function () {
                                    var sc = root.querySelector('.js-practical-answer[data-answer-id="' + answerId + '"]');
                                    return sc ? sc.closest('tr') : null;
                                })();
                                if (tr) {
                                    tr.style.transition = 'background 0.3s';
                                    tr.style.background = '#d1fae5';
                                    setTimeout(function () { tr.style.background = ''; }, 1200);
                                }
                            }
                        } else {
                            displayMessage('error', extractErrorMessage(payload));
                        }

                        setTimeout(function () {
                            if (progressWrap)  progressWrap.style.display = 'none';
                            if (progressBar)   progressBar.style.width    = '0%';
                            if (progressLabel) progressLabel.textContent  = 'Uploading…';
                        }, 800);
                        if (uploadBtn) uploadBtn.disabled = false;
                    };

                    xhr.send(formData);
                });
            }

            if (marksForm) {
                marksForm.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const actionUrl = marksForm.getAttribute('action');
                    const progressWrap = document.getElementById('updateTraineeMarksProgressWrap');
                    const progressBar  = document.getElementById('updateTraineeMarksProgress');
                    const saveBtn      = marksForm.querySelector('button[type="submit"]');

                    /* ── smooth RAF progress 0 → 80 % while in-flight ── */
                    function rafAnimate(bar, from, to, durationMs, done) {
                        if (!bar) { if (done) done(); return; }
                        var start = null;
                        function step(ts) {
                            if (!start) start = ts;
                            var p = Math.min((ts - start) / durationMs, 1);
                            bar.style.width = (from + (to - from) * p) + '%';
                            if (p < 1) { requestAnimationFrame(step); } else { if (done) done(); }
                        }
                        requestAnimationFrame(step);
                    }

                    if (progressBar) progressBar.style.width = '0%';
                    if (progressWrap) progressWrap.style.display = 'block';
                    if (saveBtn) saveBtn.disabled = true;

                    /* start smooth 0→80 animation while waiting for server */
                    rafAnimate(progressBar, 0, 80, 600, null);

                    const xhr = new XMLHttpRequest();
                    const formData = new FormData(marksForm);
                    xhr.open('POST', actionUrl, true);
                    xhr.setRequestHeader('Accept', 'application/json');
                    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

                    xhr.onreadystatechange = function () {
                        if (xhr.readyState !== 4) return;

                        /* complete 80 → 100 on response */
                        rafAnimate(progressBar, 80, 100, 250, function () {
                            let payload = null;
                            try { payload = JSON.parse(xhr.responseText); } catch (_) {}

                            if (xhr.status >= 200 && xhr.status < 300 && payload && payload.success) {
                                const modalEl = document.getElementById('updateTraineeMarksModal');
                                if (modalEl && window.bootstrap) {
                                    const inst = window.bootstrap.Modal.getInstance(modalEl);
                                    if (inst) inst.hide();
                                }

                                displayMessage('success', payload.message || 'Marks updated successfully');

                                const answerId = (marksIdInput && marksIdInput.value) ? String(marksIdInput.value) : '';
                                if (answerId) {
                                    const scoreCell   = root.querySelector('.js-practical-score[data-answer-id="'   + answerId + '"]');
                                    const commentCell = root.querySelector('.js-practical-comment[data-answer-id="' + answerId + '"]');
                                    if (scoreCell   && marksScoreInput)   scoreCell.textContent   = marksScoreInput.value;
                                    if (commentCell && marksCommentInput) commentCell.textContent = marksCommentInput.value;

                                    /* flash the updated row */
                                    const tr = root.querySelector('tr[data-practical-id]') &&
                                        (function () {
                                            var sc = root.querySelector('.js-practical-score[data-answer-id="' + answerId + '"]');
                                            return sc ? sc.closest('tr') : null;
                                        })();
                                    if (tr) {
                                        tr.style.transition = 'background 0.3s';
                                        tr.style.background = '#dbeafe';
                                        setTimeout(function () { tr.style.background = ''; }, 1200);
                                    }

                                    const btn = root.querySelector('.updateTraineeMarksBtn[data-id="' + answerId + '"], .addTraineeMarksBtn[data-id="' + answerId + '"]');
                                    if (btn && marksScoreInput && marksCommentInput) {
                                        btn.classList.remove('addTraineeMarksBtn');
                                        btn.classList.add('updateTraineeMarksBtn');
                                        btn.classList.remove('bg-success');
                                        btn.classList.add('bg-primary');
                                        btn.textContent = 'Marks';
                                        btn.setAttribute('data-score',   marksScoreInput.value);
                                        btn.setAttribute('data-comment', marksCommentInput.value);
                                    }
                                }
                            } else {
                                displayMessage('error', extractErrorMessage(payload));
                            }

                            setTimeout(function () {
                                if (progressWrap) progressWrap.style.display = 'none';
                                if (progressBar)  progressBar.style.width    = '0%';
                            }, 700);
                            if (saveBtn) saveBtn.disabled = false;
                        });
                    };

                    xhr.send(formData);
                });
            }

            if (!window.__traineeProfilePopstateBound) {
                window.__traineeProfilePopstateBound = true;
                window.addEventListener('popstate', function (event) {
                    if (event && event.state && event.state.traineeUrl) {
                        ajaxSwitchTrainee(event.state.traineeUrl);
                    }
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            initTraineeProfilePage();
        });
    </script>

    <script>
    (function () {
        var csrfToken = '{{ csrf_token() }}';

        /* ── recalculate summary cards from the live table ─── */
        function recalcSummary() {
            var totalFee  = parseFloat(document.getElementById('summary_total_fee').textContent) || 0;
            var totalPaid = 0;
            document.querySelectorAll('tr[data-fee-id]').forEach(function (row) {
                var amt = parseFloat(row.querySelectorAll('td')[1].textContent) || 0;
                totalPaid += amt;
            });
            var balance = totalFee - totalPaid;
            document.getElementById('summary_total_paid').textContent = totalPaid;
            document.getElementById('summary_balance').textContent    = balance;

            /* flash the two updated cards */
            ['summary_total_paid', 'summary_balance'].forEach(function (id) {
                var el = document.getElementById(id);
                el.style.transition = 'color 0.2s';
                el.style.color = '#0d6efd';
                setTimeout(function () { el.style.color = ''; }, 1000);
            });
        }

        /* ── helpers ─────────────────────────────────────────── */
        function animateProgress(barId, wrapId, fromPct, toPct, durationMs, cb) {
            var bar  = document.getElementById(barId);
            var wrap = document.getElementById(wrapId);
            if (!bar || !wrap) { if (cb) cb(); return; }
            wrap.style.display = 'block';
            var start = null, startPct = fromPct;
            function step(ts) {
                if (!start) start = ts;
                var prog = Math.min((ts - start) / durationMs, 1);
                bar.style.width = (startPct + (toPct - startPct) * prog) + '%';
                if (prog < 1) { requestAnimationFrame(step); } else { if (cb) cb(); }
            }
            requestAnimationFrame(step);
        }

        function hideProgress(barId, wrapId) {
            var bar  = document.getElementById(barId);
            var wrap = document.getElementById(wrapId);
            if (bar)  { bar.style.width = '0%'; }
            if (wrap) { wrap.style.display = 'none'; }
        }

        function showToast(message, type) {
            var existing = document.getElementById('feeAjaxToast');
            if (existing) existing.remove();
            var bg = type === 'success' ? '#198754' : '#dc3545';
            var toast = document.createElement('div');
            toast.id = 'feeAjaxToast';
            toast.style.cssText = 'position:fixed;top:20px;right:20px;z-index:9999;padding:12px 20px;border-radius:10px;color:#fff;font-weight:600;font-size:0.9rem;box-shadow:0 4px 16px rgba(0,0,0,0.18);background:' + bg + ';transition:opacity 0.4s;';
            toast.textContent = message;
            document.body.appendChild(toast);
            setTimeout(function () { toast.style.opacity = '0'; setTimeout(function () { toast.remove(); }, 400); }, 3000);
        }

        function getModal(id) {
            return bootstrap.Modal.getInstance(document.getElementById(id));
        }

        /* ── clear add form when modal opens ────────────────── */
        document.getElementById('addPaymentModal').addEventListener('show.bs.modal', function () {
            ['add_amount_paid','add_date_paid','add_payment_method','add_payment_ref_no'].forEach(function (id) {
                document.getElementById(id).value = '';
            });
            hideProgress('addProgressBar', 'addProgressWrap');
        });

        /* ── AJAX add payment ────────────────────────────────── */
        document.getElementById('btnSaveAddFee').addEventListener('click', function () {
            var amount = document.getElementById('add_amount_paid').value.trim();
            var date   = document.getElementById('add_date_paid').value;
            var method = document.getElementById('add_payment_method').value.trim();
            var ref    = document.getElementById('add_payment_ref_no').value.trim();

            if (!amount || !date || !method || !ref) {
                showToast('Please fill in all fields.', 'error'); return;
            }

            var btn = this;
            btn.disabled = true;
            animateProgress('addProgressBar', 'addProgressWrap', 0, 80, 500, null);

            $.ajax({
                url: '{{ route("addFees") }}',
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
                data: {
                    user_id:        '{{ $student->id }}',
                    amount_paid:    amount,
                    date_paid:      date,
                    payment_method: method,
                    payment_ref_no: ref
                },
                success: function (res) {
                    animateProgress('addProgressBar', 'addProgressWrap', 80, 100, 200, function () {
                        if (res.success && res.fee) {
                            var tbody    = document.querySelector('#payments table tbody');
                            var rowCount = tbody.querySelectorAll('tr').length + 1;
                            var feeId    = res.fee.id;
                            var downloadUrl = '{{ url("fees/admindownloadReceipt") }}/' + feeId;

                            var tr = document.createElement('tr');
                            tr.setAttribute('data-fee-id', feeId);
                            tr.style.opacity = '0';
                            tr.style.transition = 'opacity 0.4s';
                            tr.innerHTML =
                                '<td>' + rowCount + '</td>' +
                                '<td>' + amount + '</td>' +
                                '<td>' + date + '</td>' +
                                '<td>' + method + '</td>' +
                                '<td>' + ref + '</td>' +
                                '<td style="white-space:nowrap;">' +
                                    '<a class="btn btn-secondary" href="' + downloadUrl + '" title="Download receipt" style="padding:3px 7px;font-size:0.75rem;line-height:1;"><i class="mdi mdi-download"></i></a> ' +
                                    '<button type="button" class="btn btn-warning btn-edit-fee" style="padding:3px 7px;font-size:0.75rem;line-height:1;" title="Edit payment"' +
                                        ' data-id="' + feeId + '" data-amount="' + amount + '" data-date="' + date + '" data-method="' + method + '" data-ref="' + ref + '"' +
                                        ' data-bs-toggle="modal" data-bs-target="#editPaymentModal"><i class="mdi mdi-pencil"></i></button> ' +
                                    '<button type="button" class="btn btn-danger btn-delete-fee" style="padding:3px 7px;font-size:0.75rem;line-height:1;" title="Delete payment"' +
                                        ' data-id="' + feeId + '" data-amount="' + amount + '"' +
                                        ' data-bs-toggle="modal" data-bs-target="#deletePaymentModal"><i class="mdi mdi-trash-can-outline"></i></button>' +
                                '</td>';

                            tbody.appendChild(tr);
                            /* fade row in */
                            requestAnimationFrame(function () {
                                requestAnimationFrame(function () { tr.style.opacity = '1'; });
                            });

                            /* wire up the new row's edit/delete buttons */
                            tr.querySelector('.btn-edit-fee').addEventListener('click', function () {
                                document.getElementById('edit_fee_id').value         = this.dataset.id;
                                document.getElementById('edit_amount_paid').value    = this.dataset.amount;
                                document.getElementById('edit_date_paid').value      = this.dataset.date;
                                document.getElementById('edit_payment_method').value = this.dataset.method;
                                document.getElementById('edit_payment_ref_no').value = this.dataset.ref;
                                hideProgress('editProgressBar', 'editProgressWrap');
                            });
                            tr.querySelector('.btn-delete-fee').addEventListener('click', function () {
                                document.getElementById('delete_fee_id').value           = this.dataset.id;
                                document.getElementById('delete_fee_amount').textContent = this.dataset.amount;
                                hideProgress('deleteProgressBar', 'deleteProgressWrap');
                            });

                            recalcSummary();
                            getModal('addPaymentModal').hide();
                            showToast('Payment added successfully.', 'success');
                        } else {
                            showToast('Could not save payment. Please try again.', 'error');
                        }
                        hideProgress('addProgressBar', 'addProgressWrap');
                        btn.disabled = false;
                    });
                },
                error: function () {
                    hideProgress('addProgressBar', 'addProgressWrap');
                    showToast('An error occurred. Please try again.', 'error');
                    btn.disabled = false;
                }
            });
        });

        /* ── populate edit modal ─────────────────────────────── */
        document.querySelectorAll('.btn-edit-fee').forEach(function (btn) {
            btn.addEventListener('click', function () {
                document.getElementById('edit_fee_id').value         = this.dataset.id;
                document.getElementById('edit_amount_paid').value    = this.dataset.amount;
                document.getElementById('edit_date_paid').value      = this.dataset.date;
                document.getElementById('edit_payment_method').value = this.dataset.method;
                document.getElementById('edit_payment_ref_no').value = this.dataset.ref;
                hideProgress('editProgressBar', 'editProgressWrap');
            });
        });

        /* ── populate delete modal ───────────────────────────── */
        document.querySelectorAll('.btn-delete-fee').forEach(function (btn) {
            btn.addEventListener('click', function () {
                document.getElementById('delete_fee_id').value           = this.dataset.id;
                document.getElementById('delete_fee_amount').textContent = this.dataset.amount;
                hideProgress('deleteProgressBar', 'deleteProgressWrap');
            });
        });

        /* ── AJAX update ─────────────────────────────────────── */
        document.getElementById('btnSaveEditFee').addEventListener('click', function () {
            var id     = document.getElementById('edit_fee_id').value;
            var amount = document.getElementById('edit_amount_paid').value;
            var date   = document.getElementById('edit_date_paid').value;
            var method = document.getElementById('edit_payment_method').value;
            var ref    = document.getElementById('edit_payment_ref_no').value;

            if (!amount || !date || !method || !ref) {
                showToast('Please fill in all fields.', 'error'); return;
            }

            var btn = this;
            btn.disabled = true;

            /* animate 0 → 80% while request is in flight */
            animateProgress('editProgressBar', 'editProgressWrap', 0, 80, 500, null);

            $.ajax({
                url: '{{ route("updateFees") }}',
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
                data: { id: id, amount_paid: amount, date_paid: date, payment_method: method, payment_ref_no: ref },
                success: function (res) {
                    /* animate remaining 80 → 100% */
                    animateProgress('editProgressBar', 'editProgressWrap', 80, 100, 200, function () {
                        if (res.success) {
                            /* update the matching table row in-place */
                            var row = document.querySelector('tr[data-fee-id="' + id + '"]');
                            if (row) {
                                var cells = row.querySelectorAll('td');
                                cells[1].textContent = amount;
                                cells[2].textContent = date;
                                cells[3].textContent = method;
                                cells[4].textContent = ref;
                                /* update data-* on the edit button so re-opening shows fresh values */
                                var editBtn = row.querySelector('.btn-edit-fee');
                                if (editBtn) {
                                    editBtn.dataset.amount = amount;
                                    editBtn.dataset.date   = date;
                                    editBtn.dataset.method = method;
                                    editBtn.dataset.ref    = ref;
                                }
                                /* flash row highlight */
                                row.style.transition = 'background 0.3s';
                                row.style.background = '#d1fae5';
                                setTimeout(function () { row.style.background = ''; }, 1200);
                            }
                            recalcSummary();
                            getModal('editPaymentModal').hide();
                            showToast('Payment updated successfully.', 'success');
                        } else {
                            showToast('Update failed. Please try again.', 'error');
                        }
                        hideProgress('editProgressBar', 'editProgressWrap');
                        btn.disabled = false;
                    });
                },
                error: function () {
                    hideProgress('editProgressBar', 'editProgressWrap');
                    showToast('An error occurred. Please try again.', 'error');
                    btn.disabled = false;
                }
            });
        });

        /* ── AJAX delete ─────────────────────────────────────── */
        document.getElementById('btnConfirmDeleteFee').addEventListener('click', function () {
            var id  = document.getElementById('delete_fee_id').value;
            var btn = this;
            btn.disabled = true;

            /* animate 0 → 80% while request is in flight */
            animateProgress('deleteProgressBar', 'deleteProgressWrap', 0, 80, 400, null);

            $.ajax({
                url: '{{ route("deleteFees") }}',
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
                data: { id: id },
                success: function (res) {
                    animateProgress('deleteProgressBar', 'deleteProgressWrap', 80, 100, 200, function () {
                        if (res.success) {
                            var row = document.querySelector('tr[data-fee-id="' + id + '"]');
                            if (row) {
                                row.style.transition = 'opacity 0.4s, transform 0.4s';
                                row.style.opacity    = '0';
                                row.style.transform  = 'translateX(40px)';
                                setTimeout(function () { row.remove(); recalcSummary(); }, 420);
                            }
                            getModal('deletePaymentModal').hide();
                            showToast('Payment deleted successfully.', 'success');
                        } else {
                            showToast('Delete failed. Please try again.', 'error');
                        }
                        hideProgress('deleteProgressBar', 'deleteProgressWrap');
                        btn.disabled = false;
                    });
                },
                error: function () {
                    hideProgress('deleteProgressBar', 'deleteProgressWrap');
                    showToast('An error occurred. Please try again.', 'error');
                    btn.disabled = false;
                }
            });
        });
    })();
    </script>
@endsection
