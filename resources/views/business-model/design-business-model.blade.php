@extends('layouts.primary')
@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="font-weight-bolder">{{__('Business Model Canvas')}}</h4>
                    <p><strong>{{__('Source: Harvard Business Review, Entreprenuers Handbook ')}}</strong></p>
                    <hr>


                    <form method="post" action="/business-model-post">
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
                        <div class="row mt-4">
                            <div class="col align-self-center">
                                <div class="form-group">

                                    <label for="exampleFormControlTextarea1">
                                        {{__('Key Partners')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('Who are our key partners?')}}

                                    </p>
                                    <p class="form-text text-muted text-xs ms-1">

                                        {{__('Who are our key Suppliers?')}}

                                    </p>
                                    <p class="form-text text-muted text-xs ms-1">

                                        {{__('Which key resources are we acquiring from our partners?')}}

                                    </p>

                                    <textarea class="form-control mt-4" rows="10" id="partners"
                                              name="partners">@if (!empty($model)){{$model->partners}}@endif</textarea>
                                    @if(!empty($super_settings['openai_api_key']))
                                        <button class="btn btn-info mt-4" type="submit" id="generate_key_partners">{{__('Generate with AI')}}</button>
                                    @endif
                                    <button class="btn bg-success-light text-success shadow-none mt-4" type="submit">{{__('Save')}}</button>

                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col align-self-end">
                                <div class="col align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Key Activities')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('What key activities do our value propositions require?')}}
                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="activities"
                                                  name="activities">@if (!empty($model)){{$model->activities}}@endif</textarea>

                                        @if(!empty($super_settings['openai_api_key']))
                                            <button class="btn btn-info mt-4" type="submit" id="generate_key_activities">{{__('Generate with AI')}}</button>
                                        @endif
                                        <button class="btn bg-success-light text-success shadow-none mt-4" type="submit">{{__('Save')}}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Key Resources')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('What key resources do our value propositions require?')}}
                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="resources"
                                              name="resources">@if (!empty($model)){{$model->resources}}@endif</textarea>
                                    @if(!empty($super_settings['openai_api_key']))
                                        <button class="btn btn-info mt-4" type="submit" id="generate_key_resources">{{__('Generate with AI')}}</button>
                                    @endif
                                    <button class="btn bg-success-light text-success shadow-none mt-4" type="submit">{{__('Save')}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Value Propositions')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__(' What value do we deliver to the customer ?')}}
                                    </p>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('Which one of our customers problem are we helping to solve?')}}
                                    </p>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('What bundle of products or services are we offering to each segment?')}}
                                    </p>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('Which customer needs are we satisfying?')}}
                                    </p>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('What is the minimum viable product?')}}
                                    </p>

                                    <textarea class="form-control" rows="10" id="value_propositions"
                                              name="value_propositions">
@if (!empty($model)){{$model->value_propositions}}@endif</textarea>
                                    @if(!empty($super_settings['openai_api_key']))
                                        <button class="btn btn-info mt-4" type="submit" id="generate_value_propositions">{{__('Generate with AI')}}</button>
                                    @endif
                                    <button class="btn bg-success-light text-success shadow-none mt-4" type="submit">{{__('Save')}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col align-self-end">
                                <div class="col align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Customer Relationships')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__(' How do we get, keep and grow customers?')}}
                                        </p>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__(' Which cuustomer relationships have we established ?')}}
                                        </p>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__(' How are they integrated with the rest of our business model?')}}
                                        </p>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('How costly are they?')}}

                                        </p>

                                        <textarea class="form-control mt-4" rows="10" id="customer_relationships" name="customer_relationships">@if(!empty($model)){{$model->customer_relationships}}@endif</textarea>

                                        @if(!empty($super_settings['openai_api_key']))
                                            <button class="btn btn-info mt-4" type="submit" id="generate_customer_relationships">{{__('Generate with AI')}}</button>
                                        @endif
                                        <button class="btn bg-success-light text-success shadow-none mt-4" type="submit">{{__('Save')}}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Channels')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('  Through which channels do our customer segments wants to be reached?')}}
                                    </p>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('How do other companies reach them now?')}}
                                    </p>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('Which ones work best?')}}
                                    </p>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('Which ones are most cost-efficient?')}}
                                    </p>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('How are we integrating them with customer routines?')}}
                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="channels" name="channels">@if(!empty($model)){{$model->channels}}@endif</textarea>
                                    @if(!empty($super_settings['openai_api_key']))
                                        <button class="btn btn-info mt-4" type="submit" id="generate_channels">{{__('Generate with AI')}}</button>
                                    @endif
                                    <button class="btn bg-success-light text-success shadow-none mt-4" type="submit">{{__('Save')}}</button>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Customer Segments')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('For whom are we creating value?')}}

                                    </p>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('Who are our most important customers?')}}

                                    </p>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('What are the customer archetypes?')}}
                                    </p>
                                    <textarea class="form-control" rows="10" id="customer_segments" name="customer_segments">
