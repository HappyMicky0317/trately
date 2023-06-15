<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
    {{__('Login')}}-{{config('app.name')}}
</title>
@if(!empty($super_settings['favicon']))

<link rel="icon" type="image/png" href="{{PUBLIC_DIR}}/uploads/{{$super_settings['favicon']}}">
@endif
<link id="pagestyle" href="{{PUBLIC_DIR}}/css/app.css" rel="stylesheet"/>

@if(!empty($super_settings['config_recaptcha_in_user_login']))
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endif

</head>
<body class="g-sidenav-show">

@if(($super_settings['landingpage'] ?? null) === 'Default')
<nav class="navbar navbar-expand-lg top-0 z-index-3 w-100 shadow-blur  bg-gray-100 fixed-top ">
<div class="container mt-1">

    <a class="navbar-brand text-dark bg-transparent fw-bolder" href="/" rel="tooltip" title="" data-placement="bottom">
        @if(!empty($super_settings['logo']))
            <img src="{{PUBLIC_DIR}}/uploads/{{$super_settings['logo']}}" class="navbar-brand-img h-100" style="max-height: {{$super_settings['frontend_logo_max_height'] ?? '30'}}px;" alt="...">
        @else
            <span class=" font-weight-bold">{{config('app.name')}}</span>
        @endif
    </a>

    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon mt-2">
<span class="navbar-toggler-bar bar1"></span>
<span class="navbar-toggler-bar bar2"></span>
<span class="navbar-toggler-bar bar3"></span>
</span>
    </button>

    <div class="collapse  navbar-collapse w-100 pt-3 pb-2 py-lg-0 ms-lg-12 " id="navigation">
        <ul class="navbar-nav bg-transparent navbar-nav-hover w-100">

            <li class="nav-item float-end ms-5 ms-lg-auto">
                <a  href="/" class="fw-bolder h6 ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                    {{__('Home')}}

                </a>
            </li>

            <li class="nav-item float-end ms-5 ms-lg-auto">
                <a class=" fw-bolder h6 ps-2 d-flex justify-content-between cursor-pointer align-items-center me-2" href="/pricing" target="_blank">
                    {{__('Pricing')}}

                </a>
            </li>
            <li class="nav-item float-end ms-5 ms-lg-auto">
                <a class=" fw-bolder h6 ps-2 d-flex justify-content-between cursor-pointer align-items-center me-2" href="/blog" target="_blank">
                    {{__('Blog')}}

                </a>
            </li>
            <li class="nav-item float-end ms-5 ms-lg-auto">
                <a class="fw-bolder h6 ps-2 d-flex justify-content-between cursor-pointer align-items-center me-5" href="/login" target="_blank">

                    {{__('Login')}}

                </a>
            </li>

            <li class="nav-item my-auto ms-3 ms-lg-0">
                <a href="/signup" class="btn bg-dark text-white mb-0 me-1 mt-2 mt-md-0">{{__('Sign Up for free')}}</a>
            </li>
        </ul>
    </div>
</div>
</nav>
@endif

<section>
<div class="page-header  section-height-75">
<div class="container ">
    <div class="row">
        <div class="col-md-5 d-flex flex-column mx-auto">
            <div class="card card-info mt-8">
                <div class="card-header pb-0 text-center ">

                    <h3 class="font-weight-bolder text-purple">
                        {{__('Login')}}

                    </h3>
                    <p class="mb-0">
                        {{__('Enter your email and password to login')}}

                    </p>
                </div>
                <div class="card-body">
                    <form role="form text-left" method="post" action="/login">

                        @if (session()->has('status'))
                            <div class="alert alert-success">
                                {{session('status')}}
                            </div>
                        @endif
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{session('error')}}
                                </div>
                            @endif

                        @if ($errors->any())
                            <div class="alert bg-pink-light text-danger">
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <label>{{__('Email')}}</label>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" value="{{old('email')}}"
                                   aria-label="Email" aria-describedby="email-addon">
                        </div>
                        <label>{{__('Password')}}</label>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password"
                                   aria-label="Password" aria-describedby="password-addon">
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="remember" type="checkbox" id="rememberMe"
                                   checked="">
                            <label class="form-check-label" for="rememberMe">
                                {{__('Remember me')}}</label>
                        </div>
                            @if(!empty($super_settings['config_recaptcha_in_user_login']))
                                <div class="g-recaptcha" data-sitekey="{{$super_settings['recaptcha_api_key']}}">

                                </div>
                            @endif
                            <div class="d-flex justify-content-center align-items-center">
                                <a href="{{ url('/auth/google') }}" class="btn btn-primary">
                                    <i class="fa fa-google"></i>
                                    Sign in with Google
                                </a>
                            </div>
                        <div class="text-center">
                            @csrf
                            <button type="submit"
                                    class="btn btn-info w-100 mt-4 mb-0">{{__('Sign in')}}</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                    <p class="mb-4 text-sm mx-auto">
                        {{__('Forgot Password?')}}
                        <a href="/forgot-password"
                           class="text-purple font-weight-bold">{{__('Reset Password')}}</a>
                    </p>
                    <p class="text-sm mt-3 mb-0">{{__('Do not have an account?')}} <a href="/signup"
                                                                                       class="text-dark font-weight-bolder">{{__('Register')}}</a>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</section>

<script>
(function(){
"use strict";

var win = navigator.platform.indexOf('Win') > -1;
if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
        damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
}
})();

</script>


</body>

</html>
