<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @if(!empty($super_settings['favicon']))

        <link rel="icon" type="image/png" href="{{PUBLIC_DIR}}/uploads/{{$super_settings['favicon']}}">
    @endif


    <title>
        @yield('title')-{{config('app.name')}}
    </title>

    <link id="pagestyle" href="{{PUBLIC_DIR}}/css/app.css?v=2" rel="stylesheet"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @if(!empty($super_settings['meta_description']))

        <meta name="description" content="{!! $super_settings['meta_description'] !!}" />
    @endif


    @if(!empty($super_settings['custom_script']))
        {!! $super_settings['custom_script'] !!}
    @endif
</head>


<body class="about-us">

<!-- Navbar Transparent -->
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
                    <a  href="" class="fw-bolder h6 ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                        {{__('Home')}}

                    </a>
                </li>

                <li class="nav-item float-end ms-5 ms-lg-auto">
                    <a class=" fw-bolder h6 ps-2 d-flex justify-content-between cursor-pointer align-items-center me-2" href="/pricing">
                        {{__('Pricing')}}

                    </a>
                </li>
                <li class="nav-item float-end ms-5 ms-lg-auto">
                    <a class=" fw-bolder h6 ps-2 d-flex justify-content-between cursor-pointer align-items-center me-2" href="/blog">
                        {{__('Blog')}}

                    </a>
                </li>
                <li class="nav-item float-end ms-5 ms-lg-auto">
                    <a class="fw-bolder h6 ps-2 d-flex justify-content-between cursor-pointer align-items-center me-5" href="/login">

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

@yield('content')

<footer class="footer bg-dark text-white pt-5 ">

    <hr class="horizontal dark ">

    <div class="container mt-4 ">
        <div class="row">
            <div class="col-md-6 mb-4 ms-auto">
                <div>

                    <h4 class="text-white font-weight-bolder">
                        @if (!empty($contact))
                            {{$contact->title}}
                        @endif
                    </h4>

                </div>

                <p class="text-muted">
                    @if (!empty($contact))
                        {{$contact->subtitle}}
                    @endif


                </p>

                @if (!empty($contact))
                    <h6  class="text-white">{{__('Contact Us')}}</h6>
                    {{$contact->address_1}}
                @endif
                <br>
                @if (!empty($contact))
                    Email:
                    {{$contact->email}}
                @endif
                <br>
                @if (!empty($contact))
                    Phone:
                    {{$contact->phone_number}}
                @endif



                <div class="">

                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-6 mb-4 text-end mt-3">
                <ul class="flex-column ms-n3 nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/termsandconditions">
                            <h6 class="text-white text-sm">{{__('Terms & Condition')}}</h6>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link text-white" href="/privacy">
                            <h6 class="text-white text-sm">{{__('Privacy Policy')}}</h6>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link text-white" href="/cookie-policy">
                            <h6 class="text-white text-sm">{{__('Cookie Policy')}}</h6>
                        </a>
                    </li>
                    <li class="nav-item mt-6">
                        <a class=" nav-link text-white" href="#" target="_blank">
                            <h6 class="text-white text-sm">{{__('Connect with us')}}</h6>
                        </a>
                    </li>
                    <ul class="flex-row-reverse me-2 nav">
                        @if (!empty($contact))
                            <li class="nav-item">
                                <a class="nav-link pe-1 text-white" href="{{$contact->facebook}}" target="_blank">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                                </a>
                            </li>
                        @endif

                        @if (!empty($contact))
                            <li class="nav-item">
                                <a class="nav-link pe-1 text-white" href="{{$contact->twitter}}" target="_blank">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                                    </svg>
                                </a>
                            </li>
                        @endif


                        @if (!empty($contact))
                            <li class="nav-item">
                                <a class="nav-link pe-1 text-white" href="{{$contact->youtube}}" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-youtube"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon></svg>
                                </a>
                            </li>
                        @endif


                    </ul>
                </ul>
            </div>

            <div class="col-12">
                <div class="text-start">
                    <p class="my-4 text-sm">
                        All rights reserved. Copyright © <script>
                            document.write(new Date().getFullYear())
                        </script>  by  @if (!empty($contact))
                            {{$contact->title}}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>


<script src="{{PUBLIC_DIR}}/js/app.js?v=93"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    AOS.init();
</script>
@yield('script')

</body>

</html>
