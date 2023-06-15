@extends('layouts.primary')
@section('content')
    <div class="container-fluid py-4">
        <form enctype="multipart/form-data" action="/save-note" method="post">
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
                <h3 class="mb-0">{{__('Write Note')}}</h3>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">{{ __('Title') }}</label><label class="text-danger">*</label>
                    <input type="text" name="title"  value="{{$note->title ?? old('title') ?? ''}}" class="form-control" id="title">
                </div>
                <div class="mb-2">
                    <label for="exampleFormControlInput1" class="form-label"> {{ __('Topic/Subject') }}</label><label class="text-danger">*</label>
                    <input type="text" name="topic" value="{{$note->topic ?? old('topic') ?? ''}}"class="form-control" id="topic">
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
                              rows="5">@if (!empty($note)){!! $note->notes !!}@endif</textarea>
                </div>
                @csrf
                @if($note)
                    <input type="hidden" name="id" value="{{$note->id}}">
                @endif
                <button class="btn btn-info" type="submit">{{ __('Save') }}</button>
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
                branding: false,
            });
        })();
    </script>
@endsection



