@extends('layouts.primary')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="font-weight-bolder">{{__('SWOT Analysis')}}</h4>
                    <hr>
                    <form method="post" action="/save-swot">
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
                                            {{__('Strengths')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('What are the strengths?')}}

                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="strengths"
                                                  name="strengths">@if (!empty($model)){{$model->strengths}}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Weaknesses')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('What are the weaknesses?')}}

                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="weaknesses"
                                              name="weaknesses">@if (!empty($model)){{$model->weaknesses}}@endif</textarea>
                                </div>
                            </div>
                        </div>
                            <div class="row mt-4">
                                <div class="col align-self-end">
                                    <div class="col align-self-center">
                                        <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Opportunities')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('What are the opportunities?')}}
                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="opportunities"
                                                  name="opportunities">@if(!empty($model)){{$model->opportunities}}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Threats')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('What are the Threats?')}}
                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="threats"
                                              name="threats">@if(!empty($model)){{$model->threats}}@endif</textarea>
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
                selector: '#strengths',

                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#weaknesses',

                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#threats',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#opportunities',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
        })();
    </script>
@endsection
