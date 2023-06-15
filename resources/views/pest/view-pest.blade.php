@extends('layouts.primary')
@section('content')
    <div class="row d-print-none">


        <div class="col text-center">
            <h5 class="mb-2 text-secondary fw-bolder">
                {{__('PEST Analysis of')}}
                @if (!empty($model))
                    {{$model->company_name}}
                @endif

            </h5>
        </div>

    </div>
    <div class="row mt-3">
        <div class="col-lg-1 col-md-1 pt-5 pt-lg-0 ms-lg-2 text-center d-print-none">


            <a href="/write-pest?id={{$model->id}}" class="btn btn-white border-radius-lg p-2 mt-2" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="Edit">
                <i class="fas fa-pen p-2"></i>
            </a>
            <a href="#" onclick="window.print()" class="btn btn-white border-radius-lg p-2 mt-2" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Print">
                <i class="fas fa-print p-2"></i>
            </a>
            <a href="/pest-list" class="btn btn-white border-radius-lg p-2 mt-2" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="List">
                <i class="fas fa-ellipsis-h p-2"></i>
            </a>
        </div>
        <div class="col-md-10">
            <div class="card-group">

                <div class="card">

                    <div class="card-header fw-bolder text-center text-white bg-lightblue">
                        <h1 class="text-white">P</h1>
                        {{__('Political')}}
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            @if (!empty($model))
                                {!!clean($model->political)!!}
                            @endif

                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header fw-bolder text-center text-white bg-info">
                        <h1 class="text-white">E</h1>
                        {{__('Economic')}}
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            @if (!empty($model))
                                {!!clean($model->economic)!!}
                            @endif

                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header fw-bolder  text-center bg-darkblue text-white">
                        <h1 class="text-white">S</h1>
                        {{__('Social')}}
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            @if (!empty($model))
                                {!!clean($model->social)!!}
                            @endif

                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header fw-bolder text-center text-white  bg-extradarkblue">
                        <h1 class="text-white">T</h1>
                        {{__('Technological')}}
                    </div>
                    <div class="card-body">
                        <p>  @if (!empty($model))
                                {!!clean($model->technological)!!}
                            @endif

                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
