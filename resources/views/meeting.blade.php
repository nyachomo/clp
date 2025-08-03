@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Class Meeting</div>

                <div class="card-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe 
                            src="{{ $meetingUrl }}?authuser={{ auth()->user()->email }}" 
                            frameborder="0" 
                            allowfullscreen
                            class="embed-responsive-item"
                        ></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection