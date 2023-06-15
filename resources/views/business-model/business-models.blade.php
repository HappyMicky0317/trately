@extends('layouts.primary')
@section('content')
    <div class=" row">
        <div class="col">
            <h5 class="text-secondary fw-bolder">
                {{__('Business Models')}}
            </h5>
        </div>
        <div class="col text-end">
            <a href="/design-business-model" type="button" class="btn btn-info " data-bs-toggle="modal" data-bs-target="#exampleModal">{{__('Design Business Model')}}</a>
{{--            <a href="/design-business-model" type="button" class="btn btn-info">{{__('Design Business Model')}}</a>--}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mx-auto">

            <form >
                <div class="row  mb-3 mt-4">
                    <div class="col-md-6">
                        <label class="form-label  visually-hidden" for="searchJobCareers">{{__('Search')}}</label>

                        <!-- Form -->

                        <div class="input-group input-group-merge mb-3">

                            <input type="text" name="company_name" class="form-control form-control-lg" id="searchJobCareers" placeholder="Search business model" aria-label="Search business model">

                        </div>
                        <!-- End Form -->
                    </div>

                    <!-- End Col -->


                    <!-- End Col -->

                    <div class="col-md-3">

                        <!-- Select -->
                        <select class="form-select form-select-lg mb-3" name="product_id" id="model" aria-label="">
                            <option value="0">{{__('Product')}}</option>
                            @foreach ($products as $product)
                                <option value="{{$product->id}}"
                                        @if (!empty($model))
                                        @if ($model->product_id === $product->id)
                                        selected
                                    @endif
                                    @endif
                                >{{$product->title}}</option>
                            @endforeach
                        </select>
                        <!-- End Select -->
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-block bg-purple-light text-purple shadow-none
                        btn-lg btn-rounded me-3">
                            <i class="fas fa-search me-2"></i>
                            {{__('Search')}}</button>
                        <!-- End Select -->
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </form>
        </div>
        <div class="col-12">
            <div class="row">
                @foreach($models as $model)
                    <div class="col-lg-4 col-md-6 col-12 mt-lg-0 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row ">
                                    <div class="col-md-9">
                                        <h5 class="text-dark fw-bolder">{{$model->company_name}}</h5>

                                        <p class="text-sm">{{__('Related Product')}}:<span class="text-dark fw-bolder"> @if(!empty($products[$model->product_id]))
                                                    @if(isset($products[$model->product_id]))
                                                        {{$products[$model->product_id]->title}}
                                                    @endif
                                                @endif</span></p>
                                        <p class="text-sm">{{__('Designed By')}}:<span class="text-purple fw-bolder"> @if(isset($users[$model->admin_id]))
                                                    {{$users[$model->admin_id]->first_name}} {{$users[$model->admin_id]->last_name}}
                                                @endif</span></p>
                                        <p class="text-sm">{{__('Created At')}}:
                                            <span class="badge bg-info"> {{(\App\Supports\DateSupport::parse($model->updated_at))->format(config('app.date_format'))}}</span></p>
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
                                                       href="/design-business-model?id={{$model->id}}">{{__('Edit')}}</a>
                                                </li>
                                                <li><a class="dropdown-item border-radius-md"
                                                       href="/view-business-model?id={{$model->id}}">{{__('See Details')}}</a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item border-radius-md text-danger"
                                                       href="/delete/business-model/{{$model->id}}">{{__('Delete')}}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <!-- Button trigger modal -->
{{--    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">--}}
{{--        Launch demo modal--}}
{{--    </button>--}}

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('Business Model Canvas')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/business-model-post">
                        @if ($errors->any())
                            <div class="alert bg-pink-light text-danger">
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">
                                    {{__('Business/Company Name')}}
                                </label><label class="text-danger">*</label>
                                <input class="form-control" name="company_name" id="company_name">
                            </div>

                        </div>
                            <div class="">

                                <label for="exampleFormControlInput1" class="form-label">{{__('Select Product')}}</label>
                                <select class="form-select form-select-solid fw-bolder" id="contact"
                                        aria-label="Floating label select example" name="product_id">
                                    <option value="0">{{__('None')}}</option>
                                    @foreach ($products as $product)
                                        <option value="{{$product->id}}"
                                                @if (!empty($model))
                                                @if ($model->product_id === $product->id)
                                                selected
                                            @endif
                                            @endif
                                        >{{$product->title}}</option>
                                    @endforeach
                                </select>
                            </div>


{{--                        @if($model)--}}
{{--                            <input type="hidden" name="id" value="{{$model->id}}">--}}
{{--                        @endif--}}
                        @csrf
                        <button class="btn btn-info mt-4" type="submit">{{__('Save')}}</button>
                            <button type="button" class="btn btn-secondary mt-4" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>--}}
{{--                    <button type="button" class="btn btn-info">Save changes</button>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>

@endsection
