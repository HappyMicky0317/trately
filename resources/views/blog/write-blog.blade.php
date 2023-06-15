@extends('layouts.super-admin-portal')
@section('title',__('Write Blog'))
@section('content')

    <div class="row">
        <div class="col">
            <h5 class="text-white fw-bolder">
                {{__('Blog')}}
            </h5>
        </div>
        <div class="col text-end">
            <a href="/blogs" type="button" class="btn btn-info text-white">{{__('Articles')}}</a>
        </div>
    </div>
    <div class="">
        <form enctype="multipart/form-data" action="/save-blog" method="post">
            @if ($errors->any())
                <div class="alert bg-pink-light text-danger">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card col-lg-9 col-12 mx-auto">
                <div class="card-header border-bottom">
                    <h5 class="card-title">{{__('Write Blog Post')}}</h5>

                </div>

                <div class="card-body">

                    <div class="">

                        <div class="mb-3">
                            <label for="blogTitle" class="form-label">{{ __('Title') }}</label><label class="text-danger">*</label>
                            <input type="text" name="title"  value="{{$blog->title ?? old('title') ?? ''}}" class="form-control" id="blogTitle">
                        </div>
                        <label for="basic-url" for="blogSlug" class="form-label">{{__('Slug')}}</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bolder">{{config('app.url')}}/blog/</span>
                            <input type="text" value="{{$blog->slug ?? old('slug') ?? ''}}" id="blogSlug" name="slug" class="form-control ps-1">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label"> {{ __('Topic/Subject') }}</label><label class="text-danger">*</label>
                            <input type="text" name="topic" value="{{$blog->topic ?? old('topic') ?? ''}}"class="form-control" id="topic">
                        </div>
                        <div class="align-self-center mb-3">
                            <div>
                                <label for="cover_photo" class="form-label mt-4">{{__('Upload Cover Photo')}}</label>
                                <input class="form-control" name="cover_photo" type="file" id="cover_photo_file">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">{{ __('Write Notes') }}</label>
                            <textarea class="form-control" name="notes" id="notes"
                                      rows="5">@if (!empty($blog)){!! $blog->notes !!}@endif</textarea>
                        </div>
                        @csrf
                        @if($blog)
                            <input type="hidden" name="id" value="{{$blog->id}}">
                        @endif
                        <button class="btn btn-info" type="submit">{{ __('Save') }}</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        (function () {
            "use strict";
            tinymce.init({
                selector: '#notes',
                plugins: [
                    'insertdatetime media table paste code help wordcount'
                ],
                min_height: 500,
                max_height: 800,
                convert_newlines_to_brs: false,
                statusbar: false,
                relative_urls: false,
                remove_script_host: false,
                language: 'en',
            });

            @if(empty($blog))

            let blogTitle = document.getElementById('blogTitle');

            blogTitle.addEventListener('keyup', function (event) {
                event.preventDefault();
                let title = blogTitle.value;
                document.getElementById('blogSlug').value = title.toLowerCase().split(' ').join('-');
            });

            @endif
        })();
    </script>
@endsection



