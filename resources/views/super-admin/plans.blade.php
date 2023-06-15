@extends('layouts.super-admin-portal')
@section('content')
    <div class="row mb-2">
        <div class="col">
            <h5 class=" text-secondary fw-bolder">
                {{__('Subscription Plan List')}}
            </h5>
            <p class="text-muted">{{__('Create, edit or delete the plans')}}</p>
        </div>
        <div class="col text-end">
            <a href="/subscription-plan" type="button" class="btn btn-info">{{__('Create Plan')}}</a>
        </div>
    </div>

    <div class="row">
        @foreach($plans as $plan)
            <div class="col-md-4  mb-4 ">
                <div class="card ">
                    <div class="card-header text-center ">
                        <h5 class="text-purple opacity-8 text mb-2">{{$plan->name}}</h5>
                        <p>{!! $plan->description !!}</p>
                        <span>
                            <h4 class="font-weight-bolder">
                           {{formatCurrency($plan->price_monthly,getWorkspaceCurrency($settings))}} /<span><small
                                        class=" text-sm text-warning text-uppercase">{{__(' month')}}</small></span>
                            </h4>
                        </span>
                        <h4 class="mt-0">
                            {{formatCurrency($plan->price_yearly,getWorkspaceCurrency($settings))}} /<span><small
                                    class="text-sm  text-uppercase text-warning">{{__(' year')}}</small></span>
                        </h4>
                    </div>
                    <div class="card-body mx-auto pt-0">

                        @if($plan->features)
                            @foreach(json_decode($plan->features) as $feature)

                                <div class="justify-content-start d-flex px-2 py-1">
                                    <div>
                                        <i class="icon icon-shape text-center icon-xs rounded-circle fas fa-check bg-purple-light text-purple text-sm"></i>
                                    </div>
                                    <div class="ps-2">
                                        <span class="text-sm">{{$feature}}</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                    <div class="card-footer text-center pt-0">
                        <a href="/subscription-plan?id={{$plan->id}}" type="button"
                           class="btn btn-info mt-3 btn-md ">{{__('Edit')}}</a>
                        <a href="/delete/subscription-plan/{{$plan->id}}" type="button"
                           class="btn btn-warning btn-md mt-3">{{__('Delete')}}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
