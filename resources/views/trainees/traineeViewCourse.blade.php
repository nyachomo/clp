@extends('layouts.master')
@section('content')

<style>
  /* ===== Global Card Styling ===== */
.card {
    border-radius: 22px;
    border: none;
}

/* ===== Page Header Card ===== */
.user_account_card {
    background: linear-gradient(135deg, #00264d, #ff0080);
    color: #fff;
    box-shadow: 0 25px 55px rgba(0, 0, 0, 0.25);
}

.user_account_card p {
    opacity: 0.92;
    font-weight: 500;
}

/* Gradient Heading */
.user_account_card_heading {
    font-weight: 800;
    letter-spacing: 0.6px;
    background: linear-gradient(to right, #ffffff, #ffd6ea);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* ===== Download Button (Top) ===== */
.course-outline-btn {
    background: linear-gradient(135deg, #00cc99, #00e6b8);
    color: #fff;
    border-radius: 35px;
    padding: 12px 22px;
    font-weight: 700;
    transition: all 0.3s ease;
    box-shadow: 0 10px 22px rgba(0, 204, 153, 0.4);
}

.course-outline-btn:hover {
    background: linear-gradient(135deg, #ff0080, #00264d);
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(255, 0, 128, 0.45);
}

/* ===== Course Card ===== */
.course-card {
    border-radius: 22px;
    overflow: hidden;
    background: #ffffff;
    box-shadow: 0 18px 45px rgba(0, 0, 0, 0.18);
    margin-bottom: 30px;
    transition: all 0.4s ease;
}

.course-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 35px 70px rgba(0, 0, 0, 0.3);
}

/* ===== Animated Gradient Header ===== */
.course-card .card-header {
    background: linear-gradient(270deg, #00264d, #ff0080, #00264d);
    background-size: 400% 400%;
    animation: gradientMove 9s ease infinite;
    padding: 22px 25px;
    color: #fff;
}

/* Header layout */
.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
}

.course-card .card-header h5 {
    font-weight: 700;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* ===== Progress Badge ===== */
.progress-badge {
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(8px);
    padding: 7px 16px;
    border-radius: 25px;
    font-size: 13px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
}

/* ===== Card Body ===== */
.course-card .card-body {
    padding: 28px;
}

.course-card p {
    color: #444;
    font-size: 15px;
    line-height: 1.8;
}

/* ===== Progress Bar ===== */
.course-progress {
    height: 10px;
    border-radius: 30px;
    background: #e9ecef;
    overflow: hidden;
    margin-bottom: 20px;
}

.course-progress .progress-bar {
    background: linear-gradient(90deg, #00264d, #ff0080);
    border-radius: 30px;
    animation: progressGlow 2s ease-in-out infinite alternate;
}

/* ===== Buttons Footer ===== */
.course-outline-btn-footer {
    display: flex;
    gap: 18px;
    margin-top: 28px;
}

/* Buttons */
.course-outline-btn-footer .btn {
    flex: 1;
    padding: 13px 20px;
    border-radius: 35px;
    font-weight: 700;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.3s ease;
}

/* Outline Button */
.btn-outline-primary {
    border: 2px solid #00264d;
    color: #00264d;
}

.btn-outline-primary:hover {
    background: #00264d;
    color: #fff;
    transform: translateY(-3px);
}

/* Gradient Button */
.btn-gradient {
    background: linear-gradient(135deg, #00264d, #ff0080);
    color: #fff;
    border: none;
}

.btn-gradient:hover {
    background: linear-gradient(135deg, #ff0080, #00264d);
    transform: translateY(-3px);
    box-shadow: 0 12px 25px rgba(255, 0, 128, 0.45);
}

/* ===== Animations ===== */
@keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

@keyframes progressGlow {
    from { opacity: 0.85; }
    to { opacity: 1; }
}

/* ===== Mobile Optimization ===== */
@media (max-width: 768px) {
    .header-content {
        flex-direction: column;
        align-items: flex-start;
    }

    .course-outline-btn-footer {
        flex-direction: column;
    }

    .course-outline-btn {
        width: 100%;
        text-align: center;
    }
}

</style>

<br>
<!-- start page title 
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashborad</a></li>
                    <li class="breadcrumb-item active">Manage Course</li>
                </ol>
            </div>
            <h4 class="page-title">My Course</h4>
        </div>
    </div>
</div>-->


<div class="row">
    <div class="col-sm-12">
        <div class="card user_account_card">
            <div class="card-body">
                <div class="row">
                     <div class="col-sm-9">

                        <h2 class="user_account_card_heading">Course  Management</h2>
                        <p>Manage Your Personal Account</p>
                        <p>Total Course (s): 1</p>
                        <p>Name: {{$course->course_name??'NA'}}</p>

                     </div>
                     <div class="col-sm-3">
                        <div class="course-outline-download" style="margin-top:70px">
                            <a class="btn course-outline-btn"><i class="fa fa-download"></i> <b>Download Course Outline</b></a>
                        </div>
                         
                     </div>
                </div>
                
            </div>
        </div>
    </div>
</div>


<div class="row">
    


   @if(!empty($modules))
      @foreach($modules as $key=>$module)
        <div class="card course-card">
            <div class="card-header">
                <div class="header-content">
                    <h5><i class="fa fa-layer-group"></i> {{$key+1}}. {{$module->module_name}}</h5>

                    <!-- Progress Badge -->
                    <span class="progress-badge">
                        <i class="fa fa-chart-line"></i> 65% Complete
                    </span>
                </div>
            </div>

            <div class="card-body">
                <!-- Progress bar -->
                <div class="progress course-progress">
                    <div class="progress-bar" style="width:65%"></div>
                </div>

                <p>
                    <?php echo$module->module_content?>
                </p>

                <div class="course-outline-btn-footer">
                    <a href="{{ url('/trainees/view-notes/' . $module->id) }}" class="btn btn-outline-primary">
                        <i class="fa fa-book-open"></i> Read Notes
                    </a>

                    <a href="#" class="btn btn-gradient">
                        <i class="fa fa-download"></i> Download Content
                    </a>
                </div>
            </div>
        </div>
      @endforeach
    @endif





</div>



@endsection