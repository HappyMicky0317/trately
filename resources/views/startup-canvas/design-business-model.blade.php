@extends('layouts.primary')

@section('content')

    <form method="post" action="/save-startup-canvas">

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h4 class="font-weight-bolder">{{__('Startup Model Canvas')}}</h4>
                </div>
                <div class="col text-end ">
                    <button class="btn btn-info  text-end" type="submit">{{__('Save')}}</button>
                </div>

            </div>

            <p><strong>{{__('One Page Business Plan')}}</strong></p>
            <p>{{__('The Lean Startup Canvas is a version of the Business Model Canvas and it is specially designed for StartUps and Entrepreneurs. The Lean Canvas focuses on addressing broad customer problems, solutions, key metrics, competitive advantages and delivering them to customer segments through a unique value proposition.
')}}</p>
            <hr>

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
                                            @if (!empty($investor))
                                            @if ($investor->product_id === $product->id)
                                            selected
                                        @endif
                                        @endif
                                    >{{$product->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">

                    <!-- Canvas -->
                    <table class="border-0 ">
                        <!-- Upper part -->

                        <tr>
                            <td style= "padding:10px" colspan="2" rowspan="2">
                                <h6>{{__('Problems')}}</h6>
                                <textarea  class="bg-purple-light" name="problems" cols="35" rows="30" id="problems">@if(!empty($model)){!! $model->problems !!}@endif</textarea>


                            </td>
                            <td style= "padding:10px" colspan="2">
                                <h6>{{__('Solutions')}}</h6>
                                <textarea name="solutions" cols="35" rows="15"  id="solutions">@if(!empty($model)){!! $model->solutions !!}@endif
                                            </textarea>
                            </td>
                            <td style= "padding:10px" colspan="2" rowspan="2">
                                <h6>{{__('Unique Value Proposition')}}</h6>

                                <textarea name="value_propositions" cols="25" rows="30" id="value">@if(!empty($model)){!! $model->value_propositions !!}@endif</textarea>
                            </td>
                            <td style= "padding:10px" colspan="2">
                                <h6>{{__('Unfair Advantage')}}</h6>
                                <textarea name="unfair_advantage" cols="35" rows="15" id="advantage">@if(!empty($model)){!! $model->unfair_advantage !!}@endif</textarea>
                            </td>
                            <td style= "padding:10px" colspan="2" rowspan="2">
                                <h6>{{__('Customer Segments')}}</h6>

                                <textarea name="customer_segments" cols="35" rows="30" id="customer_segments">@if(!empty($model)){!! $model->customer_segments !!}@endif</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style= "padding:10px" colspan="2">
                                <h6>{{__('Key Metrics')}}</h6>

                                <textarea name="key_matrices" cols="35" rows="15" style="background-color:#C1F5D3; border-color:#C1F5D3; padding:10px" id="metrics">@if(!empty($model)){!! $model->key_matrices !!}@endif</textarea>
                            </td>
                            <td style= "padding:10px" colspan="2">
                                <h6>{{__('Channels')}}</h6>

                                <textarea name="channels" cols="35" rows="15" id="channels">@if(!empty($model)){!! $model->channels !!}@endif</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style= "padding:10px" colspan="5">
                                <h6>{{__('Cost Structure')}}</h6>

                                <textarea name="cost_structure" cols="75" rows="15" id="cost_structure">@if(!empty($model)){!! $model->cost_structure !!}@endif</textarea>
                            </td>
                            <td style= "padding:10px" colspan="5">
                                <h6>{{__('Revenue Streams')}}</h6>

                                <textarea name="revenue_stream" cols="75" rows="15" style=" padding:10px" id="revenue_stream">@if(!empty($model)){!! $model->revenue_stream !!}@endif</textarea>
                            </td>
                        </tr>
                    </table>
                    <!-- /Canvas -->
                </div>

                @if($model)
                    <input type="hidden" name="id" value="{{$model->id}}">
                    <input type="hidden" name="admin_id" value="{{$model->admin_id}}">
                @endif
                @csrf
                <button class="btn btn-info mt-4" type="submit">{{__('Save')}}</button>

        </div>
    </div>
    </form>
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
                selector: '#problems',

                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',

                lists_indent_on_tab: false,

                branding: false,
                menubar: false,

            });
            tinymce.init({
                selector: '#solutions',

                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#value',

                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#advantage',

                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#metrics',

                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#cost_structure',

                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#customer_segments',

                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#channels',

                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#value_propositions',

                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#revenue_stream',

                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
        })();
    </script>

@endsection
