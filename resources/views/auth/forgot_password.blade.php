<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8" />
        <title>Forgot Password</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <link rel="icon" type="image/jpeg" href="{{asset('website/logo/logo.jpeg')}}" >
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style"/>

        <style>
            strong{
                color:red;
            }
        </style>
</head>

<body class="loading authentication-bg" data-layout-config='{"darkMode":false}'>
        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-4 col-lg-5">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="text-center w-75 m-auto">
                                    <img src="{{asset('website/logo/logo.jpeg')}}" alt="" height="120">
                                    <h4 class="text-dark-50">TECHSPHERE  INSTITUTE</h4>
                                    <h4 class="text-dark-50 text-center pb-0 fw-bold">FORGOT PASSWORD</h4>
                                </div>

                                @if (session('status'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{ session('status') }}</strong>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('quick.password.start') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input id="email" type="email" class="form-control @if($errors->has('email')) is-invalid @endif" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @if($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="mb-3 mb-0">
                                        <button class="btn btn-primary" type="submit"> Continue </button>
                                        <button class="btn btn-success" style="float:right"> <a href="{{route('login')}}" style="color:white">Back To Login</a></button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>
</body>

</html>
