@extends('layouts.master')
@section('content')
<br>
<div class="container-fliud">
<iframe 
    src="https://8x8.vc/vpaas-magic-cookie-fa422a39574648a2b419082d4b2e784b/{{$meeting->meeting_name}}#jwt={{$meeting->jwt_link}}&userInfo.displayName=<?php echo urlencode($userName); ?>&userInfo.email=<?php echo urlencode($userEmail); ?>"
    style="width:100%; height:100vh; border:0;" 
    allow="camera; microphone; fullscreen; display-capture">
</iframe>
</div>


@endsection