@extends('layouts.primary')
@section('content')
    <div class="row">
        <h5 class=" col fw-bolder">
            {{$note->topic}}
        </h5>
        <div class="col text-end mb-3">
            <a href="/add-note?id={{$note->id}}" class="btn btn-info btn-sm mb-0">{{__('Edit')}}</a>
            <a href="/delete/note/{{$note->id}}" class="btn btn-warning btn-sm mb-0">{{__('Delete')}}</a>
        </div>
    </div>
    <div class="card">
        <div class="row">
            <div class="col-md-6 ms-auto text-center mt-3 ">
                <h2 class="mt-6 ms-3">{{$note->title}}</h2>
                @if(!empty($users[$note->admin_id]->photo))
                    <a href="javascript:" class=" mt-4 avatar rounded-circle border border-secondary">
                        <img alt="" class="p-1" src="{{PUBLIC_DIR}}/uploads/{{$users[$note->admin_id]->photo}}">
                    </a>
                @else
                    @if(!empty($users[$note->admin_id]))
                    <div class="avatar   mt-4 rounded-circle bg-purple-light  border-radius-md p-2">
                        <h6 class="text-purple mt-1">

                                {{$users[$note->admin_id]->first_name[0]}}{{$users[$note->admin_id]->last_name[0]}}

                        </h6>
                    </div>
                    @endif
                @endif
                <a href="/profile" class=" nav-link text-body font-weight-bold px-0">
                        <span class="d-sm-inline d-none "> @if(isset($users[$note->admin_id]))
                                {{$users[$note->admin_id]->first_name}}  {{$users[$note->admin_id]->last_name}}
                            @endif
                        </span>
                </a>
                <p>
                    {{(\App\Supports\DateSupport::parse($note->created_at))->format(config('app.date_format'))}}

                </p>
            </div>
            <div class="col-md-6">
                <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                    <a href="javascript:" class="d-block">
                        @if(!empty($note->cover_photo))
                            <img src="{{PUBLIC_DIR}}/uploads/{{$note->cover_photo}}" class="img-fluid border-radius-lg">

                        @endif



                    </a>
                </div>

            </div>
        </div>
        <div class="card-body pt-2">
            <div class="mb-4">
                {!! $note->notes !!}
            </div>
        </div>
    </div>
@endsection
