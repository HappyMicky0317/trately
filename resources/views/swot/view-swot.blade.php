@extends('layouts.primary')
@section('content')
    <div class="row d-print-none">
        <div class="col  text-center">
            <h5 class="mb-2 text-secondary fw-bolder">
                {{__('SWOT Analysis of')}}
                @if (!empty($model))
                    {{$model->company_name}}
                @endif

            </h5>
        </div>

    </div>
    <div class="row mt-3">
        <div class="col-lg-1 col-md-1 pt-5 pt-lg-0 ms-lg-2 text-center d-print-none">


            <a href="/write-swot?id={{$model->id}}" class="btn btn-white border-radius-lg p-2 mt-2" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="Edit">
                <i class="fas fa-pen p-2"></i>
            </a>
            <a href="#" onclick="window.print()" class="btn btn-white border-radius-lg p-2 mt-2" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Print">
                <i class="fas fa-print p-2"></i>
            </a>
            <a href="/swot-list" class="btn btn-white border-radius-lg p-2 mt-2" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="List">
                <i class="fas fa-ellipsis-h p-2"></i>
            </a>
        </div>

        <div class="col-md-10">

            <div class="card-group">
                <div class="card">
                    <div class="card-header fw-bolder  text-purple bg-purple-light border-success">
                        <h1 class="text-purple">S</h1>
                        {{__('Strengths')}}
                    </div>
                    <div class="card-body">
                        <p>
                            @if (!empty($model))
                                {!!clean($model->strengths)!!}
                            @endif

                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header fw-bolder  text-danger bg-pink-light border-success">
                        <h1 class="text-danger">W</h1>
                        {{__('Weaknesses')}}
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            @if (!empty($model))
                                {!!clean($model->weaknesses)!!}
                            @endif

                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header fw-bolder  text-success bg-success-light border-success">
                        <h1 class="text-success">O</h1>
                        {{__('Opportunities')}}
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            @if (!empty($model))
                                {!!clean($model->opportunities)!!}
                            @endif

                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header fw-bolder text-warning bg-warning-light border-success">
                        <h1 class="text-warning">T</h1>
                        {{__('Threats')}}
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            @if (!empty($model))
                                {!!clean($model->threats)!!}
                            @endif

                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
