@extends('layouts.super-admin-portal')

@section('content')


    <h5 class="mb-3">{{__('Landing Page Text Editor')}}</h5>

    <div class="btn-group">


        <button type="button" class="btn ms-auto btn-dark btn-icon-only " data-bs-toggle="offcanvas" data-bs-target="#hero" aria-controls="offcanvasRight">
        <span class="btn-inner--icon">
<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" mb-2 feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
        </span>
        </button>
        <a href="/" target="_blank" type="button" class="btn btn-success btn-icon-only">
            <span class="btn-inner--icon">
<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
            </span>
        </a>


    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="hero" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">{{__('Hero Section ')}}</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <form action="/save-hero-section" method="post" enctype="multipart/form-data">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="offcanvas-body">

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">{{__('Title')}}</label>
                    <input type="text" name="hero_title" class="form-control" id="title"  value="{{$landingpage->hero_title ?? old('hero_title') ?? ''}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">{{__('Subtitle')}}</label>
                    <input type="text" name="hero_subtitle" value="{{$landingpage->hero_subtitle ?? old('hero_subtitle') ?? ''}}" class="form-control" id="title">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">{{__('Paragraph')}}</label>
                    <textarea class="form-control" name="hero_paragraph" id="" rows="3">{{$landingpage->hero_paragraph ?? old('hero_paragraph') ?? ''}}</textarea>
                </div>
                <div class="mb-3">
                    <div>
                        <label  for="photo_file" class="form-label mt-4s">{{__('Background Image')}}</label>
                        <input class="form-control" name="background_image" type="file" id="logo_file">
                    </div>
                </div>
                @csrf

                @if (!empty($landingpage))
                    <input type="hidden" name="id" value="{{$landingpage->id}}">
                @endif
                <div class="button-row text-left mt-4">
                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit" title="Next">{{__('Save')}}</button>
                </div>

            </div>
        </form>
    </div>



    <header>
        <div class="page-header min-vh-100">
            <div class="oblique position-absolute top-0 h-100 d-md-block d-none">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 border-radius-lg border-top-start-radius-0 ms-n6"

                     @if (!empty($landingpage->background_image))

                     style="background-image: url('{{PUBLIC_DIR}}/uploads/{{$landingpage->background_image}}')"
                    @else
                        style="background-image: url('{{PUBLIC_DIR}}/img/image.png')"

                     @endif



                ></div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7 d-flex justify-content-center text-md-start text-center flex-column">

                        <h2 class="fw-bolder text-start  mb-0">
                            @if (!empty($landingpage))
                                {{$landingpage->hero_title}}
                            @endif
                        </h2>
                        <h4 class="fw-bolder text-start text-purple mt-1 mb-0">
                            @if (!empty($landingpage))
                                {{$landingpage->hero_subtitle}}
                            @endif
                        </h4>

                        <p class="text-start pe-md-5 me-md-5 mt-4 mb-4">
                            @if (!empty($landingpage))
                                {{$landingpage->hero_paragraph}}
                            @endif

                        </p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="50" fill="currentColor" class="fw-bolder text-purple bi bi-filter-left text-start" viewBox="0 0 16 16">
                            <path d="M2 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                        <div class=" text-start buttons">
                            <a href="/signup" type="button" class="btn rounded bg-dark text-white mt-4">{{__('Get Started')}}</a>
                            <a href="/pricing" type="button" class="btn-outline-dark btn text-dark shadow-none mt-4">{{__('Plans & Pricing')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <div class="btn-group mt-2">
        <button type="button" class="btn ms-auto btn-dark btn-icon-only " data-bs-toggle="offcanvas" data-bs-target="#feature2" aria-controls="offcanvasRight">
        <span class="btn-inner--icon">
<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" mb-2 feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
        </span>
        </button>
        <a href="/" target="_blank" type="button" class="btn btn-success btn-icon-only">
            <span class="btn-inner--icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>
                </svg>
            </span>
        </a>

    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="feature2" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">{{__('Feature Section ')}}</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>


        <div class="offcanvas-body">

            <form action="/save-feature2-section" method="post" enctype="multipart/form-data">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="">

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">{{__('Title')}}</label>
                        <input type="text" name="feature2_title" value="{{$landingpage->feature2_title ?? old('feature2_title') ?? ''}}" class="form-control" id="title" >
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">{{__('Subtitle')}}</label>
                        <input type="text" name="feature2_subtitle" value="{{$landingpage->feature2_subtitle ?? old('feature2_subtitle') ?? ''}}"  class="form-control" id="title" >
                    </div>


                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">{{__('Feature 1')}}</label>
                        <input type="text"  name="feature2_one" value="{{$landingpage->feature2_one ?? old('feature2_one') ?? ''}}" class="form-control" id="feature_one" >
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">{{__('Description')}}</label>
                        <textarea class="form-control" name="feature2_one_paragraph" id="" rows="3">{{$landingpage->feature2_one_paragraph ?? old('feature2_one_paragraph') ?? ''}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">{{__('Feature 2')}}</label>
                        <input type="text" class="form-control" name="feature2_two" value="{{$landingpage->feature2_two ?? old('feature2_two') ?? ''}}" id="feature1_two" >
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">{{__('Description')}}</label>
                        <textarea class="form-control" id="" name="feature2_two_paragraph" rows="3">{{$landingpage->feature2_one_paragraph ?? old('feature2_two_paragraph') ?? ''}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">{{__('Feature 3')}}</label>
                        <input type="text" class="form-control" name="feature2_three"
                               value="{{$landingpage->feature2_three ?? old('feature2_three') ?? ''}}" id="feature2_three">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">{{__('Description')}}</label>
                        <textarea class="form-control" id="" name="feature2_three_paragraph" rows="3">{{$landingpage->feature2_three_paragraph ?? old('feature2_three_paragraph') ?? ''}}</textarea>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">{{__('Feature 4')}}</label>
                            <input type="text" class="form-control" name="feature2_four"
                                   value="{{$landingpage->feature2_four ?? old('feature2_four') ?? ''}}" id="feature2_four">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">{{__('Description')}}</label>
                            <textarea class="form-control" id="" name="feature2_four_paragraph" rows="3">{{$landingpage->feature2_four_paragraph ?? old('feature2_four_paragraph') ?? ''}}</textarea>
                    </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">{{__('Feature 5')}}</label>
                            <input type="text" class="form-control" name="feature2_five"
                                   value="{{$landingpage->feature2_five ?? old('feature2_five') ?? ''}}" id="feature2_five">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">{{__('Description')}}</label>
                            <textarea class="form-control" id="" name="feature2_five_paragraph" rows="3">{{$landingpage->feature2_five_paragraph ?? old('feature2_five_paragraph') ?? ''}}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">{{__('Feature 6')}}</label>
                            <input type="text" class="form-control" name="feature2_six"
                                   value="{{$landingpage->feature2_six ?? old('feature2_six') ?? ''}}" id="feature2_six">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">{{__('Description')}}</label>
                            <textarea class="form-control" id="" name="feature2_six_paragraph" rows="3">{{$landingpage->feature2_six_paragraph ?? old('feature2_six_paragraph') ?? ''}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">{{__('Feature 7')}}</label>
                            <input type="text" class="form-control" name="feature2_seven"
                                   value="{{$landingpage->feature2_seven ?? old('feature2_seven') ?? ''}}" id="feature2_seven">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">{{__('Description')}}</label>
                            <textarea class="form-control" id="" name="feature2_seven_paragraph" rows="3">{{$landingpage->feature2_seven_paragraph ?? old('feature2_seven_paragraph') ?? ''}}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">{{__('Feature 8')}}</label>
                            <input type="text" class="form-control" name="feature2_eight"
                                   value="{{$landingpage->feature2_eight ?? old('feature2_eight') ?? ''}}" id="feature2_eight">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">{{__('Description')}}</label>
                            <textarea class="form-control" id="" name="feature2_eight_paragraph" rows="3">{{$landingpage->feature2_eight_paragraph ?? old('feature2_eight_paragraph') ?? ''}}</textarea>
                        </div>

                        @csrf
                    @if (!empty($landingpage))
                        <input type="hidden" name="id" value="{{$landingpage->id}}">
                    @endif

                    <div class="button-row text-left mt-4">
                        <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit" title="Next">{{__('Save')}}</button>
                    </div>

                </div>

        </div>
            </form>

    </div>
    </div>


    <section class="my-5 ">

        <div class="container bg-gradient-white">
            <div class="row">
                <div class="col-md-6 m-auto">
                    <span>
                       <span>
                            <h2 class="fw-bolder">
                                 @if (!empty($landingpage))
                                    {{$landingpage->feature2_title}}
                                @endif

                                </h2>
                       </span>

                    </span>
                    <p class="mb-4">
                        @if (!empty($landingpage))
                            {{$landingpage->feature2_subtitle}}
                        @endif

                    </p>


                </div>
                <div class="col-md-5 ms-auto">
                    <div class="position-relative text-end">
                        <button type="button" class="btn btn-info btn-lg mt-3 up">Get Started</button>


                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="container mt-5 mb-6 bg-white">



        <div class="row justify-content-center text-center mt-5">
            <div class="col-md-3 mt-4">

                <div class="icon icon-shape rounded-circle  icon-lg bg-purple-light text-center">


                    <svg xmlns="http://www.w3.org/2000/svg" width="60px" height="28px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle mt-3 text-purple"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                </div>

                <h5 class="text-dark mt-4">
                    @if (!empty($landingpage))
                        {{$landingpage->feature2_one}}
                    @endif

                </h5>
                <p class="fw-light">
                    @if (!empty($landingpage))
                        {{$landingpage->feature2_one_paragraph}}
                    @endif

                </p>
            </div>
            <div class="col-md-3 mt-4">
                <div class="icon icon-shape rounded-circle  icon-lg bg-purple-light text-center">


                    <svg xmlns="http://www.w3.org/2000/svg" width="60px" height="28px"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" mt-3 text-purple feather feather-headphones"><path d="M3 18v-6a9 9 0 0 1 18 0v6"></path><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path></svg>



                </div>

                <h5 class="text-dark mt-4">
                    @if (!empty($landingpage))
                        {{$landingpage->feature2_two}}
                    @endif

                </h5>
                <p class="fw-light">
                    @if (!empty($landingpage))
                        {{$landingpage->feature2_two_paragraph}}
                    @endif
                </p>
            </div>
            <div class="col-md-3 mt-4">

                <div class="icon icon-shape rounded-circle  icon-lg bg-purple-light text-center">

                    <svg xmlns="http://www.w3.org/2000/svg" width="60px" height="28px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell text-purple mt-3"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>

                </div>

                <h5 class="text-dark mt-4">
                    @if (!empty($landingpage))
                        {{$landingpage->feature2_three}}
                    @endif

                </h5>
                <p class="fw-light">
                    @if (!empty($landingpage))
                        {{$landingpage->feature2_three_paragraph}}
                    @endif

                </p>
            </div>
            <div class="col-md-3 mt-4">
                <div class="icon icon-shape rounded-circle  icon-lg bg-purple-light text-center">

                    <svg xmlns="http://www.w3.org/2000/svg" width="60px" height="28px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield text-purple mt-3"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>

                </div>

                <h5 class="text-dark mt-4">
                    @if (!empty($landingpage))
                        {{$landingpage->feature2_four}}
                    @endif

                </h5>
                <p class="fw-light">
                    @if (!empty($landingpage))
                        {{$landingpage->feature2_four_paragraph}}
                    @endif

                </p>
            </div>
        </div>

        <div class="row justify-content-center text-center mt-5">
            <div class="col-md-3 mt-4">

                <div class="icon icon-shape rounded-circle  icon-lg bg-purple-light text-center">

                    <svg class="mt-3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" fill="none" ><g clip-path="url(#A)" fill="#6366f1"><path d="M29.284 19.161a1.25 1.25 0 1 0-2.318.937l1.472 3.642-4.372-1.927a1.25 1.25 0 0 0-.995-.006 12.05 12.05 0 0 1-4.758.961c-6.692 0-11.187-5.24-11.187-10.133C7.126 7.046 12.144 2.5 18.313 2.5s11.188 4.546 11.188 10.134c0 .436-.041.958-.111 1.432a1.25 1.25 0 1 0 2.473.369 12.62 12.62 0 0 0 .139-1.801c0-3.396-1.438-6.582-4.049-8.971C25.371 1.301 21.948 0 18.313 0s-7.058 1.301-9.639 3.662c-2.333 2.136-3.729 4.907-3.999 7.896C1.74 13.501.001 16.616.001 19.97c0 2.095.66 4.084 1.917 5.795L.092 30.281A1.25 1.25 0 0 0 1.251 32a1.25 1.25 0 0 0 .504-.106l5.264-2.321c1.324.493 2.724.742 4.169.742.031 0 .062-.002.093-.005 2.09-.016 4.122-.566 5.881-1.594 1.576-.921 2.873-2.187 3.782-3.682.887-.159 1.755-.4 2.597-.722l6.706 2.956a1.25 1.25 0 0 0 1.374-.246 1.25 1.25 0 0 0 .289-1.366l-2.626-6.496zm-18.095 8.651c-.017 0-.034.002-.051.003-1.276-.007-2.505-.257-3.652-.747a1.25 1.25 0 0 0-.995.006l-2.927 1.29.944-2.336a1.25 1.25 0 0 0-.208-1.279c-1.177-1.381-1.799-3.033-1.799-4.779 0-1.998.84-3.89 2.311-5.325.458 2.495 1.749 4.882 3.698 6.757 2.424 2.333 5.631 3.685 9.094 3.848-1.626 1.6-3.952 2.562-6.415 2.562z"/><use xlink:href="#B"/><path d="M23.25 13.938a1.25 1.25 0 1 0 0-2.5 1.25 1.25 0 1 0 0 2.5zm-10 0a1.25 1.25 0 1 0 0-2.5 1.25 1.25 0 1 0 0 2.5z"/></g><defs><clipPath id="A"><path fill="#fff" d="M0 0h32v32H0z"/></clipPath><path id="B" d="M18.25 13.938a1.25 1.25 0 1 0 0-2.5 1.25 1.25 0 1 0 0 2.5z"/></defs></svg>
                </div>

                <h5 class="text-dark mt-4">
                    @if (!empty($landingpage))
                        {{$landingpage->feature2_five}}
                    @endif

                </h5>
                <p class="fw-light">
                    @if (!empty($landingpage))
                        {{$landingpage->feature2_five_paragraph}}
                    @endif

                </p>
            </div>
            <div class="col-md-3 mt-4">
                <div class="icon icon-shape rounded-circle  icon-lg bg-purple-light text-center">

                    <svg  xmlns="http://www.w3.org/2000/svg" width="60px" height="28px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay mt-3 text-purple"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>

                </div>

                <h5 class="text-dark mt-4">
                    @if (!empty($landingpage))
                        {{$landingpage->feature2_six}}
                    @endif

                </h5>
                <p class="fw-light">
                    @if (!empty($landingpage))
                        {{$landingpage->feature2_six_paragraph}}
                    @endif

                </p>
            </div>
            <div class="col-md-3 mt-4">

                <div class="icon icon-shape rounded-circle  icon-lg bg-purple-light text-center">

                    <svg xmlns="http://www.w3.org/2000/svg" width="60px" height="28px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-hexagon text-purple mt-3"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path></svg>



                </div>

                <h5 class="text-dark mt-4">
                    @if (!empty($landingpage))
                        {{$landingpage->feature2_seven}}
                    @endif

                </h5>
                <p class="fw-light">
                    @if (!empty($landingpage))
                        {{$landingpage->feature2_seven_paragraph}}
                    @endif

                </p>
            </div>
            <div class="col-md-3 mt-4">
                <div class="icon icon-shape rounded-circle  icon-lg bg-purple-light text-center">

                    <svg xmlns="http://www.w3.org/2000/svg" width="60px" height="28px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star text-purple mt-3"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>


                </div>

                <h5 class="text-dark mt-4">
                    @if (!empty($landingpage))
                        {{$landingpage->feature2_eight}}
                    @endif

                </h5>
                <p class="fw-light">
                    @if (!empty($landingpage))
                        {{$landingpage->feature2_eight_paragraph}}
                    @endif

                </p>
            </div>
        </div>
    </div>

    <div class="btn-group mt-2">
        <button type="button" class="btn ms-auto btn-dark btn-icon-only " data-bs-toggle="offcanvas" data-bs-target="#feature1" aria-controls="offcanvasRight">
        <span class="btn-inner--icon">
<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" mb-2 feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
        </span>
        </button>
        <a href="/" target="_blank" type="button"  class="btn btn-success btn-icon-only">
            <span class="btn-inner--icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>
                </svg>
            </span>
        </a>

    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="feature1" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5>{{__('Image Section')}}</h5>

            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>


        <div class="offcanvas-body">

            <form action="/save-feature1-section" method="post" enctype="multipart/form-data">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="">

                    <div class="mb-3">
                        <div>
                            <label  for="photo_file" class="form-label ">{{__('Image')}}</label>
                            <input class="form-control" name="feature1_image" type="file" id="image1">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">{{__('Image Title')}}</label>
                        <input type="text" name="feature1_image_title" value="{{$landingpage->feature1_image_title ?? old('feature1_image_title') ?? ''}}" class="form-control" id="title" >
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">{{__('Image Subtitle')}}</label>
                        <input type="text" name="feature1_image_subtitle" value="{{$landingpage->feature1_image_subtitle ?? old('feature1_image_subtitle') ?? ''}}"  class="form-control" id="title" >
                    </div>

                    <h5 class="mt-2">{{__('Feature Section')}}</h5>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">{{__('Title')}}</label>
                        <input type="text" class="form-control" name="feature1_title"
                               value="{{$landingpage->feature1_title ?? old('feature1_title') ?? ''}}" id="title" >
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">{{__('Subtitle')}}</label>
                        <input type="text" class="form-control"  value="{{$landingpage->feature1_subtitle ?? old('feature1_subtitle') ?? ''}}" name="feature1_subtitle" id="title">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">{{__('Feature 1')}}</label>
                        <input type="text"  name="feature1_one" value="{{$landingpage->feature1_one ?? old('feature1_one') ?? ''}}" class="form-control" id="feature_one" >
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">{{__('Description')}}</label>
                        <textarea class="form-control" name="feature1_one_paragraph" id="" rows="3">{{$landingpage->feature1_one_paragraph ?? old('feature1_one_paragraph') ?? ''}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">{{__('Feature 2')}}</label>
                        <input type="text" class="form-control" name="feature1_two" value="{{$landingpage->feature1_two ?? old('feature1_two') ?? ''}}" id="feature1_two" >
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">{{__('Description')}}</label>
                        <textarea class="form-control" id="" name="feature1_two_paragraph" rows="3">{{$landingpage->feature1_one_paragraph ?? old('feature1_two_paragraph') ?? ''}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">{{__('Feature 3')}}</label>
                        <input type="text" class="form-control" name="feature1_three"
                               value="{{$landingpage->feature1_three ?? old('feature1_three') ?? ''}}" id="feature1_three">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">{{__('Description')}}</label>
                        <textarea class="form-control" id="" name="feature1_three_paragraph" rows="3">{{$landingpage->feature1_three_paragraph ?? old('feature1_three_paragraph') ?? ''}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">{{__('Feature 4')}}</label>
                        <input type="text" class="form-control" name="feature1_four"
                               value="{{$landingpage->feature1_four ?? old('feature1_four') ?? ''}}" id="feature1_four">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">{{__('Description')}}</label>
                        <textarea class="form-control" id="" name="feature1_four_paragraph" rows="3">{{$landingpage->feature1_four_paragraph ?? old('feature1_four_paragraph') ?? ''}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">{{__('Feature 5')}}</label>
                        <input type="text" class="form-control" name="feature1_five"
                               value="{{$landingpage->feature1_five ?? old('feature1_five') ?? ''}}" id="feature1_five">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">{{__('Description')}}</label>
                        <textarea class="form-control" id="" name="feature1_five_paragraph" rows="3">{{$landingpage->feature1_five_paragraph ?? old('feature1_five_paragraph') ?? ''}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">{{__('Feature 6')}}</label>
                        <input type="text" class="form-control" name="feature1_six"
                               value="{{$landingpage->feature1_six ?? old('feature1_six') ?? ''}}" id="feature1_six">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">{{__('Description')}}</label>
                        <textarea class="form-control" id="" name="feature1_six_paragraph" rows="3">{{$landingpage->feature1_six_paragraph ?? old('feature1_six_paragraph') ?? ''}}</textarea>
                    </div>




                    @csrf
                    @if (!empty($landingpage))
                        <input type="hidden" name="id" value="{{$landingpage->id}}">
                    @endif

                    <div class="button-row text-left mt-4">
                        <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit" title="Next">{{__('Save')}}</button>
                    </div>

                </div>
            </form>

        </div>

    </div>


    <section class="bg-gradient-dark">
        <div class="page-header min-vh-100"
             @if (!empty($landingpage->feature1_image))
             style="background-image: url('{{PUBLIC_DIR}}/uploads/{{$landingpage->feature1_image}}')"
        @else

             style="background-image: url('{{PUBLIC_DIR}}/img/image.png')"
                    class="w-100 border-radius-lg shadow-sm">
             @endif >

            <span class="mask bg-dark opacity-8"></span>
            <div class="container">
                <div class="row text-start">


                    <div class="col-md-6 m-auto">
                    <span>
                       <span>
                            <h2 class="display-4  text-center fw-bolder text-white">
                                 @if (!empty($landingpage))
                                    {{$landingpage->feature1_image_title}}
                                @endif

                            </h2>
                           <h6 class="text-white text-center">

                               @if (!empty($landingpage))
                                   {{$landingpage->feature1_image_subtitle}}
                               @endif

                           </h6>

                       </span>

                    </span>

                    </div>
                </div>

            </div>

        </div>


    </section>


    <section class="bg-dark position-relative overflow-hidden">


        <div class="container mt-6 mb-5">
            <div class="row ">
                <div class="col-lg-12 d-flex justify-content-center flex-column">
                    <div  class="mt-3" data-bs-ride="carousel">

                        <div class="carousel-inner">
                            <h2 class="text-white fw-bolder mb-1">

                                @if (!empty($landingpage))
                                    {{$landingpage->feature1_title}}
                                @endif

                             </h2>
                            <h5 class=" text-white fw-light  mb-4">

                                @if (!empty($landingpage))
                                    {{$landingpage->feature1_subtitle}}
                                @endif

                            </h5>

                            <div class="row text-white">
                                <div class="col-md-6 ">
                                    <div class=" p-3 info-horizontal d-flex">
                                        <span class="mb-3 me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </svg>

                                        </span>
                                        <div>
                                            <h5 class="text-white">
                                                @if (!empty($landingpage))
                                                    {{$landingpage->feature1_one}}
                                                @endif


                                            </h5>
                                            <p class="fw-light">
                                                @if (!empty($landingpage))
                                                    {{$landingpage->feature1_one_paragraph}}
                                                @endif

                                            </p>
                                        </div>
                                    </div>
                                    <div class="p-3 info-horizontal d-flex">
                                        <span class="mb-3 me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </svg>

                                        </span>
                                        <div>
                              <span>
                                   <h5 class="text-white">
                                      @if (!empty($landingpage))
                                         {{$landingpage->feature1_two}}
                                     @endif

                                   </h5>
                               </span>
                                  <p class="fw-light">
                                    @if (!empty($landingpage))
                                 {{$landingpage->feature1_two_paragraph}}
                                   @endif

                                  </p>
                                        </div>
                                    </div>
                                    <div class="p-3 info-horizontal d-flex">
                                        <span class="mb-3 me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                 </svg>

                                    </span>
                                        <div>
                                            <h5 class="text-white">
                                                @if (!empty($landingpage))
                                                    {{$landingpage->feature1_three}}
                                                @endif

                                            </h5>
                                            <p class="fw-light">
                                                @if (!empty($landingpage))
                                                    {{$landingpage->feature1_three_paragraph}}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class=" p-3 info-horizontal d-flex">
                                        <span class="mb-3 me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </svg>

                                        </span>
                                        <div>
                                            <h5 class="text-white">
                                                @if (!empty($landingpage))
                                                    {{$landingpage->feature1_four}}
                                                @endif

                                            </h5>
                                            <p class="fw-light">
                                                @if (!empty($landingpage))
                                                    {{$landingpage->feature1_four_paragraph}}
                                                @endif

                                            </p>
                                        </div>
                                    </div>
                                    <div class="p-3 info-horizontal d-flex">
                                        <span class="mb-3 me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </svg>

                                        </span>
                                        <div>
                                            <h5 class="text-white">
                                                @if (!empty($landingpage))
                                                    {{$landingpage->feature1_five}}
                                                @endif

                                            </h5>
                                            <p class="fw-light">
                                                @if (!empty($landingpage))
                                                    {{$landingpage->feature1_five_paragraph}}
                                                @endif

                                            </p>
                                        </div>
                                    </div>
                                    <div class="p-3 info-horizontal d-flex">
                                        <span class="mb-3 me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </svg>

                                        </span>
                                        <div>
                                            <h5 class="text-white">
                                                @if (!empty($landingpage))
                                                    {{$landingpage->feature1_six}}
                                                @endif
                                            </h5>
                                            <p class="fw-light">
                                                @if (!empty($landingpage))
                                                    {{$landingpage->feature1_six_paragraph}}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>

    <div class="position-absolute w-100 z-inde-1 ">

    </div>




    <div class="btn-group mt-2">
        <button type="button" class="btn ms-auto btn-dark btn-icon-only " data-bs-toggle="offcanvas" data-bs-target="#story1" aria-controls="offcanvasRight">
        <span class="btn-inner--icon">
<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" mb-2 feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
        </span>
        </button>
        <a href="/" target="_blank" type="button" class="btn btn-success btn-icon-only">
            <span class="btn-inner--icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>
                </svg>
            </span>
        </a>

    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="story1" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">{{__('Story Section 1 ')}}</h5>
            <button type="button" class="btn-close text-reset"  data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

            <form action="/save-story1-section" method="post" enctype="multipart/form-data">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3">
                    <div>
                        <label  for="photo_file" class="form-label mt-4s">{{__('Image')}}</label>
                        <input class="form-control" name="story1_image" type="file" id="logo_file">
                    </div>
                </div>

                <div class="mb-3">
                    <label  class="form-label">{{__('Title')}}</label>
                    <input type="text" class="form-control"  value="{{$landingpage->story1_title ?? old('story1_title') ?? ''}}" name="story1_title" id="storytitle" placeholder="">
                </div>
                <div class="mb-3">
                    <label  class="form-label">{{__('Paragraph')}}</label>
                    <textarea class="form-control" name="story1_paragrapgh" id="paragraph" rows="8">{{$landingpage->story1_paragrapgh ?? old('story1_paragrapgh') ?? ''}}</textarea>
                </div>

                @csrf
                @if (!empty($landingpage))
                    <input type="hidden" name="id" value="{{$landingpage->id}}">
                @endif
                <div class="button-row text-left mt-4">
                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit" title="Next">{{__('Save')}}</button>
                </div>
            </form>
        </div>
    </div>

    <section class="overflow-hidden">
        <div class="container bg-gradient-white mt-6 mb-7">
            <div class="row">

                <div class="col-md-6 m-auto">
                    <h3 class="text-dark fw-bolder">
                        @if (!empty($landingpage))
                            {{$landingpage->story1_title}}
                        @endif
                    </h3>
                    <p class="col-md-10 fw-light mt-4">
                        @if (!empty($landingpage))
                            {{$landingpage->story1_paragrapgh}}
                        @endif

                    </p>


                </div>
                <div class=" col-md-6">
                    <div class=" p-0 mx-3 mt-3 position-relative z-index-1">


                        <div class="d-block blur-shadow-image">
                            @if (!empty($landingpage->story1_image))
                                <img src="{{PUBLIC_DIR}}/uploads/{{$landingpage->story1_image}}"  class="img-fluid shadow rounded-3">

                                @else  <img src="{{PUBLIC_DIR}}/img/image.png"
                                            class="w-100 border-radius-lg shadow-sm">
                            @endif

                        </div>

                        <div class="colored-shadow"
                             @if (!empty($landingpage))
                             style="background-image: url('{{PUBLIC_DIR}}/uploads/{{$landingpage->story1_image}}');"
                            @endif

                        >

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </section>


    <div class="btn-group mt-2">
        <button type="button" class="btn ms-auto btn-dark btn-icon-only " data-bs-toggle="offcanvas" data-bs-target="#story2" aria-controls="offcanvasRight">
        <span class="btn-inner--icon">
<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" mb-2 feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
        </span>
        </button>
        <a href="/" target="_blank" type="button" class="btn btn-success btn-icon-only">
            <span class="btn-inner--icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>
                </svg>
            </span>
        </a>

    </div>


    <div class="offcanvas offcanvas-end" tabindex="-1" id="story2" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">{{__('Story Section 2 ')}}</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

            <form action="/save-story2-section" method="post" enctype="multipart/form-data">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3">
                    <div>
                        <label  for="photo_file" class="form-label mt-4s">{{__('Image')}}</label>
                        <input class="form-control" name="story2_image" type="file" id="logo_file">
                    </div>
                </div>

                <div class="mb-3">
                    <label  class="form-label">{{__('Title')}}</label>
                    <input type="text" class="form-control" name="story2_title" value="{{$landingpage->story2_title ?? old('story2_title') ?? ''}}" id="storytitle">
                </div>
                <div class="mb-3">
                    <label  class="form-label">{{__('Paragraph')}}</label>
                    <textarea class="form-control" name="story2_paragrapgh" id="paragraph" rows="3">{{$landingpage->story2_paragrapgh ?? old('story2_paragrapgh') ?? ''}}</textarea>
                </div>

                @csrf
                @if (!empty($landingpage))
                    <input type="hidden" name="id" value="{{$landingpage->id}}">
                @endif

                <div class="button-row text-left mt-4">
                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit" title="Next">{{__('Save')}}</button>
                </div>

            </form>

        </div>
    </div>


    <section class="py-7 bg-gray-100 mt-5 overflow-hidden">

        <div class="container ">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <div class=" p-0 mx-3 mt-3 position-relative z-index-1">


                        <div class="d-block blur-shadow-image">
                            @if (!empty($landingpage->story2_image))
                                <img src="{{PUBLIC_DIR}}/uploads/{{$landingpage->story2_image}}" alt="" class="img-fluid shadow rounded-3">
                            @else  <img src="{{PUBLIC_DIR}}/img/image.png"
                                        class="w-100 border-radius-lg shadow-sm">
                            @endif

                        </div>
                        <div class="colored-shadow" style="background-image: url('{{PUBLIC_DIR}}/img/feature.jpg');"></div>
                    </div>

                </div>

                <div class="col-md-5 m-auto">
                    <h3 class="text-dark fw-bolder">
                        @if (!empty($landingpage))
                            {{$landingpage->story2_title}}
                        @endif
                    </h3>
                    <p class="col-md-10 fw-light mt-4">
                        @if (!empty($landingpage))
                            {{$landingpage->story2_paragrapgh}}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </section>


    <div class="btn-group mt-2">
        <button type="button" class="btn ms-auto btn-dark btn-icon-only " data-bs-toggle="offcanvas" data-bs-target="#calltoaction" aria-controls="offcanvasRight">
        <span class="btn-inner--icon">
<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" mb-2 feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
        </span>
        </button>
        <a href="/" target="_blank" type="button" class="btn btn-success btn-icon-only">
            <span class="btn-inner--icon">

<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>

</span>
        </a>

    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="calltoaction" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">{{__('Call to Action Section ')}}</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <form action="/save-calltoaction-section" method="post" enctype="multipart/form-data">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="offcanvas-body">


                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">{{__('Subtitle')}}</label>
                    <input type="text" name="calltoaction_subtitle" value="{{$landingpage->calltoaction_subtitle ?? old('calltoaction_subtitle') ?? ''}}" class="form-control" id="title">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">{{__('Title')}}</label>
                    <input type="text" name="calltoaction_title" class="form-control" id="title"  value="{{$landingpage->calltoaction_title ?? old('calltoaction_title') ?? ''}}">
                </div>


                @csrf

                @if (!empty($landingpage))
                    <input type="hidden" name="id" value="{{$landingpage->id}}">
                @endif
                <div class="button-row text-left mt-4">
                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit" title="Next">{{__('Save')}}</button>
                </div>

            </div>
        </form>
    </div>
    <section class="py-7 bg-extradarkblue overflow-hidden">

        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="row justify-content-center">

                        <div class="info text-center">
                            <p class="display-7 text-white">
                                @if (!empty($landingpage))
                                    {{$landingpage->calltoaction_subtitle}}
                                @endif

                            </p>

                            <h2 class="fw-bolder text-white">
                                @if (!empty($landingpage))
                                    {{$landingpage->calltoaction_title}}
                                @endif

                            </h2>

                        </div>

                        <div class="col-4  text-center ps-0 mt-3">
                            <a href="/signup" class="btn btn-info btn-lg mt-3 up">Signup,  Its Free</a>
                        </div>

                    </div>

                </div>


            </div>

    </section>


@endsection
