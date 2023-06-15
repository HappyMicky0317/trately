@extends('layouts.super-admin-portal')
@section('content')

    <div class="btn-group">
        <button type="button" class="btn ms-auto btn-dark btn-icon-only " data-bs-toggle="offcanvas" data-bs-target="#footer" aria-controls="offcanvasRight">
        <span class="btn-inner--icon">
<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" mb-2 feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
        </span>
        </button>
        <a href="/home" target="_blank" type="button" class="btn btn-success btn-icon-only">
            <span class="btn-inner--icon">
<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
            </span>
        </a>

    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="footer" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">{{__('Footer Section ')}}</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="/save-footer-section" method="post" enctype="multipart/form-data">
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
                    <label for="exampleFormControlInput1" class="form-label">{{__('Company Name')}}</label>
                    <input type="text" name="title" class="form-control" id="title"  value="{{$contact->title ?? old('title') ?? ''}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">{{__('Short Description')}}</label>
                    <input type="text" name="subtitle" class="form-control" id="subtitle"  value="{{$contact->subtitle ?? old('subtitle') ?? ''}}">
                </div>
                <div class="mb-3">
                    <label>{{__('Phone Number')}}</label>
                    <input name="phone_number" class="multisteps-form__input form-control"  value="{{$contact->phone_number ?? old('phone_number') ?? ''}}"  />
                </div>

                <div class="mb-3">
                    <label>{{__('Email')}}</label>
                    <input name="email" type="email" class="multisteps-form__input form-control"  value="{{$contact->email ?? old('email') ?? ''}}" />
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">{{__('Address')}}</label>
                    <textarea class="form-control" name="address_1" id="privacy" rows="4">{{$contact->address_1 ?? old('address_1') ?? ''}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">{{__('Facebook')}}</label>
                    <input type="url" name="facebook" class="form-control" id="facebook"  value="{{$contact->facebook ?? old('facebook') ?? ''}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">{{__('Twitter')}}</label>
                    <input type="url" name="twitter" class="form-control" id="twitter"  value="{{$contact->twitter ?? old('twitter') ?? ''}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">{{__('Youtube')}}</label>
                    <input type="url" name="youtube" class="form-control" id="youtube"  value="{{$contact->youtube ?? old('youtube') ?? ''}}">
                </div>

                @csrf
                @if (!empty($contact))
                    <input type="hidden" name="id" value="{{$contact->id}}">
                @endif
                <div class="button-row text-left mt-4">
                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit" title="Next">{{__('Save')}}</button>
                </div>

            </form>
        </div>

    </div>
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
@endsection



