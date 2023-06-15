@extends('layouts.primary')
@section('content')
    <div class=" row">
        <div class="col">
            <h5 class="text-secondary fw-bolder">
                {{__('Startup Canvas')}}
            </h5>
        </div>
        <div class="col text-end">
            <a href="/design-startup-canvas" type="button" class="btn btn-info ">{{__('Design Business Model')}}</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mx-auto">

            <form >
                <div class="row gx-2 gx-md-3 mb-3 mt-4">
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
                        btn-lg btn-rounded">
                            <i class="fas fa-search"></i>
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
                                            <span class="badge bg-secondary">{{(\App\Supports\DateSupport::parse($model->created_at))->format(config('app.date_format'))}}</span></p>

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
                                                       href="/design-startup-canvas?id={{$model->id}}">{{__('Edit')}}</a>
                                                </li>
                                                <li><a class="dropdown-item border-radius-md"
                                                       href="/view-startup-canvas?id={{$model->id}}">{{__('See Details')}}</a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item border-radius-md text-danger"
                                                       href="/delete/startup-canvas/{{$model->id}}">{{__('Delete')}}</a>
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

@endsection