@if(!empty($model)){{$model->customer_segments}}@endif</textarea>
                                    @if(!empty($super_settings['openai_api_key']))
                                        <button class="btn btn-info mt-4" type="submit" id="generate_customer_segments">{{__('Generate with AI')}}</button>
                                    @endif
                                    <button class="btn bg-success-light text-success shadow-none mt-4" type="submit">{{__('Save')}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col align-self-end">
                                <div class="col align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Cost Structure')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('What are the most important costs inherent to our business model?')}}
                                        </p>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('Which key resources are most expensive?')}}

                                        </p>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('Which key activities are most expensive?')}}

                                        </p>


                                        <textarea class="form-control" rows="10" id="cost_structure"
                                                  name="cost_structure">
@if(!empty($model)){{$model->cost_structure}}@endif</textarea>
                                        @if(!empty($super_settings['openai_api_key']))
                                            <button class="btn btn-info mt-4" type="submit" id="generate_cost_structure">{{__('Generate with AI')}}</button>
                                        @endif
                                        <button class="btn bg-success-light text-success shadow-none mt-4" type="submit">{{__('Save')}}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Revenue Stream')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('For what value are our customers willing to pay?')}}
                                    </p>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('For what do they currently pay?')}}
                                    </p>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('What is the revenue model?')}}
                                    </p>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('What are the pricing tactics?')}}
                                    </p>
                                    <textarea class="form-control" rows="10" id="revenue_stream" name="revenue_stream">@if(!empty($model)){{$model->revenue_stream}}@endif</textarea>
                                    @if(!empty($super_settings['openai_api_key']))
                                        <button class="btn btn-info mt-4" type="submit" id="generate_revenue_stream">{{__('Generate with AI')}}</button>
                                    @endif
                                    <button class="btn bg-success-light text-success shadow-none mt-4" type="submit">{{__('Save')}}</button>
                                </div>
                            </div>
                        </div>
                        @if($model)
                            <input type="hidden" name="id" value="{{$model->id}}">
                        @endif
                        @csrf
                       <button class="btn btn-dark shadow-none mt-4" type="submit">{{__('Save')}}</button>
                      <a href="/business-models" class="btn btn-secondary mt-4" type="submit">{{__('Go Back to list')}}</a>
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
            flatpickr("#date", {

                dateFormat: "Y-m-d",
            });
            tinymce.init({
                selector: '#partners',

                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
                content_langs: [

                    { title: 'French', code: 'fr' },

                ]
            });
            tinymce.init({
                selector: '#activities',
                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#resources',

                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#customer_relationships',
                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#cost_structure',

                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#customer_segments',

                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#channels',

                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#value_propositions',

                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
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


            @if(!empty($super_settings['openai_api_key']))

            let generate_key_partners = document.getElementById('generate_key_partners');
            let key_partners = document.getElementById('key_partners');

            generate_key_partners.addEventListener('click',function (e) {
                e.preventDefault();

                generate_key_partners.disabled = true;
                generate_key_partners.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'key_partners',
                }).then(function (response) {
                    tinymce.get("partners").setContent(response.data.message);

                    generate_key_partners.disabled = false;
                    generate_key_partners.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_key_activities = document.getElementById('generate_key_activities');
            let key_activities = document.getElementById('key_activities');

            generate_key_activities.addEventListener('click',function (e) {
                e.preventDefault();

                generate_key_activities.disabled = true;
                generate_key_activities.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'key_activities',
                }).then(function (response) {
                    tinymce.get("activities").setContent(response.data.message);

                    generate_key_activities.disabled = false;
                    generate_key_activities.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_key_resources = document.getElementById('generate_key_resources');
            let key_resources = document.getElementById('key_resources');

            generate_key_resources.addEventListener('click',function (e) {
                e.preventDefault();

                generate_key_resources.disabled = true;
                generate_key_resources.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'key_resources',
                }).then(function (response) {
                    tinymce.get("resources").setContent(response.data.message);

                    generate_key_resources.disabled = false;
                    generate_key_resources.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });


            let generate_value_propositions = document.getElementById('generate_value_propositions');
            let value_propositions = document.getElementById('value_propositions');

            generate_value_propositions.addEventListener('click',function (e) {
                e.preventDefault();

                generate_value_propositions.disabled = true;
                generate_value_propositions.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'value_propositions',
                }).then(function (response) {
                    tinymce.get("value_propositions").setContent(response.data.message);

                    generate_value_propositions.disabled = false;
                    generate_value_propositions.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_customer_relationships = document.getElementById('generate_customer_relationships');
            let customer_relationships = document.getElementById('customer_relationships');

            generate_customer_relationships.addEventListener('click',function (e) {
                e.preventDefault();

                generate_customer_relationships.disabled = true;
                generate_customer_relationships.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'customer_relationships',
                }).then(function (response) {
                    tinymce.get("customer_relationships").setContent(response.data.message);

                    generate_customer_relationships.disabled = false;
                    generate_customer_relationships.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_channels = document.getElementById('generate_channels');
            let channels = document.getElementById('channels');

            generate_channels.addEventListener('click',function (e) {
                e.preventDefault();

                generate_channels.disabled = true;
                generate_channels.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'channels',
                }).then(function (response) {
                    tinymce.get("channels").setContent(response.data.message);

                    generate_channels.disabled = false;
                    generate_channels.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_customer_segments = document.getElementById('generate_customer_segments');
            let customer_segments = document.getElementById('customer_segments');

            generate_customer_segments.addEventListener('click',function (e) {
                e.preventDefault();

                generate_customer_segments.disabled = true;
                generate_customer_segments.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'customer_segments',
                }).then(function (response) {
                    tinymce.get("customer_segments").setContent(response.data.message);

                    generate_customer_segments.disabled = false;
                    generate_customer_segments.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_cost_structure = document.getElementById('generate_cost_structure');
            let cost_structure = document.getElementById('cost_structure');

            generate_cost_structure.addEventListener('click',function (e) {
                e.preventDefault();

                generate_cost_structure.disabled = true;
                generate_cost_structure.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'cost_structure',
                }).then(function (response) {
                    tinymce.get("cost_structure").setContent(response.data.message);

                    generate_cost_structure.disabled = false;
                    generate_cost_structure.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_revenue_stream = document.getElementById('generate_revenue_stream');
            let revenue_stream = document.getElementById('revenue_stream');

            generate_revenue_stream.addEventListener('click',function (e) {
                e.preventDefault();

                generate_revenue_stream.disabled = true;
                generate_revenue_stream.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'revenue_stream',
                }).then(function (response) {
                    tinymce.get("revenue_stream").setContent(response.data.message);

                    generate_revenue_stream.disabled = false;
                    generate_revenue_stream.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });



            @endif

        })();
    </script>

@endsection
