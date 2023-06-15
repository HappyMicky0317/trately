@extends('layouts.primary')
@section('content')



    <div class="row mt-3">

        <div class="col-md-1 text-center d-print-none">


            <a href="/new-report?id={{$model->id}}" class="btn btn-white border-radius-lg p-2 mt-2" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="Edit">
                <i class="fas fa-pen p-2"></i>
            </a>
            <a href="#" onclick="window.print()" class="btn btn-white border-radius-lg p-2 mt-2" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Print">
                <i class="fas fa-print p-2"></i>
            </a>
            <a href="/reports" class="btn btn-white border-radius-lg p-2 mt-2" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="List">
                <i class="fas fa-ellipsis-h p-2"></i>
            </a>
        </div>

        <div class="col-md-11">
            <div class="page-header mb-4">
                <span class="mask bg-purple-light"></span>
                <div class="container">

                    <div class="col-md-12 mt-3 mb-2">

                        <h4 class="text-purple  fw-bolder fadeIn2 fadeInBottom mt-4 mb-2"> {{__('Report of')}}
                            @if(!empty($products[$model->product_id]))
                                @if(isset($products[$model->product_id]))
                                    {{$products[$model->product_id]->title}}
                                @endif
                            @endif
                        </h4>
                        <h6 class="text-muted fadeIn2 fadeInBottom">
                            @if(!empty($model->date))
                                {{(\App\Supports\DateSupport::parse($model->date))->format(config('app.date_format'))}}

                            @endif
                        </h6>
                        <p class="text-sm">{{__('Produced By')}}:<strong> {{$model->name}}</strong></p>


                        <p class="text-sm">{{__('Status')}}:
                            <span class="badge bg-info-light"> {{$model->status}}</span></p>
                        <p class="text-sm">{{__('Uncertainty level')}}:
                            <span class="badge bg-secondary">{{$model->uncertainty_level}}</span></p>
                        <p class="text-sm">{{__('Feasibility level')}}:
                            <span class="badge bg-success-light">{{$model->feasibility_level}}</span></p>

                    </div>

                </div>
            </div>

            @if($model->executive_summary)
                <div class="mt-4">
                    <h6>{{__('Executive Summary')}}</h6>
                </div>
                <div>
                    {!! $model->executive_summary !!}
                </div>
            @endif

            @if($model->administrative_analysis)
                <div class="mt-4">
                    <h6>{{__('Administrative analysis')}}</h6>
                </div>
                <div>
                    {!! $model->administrative_analysis !!}
                </div>
            @endif
            @if($model->technical_analysis)
                <div class="mt-4">
                    <h6>{{__('Technical analysis')}}</h6>
                </div>
                <div>
                    {!! $model->technical_analysis !!}
                </div>
            @endif
            @if($model->financial_analysis)
                <div class="mt-4">
                    <h6>{{__('Financial analysis')}}</h6>
                </div>
                <div>
                    {!! $model->financial_analysis !!}
                </div>
            @endif
            @if($model->improvement_activities)
                <div class="mt-4">
                    <h6>{{__('Improvement activities')}}</h6>
                </div>
                <div>
                    {!! $model->improvement_activities !!}
                </div>
            @endif



        </div>
    </div>
@endsection
