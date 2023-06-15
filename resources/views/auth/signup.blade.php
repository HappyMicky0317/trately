<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        {{__('Signup')}}-{{config('app.name')}}
    </title>
    @if(!empty($super_settings['favicon']))

        <link rel="icon" type="image/png" href="{{PUBLIC_DIR}}/uploads/{{$super_settings['favicon']}}">
    @endif
    <link id="pagestyle" href="{{PUBLIC_DIR}}/css/app.css" rel="stylesheet"/>

    @if(!empty($super_settings['config_recaptcha_in_user_signup']))
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif
</head>
<body class="g-sidenav-show  bg-gray-100">
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

<section class="min-vh-100">
    <div class="row my-6">
        <div class="col-md-7">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="text-center mx-auto">
                        <h1 class=" text-purple mb-4 mt-10">{{__('“Play by the rules, but be ferocious.” ')}}</h1>
                        <h6 class="text-lead text-success">{{__('– Phil Knight')}}</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="container">
                <div class=" card z-index-0 mt-5">
                    <div class="card-header text-start pt-4">
                        <h4>{{__('SignUp')}}</h4>
                    </div>
                    <div class="card-body">
                        <form role="form text-left" method="post" action="/signup">
                            @if (session()->has('status'))
                                <div class="alert alert-success">
                                    {{session('status')}}
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
                            <label>{{__('First Name')}}</label>
                            <div class="mb-3">
                                <input name="first_name" class="form-control" type="text" placeholder="First name"
                                       aria-describedby="email-addon">
                            </div>
                            <label>{{__('Last Name')}}</label>
                            <div class="mb-3">
                                <input type="text" name="last_name" class="form-control" placeholder="Last name"
                                       aria-describedby="email-addon">
                            </div>
                            <label>{{__('Email')}}</label>
                            <div class="mb-3">
                                <input type="email" placeholder="Email" name="email" class="form-control"
                                       aria-label="Email" aria-describedby="email-addon">
                            </div>
                            <label>{{__('Choose Password')}}</label>
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Password"
                                       aria-label="Password" aria-describedby="password-addon">
                            </div>
                                @if(!empty($super_settings['config_recaptcha_in_user_signup']))
                                    <div class="g-recaptcha" data-sitekey="{{$super_settings['recaptcha_api_key']}}">

                                    </div>
                                @endif
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="{{ url('/auth/google') }}" class="btn btn-primary">
                                        <i class="fa fa-google"></i>
                                        Sign in with Google
                                    </a>
                                </div>
                            @csrf
                            <div class="text-start">
                                <button type="submit" class="btn btn-info  my-4 mb-2">{{__('Sign up')}}</button>
                            </div>
                            <p class="text-sm mt-3 mb-0">{{__('Already have an account?')}} <a href="/login"
                                                                                               class="text-dark font-weight-bolder">{{__('Sign in')}}</a>
                            </p>
                        </form>
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
