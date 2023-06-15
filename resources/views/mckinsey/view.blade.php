@extends('layouts.primary')
@section('content')

    @if (!empty($model))

       <div class="row d-print-none">
           <div class=" text-center">
               <a href="/new-mckinsey-model?id={{$model->id}}" class="btn btn-white border-radius-lg p-2 mt-2" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="Edit">
                   <i class="fas fa-pen p-2"></i>
               </a>
               <a href="#" onclick="window.print()" class="btn btn-white border-radius-lg p-2 mt-2" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Print">
                   <i class="fas fa-print p-2"></i>
               </a>
               <a href="/mckinsey-models" class="btn btn-white border-radius-lg p-2 mt-2" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="List">
                   <i class="fas fa-ellipsis-h p-2"></i>
               </a>

           </div>
       </div>
    @endif


    <div class="row ">

        <h4 class="text-center text-secondary mb-5">

            {{__(' McKinsey 7-S Model of')}}
            @if (!empty($model))
                {{$model->company_name}}
            @endif

        </h4>

        <div class="col-md-6">
                <div class="d-flex px-2 py-1 mb-3">
                    <div>
                        <div class="avatar avatar-xxl rounded-circle bg-lightblue shadow text-center">
                            {{__(' Style')}}
                        </div>

                    </div>
                    <div class="d-flex flex-column justify-content-center ms-3">
                        <a href="">
                            <h6 class="mb-0"><p class="mb-0 text-secondary">
                                    @if (!empty($model))
                                        {!! $model->style !!}
                                    @endif
                                </p></h6>
                        </a>

                        <p class=" text-sm text-muted mb-0"></p>
                    </div>
                </div>
                <div class="d-flex px-2 py-1 mb-3">
                    <div>
                        <div class="avatar avatar-xxl rounded-circle bg-info shadow text-center">
                            {{__('Staff')}}

                        </div>


                    </div>
                    <div class="d-flex flex-column justify-content-center ms-3">
                        <a href="">
                            <h6 class="mb-0"><p class="mb-0 text-secondary">
                                    @if (!empty($model))
                                        {!! $model->staff !!}
                                    @endif
                                </p></h6>
                        </a>

                        <p class=" text-sm text-muted mb-0"></p>
                    </div>
                </div>
                <div class="d-flex px-2 py-1 mb-3">
                    <div>
                        <div class="avatar avatar-xxl rounded-circle bg-darkblue shadow text-center">
                            {{__('Skill')}}
                        </div>


                    </div>
                    <div class="d-flex flex-column justify-content-center ms-3">
                        <a href="">
                            <h6 class="mb-0"><p class="mb-0 text-secondary">
                                    @if (!empty($model))
                                        {!! $model->skill !!}
                                    @endif
                                </p>
                            </h6>
                        </a>

                        <p class=" text-sm text-muted mb-0"></p>
                    </div>
                </div>
                <div class="d-flex px-2 py-1">
                    <div>
                        <div class="avatar avatar-xxl rounded-circle  bg-gradient-dark shadow text-center">
                            {{__('Shared')}}
                            <br>
                            {{__('Values')}}
                        </div>


                    </div>
                    <div class="d-flex flex-column justify-content-center ms-3">
                        <a href="">
                            <h6 class="mb-0"><p class="mb-0 text-secondary">
                                    @if (!empty($model))
                                        {!! $model->shared_values!!}
                                    @endif
                                </p></h6>
                        </a>

                        <p class=" text-sm text-muted mb-0"></p>
                    </div>
                </div>

        </div>
        <div class="col-md-6 ">

            <div class="d-flex px-2 py-1 mb-3">
                <div>
                    <div class="avatar avatar-xxl rounded-circle bg-lightblue shadow text-center">
                        {{__(' Structure')}}
                    </div>


                </div>
                <div class="d-flex flex-column justify-content-center ms-3">
                    <a href="">
                        <h6 class="mb-0"><p class="mb-0 text-secondary">
                                @if (!empty($model))
                                    {!! $model->structure!!}
                                @endif
                                </p>
                        </h6>
                    </a>

                    <p class="text-sm text-muted mb-0"></p>
                </div>
            </div>


            <div class="d-flex px-2 py-1 mb-3">
                <div>
                    <div class="avatar avatar-xxl rounded-circle bg-info shadow text-center">
                        {{__(' Strategy')}}
                    </div>


                </div>
                <div class="d-flex flex-column justify-content-center ms-3">
                    <a href="">
                        <h6 class="mb-0">
                            <p class="mb-0 text-secondary">
                                @if (!empty($model))
                                    {!! $model->strategy!!}
                                @endif
                            </p>
                        </h6>
                    </a>

                    <p class=" text-sm text-muted mb-0"></p>
                </div>
            </div>
            <div class="d-flex px-2 py-1 mb-3">
                <div>
                    <div class="avatar avatar-xxl rounded-circle bg-darkblue shadow text-center">
                        {{__('System')}}
                    </div>


                </div>
                <div class="d-flex flex-column justify-content-center ms-3">
                    <a href="">
                        <h6 class="mb-0"><p class="mb-0 text-secondary">
                                @if (!empty($model))
                                    {!! $model->system!!}
                                @endif
                            </p>
                        </h6>
                    </a>

                    <p class=" text-sm text-muted mb-0"></p>
                </div>
            </div>
        </div>
    </div>

@endsection
