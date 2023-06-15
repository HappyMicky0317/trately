@extends('layouts.super-admin-portal')
@section('title',__('Blogs'))
@section('content')

    <div class=" row mb-2">
        <div class="col">
            <h5 class=" fw-bolder">
                {{__('Blogs')}} /<span class="text-secondary">
                            {{__('Article List')}}
                    </span>
            </h5>
            <p class="text-muted">{{__('Create, edit or delete blog articles.')}}</p>
        </div>
        <div class="col text-end">
            <a href="/write-blog" type="button" class="btn btn-info"><i class="fas fa-plus"></i> {{__('Write New Blog')}}</a>

        </div>
    </div>

    @if(!count($blogs))

        <div class="card">
            <div class="card-body">
                <p>{{__('No items to display. Get started by writing an article.')}}</p>

                <a href="/write-blog" type="button" class="btn btn-info text-white"><i class="fas fa-plus"></i> {{__('Write an article ')}}</a>
            </div>
        </div>

    @else

    <div class="row" data-masonry='{"percentPosition": true }'>
        @foreach($blogs as $blog)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if(!empty($blog->cover_photo))
                        <img src="{{PUBLIC_DIR}}/uploads/{{$blog->cover_photo}}" class="card-img-top">
                    @endif

                    <div class="card-body ">
                        <p class="mb-1 pt-2 text-bold">{{$blog->topic}}</p>
                        <h5 class="card-title">{{$blog->title}}</h5>

                        <div class="mt-3">
                            <a href="/view-blog?id={{$blog->id}}" class="btn btn-success btn-xs mb-0">{{__('Read')}}</a>

                            <a href="/write-blog?id={{$blog->id}}" class="btn btn-info btn-xs mb-0">{{__('Edit')}}</a>
                            <a href="/delete/blog/{{$blog->id}}" class="btn btn-warning btn-xs mb-0">{{__('Delete')}}</a>
                        </div>


                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif
@endsection
