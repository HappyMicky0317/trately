<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>
        {{config('app.name')}}
    </title>

    <link id="pagestyle" href="{{PUBLIC_DIR}}/css/app.css?v=1128" rel="stylesheet"/>


    @yield('head')



</head>

<body class="g-sidenav-show  bg-gray-100" id="clx_body">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0  fixed-left " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute right-0 top-0 d-none d-xl-none"
           aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{config('app.url')}}/dashboard">
            @if(!empty($super_settings['logo']))
                <img src="{{PUBLIC_DIR}}/uploads/{{$super_settings['logo']}}" class="navbar-brand-img h-100" alt="...">
            @else
                <span class="ms-1 font-weight-bold"> {{config('app.name')}}</span>
            @endif
        </a>
    </div>
    <div class=" text-center">
        @if(!empty($user->photo))
            <a href="javascript:" class="avatar avatar-md rounded-circle border border-secondary">
                <img alt="" class="p-1" src="{{PUBLIC_DIR}}/uploads/{{$user->photo}}">
            </a>
        @else
            <div class="avatar avatar-md  rounded-circle bg-purple-light  border-radius-md p-2">
                <h6 class="text-purple text-uppercase mt-1">{{$user->first_name[0]}}{{$user->last_name[0]}}</h6>
            </div>


        @endif
        <a href="/profile" class=" nav-link text-body font-weight-bold px-0">
            <span
                class="d-sm-inline d-none ">@if (!empty($user)) {{$user->first_name}} {{$user->last_name}}@endif</span>
        </a>

    </div>
    <hr class="horizontal dark mt-0">

    <div class="collapse navbar-collapse  w-auto  d-print-none " id="sidenav-collapse-main">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link @if(($selected_navigation ?? '') === 'dashboard') active @endif" href="/dashboard">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-home">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <span class="nav-link-text ms-3">{{ __('Dashboard') }}</span>
                </a>


            </li>
            <li class="nav-item mt-3 mb-2">
                <h6 class="ps-4 ms-2 text-uppercase text-muted text-xs opacity-6">{{__('Product Planning')}} </h6>
            </li>



            @if(empty($modules) || in_array('projects',$modules))
                <li class="nav-item ">
                    <a class="nav-link @if(($selected_navigation ?? '') === 'projects') active @endif "
                       href="/projects">

                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-grid">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                        <span class="nav-link-text ms-3">{{__('Product Planning')}}</span>
                    </a>
                </li>

            @endif
            @if(empty($modules) || in_array('to_dos',$modules))

                <li class="nav-item ">
                    <a class="nav-link @if(($selected_navigation ?? '') === 'todos') active @endif "
                       href="{{route('admin.tasks', ['action' => 'list'])}}">

                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-check-circle">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        <span class="nav-link-text ms-3">{{__('Tasks')}}</span>
                    </a>
                </li>


            @endif

            @if(empty($modules) || in_array('calendar',$modules))

                <li class="nav-item">
                    <a class="nav-link @if(($selected_navigation ?? '') === 'calendar') active @endif" href="/calendar">

                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-calendar">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <span class="nav-link-text ms-3">{{__('Calendar')}}</span>
                    </a>
                </li>
            @endif

            @if(empty($modules) || in_array('brainstorm',$modules))
                <li class="nav-item">
                    <a class="nav-link @if(($selected_navigation ?? '') === 'brainstorm') active @endif" href="/brainstorming-list">

                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-edit-2">
                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                        </svg>
                        <span class="nav-link-text ms-3">{{__('Ideation Canvas')}}</span>
                    </a>
                </li>

            @endif

            <li class="nav-item mt-3 mb-2">
                <h6 class="ps-4 ms-2 text-uppercase text-muted text-xs opacity-6">{{__('Contacts')}} </h6>
            </li>

            @if(empty($modules) || in_array('investors',$modules))

                <li class="nav-item ">
                    <a class="nav-link @if(($selected_navigation ?? '') === 'investors') active @endif " href="/investors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                        <span class="nav-link-text text-end ms-3 ">{{__('Investors')}}</span>
                    </a>
                </li>
            @endif


            <li class="nav-item mt-3 mb-2">
                <h6 class="ps-4 ms-2 text-uppercase text-muted text-xs opacity-6">{{__('Business Models')}} </h6>
            </li>



            @if(empty($modules) || in_array('business_model',$modules))

                <li class="nav-item ">
                    <a class="nav-link @if(($selected_navigation ?? '') === 'business-models') active @endif "
                       href="/business-models">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-briefcase">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                        </svg>
                        <span class="nav-link-text text-end ms-3 ">{{__('Business Models')}}</span>
                    </a>
                </li>
            @endif
            @if(empty($modules) || in_array('business_model',$modules))


                <li class="nav-item ">
                    <a class="nav-link @if(($selected_navigation ?? '') === 'startup-canvas') active @endif "
                       href="/startup-canvases">

                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>
                        <span class="nav-link-text text-end ms-3 ">{{__('Startup Canvas')}}</span>
                    </a>
                </li>
            @endif

            @if(empty($modules) || in_array('mckinsey',$modules))
                <li class="nav-item">
                    <a class="nav-link  @if(($selected_navigation ?? '') === 'mckinsey') active @endif" href="/mckinsey-models">


                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                        <span class="nav-link-text ms-3">{{__('McKinsey 7-S Model')}}</span>
                    </a>
                </li>

            @endif

            @if(empty($modules) || in_array('porter',$modules))
                <li class="nav-item">
                    <a class="nav-link  @if(($selected_navigation ?? '') === 'porter') active @endif" href="/porter-models">

                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-life-buoy"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle><line x1="4.93" y1="4.93" x2="9.17" y2="9.17"></line><line x1="14.83" y1="14.83" x2="19.07" y2="19.07"></line><line x1="14.83" y1="9.17" x2="19.07" y2="4.93"></line><line x1="14.83" y1="9.17" x2="18.36" y2="5.64"></line><line x1="4.93" y1="19.07" x2="9.17" y2="14.83"></line></svg>
                        <span class="nav-link-text ms-3">{{__('Porter\'s 5-F Model')}}</span>
                    </a>
                </li>

            @endif


            <li class="nav-item mt-3 mb-2">
                <h6 class="ps-4 ms-2 text-uppercase text-muted text-xs opacity-6">{{__('Strategies & Analysis')}} </h6>
            </li>
            @if(empty($modules) || in_array('swot',$modules))
                <li class="nav-item">
                    <a class="nav-link  @if(($selected_navigation ?? '') === 'swot') active @endif" href="/swot-list">

                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-disc">
                            <circle cx="12" cy="12" r="10"></circle>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                        <span class="nav-link-text ms-3">{{__('SWOT Analysis')}}</span>
                    </a>
                </li>

            @endif
            @if(empty($modules) || in_array('pest',$modules))
                <li class="nav-item">
                    <a class="nav-link  @if(($selected_navigation ?? '') === 'pest') active @endif" href="/pest-list">

                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                        <span class="nav-link-text ms-3">{{__('PEST Analysis')}}</span>
                    </a>
                </li>

            @endif
            @if(empty($modules) || in_array('pestle',$modules))
                <li class="nav-item">
                    <a class="nav-link  @if(($selected_navigation ?? '') === 'pestel') active @endif" href="/pestle-list">


                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-columns"><path d="M12 3h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7m0-18H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7m0-18v18"></path></svg>
                        <span class="nav-link-text ms-3">{{__('PESTLE Analysis')}}</span>
                    </a>
                </li>

            @endif



            @if(empty($modules) || in_array('business_plan',$modules))

                <li class="nav-item ">
                    <a class="nav-link @if(($selected_navigation ?? '') === 'business-plans') active @endif "
                       href="/business-plans">

                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-edit">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                        <span class="nav-link-text  ms-3">{{__('Business Plans')}}</span>
                    </a>
                </li>

            @endif

            @if(empty($modules) || in_array('notes',$modules))
                <li class="nav-item mt-3 mb-2">
                    <h6 class="ps-4 ms-2 text-uppercase text-muted text-xs opacity-6">{{__('Knowledgebase')}}</h6>
                </li>
                <li class="nav-item ">
                    <a class="nav-link @if(($selected_navigation ?? '') === 'notes') active @endif " href="/notes">

                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                        <span class="nav-link-text ms-3">{{__('Note Book')}}</span>
                    </a>
                </li>
            @endif
            @if(empty($modules) || in_array('documents',$modules))

                <li class="nav-item">
                    <a class="nav-link @if(($selected_navigation ?? '') === 'documents') active @endif"
                       href="/documents">

                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-file">
                            <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                            <polyline points="13 2 13 9 20 9"></polyline>
                        </svg>
                        <span class="nav-link-text ms-3">{{__('Documents')}}</span>
                    </a>
                </li>
            @endif
            <li class="nav-item mt-3 mb-2">
                <h6 class="ps-4 ms-2 text-uppercase text-muted text-xs opacity-6">{{__('Account pages')}} </h6>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(($selected_navigation ?? '') === 'profile') active @endif " href="/profile">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-user">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span class="nav-link-text ms-3">{{__('Profile')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(($selected_navigation ?? '') === 'team') active @endif " href="/staff">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-database">
                        <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                        <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                        <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                    </svg>
                    <span class="nav-link-text ms-3">{{__('Users')}}</span>
                </a>
            </li>

            <li class="nav-item mt-3 mb-2">
                <h6 class="ps-4 ms-2 text-uppercase text-muted text-xs opacity-6">{{__('Settings')}}  </h6>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(($selected_navigation ?? '') === 'billing') active @endif  " href="/billing">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-shopping-cart">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    <span class="nav-link-text ms-3">{{__('My Plan')}}</span>
                </a>
            </li>
            <li class="nav-item mb-4">
                <a class="nav-link @if(($selected_navigation ?? '') === 'settings') active @endif  " href="/settings">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-command">
                        <path
                            d="M18 3a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3H6a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3V6a3 3 0 0 0-3-3 3 3 0 0 0-3 3 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 3 3 0 0 0-3-3z"></path>
                    </svg>
                    <span class="nav-link-text ms-3">{{__('Settings')}}</span>
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


<main class="main-content mt-1 border-radius-lg ">
    <!-- Navbar -->

    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl d-print-none" navbar-scroll="true" >
        <div class="container-fluid py-1 px-3 d-print-none">

            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                </div>
                <ul class=" justify-content-end">
                    <li class="nav-item d-xl-none pe-2 ps-3 d-flex align-items-center">
                        <a href="javascript:" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown pe-2 d-flex align-items-center">
                        <a href="" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown"
                           aria-expanded="false">
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                            aria-labelledby="dropdownMenuButton">
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="/profile">
                                    <div class="d-flex py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">{{__('My Profile')}}</span>
                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item border-radius-md" href="/logout">
                                    <div class="d-flex py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-bolder mb-1">
                                                {{__('Logout')}}
                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- End Navbar -->
    <div class="container-fluid">
        @yield('content')
    </div>
</main>
<!--   Core JS Files   -->
<script src="{{PUBLIC_DIR}}/js/app.js?v=99"></script>
<script src="{{PUBLIC_DIR}}/lib/tinymce/tinymce.min.js?v=58"></script>
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

@yield('script')

</body>

</html>

