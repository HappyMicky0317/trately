@extends('layouts.primary')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="font-weight-bolder">{{__('Write Marketing Plan')}}</h4>
                    <hr>
                    <form method="post" action="/save-marketing-plan">
                        @if ($errors->any())
                            <div class="alert bg-pink-light text-danger">
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                            <div class="row">
                                <div class="col-md-6">
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
                                </div>
                                <div class="col-md-6">
                                    <div class="">

                                        <label for="exampleFormControlInput1" class="form-label">{{__('Select Product')}}</label>
                                        <select class="form-select form-select-solid fw-bolder" id="contact"
                                                aria-label="Floating label select example" name="product_id">
                                            <option value="0">{{__('None')}}</option>
                                            @foreach ($products as $product)
                                                <option value="{{$product->id}}"
                                                        @if (!empty($model))
                                                        @if ($model->product_id === $product->id)
                                                        selected
                                                    @endif
                                                    @endif
                                                >{{$product->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-end">
                                <div class="col align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Business Summary')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('Companny name and mission statement')}}

                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="summary"
                                                  name="summary">@if (!empty($model)){{$model->summary}}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                        <div class="row mt-4">
                            <div class="col align-self-end">
                                <div class="col align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Company Description')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('What does your company do? What challanges your company solve?')}}
                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="description"
                                                  name="description">@if (!empty($model)){{$model->description}}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Team')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('Who is involved in this journey? List who is enacting different stages of the plan.')}}
                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="team"
                                              name="team">@if (!empty($model)){{$model->team}}@endif</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col align-self-end">
                                <div class="col align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Business Initiatives')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('Summary of your marketing goals and initiatives to achieve them. Who are your competitors?Include marketing strategies.')}}
                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="business_initiatives"
                                                  name="business_initiatives">@if(!empty($model)){{$model->business_initiatives}}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Target Market')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('Who are you targeting? Who makes up your target market? Who are your target buyer, personas, and ideal customers?')}}
                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="target_market"
                                              name="target_market">@if(!empty($model)){{$model->target_market}}@endif</textarea>
                                </div>
                            </div>
                        </div>
                            <div>
                                <div class="row mt-4">
                                    <div class="col align-self-center">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">
                                                {{__('Budget')}}
                                            </label>
                                            <p class="form-text text-muted text-xs ms-1">
                                                {{__('An overview of the amount you will spend to reach your marketing goals.')}}
                                            </p>
                                            <textarea class="form-control mt-4" rows="10" id="budget"
                                                      name="budget">
                                                @if(!empty($model)){{$model->budget}}@endif
                                            </textarea>
                                        </div>
                                    </div>

                                    <div class="col align-self-center">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">
                                                {{__('Marketing Channels')}}
                                            </label>
                                            <p class="form-text text-muted text-xs ms-1">
                                               {{__('Which Channels and platforms you use to reach your audience and achieve your goals?')}}
                                            </p>
                                            <textarea class="form-control mt-4" rows="10" id="marketing"
                                                      name="marketing_channels">
                                                @if(!empty($model)){{$model->marketing_channels}}@endif
                                            </textarea>
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
                selector: '#budget',
                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#target_market',
                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#marketing',
                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#business_initiatives',
                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#team',
                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#description',
                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#summary',
                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
        })();
    </script>
@endsection
