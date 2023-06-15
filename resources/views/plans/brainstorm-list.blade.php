@extends('layouts.primary')
@section('content')


    <div class=" row">
        <div class="col">
            <h5 class=" text-secondary fw-bolder">
                {{__('Ideation Canvas List')}}
            </h5>
        </div>
        <div class="col text-end">
            <a href="/brainstorming" type="button" class="btn btn-info text-white">{{__('Create Canvas')}}</a>
        </div>
    </div>

        <div class="row mt-1">
            @foreach($canvases as $canvas)

                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="card">
                        <div class="overflow-hidden position-relative border-radius-lg bg-cover p-3"

                             @if(file_exists(public_path() . '/uploads/brainstorming/'.$canvas->uuid.'.png'))
                             style="background-image: url('{{PUBLIC_DIR}}/uploads/brainstorming/{{$canvas->uuid}}.png')"
 @endif
 >
                            <span class="mask bg-purple-light opacity-6"></span>
                            <div class="card-body position-relative ">

                                <div class="d-flex mt-7">
                                    <a href="/brainstorming?id={{$canvas->id}}" class="btn btn-info btn-round p-2 mb-0" type="button" >
                                        {{__('Edit Canvas')}}
                                    </a>
                                    <a href="/delete/canvas/{{$canvas->id}}" class="btn btn-round btn-outline-dark p-2  ms-2 mb-0" type="button" >
                                        {{__('Delete')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mt-1">
                        @if(!empty($users[$canvas->admin_id]->photo))
                            <a href="javascript:" class=" avatar avatar-sm rounded-circle ">
                                <img alt="" class="p-1" src="{{PUBLIC_DIR}}/uploads/{{$users[$canvas->admin_id]->photo}}">
                            </a>
                        @else
                            <div class="avatar avatar-sm  rounded-circle bg-warning-light  p-2">
                                <h6 class="text-dark mt-1">{{$users[$canvas->admin_id]->first_name[0]}}{{$users[$canvas->admin_id]->last_name[0]}}</h6>
                            </div>
                        @endif

                        <div class="mx-3">
                            <a href="javascript:;" class="text-dark font-weight-600 text-sm">
                                @if(isset($users[$canvas->admin_id]))
                                    {{$users[$canvas->admin_id]->first_name}}  {{$users[$canvas->admin_id]->last_name}}
                                @endif
                            </a>
                            <small class="d-block text-muted">{{__('Created at')}} {{(\App\Supports\DateSupport::parse($canvas->created_at))->format(config('app.date_format'))}}</small>
                        </div>
                    </div>


                    <h5 class="mb-0 mt-1">{{$canvas->title}}</h5>
                </div>
            @endforeach
        </div>



@endsection
