@extends('layouts.super-admin-portal')
@section('content')

    <div class="container-fluid py-4">
        <div class="row">
            <form action="/save-notice" method="post">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="col-lg-9 col-12 mx-auto">
                    <h4 class="mb-0">{{__('Write Notice')}}</h4>
                    <p> {{__('NB: Only the latest published notice will be visible on the user dashboard')}}</p>
                    <div class="card card-body mt-4">



                        <label for="projectName" class="form-label">{{__('Title')}}</label>
                        <input type="text" @if (!empty($notice)) value="{{$notice->title}}" @endif   name="title" class="form-control" id="projectName">

                        <div class="mt-3">
                            <label class="">{{__('Status')}}</label>

                            <select class="form-control" aria-label="Default select example" name="status">
                                <option value="Draft"
                                        @if(($notice->status ?? null) === 'Draft') selected @endif>{{__('Draft')}}</option>
                                <option value="Published"
                                        @if(($notice->status ?? null) === 'Published') selected @endif>{{__('Published')}}</option>

                            </select>
                        </div>

                        <label class="mt-4 text-sm mb-2">{{__('Write Notice')}}</label>


                        <div class="form-group">
                            <textarea class="form-control" rows="10" id="description" name="notes">@if (!empty($notice)){{$notice->notes}}@endif
                            </textarea>
                        </div>
                        @csrf
                        @if($notice)
                            <input type="hidden" name="id" value="{{$notice->id}}">
                        @endif

                        <div class="d-flex  mt-2 ">

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

        (function(){
            "use strict";
            tinymce.init({
                selector: '#description',
                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });


        })();
    </script>
@endsection

