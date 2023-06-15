@extends('layouts.primary')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="multisteps-form mb-5">
                <!--form panels-->
                <div class="row">
                    <div class="col-12 col-lg-8 m-auto">
                        <form action="/save-investor" method="post" class="multisteps-form__form mb-8">
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
                            <div class="card card-body p-3  js-active" data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">
                                    {{__('Add New Investor')}}

                                </h5>

                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{__('First Name')}}</label><small class="text-danger">*</small>
                                            <input name="first_name" class="multisteps-form__input form-control"
                                                   type="text"
                                                   @if (!empty($investor)) value="{{$investor->first_name}}" @endif />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{__('Last Name')}}</label><small class="text-danger">*</small>
                                            <input name="last_name" class="multisteps-form__input form-control"
                                                   type="text"
                                                   @if (!empty($investor)) value="{{$investor->last_name}}" @endif />
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <label>{{__('Username/Email')}}</label><small class="text-danger">*</small>
                                            <input name="email" class="multisteps-form__input form-control"
                                                   type="email"
                                                   value="{{$investor->email ?? old('email') ?? ''}}"/>
                                        </div>

                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{__('Phone Number')}}</label>
                                            <input name="phone_number" class="multisteps-form__input form-control" value="{{$investor->phone_number ?? old('phone_number') ?? ''}}">
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{__('Source')}}</label>
                                            <input name="source" class="multisteps-form__input form-control" value="{{$investor->source ?? old('source') ?? ''}}"/>
                                        </div>


                                    </div>
                                    <div class="mb-1 mt-3">

                                        <label for="exampleFormControlInput1" class="form-label">{{__('Select Product')}}</label>
                                        <select class="form-select form-select-solid fw-bolder" id="contact"
                                                aria-label="Floating label select example" name="product_id">
                                            <option value="0">{{__('None')}}</option>
                                            @foreach ($products as $product)
                                                <option value="{{$product->id}}"
                                                        @if (!empty($investor))
                                                        @if ($investor->product_id === $product->id)
                                                        selected
                                                    @endif
                                                    @endif
                                                >{{$product->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{__('Estimated Amount to be invested')}}</label>
                                            <input name="amount" class=" form-control"
                                                   value="{{$investor->amount ?? old('amount') ?? ''}}" >
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">
                                                    {{__('Status')}}
                                                </label><span class="text-danger">*</span>
                                                <select class="form-select" aria-label="Default select example" name="status">
                                                    <option value="Pending"
                                                            @if(($investor->status ?? null) === 'Pending') selected @endif>{{__('Pending')}}</option>
                                                    <option value="Approved"
                                                            @if(($investor->status ?? null) === 'Approved') selected @endif>{{__('Approved')}}</option>

                                                </select>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="mt-4 text-sm mb-0">{{__('Write a short Note')}}</label>

                                            <div class="form-group">
                                                <textarea name="notes" class="form-control bg-yellow-light" rows="4" id="editor">{{$investor->notes ?? old('notes') ?? ''}}</textarea>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                            </div>


                            <div class=" mt-4 card card-body  p-3" data-animation="FadeIn">
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
                                                   @if(!empty($investor)) value="{{$investor->twitter}}" @endif />
                                        </div>
                                        <div class="col-12 mt-3">
                                                <span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                                                     <label>{{__('Facebook Account')}}</label>
                                                </span>

                                            <input name="facebook" class="multisteps-form__input form-control"
                                                   type="text"
                                                   @if(!empty($investor)) value="{{$investor->facebook}}" @endif />
                                        </div>
                                        <div class="col-12 mt-3">
                                              <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-linkedin"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle
                                                            cx="4" cy="4" r="2"></circle></svg>
                                                     <label>{{__('Linkedin Account')}}</label>
                                               </span>

                                            <input name="linkedin" class="multisteps-form__input form-control"
                                                   @if(!empty($investor)) value="{{$investor->linkedin}}" @endif />
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!--single form panel-->
                            @csrf
                            @if (!empty($investor))
                                <input type="hidden" name="id" value="{{$investor->id}}">
                            @endif
                            <div class="button-row text-left mt-4 ">
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

@section('script')

    <script>

        $(function () {
            "use strict";


            flatpickr("#start_date", {

                dateFormat: "Y-m-d",
            });

            flatpickr("#end_date", {

                dateFormat: "Y-m-d",
            });


            tinymce.init({
                selector: '#editor',

                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,


            });

        });


    </script>

@endsection

