@extends('layouts.super-admin-portal')
@section('content')




    <div class=" row">
        <div class="col">
            <h5 class=" text-secondary fw-bolder">
                {{__('Email Settings')}}
            </h5>
        </div>
        <div class="col text-end">
        </div>
    </div>



    <div class="row mb-5">
        <div class="  col-md-8 mt-lg-0 mt-4">
            <div class="card">
                <div class="card-body">
                    <form enctype="multipart/form-data" action="/save-email-setting" method="post">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mt-4" id="basic-info">
                            <div class=" pt-0">
                                <div class="row mb-4">
                                    <label class="form-label">{{__('SMTP Host')}}</label>

                                    <div class="input-group">
                                        <input id="host" name="smtp_host" value="{{$settings['smtp_host'] ?? ''}}"
                                               class="form-control" type="text" required="required">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="form-label">{{__('SMTP Username')}}</label>

                                    <div class="input-group">
                                        <input id="username" name="smtp_username" value="{{$settings['smtp_username'] ?? ''}}"
                                               class="form-control" type="text" required="required">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="form-label">{{__('SMTP Password')}}</label>

                                    <div class="input-group">
                                        <input id="password" name="smtp_password" value="{{$settings['smtp_password'] ?? ''}}"
                                               class="form-control" type="text" required="required">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="form-label">{{__('SMTP Port')}}</label>

                                    <div class="input-group">
                                        <input id="port" name="smtp_port" value="{{$settings['smtp_port'] ?? ''}}"
                                               class="form-control" type="number" required="required">
                                    </div>
                                </div>



                                @csrf
                                <button class="btn btn-info btn-sm float-left mt-4 mb-0">{{__('Update')}} </button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>



@endsection
