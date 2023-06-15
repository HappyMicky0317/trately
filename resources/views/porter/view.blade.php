@extends('layouts.primary')
@section('content')

    <div class="row d-print-none">


        <div class="col text-center">
            <h5 class="mb-2 text-secondary fw-bolder">
                {{__('Porter\'s Five Forces Model of')}}
                @if (!empty($model))
                    {{$model->company_name}}
                @endif

            </h5>
        </div>

    </div>
    <div class="row mt-3">
        <div class="col-md-1 text-center d-print-none">


            <a href="/new-porter?id={{$model->id}}" class="btn btn-white border-radius-lg p-2 mt-2" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="Edit">
                <i class="fas fa-pen p-2"></i>
            </a>
            <a href="#" onclick="window.print()" class="btn btn-white border-radius-lg p-2 mt-2" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Print">
                <i class="fas fa-print p-2"></i>
            </a>
            <a href="/porter-models" class="btn btn-white border-radius-lg p-2 mt-2" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="List">
                <i class="fas fa-ellipsis-h p-2"></i>
            </a>
        </div>
        <div class="col-md-11">
            <div class="card-group">

                <div class="card">

                    <div class="card-header fw-bolder text-center text-white bg-lightblue">

                        {{__('Threat of New Entry')}}
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            @if (!empty($model))
                                {!!clean($model->entrants)!!}
                            @endif

                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header fw-bolder text-center text-white bg-info">

                        {{__(' Bargaining Power of Suppliers')}}
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            @if (!empty($model))
                                {!!clean($model->suppliers)!!}
                            @endif

                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header fw-bolder text-center text-white  bg-darkblue">

                        {{__('Rivalry Among Existing Competitors')}}
                    </div>
                    <div class="card-body">
                        <p>  @if (!empty($model))
                                {!!clean($model->rivals)!!}
                            @endif

                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header fw-bolder  text-center bg-info text-white">

                        {{__('Bargaining Power of Buyers')}}
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            @if (!empty($model))
                                {!!clean($model->customers)!!}
                            @endif

                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header fw-bolder text-center text-white  bg-lightblue">

                        {{__('Threat of Substitute')}}
                    </div>
                    <div class="card-body">
                        <p>  @if (!empty($model))
                                {!!clean($model->substitute)!!}
                            @endif

                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
