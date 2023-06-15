@extends('layouts.primary')
@section('content')
    <div class="row">
        <div class="col">
            <h5 class=" text-secondary fw-bolder">
                {{__('Product Plan')}}
            </h5>
        </div>
        <div class="col text-end">
            <a href="/projects" type="button" class="btn btn-info text-white">{{__('Product Plans  ')}}</a>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <form action="/save-project" method="post">
                @if ($errors->any())
                    <div class="alert bg-pink-light text-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-lg-9 col-12 mx-auto">
                    <div class=" card-body">
                        <h3 class="mb-0">{{__('New Product Idea')}}</h3>
                        <p class="text-sm mb-0">{{__('Create new product idea')}}</p>
                        <hr class="horizontal dark my-3">
                        <label for="projectName" class="form-label">{{__('Product Name')}}</label><label class="text-danger">*</label>
                        <input type="text" value="{{$project->title ?? old('title') ?? ''}}"  name="title"
                               class="form-control" id="projectName">
                        <label class="mt-4 text-sm mb-0">{{__('What Problem does this product solves?')}}</label>
                        <p class="form-text  text-purple text-xs ms-1">
                            {{__('Write a short pitch.Within 225 words')}}
                        </p>
                        <div class="form-group">
                            <textarea name="summary" class="form-control" rows="4" id="editor">{{$project->summary ?? old('summary') ?? ''}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">
                                {{__('Status')}}
                            </label><span class="text-danger">*</span>
                            <select class="form-select" aria-label="Default select example" name="status">
                                <option value="Pending"
                                        @if(($project->status ?? null) === 'Pending') selected @endif>{{__('Pending')}}</option>
                                <option value="Started"
                                        @if(($project->status ?? null) === 'Started') selected @endif>{{__('Started')}}</option>
                                <option value="Finished"
                                        @if(($project->status ?? null) === 'Finished') selected @endif>{{__('Finished')}}</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div>
                                <label for="exampleFormControlInput1" class="form-label">{{__('Team Members')}}</label><span class="text-danger">*</span>
                                <select class="form-control select2" multiple id="" name="members[]">
                                    @foreach ($other_users as $other_user)
                                        <option value="{{$other_user->id}}"
                                                @if($members)

                                                @if(in_array($other_user->id,$members)) selected @endif
                                            @endif
                                        >{{$other_user->first_name}} {{$other_user->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <label class="form-label">{{__('Start Date')}}</label>
                                <input class="form-control" name="start_date" id="start_date"
                                       @if(!empty($project))value="{{$project->start_date}}"
                                       @else
                                       value="{{date('Y-m-d')}}"
                                    @endif >
                            </div>
                            <div class="col-6">
                                <label class="form-label">{{__('End Date')}}</label>
                                <input class="form-control" name="end_date" id="end_date" @if(!empty($project))
                                value="{{$project->end_date}}"
                                       @else
                                       value="{{date('Y-m-d')}}"
                                    @endif>
                            </div>
                        </div>
                        <label class="mt-4 text-sm mb-0">{{__('Product Description')}}</label>
                        <p class="form-text text-purple text-xs ms-1">
                            {{__('Write a well organised description of the product.')}}
                        </p>
                        <div class="form-group">
                            <textarea class="form-control" rows="10" id="description"
                                      name="description">{{$project->description ?? old('description') ?? ''}}</textarea>
                        </div>
                        @csrf
                        @if($project)
                            <input type="hidden" name="id" value="{{$project->id}}">
                        @endif
                        <div class="d-flex  mt-4">
                            <button type="submit" name="button" class="btn btn-info m-0 ">
                                {{__('Save')}}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')

    <script>

        $(function () {
            "use strict";


            flatpickr("#start_date", {

                dateFormat: "Y-m-d",
            });

            flatpickr("#end_date", {

                dateFormat: "Y-m-d",
            });


            tinymce.init({
                selector: '#description',


                plugins: 'table,code',
                branding: false,


            });

        });


    </script>

@endsection

