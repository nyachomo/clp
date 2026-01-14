@extends('layouts.master')
@section('content')

<style>
    .card{
        border-radius:20px;
    }

    .user_account_card_heading{
        
         background: linear-gradient(to right, #00264d, #ff0080);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        display: inline-block; /* Optional: ensures proper sizing */
    }

    progress {
        width: 300px;
        height: 20px;
        border: none;
        border-radius: 10px;
        background-color: #f0f0f0; /* Track color */
    }

        /* Webkit/Blink browsers (Chrome, Safari, Edge) */
        progress::-webkit-progress-bar {
        background-color: #f0f0f0;
        border-radius: 10px;
    }

    progress::-webkit-progress-value {
        background-color: #00cc99 !important;
        border-radius: 10px;
    }

    /* Firefox */
    progress::-moz-progress-bar {
        background-color: #00cc99;
        border-radius: 10px;
    }

    .course-outline-btn{
        background-color:#00cc99;
        color:white;
    }

     .course-outline-btn:hover{
        background-color:#ff0080;
        color:white;
    }





/* Card */
.course-card {
    border: none;
    border-radius: 20px;
    overflow: hidden;
    background: #ffffff;
    box-shadow: 0 18px 40px rgba(0, 0, 0, 0.18);
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}

.course-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.28);
}

/* Animated Gradient Header */
.course-card .card-header {
    background: linear-gradient(
        270deg,
        #00264d,
        #ff0080,
        #00264d
    );
    background-size: 400% 400%;
    animation: gradientMove 8s ease infinite;
    color: #fff;
    padding: 20px 22px;
    border-bottom: none;
}

/* Header layout */
.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.course-card .card-header h5 {
    margin: 0;
    font-weight: 700;
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Progress badge */
.progress-badge {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(6px);
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* Body */
.course-card .card-body {
    padding: 25px;
}

.course-card p {
    color: #444;
    line-height: 1.7;
    font-size: 15px;
}

/* Progress bar */
.course-progress {
    height: 8px;
    border-radius: 30px;
    background: #e9ecef;
    overflow: hidden;
    margin-bottom: 18px;
}

.course-progress .progress-bar {
    background: linear-gradient(90deg, #00264d, #ff0080);
    border-radius: 30px;
    animation: progressGlow 2s ease-in-out infinite alternate;
}

/* Button footer */
.course-outline-btn-footer {
    display: flex;
    justify-content: space-between;
    gap: 15px;
    margin-top: 25px;
}

/* Buttons */
.course-outline-btn-footer .btn {
    flex: 1;
    padding: 12px 18px;
    border-radius: 30px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

/* Outline button */
.btn-outline-primary {
    border: 2px solid #00264d;
    color: #00264d;
    background: transparent;
}

.btn-outline-primary:hover {
    background: #00264d;
    color: #fff;
    transform: translateY(-2px);
}

/* Gradient button */
.btn-gradient {
    background: linear-gradient(135deg, #00264d, #ff0080);
    color: #fff;
    border: none;
}

.btn-gradient:hover {
    background: linear-gradient(135deg, #ff0080, #00264d);
    transform: translateY(-2px);
    box-shadow: 0 10px 22px rgba(255, 0, 128, 0.4);
}

/* Animations */
@keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

@keyframes progressGlow {
    from { opacity: 0.85; }
    to { opacity: 1; }
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