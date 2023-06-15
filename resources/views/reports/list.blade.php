@extends('layouts.primary')
@section('content')

    <div class=" row">
        <div class="col">
            <h5 class="mb-2 text-secondary fw-bolder">
                {{__('Reports')}}
            </h5>

        </div>
        <div class="col text-end">
            <a href="/new-report" type="button" class="btn btn-info">
                {{__('New Report')}}
            </a>
        </div>
    </div>

    <div>
        <div class="row">
            @foreach($models as $model)
                <div class="col-lg-4 col-md-6 col-12 mt-lg-0 mb-4">
                    <div class="card mb-3 mt-lg-0 mt-4">
                        <div class="card-body pb-0">
                            <div class="row align-items-center mb-3">
                                <div class="col-9">
                                    <h5 class=" fw-bolder text-dark text-primary">
                                        <a href="/view-report?id={{$model->id}}"></a>
                                    </h5>
                                </div>
                                <div class="col-3 text-end">
                                    <div class="dropstart">
                                        <a href="javascript:" class="text-secondary" id="dropdownMarketingCard"
                                           data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3"
                                            aria-labelledby="dropdownMarketingCard">
                                            <li><a class="dropdown-item border-radius-md"
                                                   href="/new-report?id={{$model->id}}">{{__('Edit')}}</a></li>

                                            <li><a class="dropdown-item border-radius-md"
                                                   href="/view-report?id={{$model->id}}">{{__('See Details')}}</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item border-radius-md text-danger"
                                                   href="/delete/report/{{$model->id}}">{{__('Delete')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <p class="text-sm">{{__('Related Product')}}:<span class="text-dark fw-bolder"> @if(!empty($products[$model->product_id]))
                                            @if(isset($products[$model->product_id]))
                                                {{$products[$model->product_id]->title}}
                                            @endif
                                        @endif</span></p>
                                <p class="text-sm">{{__('Designed By')}}:<span class="text-purple fw-bolder"> @if($model->name)
                                            {{$model->name}}
                                        @endif</span></p>
                                <p class="text-sm">{{__('Created At')}}:
                                    <span > {{(\App\Supports\DateSupport::parse($model->date))->format(config('app.date_format'))}}</span></p>
                                <p class="text-sm">{{__('Status')}}:
                                    <span class="badge bg-info-light"> {{$model->status}}</span></p>
                                <p class="text-sm">{{__('Uncertainty level')}}:
                                    <span class="badge bg-secondary">{{$model->uncertainty_level}}</span></p>
                                <p class="text-sm">{{__('Feasibility level')}}:
                                    <span class="badge bg-success-light">{{$model->feasibility_level}}</span></p>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
