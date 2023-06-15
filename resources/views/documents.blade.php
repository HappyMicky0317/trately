@extends('layouts.primary')
@section('content')
    <h5 class="text-secondary fw-bolder mb-3">{{__('Documents')}}</h5>
    <form action="/document" class="form-control dropzone" id="dropzone">
        <div class="fallback">
            <input name="file" type="file" multiple/>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">{{__('Uploaded Documents')}}</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <ul class="list-group">
                        @foreach($documents as $document)
                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-file-text">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-3 ms-2 text-sm">{{$document->name}}</h6>
                                </div>
                                <div class="ms-auto">
                                    <a href="/download/{{$document->id}}" class="btn btn-sm btn-info text-sm mb-0 "><i
                                            class="fas fa-download text-sm me-1"></i>{{__('Download')}}
                                    </a>
                                    <a class="btn btn-sm btn-warning  px-3 mb-0"
                                       href="/delete/document/{{$document->id}}"><i
                                            class="far fa-trash-alt me-1 text-sm"></i>{{__('Delete')}}
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        @endsection

        @section('script')
            <script>

                Dropzone.autoDiscover = false;
                Dropzone.options.dropzone = {
                    acceptedFiles: "image/*,application/pdf",
                };

                $(function () {
                    "use strict"

                    $("#dropzone").dropzone({
                        url: "/document",
                        success: function (file, response) {
                            location.reload();

                        },
                        error: function (file, response) {
                            file.previewElement.classList.add("dz-error");
                        },
                        sending: function (file, xhr, formData) {
                            formData.append('_token', '{{csrf_token()}}');
                        }
                    });
                })
            </script>
@endsection


