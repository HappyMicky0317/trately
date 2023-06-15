<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @if(!empty($settings['favicon']))

        <link rel="icon" type="image/png" href="{{PUBLIC_DIR}}/uploads/{{$settings['favicon']}}">
    @endif
    <title>
        {{config('app.name')}}
    </title>

    <link id="pagestyle" href="{{PUBLIC_DIR}}/css/app.css?v=487" rel="stylesheet"/>

    <script>
        window.public_dir = "{{PUBLIC_DIR}}";
        window.business_name = "{{config('app.name')}}";
        window.csrf_token = "{{csrf_token()}}";
        @if(!empty($settings['ltoken']))
            window.ltoken = "{{$settings['ltoken']}}";
        @endif
    </script>

    @yield('head')

</head>

<body class="g-sidenav-show   bg-gray-100" id="clx_body">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0  fixed-left" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute right-0 top-0 d-none d-xl-none"
           aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{config('app.url')}}/super-admin/dashboard">
            @if(!empty($settings['logo']))
                <img src="{{PUBLIC_DIR}}/uploads/{{$settings['logo']}}" class="navbar-brand-img h-100" alt="...">
            @else
                <span class="ms-1 font-weight-bold"> {{config('app.name')}}</span>
            @endif
        </a>
    </div>
    <hr class="horizontal dark mt-0">

    <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link @if(($selected_navigation ?? '') === 'sdashboard') active @endif"
                   href="/super-admin/dashboard">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-home">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <span class="nav-link-text ms-3">{{ __('Dashboard') }}</span>
                </a>
            </li>
            <li class="nav-item mt-4 mb-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-muted font-weight-bolder opacity-6">{{__('Plans & Users')}}  </h6>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(($selected_navigation ?? '') === 'saas-plans') active @endif "
                   href="/subscription-plans">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-box">
                        <path
                            d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                    <span class="nav-link-text ms-3">{{__('Plans')}}</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(($selected_navigation ?? '') === 'workspaces') active @endif" href="/workspaces">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-briefcase">
                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                    </svg>
                    <span class="nav-link-text ms-3">{{__('Workspaces')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(($selected_navigation ?? '') === 'users') active @endif " href="/users">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-users">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span class="nav-link-text ms-3">{{__('Users')}}</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link @if(($selected_navigation ?? '') === 'notice') active @endif "
                   href="/notice-list">


                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                    <span class="nav-link-text ms-3">{{__('Notice Board')}}</span>
                </a>
            </li>


            <li class="nav-item mt-4 mb-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-muted font-weight-bolder opacity-6">{{__('Settings')}}  </h6>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(($selected_navigation ?? '') === 'payment-gateways') active @endif "
                   href=" /payment-gateways">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-credit-card">
                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                        <line x1="1" y1="10" x2="23" y2="10"></line>
                    </svg>
                    <span class="nav-link-text ms-3">{{__('Payment Gateways')}}</span>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link @if(($selected_navigation ?? '') === 'email-settings') active @endif  "
                   href="/email-setting">


                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                    <span class="nav-link-text ms-3">{{__('Email Settings')}}</span>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link @if(($selected_navigation ?? '') === 'settings') active @endif  "
                   href="/super-admin-setting">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-settings">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path
                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                    </svg>
                    <span class="nav-link-text ms-3">{{__(' Settings')}}</span>
                </a>
            </li>


            <li class="nav-item mt-4 mb-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-muted font-weight-bolder opacity-6">{{__('Frontend Website')}} </h6>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(($selected_navigation ?? '') === 'landing-page') active @endif "
                   href="/landingpage">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                    <span class="nav-link-text ms-3">{{__('Landing Page')}}</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(($selected_navigation ?? '') === 'blogs') active @endif "
                   href="/blogs">


                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    <span class="nav-link-text ms-3">{{__('Blogs')}}</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(($selected_navigation ?? '') === 'privacy-page-editor') active @endif " href="/privacypage">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>

                    <span class="nav-link-text ms-3">{{__('Privacy Policy')}}</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(($selected_navigation ?? '') === 'terms') active @endif " href="/termspage">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-minus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="9" y1="15" x2="15" y2="15"></line></svg>

                    <span class="nav-link-text ms-3">{{__('Terms & Condition')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(($selected_navigation ?? '') === 'cookie') active @endif " href="/cookiepage">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    <span class="nav-link-text ms-3">{{__('Cookie Policy')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(($selected_navigation ?? '') === 'footer') active @endif " href="/footer">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-compass"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>

                    <span class="nav-link-text ms-3">{{__('Footer')}}</span>
                </a>
            </li>



            <li class="nav-item mt-3 ">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-muted font-weight-bolder opacity-6">{{__('My Account')}} </h6>
            </li>
            <li class="nav-item mb-4 ">
                <a class="nav-link @if(($selected_navigation ?? '') === 'profile') active @endif "
                   href="/super-admin-profile">

                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-user">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span class="nav-link-text ms-3">{{__('My Profile')}}</span>
                </a>
            </li>
            <li class="mb-4 ms-5">
                <a class="btn btn-warning " type="button" href="/logout">


                    <span class="">{{__('Logout')}}</span>
                </a>
            </li>

        </ul>
    </div>

</aside>
<main class="main-content mt-1 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0"></h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group">
                    </div>
                </div>
                <ul class=" justify-content-end">
                    <li class="nav-item px-3 d-flex align-items-center">
                    </li>
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid" id="main_content">

        @if(session('error'))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {!! session('error') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        @endif

        @yield('content')
    </div>
</main>

<!--   Core JS Files   -->
<script src="{{PUBLIC_DIR}}/js/app.js?v=64"></script>
<script src="{{PUBLIC_DIR}}/lib/tinymce/tinymce.min.js?v=54"></script>

<script>
    "use strict"
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
@yield('script')
</body>
</html>

