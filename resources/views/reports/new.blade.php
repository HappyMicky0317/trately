@extends('layouts.primary')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="font-weight-bolder">{{__('New Report')}}</h4>
                    <hr>
                    <form method="post" action="/save-report">
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
                                        <label for="example-search-input" class="form-control-label">{{__('Produced by')}}</label><label class="text-danger">*</label>
                                        <input class="form-control" name="name" type="text"
                                               value="{{$model->name ?? old('name') ?? ''}}">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-search-input" class="form-control-label">{{__('Date of elaboration')}}</label>
                                        <input class="form-control" name="date" id="date" @if(!empty($model->date))
                                        value="{{$model->date}}"
                                               @else
                                               value="{{date('Y-m-d')}}"
                                            @endif >
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">
                                            {{__('Status')}}
                                        </label><span class="text-danger">*</span>
                                        <select class="form-select" aria-label="Default select example" name="status">
                                            <option value="Formulation"
                                                    @if(($model->status ?? null) === 'Formulation') selected @endif>{{__('Formulation')}}</option>
                                            <option value="Execution"
                                                    @if(($model->status ?? null) === 'Execution') selected @endif>{{__('Execution')}}</option>
                                            <option value="Validation"
                                                    @if(($model->status ?? null) === 'Validation') selected @endif>
                                                Validation
                                            </option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        <div class="row mt-4">
                            <div class="col align-self-end">
                                <div class="col align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Executive summary ')}}
                                        </label>

                                        <textarea class="form-control mt-4" rows="10" id="structure"
                                                  name="executive_summary">@if (!empty($model)){{$model->executive_summary}}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Administrative analysis')}}
                                    </label>

                                    <textarea class="form-control mt-4" rows="10" id="strategy" name="administrative_analysis">@if (!empty($model)){{$model->administrative_analysis}}@endif</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col align-self-end">
                                <div class="col align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Technical analysis')}}
                                        </label>

                                        <textarea class="form-control mt-4" rows="10" id="system"
                                                  name="technical_analysis">@if(!empty($model)){{$model->technical_analysis}}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Financial analysis')}}
                                    </label>

                                    <textarea class="form-control mt-4" rows="10" id="style"
                                              name="financial_analysis">@if(!empty($model)){{$model->financial_analysis}}@endif</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">

                            <div class="col-md-6 align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Improvement activities')}}
                                    </label>

                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="shared"
                                              name="improvement_activities">@if(!empty($model)){{$model->improvement_activities}}@endif</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Observations and recommendations')}}
                                    </label>
                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="observations"
                                              name="recommendations">@if(!empty($model)){{$model->recommendations}}@endif</textarea>
                                </div>
                            </div>

                        </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">
                                            {{__('Uncertainty level')}}
                                        </label><span class="text-danger">*</span>
                                        <select class="form-select" aria-label="Default select example" name="uncertainty_level">
                                            <option value="High"
                                                    @if(($model->uncertainty_level ?? null) === 'High') selected @endif>{{__('High')}}</option>
                                            <option value="Tolerable"
                                                    @if(($model->uncertainty_level ?? null) === 'Tolerable') selected @endif>{{__('Tolerable')}}</option>
                                            <option value="Low" @if(($model->uncertainty_level ?? null) === 'Low') selected @endif>{{__('Low')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">
                                            {{__('Feasibility level')}}
                                        </label><span class="text-danger">*</span>
                                        <select class="form-select" aria-label="Default select example" name="feasibility_level">
                                            <option value="Investment ready"
                                                    @if(($model->feasibility_level ?? null) === 'Investment ready') selected @endif>{{__(' Investment ready')}}</option>
                                            <option value="Feasible for validation"
                                                    @if(($model->feasibility_level ?? null) === 'Feasible for validation') selected @endif>{{__(' Feasible for validation')}}</option>
                                            <option value="Little feasible" @if(($model->feasibility_level ?? null) === 'Little feasible') selected @endif>{{__('Little feasible')}}</option>
                                        </select>
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

        $(function () {
            "use strict";

            flatpickr("#date", {

                dateFormat: "Y-m-d",
            });

        });

    </script>
    <script>

        (function(){
            "use strict";
            tinymce.init({
                selector: '#structure',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#strategy',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#system',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#skill',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#staff',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#style',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#observations',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#shared',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
        })();
    </script>
@endsection

