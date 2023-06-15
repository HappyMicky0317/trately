@extends('frontend.layout')
@section('title','Blog')
@section('content')
    <section class="py-7">
        <div class="container">
            <h2 class="text-center mb-2 mt-3">{{__('Read our Blog')}}</h2>
            <p class="text-center mb-5">{{__('We post articles on business news, inspiring stories, best advice and guidelines on successful business planning.')}}</p>

            <div class="container ms-3 mb-4">
                <div class="row mb-4" data-masonry='{"percentPosition": true }'>
                    @foreach($blogs as $blog)
                        <div class="col-lg-4 mb-3">
                            <div class="card card-plain border">
                                <div class="card-header p-0 mx-lg-3 mt-3 position-relative z-index-1">
                                    <a href="" class="d-block">
                                        @if(!empty($blog->cover_photo))
                                            <img src="{{PUBLIC_DIR}}/uploads/{{$blog->cover_photo}}" class="img-fluid border-radius-md"> @else
                                            <img src="{{PUBLIC_DIR}}/img/placeholder.jpeg" class="img-fluid border-radius-lg">
                                        @endif
                                    </a>
                                </div>
                                <div class="card-body pt-3">

                                    <p class="mb-1 pt-2 text-bold"><span class="badge bg-secondary">{{$blog->topic}}</span></p>
                                    <h4 class="mb-3">
                                        <a href="/blog/{{$blog->slug}}" class="text-darker font-weight-bolder">{{$blog->title}}
                                        </a>
                                    </h4>
                                    <p class="card-text"> {!!substr($blog->notes,0,100)!!}
                                        <a href="/blog/{{$blog->slug}}" class="fw-bolder">{{__('Read More')}}</a>
                                        </p>

                                    <div class="author">

                                        <div class="stats">
                                            <p class="text-xs text-secondary mb-0">{{$blog->updated_at->diffForHumans()}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
@endsection
