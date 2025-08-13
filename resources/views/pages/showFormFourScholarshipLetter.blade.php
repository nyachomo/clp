@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                <center>
                     <img src="{{asset('images/logo/logo.jpeg')}}" width="120px">
                     <h1 style="color:#07294d">TECHSPHERE TRAINING INSTITUTE</h1>
                     <p style="font-size:20px; border-bottom:4px solid #07294d">
                        View Park Towers 17th Floor, University way | P. O. Box 1334-00618, Nairobi<br>
                        Web:   <b style="color:blue;"><u>https://www.techsphereinstitute.co.ke</u></b>   |Email: <b style="color:blue;"><u>Info@techsphereinstitute.co.ke </u></b>|<br>
                        Phone: <b style="color:#33d6ff">+254768919307</b>

                     </p>
                </center>
                <p>01/02/2025</p>

                @if(!empty($letter))
                  <?php echo$letter->form_four?>
                @endif
               

            </div>
        </div>
    </div>
    <div class="col-sm-1"></div>
</div>
@endsection