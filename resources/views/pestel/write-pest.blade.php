@extends('layouts.primary')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="font-weight-bolder">{{__('PESTLE Analysis')}}</h4>
                    <hr>
                    <form method="post" action="/save-pestel">
                        @if ($errors->any())
                            <div class="alert bg-pink-light text-danger">
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">
                                {{__('Business/Company Name')}}
                            </label><label class="text-danger">*</label>
                            <input class="form-control" name="company_name" id="company_name"

                                   @if (!empty($model))
                                   value="{{$model->company_name}}"
                                @endif
                            >

                        </div>
                        <div class="row mt-4">
                            <div class="col align-self-end">
                                <div class="col align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Political')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('What are the political factors relate to how the government intervenes in the economy?')}}

                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="political"
                                                  name="political">@if (!empty($model)){{$model->political}}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Economic')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('What are the economic factors include economic growth, exchange rates, inflation rate, and interest rates. ')}}

                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="economic"
                                              name="economic">@if (!empty($model)){{$model->economic}}@endif</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col align-self-end">
                                <div class="col align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Social')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('What are the social factors include the cultural aspects and health consciousness, population growth rate, age distribution, career attitudes and emphasis on safety?')}}
                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="social"
                                                  name="social">@if(!empty($model)){{$model->social}}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Technological')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('What are the technological factors include technological aspects like R&D activity, automation, technology incentives and the rate of technological change?')}}
                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="technological"
                                              name="technological">@if(!empty($model)){{$model->technological}}@endif</textarea>
                                </div>
                            </div>
                        </div>
                            <div class="row mt-4">

                                <div class="col align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Legal')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('Legal factors are those that emerge from changes to the regulatory environment, which may affect the broader economy, certain industries, or even individual businesses within a specific sector. ')}}
                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="legal"
                                                  name="legal">@if(!empty($model)){{$model->legal}}@endif</textarea>
                                    </div>
                                </div>
                                <div class="col align-self-end">
                                    <div class="col align-self-center">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">
                                                {{__('Environmental')}}
                                            </label>
                                            <p class="form-text text-muted text-xs ms-1">
                                                {{__('Environmental factors emerged as a sensible addition to the original PEST framework as the business community began to recognize that changes to our physical environment can present material risks and opportunities for organizations.')}}
                                            </p>
                                            <textarea class="form-control mt-4" rows="10" id="environmental"
                                                      name="environmental">@if(!empty($model)){{$model->environmental}}@endif</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @if($model)
                            <input type="hidden" name="id" value="{{$model->id}}">
                        @endif
                        @csrf
                        <button class="btn btn-info mt-4" type="submit">{{__('Save')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

        (function(){
            "use strict";
            tinymce.init({
                selector: '#political',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#social',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#technological',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#economic',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#legal',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#environmental',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
        })();
    </script>
@endsection
