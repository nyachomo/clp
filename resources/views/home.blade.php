@extends('layouts.master')
@section('content')

<?php 
use App\Models\User;
use App\Models\Fee;
use App\Models\StudentAnswer;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Support\Facades\DB;


if(Auth::check() && Auth::user()->role=='Trainee' or Auth::user()->role=='scholarship_test_student' or Auth::user()->role=='ict_club_student'){

    $user_id=Auth::user()->id;
    $fees=Fee::where('user_id',$user_id)->get();
    $debit=Auth::user()->course->course_price?? 0;
    $credit=Fee::where('user_id',$user_id)->sum('amount_paid');
    $balance=$debit-$credit;

    $totalCoursesEnrolled = Auth::user()->course_id ? 1 : 0;
    $totalAssessmentsDone = StudentAnswer::where('user_id', $user_id)
        ->whereNotNull('exam_id')
        ->distinct('exam_id')
        ->count('exam_id');

//Get all the scores of the assignment of the person that logins.
$uniqueQuestions = StudentAnswer::where('user_id', $user_id)
    ->distinct()
    ->pluck('question_id'); // Get unique question IDs only

    $uniqueExamIds = StudentAnswer::where('user_id', $user_id)
    ->distinct()
    ->pluck('exam_id');


    $assignmentExamIds = Exam::whereIn('id', $uniqueExamIds)
    ->where('is_assignment', 'Yes')
    ->pluck('id');

    //Get the total score for assignment

    $total_question_mark = Question::whereIn('exam_id', $assignmentExamIds)
    ->sum('question_mark');

    $total_student_score=StudentAnswer::whereIn('exam_id', $assignmentExamIds)
    ->where('user_id',$user_id)
    ->sum('score');

    $avgAssignment = ($total_question_mark > 0) 
    ? round(($total_student_score / $total_question_mark) * 30) 
    : 0; // Default value if division is not possible


    //GETTING UNIQUE CATS IDS
    $assignmentCatIds = Exam::whereIn('id', $uniqueExamIds)
    ->where('is_cat', 'Yes')
    ->pluck('id');

    $total_cat_question_mark = Question::whereIn('exam_id', $assignmentCatIds)
    ->sum('question_mark');

    $total_student_cat_score=StudentAnswer::whereIn('exam_id', $assignmentCatIds)
    ->where('user_id',$user_id)
    ->sum('score');

    $avgCat = ($total_cat_question_mark > 0) 
    ? round(($total_student_cat_score / $total_cat_question_mark) * 30) 
    : 0; // Default value if division is not possible




    //GETTING UNIQUE FINAL EXAM IDS
    $assignmentFinalExamIds = Exam::whereIn('id', $uniqueExamIds)
    ->where('is_final_exam', 'Yes')
    ->pluck('id');

    $total_final_exam_question_mark = Question::whereIn('exam_id', $assignmentFinalExamIds)
    ->sum('question_mark');

    $total_student_final_exam_score=StudentAnswer::whereIn('exam_id', $assignmentFinalExamIds)
    ->where('user_id',$user_id)
    ->sum('score');

    $avgFinalExam = ($total_final_exam_question_mark > 0) 
    ? round(($total_student_final_exam_score / $total_final_exam_question_mark) * 30) 
    : 0; // Default value if division is not possible


}
?>

