@extends('layouts.primary')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>{{__('Write your Business plan')}}</h3>
        </div>
        <div class="card-body multisteps-form">
            <form action="/business-plan-post" class="multisteps-form__form mb-8" enctype="multipart/form-data" method="post">
                @if ($errors->any())
                    <div class="alert bg-pink-light text-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error => $error_message)
                                <li>{{ $error_message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label">{{__('Business Name')}}</label><label class="text-danger">*</label>
                    <input class="form-control" type="text" name="company_name"
                        value="{{$plan->company_name ?? old('company_name') ?? ''}}">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="example-search-input" class="form-control-label">{{__('Your Name')}}</label><label class="text-danger">*</label>
                            <input class="form-control" name="name" type="text"
                                   value="{{$plan->name ?? old('name') ?? ''}}">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="example-search-input" class="form-control-label">{{__('Date')}}</label>
                            <input class="form-control" name="date" id="date" @if(!empty($plan))
                            value="{{$plan->date}}"
                                   @else
                                   value="{{date('Y-m-d')}}"
                                @endif >
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="example-email-input" class="form-control-label">{{__('Email')}}</label>
                            <input class="form-control" type="email" name="email"
                                   @if(!empty($plan))value="{{$plan->email}}"@endif>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="example-tel-input" class="form-control-label">{{__('Phone')}}</label>
                            <input class="form-control" type="tel" name="phone"
                                   @if(!empty($plan))value="{{$plan->phone}}"@endif>
                        </div>
                    </div>
                </div>
                    <div class="form-group">
                        <label for="logo_file" class="form-label mt-4">{{__('Upload Logo')}}</label>
                        <input class="form-control" name="logo" type="file" id="logo_file">
                    </div>
                <div class="form-group">
                    <label for="example-url-input" class="form-control-label">{{__('Website')}}</label>
                    <input class="form-control" name="website"
                           @if(!empty($plan))value="{{$plan->website}}"@endif>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">
                        {{__('Executive Summary')}}

                    </label>
                    <p class="form-text text-muted text-xs ms-1">
                        {{__('A snapshot of your business')}}
                    </p>
                    <textarea class="form-control" name="ex_summary" id="ex_summary"
                              rows="10">@if (!empty($plan)){{$plan->ex_summary}}@endif</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">
                        {{__('Company description')}}

                    </label>
                    <p class="form-text text-muted text-xs ms-1">
                        {{__('Describe what you do')}}
                    </p>
                    <textarea class="form-control" name="description" id="com_description"
                              rows="10">@if(!empty($plan)){{$plan->description}}@endif</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">
                        {{__('Market Analysis')}}

                    </label>
                    <p class="form-text text-muted text-xs ms-1">
                        {{__('Rsesearch on your industry, market and competitors')}}
                    </p>
                    <textarea class="form-control" name="m_analysis" id="market_analysis"
                              rows="10">@if(!empty($plan)){{$plan->m_analysis}}@endif</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">
                        {{__('Organization & Management')}}

                    </label>
                    <p class="form-text text-muted text-xs ms-1">
                        {{__('Your business and management structure')}}
                    </p>
                    <textarea class="form-control" name="management" id="organization"
                              rows="10">@if(!empty($plan)){{$plan->management}}@endif</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">
                        {{__('Service or product')}}

                    </label>
                    <p class="form-text text-muted text-xs ms-1">
                        {{__('The products or services you’re offering')}}
                    </p>
                    <textarea class="form-control" name="product" id="service_product"
                              rows="10">@if(!empty($plan)){{$plan->product}}@endif</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">
                        {{__('Marketing and sales')}}

                    </label>
                    <p class="form-text text-muted text-xs ms-1">
                        {{__('How you’ll market your business and your sales strategy')}}
                    </p>
                    <textarea class="form-control" name="marketing" id="marketing_sale"
                              rows="10">@if(!empty($plan)){{$plan->marketing}}@endif</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">
                        {{__('Budget')}}

                    </label>
                    <p class="form-text text-muted text-xs ms-1">
                        {{__('Budget of your company for next 2 years with source of the moneys')}}
                    </p>
                    <textarea class="form-control" name="budget" id="budget"
                              rows="10">@if(!empty($plan)){{$plan->budget}}@endif</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">
                        {{__('Investment/Funding request')}}

                    </label>
                    <p class="form-text text-muted text-xs ms-1">
                        {{__('How much money you’ll need for next 3 to 5 years')}}
                    </p>
                    <textarea class="form-control" name="investment" id="investment"
                              rows="10">@if(!empty($plan)){{$plan->investment}}@endif</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">
                        {{__('Financial projections')}}

                    </label>
                    <p class="form-text text-muted text-xs ms-1">
                        {{__('Supply information like balance sheets')}}
                    </p>
                    <textarea class="form-control" name="finance" id="financial_projections"
                              rows="10">@if(!empty($plan)){{$plan->finance}}@endif</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">
                        {{__('Appendix')}}

                    </label>
                    <p class="form-text text-muted text-xs ms-1">
                        {{__('An optional section that includes résumés and permits')}}
                    </p>
                    <textarea class="form-control" name="appendix" id="appendix"
                              rows="10">@if(!empty($plan)){{$plan->appendix}}@endif</textarea>
                </div>
                    <div class="form-group mb-4">
                        <label for="logo_file" class="form-label mt-3 ">{{__('Upload file')}}</label>
                        <p class="form-text text-muted text-xs ms-1">
                            {{__('Upload résumés and permits')}}
                        </p>
                        <input class="form-control" name="file" type="file" id="logo_file">
                    </div>

                @csrf
                @if($plan)
                    <input type="hidden" name="id" value="{{$plan->id}}">
                @endif
                <button type="submit" class="btn bg-gradient-dark">{{__('Save')}}</button>

            </form>
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
                selector: '#ex_summary',

                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                branding: false,

            });
            tinymce.init({
                selector: '#com_description',

                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                branding: false,

            });
            tinymce.init({
                selector: '#market_analysis',

                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',

                    'insertdatetime media table paste code  wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                branding: false,


            });
            tinymce.init({
                selector: '#organization',

                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',

                    'insertdatetime media table paste code  wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                branding: false,


            });
            tinymce.init({
                selector: '#service_product',

                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',

                    'insertdatetime media table paste code  wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                branding: false,


            });
            tinymce.init({
                selector: '#marketing_sale',

                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',

                    'insertdatetime media table paste code  wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                branding: false,


            });
            tinymce.init({
                selector: '#budget',

                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',

                    'insertdatetime media table paste code  wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                branding: false,


            });
            tinymce.init({
                selector: '#investment',

                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',

                    'insertdatetime media table paste code  wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                branding: false,


            });
            tinymce.init({
                selector: '#financial_projections',

                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',

                    'insertdatetime media table paste code  wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                branding: false,
            });
            tinymce.init({
                selector: '#appendix',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,

            });
        })();
    </script>

@endsection
