@extends('layouts.primary')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="font-weight-bolder">{{__('Porter\'s Five Forces Model')}}</h4>
                    <p>{{__('The Porter\'s Five Forces Model is *a framework for analyzing a company\'s
competitive environment*.
')}}</p>
                    <hr>
                    <form method="post" action="/save-porter-model">
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
                                            {{__('Threat of New Entry')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('Profitable markets attract new entrants, which erodes profitability. Unless incumbents have strong and durable barriers to entry, for example, patents, economies of scale, capital requirements or government policies, then profitability will decline to a competitive rate.')}}

                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="structure"
                                                  name="entrants">@if (!empty($model)){{$model->entrants}}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Competitive rivalry')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('The main driver is the number and capability of competitors in the market. Many competitors, offering undifferentiated products and services, will reduce market attractiveness.')}}

                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="strategy" name="rivals">@if (!empty($model)){{$model->rivals}}@endif</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col align-self-end">
                                <div class="col align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Bargaining Power of Supplier')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('An assessment of how easy it is for suppliers to drive up prices. This is driven by the: number of suppliers of each essential input; uniqueness of their product or service; relative size and strength of the supplier; and cost of switching from one supplier to another.')}}
                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="system"
                                                  name="suppliers">@if(!empty($model)){{$model->suppliers}}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Bargaining Power of Buyers/Customers.')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('An assessment of how easy it is for buyers to drive prices down. This is driven by the: number of buyers in the market; importance of each individual buyer to the organisation; and cost to the buyer of switching from one supplier to another. If a business has just a few powerful buyers, they are often able to dictate terms.')}}
                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="style"
                                              name="customers">@if(!empty($model)){{$model->customers}}@endif</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">

                            <div class="col-md-12 align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Threat of substitution')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('Where close substitute products exist in a market, it increases the likelihood of customers switching to alternatives in response to price increases. This reduces both the power of suppliers and the attractiveness of the market.')}}
                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="shared"
                                              name="substitute">@if(!empty($model)){{$model->substitute}}@endif</textarea>
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
                selector: '#shared',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
        })();
    </script>
@endsection

