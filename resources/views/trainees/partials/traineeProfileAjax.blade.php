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
        <div class="col-sm-12 mb-3">
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

                        @include('trainees.traineeProfileTabs')

                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- end row -->

</div>

@if(Auth::check() && Auth::user()->role != 'Trainee')
    @include('trainees.traineeProfileModals')
@endif
