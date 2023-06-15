@extends('layouts.primary')
@section('content')
    <div class="row mt-1 d-print-none">
        <div class="col">
            <h5 class="text-secondary fw-bolder">
                {{__('Business Plan')}}
            </h5>
        </div>
        <div class="col text-end">
            <a href="#" onclick="window.print()"
               class="btn bg-gradient-dark btn-sm add_event waves-effect waves-light">{{__('Print')}}</a>
            <a href="/write-business-plan?id={{$plan->id}}"
               class="btn btn-sm btn-warning add_event waves-effect waves-light">{{__('Edit')}}</a>
            <a href="/delete/business-plan/{{$plan->id}}"
               class="btn btn-sm btn-danger add_event waves-effect waves-light">{{__('Delete')}}</a>
        </div>

    </div>

    <div class="">
        <div class="col-lg-12">
            <div class="card-body ">
                <div class="page-header mb-4">
                    <span class="mask bg-purple-light"></span>
                    <div class="container">
                        <div class="row">

                            <div class="col-md-12 mt-3 mb-2">

                                <h5 class="text-dark">
                                    @if(!empty($plan->logo))
                                        <img src="{{PUBLIC_DIR}}/uploads/{{$plan->logo}}" class="w-5">
                                    @endif
                                    {{$plan->company_name}}
                                </h5>

                                <h4 class="text-purple  fw-bolder fadeIn2 fadeInBottom mt-4 mb-2">{{__('Business Plan')}}</h4>
                                <h6 class="text-muted fadeIn2 fadeInBottom">
                                    @if(!empty($plan->date))
                                        {{(\App\Supports\DateSupport::parse($plan->date))->format(config('app.date_format'))}}

                                    @endif
                                </h6>
                            </div>
                            <div class="mb-3">
                                <h6 class="text-secondary">{{__('Written By')}}</h6>
                                <h6>{{$plan->name}}</h6>
                                <h6 class="text-muted">{{$plan->email}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                @if($plan->ex_summary)
                    <div class="mt-4">
                        <h6>{{__('Executive Summary')}}</h6>
                    </div>
                    <div>
                        {!! $plan->ex_summary !!}
                    </div>
                @endif
                @if($plan->description)
                    <div class="mt-4">
                        <h6>{{__('Company description')}}</h6>
                    </div>
                    {!! $plan->description !!}
                @endif
                @if($plan->m_analysis)

                    <div class="mt-4">
                        <h6>{{__('Market Analysis')}}</h6>
                    </div>
                    {!! $plan->m_analysis !!}

                @endif


                @if($plan->management)

                    <div class="mt-4">
                        <h6>{{__('Organization & Management')}}</h6>
                    </div>
                    {!! $plan->management !!}

                @endif

                @if($plan->product)

                    <div class="mt-4">
                        <h6>{{__('Service or product')}}</h6>
                    </div>
                    {!! $plan->product !!}

                @endif

                @if($plan->marketing)

                    <div class="mt-4">
                        <h6>{{__('Marketing and sales')}}</h6>
                    </div>
                    {!! $plan->marketing !!}

                @endif

                @if($plan->budget)
                    <div class="mt-4">
                        <h6>{{__('Budget')}}</h6>
                    </div>
                    {!! $plan->budget !!}
                @endif

                @if( $plan->investment )
                    <div class="mt-4">
                        <h6>{{__('Investment/Funding request')}}</h6>
                    </div>
                    {!! $plan->investment !!}
                @endif

                @if($plan->finance)
                    <div class="mt-4">
                        <h6>{{__('Financial projections')}}</h6>
                    </div>
                    {!! $plan->finance !!}
                @endif

                @if($plan->appendix)
                    <div class="mt-4">
                        <h6>{{__('Appendix')}}</h6>
                    </div>
                    {!! $plan->appendix !!}
                @endif

                @if(!empty($plan->file))
                    <div class="">
                        <!-- Buttons -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-file-text">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        <a href="{{PUBLIC_DIR}}/uploads/{{$plan->file}}" class="fw-bolder">
                            {{$plan->file}}
                        </a>

                    </div>

                @endif
            </div>
        </div>
    </div>
@endsection