<style>
    /* ===== ADMIN DASHBOARD STYLES ===== */
    :root {
        --primary: #6366f1;
        --primary-dark: #4f46e5;
        --success: #10b981;
        --danger: #ef4444;
        --warning: #f59e0b;
        --info: #3b82f6;
        --purple: #8b5cf6;
        --pink: #ec4899;
    }

    .admin-dashboard { font-family: 'Inter', sans-serif; }

    /* Hero Welcome Banner */
    .admin-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 40%, #312e81 70%, #4c1d95 100%);
        border-radius: 24px;
        padding: 36px 40px;
        color: #fff;
        position: relative;
        overflow: hidden;
        margin-bottom: 28px;
        box-shadow: 0 20px 60px rgba(79, 70, 229, 0.4);
    }
    .admin-hero::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 300px; height: 300px;
        background: radial-gradient(circle, rgba(139,92,246,0.35) 0%, transparent 70%);
        border-radius: 50%;
    }
    .admin-hero::after {
        content: '';
        position: absolute;
        bottom: -80px; left: 30%;
        width: 250px; height: 250px;
        background: radial-gradient(circle, rgba(236,72,153,0.2) 0%, transparent 70%);
        border-radius: 50%;
    }
    .hero-title { font-size: 2rem; font-weight: 800; margin: 0 0 6px; letter-spacing: -0.5px; }
    .hero-subtitle { font-size: 1rem; opacity: 0.75; margin: 0 0 20px; }
    .hero-pills { display: flex; gap: 10px; flex-wrap: wrap; }
    .hero-pill {
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.18);
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 0.82rem;
        font-weight: 600;
        backdrop-filter: blur(8px);
    }
    .hero-badge {
        position: absolute; top: 28px; right: 36px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        padding: 14px 20px;
        text-align: center;
    }
    .hero-badge .time-display { font-size: 1.6rem; font-weight: 700; letter-spacing: 2px; }
    .hero-badge .date-display { font-size: 0.75rem; opacity: 0.7; margin-top: 2px; }

    /* Stat Cards */
    .stat-card {
        border-radius: 20px;
        padding: 24px;
        border: none;
        position: relative;
        overflow: hidden;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        cursor: default;
    }
    .stat-card:hover { transform: translateY(-5px); box-shadow: 0 24px 48px rgba(0,0,0,0.15) !important; }
    .stat-card .icon-wrap {
        width: 54px; height: 54px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 16px;
    }
    .stat-card .stat-label { font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; opacity: 0.7; margin-bottom: 6px; }
    .stat-card .stat-value { font-size: 1.75rem; font-weight: 800; line-height: 1; margin-bottom: 10px; }
    .stat-card .stat-footer { font-size: 0.78rem; font-weight: 600; opacity: 0.7; }
    .stat-card .stat-footer a { color: inherit; text-decoration: underline; opacity: 0.8; }
    .stat-card .shimmer-bar {
        position: absolute; bottom: 0; left: 0; right: 0;
        height: 4px;
        border-radius: 0 0 20px 20px;
        background: rgba(255,255,255,0.3);
    }

    .stat-indigo { background: linear-gradient(135deg, #6366f1, #4f46e5); color: #fff; box-shadow: 0 10px 30px rgba(99,102,241,0.35); }
    .stat-emerald { background: linear-gradient(135deg, #10b981, #059669); color: #fff; box-shadow: 0 10px 30px rgba(16,185,129,0.35); }
    .stat-rose { background: linear-gradient(135deg, #f43f5e, #e11d48); color: #fff; box-shadow: 0 10px 30px rgba(244,63,94,0.35); }
    .stat-amber { background: linear-gradient(135deg, #f59e0b, #d97706); color: #fff; box-shadow: 0 10px 30px rgba(245,158,11,0.35); }
    .stat-sky { background: linear-gradient(135deg, #0ea5e9, #0284c7); color: #fff; box-shadow: 0 10px 30px rgba(14,165,233,0.35); }
    .stat-violet { background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: #fff; box-shadow: 0 10px 30px rgba(139,92,246,0.35); }

    /* Chart Cards */
    .chart-card {
        background: #fff;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.07);
        border: 1px solid rgba(0,0,0,0.05);
        height: 100%;
    }
    .chart-card .chart-title { font-size: 1rem; font-weight: 700; color: #1e293b; margin-bottom: 4px; }
    .chart-card .chart-subtitle { font-size: 0.8rem; color: #94a3b8; margin-bottom: 20px; }

    /* Quick Action Buttons */
    .quick-action {
        background: #fff;
        border-radius: 16px;
        padding: 20px;
        text-align: center;
        border: 2px solid transparent;
        transition: all 0.2s;
        text-decoration: none;
        display: block;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    }
    .quick-action:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,0.12); text-decoration: none; }
    .quick-action .qa-icon { font-size: 2rem; margin-bottom: 10px; display: block; }
    .quick-action .qa-label { font-size: 0.82rem; font-weight: 700; color: #475569; }
    .quick-action.qa-indigo:hover { border-color: #6366f1; background: linear-gradient(135deg, #eef2ff, #fff); }
    .quick-action.qa-emerald:hover { border-color: #10b981; background: linear-gradient(135deg, #ecfdf5, #fff); }
    .quick-action.qa-amber:hover { border-color: #f59e0b; background: linear-gradient(135deg, #fffbeb, #fff); }
    .quick-action.qa-rose:hover { border-color: #f43f5e; background: linear-gradient(135deg, #fff1f2, #fff); }
    .quick-action.qa-sky:hover { border-color: #0ea5e9; background: linear-gradient(135deg, #f0f9ff, #fff); }
    .quick-action.qa-violet:hover { border-color: #8b5cf6; background: linear-gradient(135deg, #f5f3ff, #fff); }

    /* Section headings */
    .section-heading { font-size: 1.1rem; font-weight: 700; color: #1e293b; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
    .section-heading::after { content: ''; flex: 1; height: 1px; background: #e2e8f0; }

    /* Welcome card (student) */
    .welcome-card {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 40px;
    border-radius: 20px;
    color: #fff;
    background: linear-gradient(
        90deg,
        #003366,
        #6a11cb,
        #ff9900,
        #003366
    );
    background-size: 400% 400%;
    animation: gradientMove 10s ease infinite;
    box-shadow: 0 20px 40px rgba(0,0,0,0.25);
    max-width: 100%;
}

/* Gradient animation */
@keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.card-content h1 {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 10px;
}

.card-content p {
    font-size: 1rem;
    opacity: 0.9;
    max-width: 600px;
}

.info-row {
    display: flex;
    gap: 12px;
    margin-top: 18px;
    flex-wrap: wrap;
}

.info-pill {
    background: rgba(255,255,255,0.15);
    padding: 10px 16px;
    border-radius: 12px;
    font-size: 0.9rem;
    backdrop-filter: blur(10px);
}

.card-actions {
    display: flex;
    gap: 16px;
}

.btn {
    padding: 14px 22px;
    border-radius: 12px;
    font-size: 0.95rem;
    cursor: pointer;
    border: none;
    font-weight: 600;
}

.btn.primary {
    background: #2563eb;
    color: #fff;
}

.btn.primary:hover {
    background: #1d4ed8;
}

.btn.secondary {
    background: #ffffff;
    color: #2563eb;
}

.btn.secondary:hover {
    background: #f1f5f9;
}

.alert-cards{
    border-radius:20px
}

.strong-text{
    font-size:20px;
}

.finance-summary{
    margin-left: 12px;
    margin-right: 12px;
}

.summary-card{
    border-radius: 18px !important;
    border: 1px solid rgba(15, 23, 42, 0.08);
    padding: 18px 18px;
    box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
}

.summary-card .summary-label{
    display: block;
    font-size: 0.95rem;
    font-weight: 700;
    letter-spacing: 0.2px;
    margin-bottom: 10px;
    color: rgba(15, 23, 42, 0.75);
}

.summary-card .summary-value{
    margin: 0;
    font-size: 1.75rem;
    font-weight: 800;
    line-height: 1.1;
    color: #0f172a;
}

.summary-card .summary-value{
    background-clip: text;
    -webkit-background-clip: text;
    color: transparent;
    -webkit-text-fill-color: transparent;
}

.summary-card.alert-success .summary-value{ background-image: linear-gradient(90deg, #15803d, #22c55e, #4ade80); }
.summary-card.alert-info .summary-value{ background-image: linear-gradient(90deg, #1d4ed8, #3b82f6, #60a5fa); }
.summary-card.alert-danger .summary-value{ background-image: linear-gradient(90deg, #b91c1c, #ef4444, #fb7185); }
.summary-card.alert-warning .summary-value{ background-image: linear-gradient(90deg, #b45309, #f59e0b, #fbbf24); }

.summary-card.alert-success{ background: linear-gradient(180deg, rgba(34,197,94,0.18), rgba(34,197,94,0.10)); }
.summary-card.alert-info{ background: linear-gradient(180deg, rgba(59,130,246,0.18), rgba(59,130,246,0.10)); }
.summary-card.alert-danger{ background: linear-gradient(180deg, rgba(239,68,68,0.18), rgba(239,68,68,0.10)); }
.summary-card.alert-warning{ background: linear-gradient(180deg, rgba(245,158,11,0.20), rgba(245,158,11,0.10)); }

.summary-card:hover{
    transform: translateY(-2px);
    transition: transform 160ms ease, box-shadow 160ms ease;
    box-shadow: 0 16px 34px rgba(15, 23, 42, 0.12);
}
</style>

<!--
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                </ol>
            </div>
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>
 
-->
<br>






 <!-- end page title -->
 @if(Auth::check() && Auth::user()->role=='Admin')

<div class="admin-dashboard">

    {{-- ===== HERO BANNER ===== --}}
    <div class="admin-hero">
        <div style="position:relative;z-index:2;">
            <div class="hero-title">Welcome back, {{ Auth::user()->firstname }} 👋</div>
            <div class="hero-subtitle">Here's what's happening at Techsphere Training Institute today.</div>
            <div class="hero-pills">
                <span class="hero-pill">🎓 Admin Panel</span>
                <span class="hero-pill" id="admin-live-time">--:-- --</span>
                <span class="hero-pill" id="admin-live-date">--- --, ----</span>
            </div>
        </div>
        <div class="hero-badge" style="z-index:2;">
            <div class="time-display" id="admin-clock">--:--</div>
            <div class="date-display" id="admin-date-short">Loading...</div>
        </div>
    </div>

    {{-- ===== STAT CARDS ===== --}}
    <div class="section-heading">Overview Statistics</div>
    <div class="row g-3 mb-4">

        <div class="col-6 col-lg-2">
            <div class="stat-card stat-emerald">
                <div class="icon-wrap" style="background:rgba(255,255,255,0.2);">💰</div>
                <div class="stat-label">Total Debit</div>
                <div class="stat-value" id="totalExpectedFee" style="font-size:1.2rem;">—</div>
                <div class="stat-footer">Expected Revenue</div>
                <div class="shimmer-bar"></div>
            </div>
        </div>

        <div class="col-6 col-lg-2">
            <div class="stat-card stat-sky">
                <div class="icon-wrap" style="background:rgba(255,255,255,0.2);">💳</div>
                <div class="stat-label">Total Credit</div>
                <div class="stat-value" id="totalFeePaid" style="font-size:1.2rem;">—</div>
                <div class="stat-footer">Collected So Far</div>
                <div class="shimmer-bar"></div>
            </div>
        </div>

        <div class="col-6 col-lg-2">
            <div class="stat-card stat-rose">
                <div class="icon-wrap" style="background:rgba(255,255,255,0.2);">📉</div>
                <div class="stat-label">Balance</div>
                <div class="stat-value" id="balanceToPay" style="font-size:1.2rem;">—</div>
                <div class="stat-footer">Outstanding Amount</div>
                <div class="shimmer-bar"></div>
            </div>
        </div>

        <div class="col-6 col-lg-2">
            <div class="stat-card stat-indigo">
                <div class="icon-wrap" style="background:rgba(255,255,255,0.2);">🧑‍💼</div>
                <div class="stat-label">Administrators</div>
                <div class="stat-value" id="total_admin">—</div>
                <div class="stat-footer"><a href="{{route('showAdministrator')}}">View All</a></div>
                <div class="shimmer-bar"></div>
            </div>
        </div>

        <div class="col-6 col-lg-2">
            <div class="stat-card stat-amber">
                <div class="icon-wrap" style="background:rgba(255,255,255,0.2);">🎓</div>
                <div class="stat-label">Trainees</div>
                <div class="stat-value" id="total_trainees">—</div>
                <div class="stat-footer"><a href="{{route('showTrainees')}}">View All</a></div>
                <div class="shimmer-bar"></div>
            </div>
        </div>

        <div class="col-6 col-lg-2">
            <div class="stat-card stat-violet">
                <div class="icon-wrap" style="background:rgba(255,255,255,0.2);">📚</div>
                <div class="stat-label">Courses</div>
                <div class="stat-value" id="total_courses">—</div>
                <div class="stat-footer"><a href="{{route('showCourses')}}">View All</a></div>
                <div class="shimmer-bar"></div>
            </div>
        </div>

    </div>

    {{-- ===== CHARTS ROW 1 ===== --}}
    <div class="section-heading">Analytics & Insights</div>
    <div class="row g-3 mb-4">

        {{-- Fee Collections Area Chart --}}
        <div class="col-lg-8">
            <div class="chart-card">
                <div class="chart-title">Monthly Fee Collections</div>
                <div class="chart-subtitle">Revenue collected per month — last 12 months</div>
                <div id="feeCollectionsChart"></div>
            </div>
        </div>

        {{-- User Distribution Donut --}}
        <div class="col-lg-4">
            <div class="chart-card">
                <div class="chart-title">User Distribution</div>
                <div class="chart-subtitle">Breakdown by role</div>
                <div id="userDistributionChart"></div>
            </div>
        </div>

    </div>

    {{-- ===== CHARTS ROW 2 ===== --}}
    <div class="row g-3 mb-4">

        {{-- Monthly Enrollments Bar Chart --}}
        <div class="col-lg-8">
            <div class="chart-card">
                <div class="chart-title">Monthly Enrollments</div>
                <div class="chart-subtitle">New trainee registrations over time</div>
                <div id="enrollmentsBarChart"></div>
            </div>
        </div>

        {{-- Fee Collection Progress Radial --}}
        <div class="col-lg-4">
            <div class="chart-card" style="display:flex;flex-direction:column;align-items:center;justify-content:center;">
                <div class="chart-title" style="text-align:center;width:100%;">Fee Collection Rate</div>
                <div class="chart-subtitle" style="text-align:center;width:100%;">Percentage of total fees collected</div>
                <div id="feeRadialChart" style="width:100%;"></div>
                <div style="text-align:center;margin-top:10px;">
                    <span style="font-size:0.8rem;color:#64748b;">Collected: <strong id="radial-collected">Ksh —</strong></span><br>
                    <span style="font-size:0.8rem;color:#64748b;">Target: <strong id="radial-target">Ksh —</strong></span>
                </div>
            </div>
        </div>

    </div>

    {{-- ===== QUICK ACTIONS ===== --}}
    <div class="section-heading">Quick Actions</div>
    <div class="row g-3 mb-4">
        <div class="col-6 col-sm-4 col-lg-2">
            <a href="{{route('showAdministrator')}}" class="quick-action qa-indigo">
                <span class="qa-icon">🧑‍💼</span>
                <span class="qa-label">Administrators</span>
            </a>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <a href="{{route('showTrainees')}}" class="quick-action qa-emerald">
                <span class="qa-icon">🎓</span>
                <span class="qa-label">Trainees</span>
            </a>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <a href="{{route('showCourses')}}" class="quick-action qa-amber">
                <span class="qa-icon">📚</span>
                <span class="qa-label">Courses</span>
            </a>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <a href="{{route('showClases')}}" class="quick-action qa-rose">
                <span class="qa-icon">🏫</span>
                <span class="qa-label">Classes</span>
            </a>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <a href="{{route('showExams')}}" class="quick-action qa-sky">
                <span class="qa-icon">📝</span>
                <span class="qa-label">Assessments</span>
            </a>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <a href="{{route('showSchools')}}" class="quick-action qa-violet">
                <span class="qa-icon">🏛️</span>
                <span class="qa-label">Schools</span>
            </a>
        </div>
    </div>

</div>{{-- end admin-dashboard --}}

 @endif


 @if(Auth::check() && Auth::user()->role=='High_school_teacher')

   <?php
    $student=count(User::where('school_id', Auth::user()->school_id)
    ->whereIn('clas_category', ['Form One', 'Form Two', 'Form Three', 'Form Four'])->get());
   ?>
    <div class="row">

        <div class="col-xxl-3 col-sm-3">
            <div class="card widget-flat bg-success text-white">
                <div class="card-body">
                    <div class="float-end">
                        <i class="mdi mdi-account-multiple widget-icon bg-white text-success"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Total Students</h6>
                    <h3 class="mt-3 mb-3">{{$student ?? 'NA'}}</h3>

                    <a href="{{route('highSchoolTeacherViewStudent')}}" class="btn btn-sm">Click Here to Enrol Student</a>
                </div>
            </div>
        </div> <!-- end col-->

       

    </div>
    <!-- end row-->



 @endif

 @if(Auth::check() && Auth::user()->role=='scholarship_test_student' or Auth::user()->role=='ict_club_student')


 <div class="row">
    <div class="col-sm-8">

        <div class="alert alert-success" role="alert">
            <strong> <h3>Dear {{Auth::user()->firstname ?? ''}} {{Auth::user()->lastname ?? ''}}</strong></h3>
            <p>
                Techsphere Training Institute congratulates you for showing interest to be admitted this year student partial 
                scholarship test. The test question are simple and any students can do it. After the test kindly remember to
                download your scholarship letter.

                
            </p>
            <a href="{{route('showScholarshipTest')}}" class="btn btn-danger">Click Here to begin the test</a>  <a href="{{route('showFormFourScholarshipLetter')}}" class="btn btn-success">Click Here to download scholarship Letter</a>
        </div>

    </div>

       <!-- end col-->
       <div class="col-sm-4">
             <div class="card">
                 <div class="card-header">
                         <h4 class="header-title mb-4">Assesment Analysis</h4>
                         <!--<p>This is your Avarage Assesment</p>-->
                 </div>

                 <div class="card-body">
                     <table class="table table-bordered">
                         <tbody>
                            
                             <tr>
                                 <td><h2>Score</h2></td>
                                 <td><h2>{{$avgCat}} (<a href="{{route('showScholarshipTest')}}">View</a>) </h2></td>
                             </tr>

                         </tbody>

                     </table>
                 </div>
             </div>
         </div>






</div>





@endif



@if(Auth::check() && Auth::user()->role=='Trainee' && Auth::user()->has_paid_reg_fee=='Yes')

<div class="row">
    <div class="col-sm-12">
         
    <div class="welcome-card">
        <div class="card-content">
            <h1>Welcome back, {{Auth::user()->firstname}} 👋</h1>
                 <!--<p>Techsphere wishes to congratulate you on your 2025 KCSE results and thanks you for expressing interest in learning with us. We wish you a great learning experience with us.</p>-->
                 <p>We wish you a great learning experience with us.</p>


            <div class="info-row">
                @php
                    $clockTimeId = 'clock-time-' . (Auth::id() ?? 'guest');
                    $clockDateId = 'clock-date-' . (Auth::id() ?? 'guest');
                    $now = now();
                @endphp
                <span class="info-pill" id="{{ $clockTimeId }}">🟢 {{ $now->format('h:i:s A') }}</span>
                <span class="info-pill" id="{{ $clockDateId }}">📅 {{ $now->format('l, F j') }}</span>
            </div>

            <script>
                (function () {
                    var timeEl = document.getElementById(@json($clockTimeId));
                    var dateEl = document.getElementById(@json($clockDateId));
                    if (!timeEl || !dateEl) return;

                    function pad(n) { return String(n).padStart(2, '0'); }

                    function update() {
                        var d = new Date();
                        var hours = d.getHours();
                        var ampm = hours >= 12 ? 'PM' : 'AM';
                        hours = hours % 12;
                        hours = hours ? hours : 12;

                        timeEl.textContent = '🟢 ' + pad(hours) + ':' + pad(d.getMinutes()) + ':' + pad(d.getSeconds()) + ' ' + ampm;
                        dateEl.textContent = '📅 ' + d.toLocaleDateString(undefined, { weekday: 'long', month: 'long', day: 'numeric' });
                    }

                    update();
                    setInterval(update, 1000);
                })();
            </script>

            <div class="info-row">
                <span class="info-pill">🧳 {{ $totalCoursesEnrolled }} Course(s)</span>
                <span class="info-pill">👥 {{ $totalAssessmentsDone }} Assesment(s)</span>
            </div>
        </div>

        <div class="card-actions">
            @if(Auth::user()->has_paid_reg_fee=='Yes')
            <a href="{{ route('traineePrintingReceiptForRegistration') }}" class="btn primary"><i class="fa fa-download"></i> Download Payment Receipt for Registration </a>
            @endif
            <a href="{{ route('userAccount') }}" class="btn secondary">⚙️Settings</a>
        </div>
    </div>



    </div>
</div>


<br>

<div class="finance-summary">
    <div class="card" style="border-radius:20px">
            <div class="card-body">
                  
                 <div class="row">
                    <div class="col-12 col-sm-6 col-lg-3 mb-3">
                        <div class="alert alert-success alert-cards summary-card" role="alert">
                            <span class="summary-label">Total Debit (Ksh)</span>
                            <h1 class="summary-value">Ksh {{ Auth::user()->course->course_price ?? '0' }}.00</h1>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-3 mb-3">
                        <div class="alert alert-info alert-cards summary-card" role="alert">
                            <span class="summary-label">Total Credit (Ksh)</span>
                            <h1 class="summary-value">{{ $credit ?? 'NA' }}.00</h1>
                        </div>
                    </div>


                    <div class="col-12 col-sm-6 col-lg-3 mb-3">
                        <div class="alert alert-danger alert-cards summary-card" role="alert">
                            <span class="summary-label">Balance (Ksh)</span>
                            <h1 class="summary-value">{{ $balance ?? 'NA' }}.00</h1>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-3 mb-3">
                        <div class="alert alert-warning alert-cards summary-card" role="alert">
                            <span class="summary-label">Total Course</span>
                            <h1 class="summary-value">{{ $totalCoursesEnrolled ?? 0 }}</h1>
                        </div>
                    </div>



                   </div>




             </div>

        </div> <!-- end col -->

</div>



   
@endif

@if(Auth::check() && Auth::user()->role=='Applicant')
<div class="row">
    
    <div class="col-sm-12">

        <div class="alert alert-success" role="alert">
             <strong> <h3>Dear {{Auth::user()->firstname ?? 'NA'}} {{Auth::user()->lastname ?? 'NA'}}</strong></h3>

             <h3 style="text-transform:uppercase"><u>RE: ADMISSION INTO {{Auth::user()->course->course_name ?? 'NA'}} COURSE !</u></h3>

             <p>
                Congratulations on being awarded a scholarship to join Techsphere Training Institute and For
                expressing interest in our <b>{{Auth::user()->course->course_name}} COURSE !</b> . We are
                excited about the possibility of having you in our learning community and commend your
                enthusiasm to gain valuable programming skills.
            </p>

           
            <strong> <h3>How to pay registration Fee (Ksh 1000)</strong></h3>
            <p>Pay Ksh 1000 to techsphere training institute and send the payment details to : +254115665719. Choose one payment option</p>
            
            <p><b>Mpesa</b></p>
            <ul>

                <li>Business Name: Techsphere Institute</li>
                <li>Paybill: 522533</li>
                <li>Acc No: 7855887</li>

            </ul>
           

            <p><b>Bank</b></p>

            <ul>
                <li>Bank: Kenya Comercial Bank</li>
                <li>Acc Name: Techsphere Institute</li>
                <li>Acc No: 1327338564</li>
            </ul>
           

           <br>
            <a href="{{route('applicantDownloadAdmissionLetter')}}" class="btn btn-warning">Download Admission Letter</a>
        </div>

    </div>



</div>
@endif



<!-- Add User modal -->
<div id="feeReminderModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Fee Reminder</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form>
                @csrf
               

                <!-- /.card-header -->
                <div class="card-body">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-success" role="alert">
                                    <strong>Notice ! </strong> 
                                    <p>
                                        <ol>
                                            <li>You have fee balance of  Ksh<span id="feeBalance" style="color:red;font-size:20px"> </span></li>
                                            <li> Pay at least Ksh <span id="payment" style="color:red;font-size:20px">*</span> by <span id="endOfMonth" style="color:red;font-size:20px"></span> to avoid interuption</li>
                                        </ol>
                                    </p>
                                </div>

                            </div>
                        </div>

                     
                </div>
                 <!-- /.card-body -->


            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger rounded-pill"  data-bs-dismiss="modal">Close</button>
                
            </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--end of modal-->




@endsection

@section('scripts')

<script>
/* ===== LIVE CLOCK ===== */
(function () {
    function pad(n) { return String(n).padStart(2, '0'); }
    var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
    var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    var longMonths = ['January','February','March','April','May','June','July','August','September','October','November','December'];

    function updateClock() {
        var d = new Date();
        var h = d.getHours(), m = d.getMinutes(), s = d.getSeconds();
        var ampm = h >= 12 ? 'PM' : 'AM';
        var h12 = h % 12 || 12;

        var clockEl = document.getElementById('admin-clock');
        var dateShortEl = document.getElementById('admin-date-short');
        var liveTimeEl = document.getElementById('admin-live-time');
        var liveDateEl = document.getElementById('admin-live-date');

        if (clockEl) clockEl.textContent = pad(h12) + ':' + pad(m);
        if (dateShortEl) dateShortEl.textContent = days[d.getDay()].substring(0,3) + ', ' + months[d.getMonth()] + ' ' + d.getDate();
        if (liveTimeEl) liveTimeEl.textContent = '🟢 ' + pad(h12) + ':' + pad(m) + ':' + pad(s) + ' ' + ampm;
        if (liveDateEl) liveDateEl.textContent = '📅 ' + days[d.getDay()] + ', ' + longMonths[d.getMonth()] + ' ' + d.getDate();
    }
    updateClock();
    setInterval(updateClock, 1000);
})();

/* ===== CHART INSTANCES ===== */
var feeCollectionsChart, userDistributionChart, enrollmentsBarChart, feeRadialChart;

/* ===== NUMBER FORMATTING ===== */
function formatKsh(num) {
    if (num >= 1000000) return 'Ksh ' + (num / 1000000).toFixed(1) + 'M';
    if (num >= 1000) return 'Ksh ' + (num / 1000).toFixed(1) + 'K';
    return 'Ksh ' + Number(num).toLocaleString();
}

/* ===== INIT USER DISTRIBUTION DONUT ===== */
function initUserDistributionChart(admins, trainees, trainers, courses) {
    var opts = {
        series: [admins, trainees, trainers, courses],
        labels: ['Admins', 'Trainees', 'Trainers', 'Courses'],
        chart: { type: 'donut', height: 280, fontFamily: 'Inter, sans-serif' },
        colors: ['#6366f1', '#f59e0b', '#10b981', '#8b5cf6'],
        plotOptions: {
            pie: {
                donut: {
                    size: '70%',
                    labels: {
                        show: true,
                        total: {
                            show: true, label: 'Total', color: '#374151',
                            fontSize: '14px', fontWeight: 700,
                            formatter: function (w) {
                                return w.globals.seriesTotals.reduce(function(a, b) { return a + b; }, 0);
                            }
                        }
                    }
                }
            }
        },
        legend: { position: 'bottom', fontSize: '12px' },
        dataLabels: { enabled: false },
        tooltip: { theme: 'light' },
        stroke: { width: 0 }
    };
    var el = document.querySelector('#userDistributionChart');
    if (!el) return;
    if (userDistributionChart) { userDistributionChart.destroy(); }
    userDistributionChart = new ApexCharts(el, opts);
    userDistributionChart.render();
}

/* ===== INIT FEE RADIAL CHART ===== */
function initFeeRadialChart(collected, total) {
    var pct = total > 0 ? Math.round((collected / total) * 100) : 0;
    var opts = {
        series: [pct],
        chart: { type: 'radialBar', height: 240, fontFamily: 'Inter, sans-serif' },
        plotOptions: {
            radialBar: {
                startAngle: -135, endAngle: 135,
                hollow: { size: '60%' },
                dataLabels: {
                    name: { show: true, fontSize: '13px', color: '#64748b', offsetY: -10, fontWeight: 600 },
                    value: { show: true, fontSize: '2rem', fontWeight: 800, color: '#1e293b', offsetY: 6,
                        formatter: function (val) { return val + '%'; }
                    }
                },
                track: { background: '#e2e8f0', strokeWidth: '100%' }
            }
        },
        fill: {
            type: 'gradient',
            gradient: { shade: 'dark', type: 'horizontal', gradientToColors: ['#10b981'], stops: [0, 100] }
        },
        colors: ['#6366f1'],
        labels: ['Collected'],
        stroke: { lineCap: 'round' }
    };
    var el = document.querySelector('#feeRadialChart');
    if (!el) return;
    if (feeRadialChart) { feeRadialChart.destroy(); }
    feeRadialChart = new ApexCharts(el, opts);
    feeRadialChart.render();
    document.getElementById('radial-collected').textContent = formatKsh(collected);
    document.getElementById('radial-target').textContent = formatKsh(total);
}

/* ===== INIT FEE COLLECTIONS AREA CHART ===== */
function initFeeCollectionsChart(labels, data) {
    var opts = {
        series: [{ name: 'Fee Collected (Ksh)', data: data }],
        chart: { type: 'area', height: 280, fontFamily: 'Inter, sans-serif', toolbar: { show: false }, zoom: { enabled: false } },
        colors: ['#6366f1'],
        fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.5, opacityTo: 0.05, stops: [0, 100] } },
        stroke: { curve: 'smooth', width: 3 },
        xaxis: { categories: labels, labels: { style: { fontSize: '11px', colors: '#94a3b8' } }, axisBorder: { show: false }, axisTicks: { show: false } },
        yaxis: { labels: { formatter: function(v) { return 'Ksh ' + (v/1000).toFixed(0) + 'K'; }, style: { colors: '#94a3b8', fontSize: '11px' } } },
        grid: { borderColor: '#f1f5f9', strokeDashArray: 4 },
        tooltip: { y: { formatter: function(v) { return 'Ksh ' + Number(v).toLocaleString(); } } },
        markers: { size: 4, colors: ['#fff'], strokeColors: '#6366f1', strokeWidth: 3, hover: { size: 6 } },
        dataLabels: { enabled: false }
    };
    var el = document.querySelector('#feeCollectionsChart');
    if (!el) return;
    if (feeCollectionsChart) { feeCollectionsChart.destroy(); }
    feeCollectionsChart = new ApexCharts(el, opts);
    feeCollectionsChart.render();
}

/* ===== INIT ENROLLMENTS BAR CHART ===== */
function initEnrollmentsBarChart(labels, data) {
    var opts = {
        series: [{ name: 'New Trainees', data: data }],
        chart: { type: 'bar', height: 280, fontFamily: 'Inter, sans-serif', toolbar: { show: false } },
        colors: ['#f59e0b'],
        plotOptions: { bar: { borderRadius: 8, columnWidth: '50%' } },
        fill: { type: 'gradient', gradient: { shade: 'light', type: 'vertical', gradientToColors: ['#fbbf24'], stops: [0, 100] } },
        xaxis: { categories: labels, labels: { style: { fontSize: '11px', colors: '#94a3b8' } }, axisBorder: { show: false }, axisTicks: { show: false } },
        yaxis: { labels: { style: { colors: '#94a3b8', fontSize: '11px' } } },
        grid: { borderColor: '#f1f5f9', strokeDashArray: 4 },
        tooltip: { y: { formatter: function(v) { return v + ' trainees'; } } },
        dataLabels: { enabled: false }
    };
    var el = document.querySelector('#enrollmentsBarChart');
    if (!el) return;
    if (enrollmentsBarChart) { enrollmentsBarChart.destroy(); }
    enrollmentsBarChart = new ApexCharts(el, opts);
    enrollmentsBarChart.render();
}

/* ===== FETCH & POPULATE DASHBOARD ===== */
$(document).ready(function () {

    /* Only run admin chart code when the admin dashboard containers exist */
    if (!document.getElementById('feeCollectionsChart')) return;

    function fetchAdminStats() {
        $.ajax({
            type: 'GET', url: "{{ route('fetchAdminDashboardUpdates') }}", dataType: 'json',
            success: function (res) {
                $('#totalExpectedFee').text(formatKsh(res.totalExpectedFee));
                $('#totalFeePaid').text(formatKsh(res.totalFeePaid));
                $('#balanceToPay').text(formatKsh(res.balanceToPay));
                $('#total_admin').text(res.total_admin);
                $('#total_trainees').text(res.total_trainees);
                $('#total_trainer').text(res.total_trainer);
                $('#total_courses').text(res.total_courses);
                if (document.getElementById('userDistributionChart')) {
                    initUserDistributionChart(parseInt(res.total_admin)||0, parseInt(res.total_trainees)||0, parseInt(res.total_trainer)||0, parseInt(res.total_courses)||0);
                }
                if (document.getElementById('feeRadialChart')) {
                    initFeeRadialChart(parseFloat(res.totalFeePaid)||0, parseFloat(res.totalExpectedFee)||0);
                }
            },
            error: function (err) { console.error('Dashboard stats error:', err); }
        });
    }

    function fetchFeeCollections() {
        $.ajax({
            type: 'GET', url: "{{ route('monthly.fee.collections') }}", dataType: 'json',
            success: function (data) {
                var labels = data.map(function(d) { return d.month; });
                var values = data.map(function(d) { return parseFloat(d.total) || 0; });
                if (labels.length === 0) { labels = ['No Data']; values = [0]; }
                initFeeCollectionsChart(labels, values);
            },
            error: function () { initFeeCollectionsChart(['No Data'], [0]); }
        });
    }

    function fetchEnrollments() {
        $.ajax({
            type: 'GET', url: "{{ route('monthly.enrollments') }}", dataType: 'json',
            success: function (data) {
                var labels = data.map(function(d) { return d.month; });
                var values = data.map(function(d) { return parseInt(d.total) || 0; });
                if (labels.length === 0) { labels = ['No Data']; values = [0]; }
                initEnrollmentsBarChart(labels, values);
            },
            error: function () { initEnrollmentsBarChart(['No Data'], [0]); }
        });
    }

    fetchAdminStats();
    fetchFeeCollections();
    fetchEnrollments();
    setInterval(fetchAdminStats, 30000);
});
</script>

@endsection
