@extends('layouts.'.($layout ?? 'primary'))
@section('content')

    <div class="page-header card min-height-250 "@if(!empty($user->cover_photo))
         style="background-image: url('{{PUBLIC_DIR}}/uploads/{{$user->cover_photo}}'); background-position-y: 50%;"
        @endif>
        <span class="mask bg-gradient-dark opacity-6"></span>
    </div>
    <div class="mx-4 mt-n5 overflow-hidden">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar rounded-circle avatar-xxl position-relative border-avatar">
                    @if(empty($user->photo))
                        <img src="{{PUBLIC_DIR}}/img/user-avatar-placeholder.png"
                             class="w-100 border-radius-lg shadow-sm">
                    @else
                        <img src="{{PUBLIC_DIR}}/uploads/{{$user->photo}}" class="w-100 border-radius-lg shadow-sm">
                    @endif

                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1 mt-5">
                        {{$user->first_name}} {{$user->last_name}}
                    </h5>
                    <p class="mb-0  text-sm">
                        {{$user->email}}
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row  mb-5">
        <div class="col-md-4">
            <div class="card mt-4">

                <div class="card-body">

                    <h5 class="fw-bolder mb-4">{{__('Basic Info')}}</h5>

                    <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong
                                class="text-dark">{{__('Full Name:')}}</strong>
                            {{$user->first_name}} {{$user->last_name}}
                        </li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong
                                class="text-dark">{{__('Phone Number:')}}</strong>
                            {{$user->phone_number}}
                        </li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong
                                class="text-dark">{{__('Email:')}}</strong> {{$user->email}}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong
                                class="text-dark">{{__('Account Created:')}}</strong> {{(\App\Supports\DateSupport::parse($user->created_at))->format(config('app.date_time_format'))}}
                        </li>
                    </ul>
                    <a class="btn btn-info btn-sm mb-0 mt-3" href="/user-edit/{{$user->id}}">{{__('Edit')}}</a>

                </div>
            </div>
        </div>

        <div class="col-md-8 mt-lg-0 mt-4">
            <form enctype="multipart/form-data" action="/profile" method="post">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card mt-4" id="basic-info">

                    <div class="card-header">
                        <h5>{{__('Details')}}</h5>
                    </div>

                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label">{{__('First Name')}}</label>
                                <div class="input-group">
                                    <input id="firstName" name="first_name"
                                           @if (!empty($user)) value="{{$user->first_name}}" @endif class="form-control"
                                           type="text" placeholder="Alec" required="required">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">{{__('Last Name')}}</label>
                                <div class="input-group">
                                    <input id="lastName" name="last_name"
                                           @if (!empty($user)) value="{{$user->last_name}}" @endif class="form-control"
                                           type="text" required="required">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label class="form-label mt-4">{{__('Email/Username')}}</label>
                                <div class="input-group">
                                    <input id="email" name="email" @if (!empty($user)) value="{{$user->email}}"
                                           @endif class="form-control" type="email">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label mt-4">{{__('Phone Number')}}</label>
                                <div class="input-group">
                                    <input id="phone" name="phone_number"
                                           @if (!empty($user)) value="{{$user->phone_number}}"
                                           @endif class="form-control" type="number">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <label class="form-label  mt-4">{{__('Language')}}</label>
                                <select class="form-control select2" name="language" id="choices-language">

                                    @foreach($available_languages as $key => $value)
                                        <option value="{{$key}}"
                                                @if($user->language===$key) selected @endif >{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 align-self-center">
                                <div>
                                    <label for="photo_file" class="form-label mt-4">{{__('Upload photo')}}</label>
                                    <input class="form-control" name="photo" type="file" id="logo_file">
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="timezone">{{__('Timezone')}}</label>
                            <select class="form-control select2" id="timezone" name="timezone">
                                <option value="">{{__('Select')}}</option>
                                @foreach(\App\Supports\UtilSupport::timezoneList() as $key => $value)
                                    <option value="{{$key}}" @if($user->timezone===$key) selected @endif >{{$value}}</option>
                                @endforeach


                            </select>
                        </div>


                        <div class="align-self-center">
                            <div>
                                <label for="cover_photo" class="form-label mt-3">{{__('Upload Cover Photo')}}</label>
                                <input class="form-control" name="cover_photo" type="file" id="cover_photo_file">
                            </div>
                        </div>
                        @csrf
                        <button type="submit" class="btn btn-info btn-sm float-left mt-4 mb-0">
                            {{__('Update info')}}
                        </button>
                    </div>
                </div>
            </form>

            <!-- Card Change Password -->
            <div class="card mt-4" id="password">
                <div class="card-header">
                    <h5>{{__('Change Password')}}</h5>
                </div>
                <form action="/user-change-password" method="post">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body pt-0">
                        <label class="form-label">{{__('Current password')}}</label>
                        <div class="form-group">
                            <input class="form-control" name="password" type="password">
                        </div>
                        <label class="form-label">{{__('New password')}}</label>
                        <div class="form-group">
                            <input class="form-control" name="new_password" type="password">
                        </div>
                        <label class="form-label">{{__('Confirm new password')}}</label>
                        <div class="form-group">
                            <input class="form-control" name="new_password_confirmation">
                        </div>

                        @csrf
                        <button type="submit" class="btn btn-info btn-sm float-left  mb-0">
                            {{__(' Update password')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
