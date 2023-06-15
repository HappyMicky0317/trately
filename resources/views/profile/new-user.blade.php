@extends('layouts.primary')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="multisteps-form mb-5">
                <!--form panels-->
                <div class="row">
                    <div class="col-12 col-lg-8 m-auto">
                        <form action="/user-post" method="post" class="multisteps-form__form mb-8">
                            <!--single form panel-->
                            @if ($errors->any())
                                <div class="alert bg-pink-light text-danger">
                                    <ul class="list-unstyled">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="multisteps-form__panel p-3  js-active" data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">
                                    {{__('Add New User')}}

                                </h5>

                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{__('First Name')}}</label><small class="text-danger">*</small>
                                            <input name="first_name" class="multisteps-form__input form-control"
                                                   type="text"
                                                   @if (!empty($selected_user)) value="{{$selected_user->first_name}}" @endif />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{__('Last Name')}}</label><small class="text-danger">*</small>
                                            <input name="last_name" class="multisteps-form__input form-control"
                                                   type="text"
                                                   @if (!empty($selected_user)) value="{{$selected_user->last_name}}" @endif />
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <label>{{__('Username/Email')}}</label><small class="text-danger">*</small>
                                            <input name="email" class="multisteps-form__input form-control"
                                                   type="email"
                                                   @if (!empty($selected_user)) value="{{$selected_user->email}}" @endif />
                                        </div>

                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <label>{{__('Password')}}</label><small class="text-danger">*</small>

                                            <input name="password" type="password"
                                                   class="multisteps-form__input form-control"
                                                   @if (!empty($selected_user)) value="" @endif/>
                                            <p class="text-xs">
                                                {{__('Keep blank if you do not want to change Password')}}
                                            </p>

                                        </div>

                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{__('Mobile Phone')}}</label>
                                            <input name="mobile_number" class="multisteps-form__input form-control"
                                                   @if(!empty($selected_user)) value="{{$selected_user->mobile_number}}" @endif >
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{__('Telephone')}}</label>
                                            <input name="phone_number" class="multisteps-form__input form-control"
                                                   @if(!empty($selected_user)) value="{{$selected_user->phone_number}}" @endif />
                                        </div>


                                    </div>


                                </div>
                            </div>


                            <div class=" mt-4 multisteps-form__panel p-3" data-animation="FadeIn">
                                <h5 class="font-weight-bolder">{{__('Socials')}}</h5>
                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col-12">
                                                <span>
<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
     stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter"><path
        d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                                                 <label>{{__('Twitter Handle')}}</label>

                                                </span>
                                            <input name="twitter" class="multisteps-form__input form-control"
                                                   type="text"
                                                   @if(!empty($selected_user)) value="{{$selected_user->twitter}}" @endif />
                                         </div>
                                   <div class="col-12 mt-3">
                                                <span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                                                     <label>{{__('Facebook Account')}}</label>
                                                </span>

                                            <input name="facebook" class="multisteps-form__input form-control"
                                                   type="text"
                                                   @if(!empty($selected_user)) value="{{$selected_user->facebook}}" @endif />
                                        </div>
                                        <div class="col-12 mt-3">
                                              <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-linkedin"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9"
 width="4"height="12"></rect><circle
        cx="4" cy="4" r="2"></circle></svg>
                                                     <label>{{__('Linkedin Account')}}</label>
                                               </span>

                                            <input name="linkedin" class="multisteps-form__input form-control"
                                                   @if(!empty($selected_user)) value="{{$selected_user->linkedin}}" @endif />
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!--single form panel-->
                            @csrf
                            @if (!empty($selected_user))
                                <input type="hidden" name="id" value="{{$selected_user->id}}">
                            @endif
                            <div class="button-row text-left mt-4 ms-3">
                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit"
                                        title="Next">{{__('Submit')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



