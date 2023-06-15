@extends('frontend.layout')
@section('title',$blog->title)
@section('content')

    <div class="page-header min-vh-80 py-9" style="background-image: url({{PUBLIC_DIR}}/uploads/{{$blog->cover_photo}});">
        <span class="mask bg-gradient-dark opacity-4"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="text-center mx-auto">




                </div>
            </div>
        </div>
    </div>



<div class="col-lg-7 mx-auto text-start card card-body blur d-flex justify-content-center mt-lg-5">
    <h2 class="fw-bolder mt-2 mb-4">{{$blog->title}}</h2>

    <div class=" d-flex ">
        @if(!empty($users[$blog->admin_id]->photo))
            <img alt="" class=" avatar rounded-circle shadow " src="{{PUBLIC_DIR}}/uploads/{{$users[$blog->admin_id]->photo}}">
        @else
            <div class="avatar rounded-circle bg-purple-light  border-radius-md p-2">
                <h6 class="text-purple mt-1">{{$users[$blog->admin_id]->first_name[0]}}{{$users[$blog->admin_id]->last_name[0]}}</h6>
            </div>
        @endif

        <div class="name text-dark ps-2">
            @if(!empty($users[$blog->admin_id]))
                <span>{{$users[$blog->admin_id]->first_name}} {{$users[$blog->admin_id]->last_name}}</span>

            @endif
                <div class="stats text-muted">
                    <small>{{$blog->updated_at->diffForHumans()}}</small>

                </div>

        </div>


    </div>


        <p class="text-dark">
            {!! $blog->notes !!}
        </p>
</div>

@endsection
