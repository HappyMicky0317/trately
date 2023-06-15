@extends('install.base')
@section('content')


    <h3>{{__('StartupKit Installation')}}</h3>
    <p>{{__('Set your Admin Profile')}}</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{route('set.admin.profile')}}">
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label>{{__('First Name')}}</label>
                    <input class="form-control" name="first_name" value="{{old('first_name')}}">
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label>{{__('Last Name')}}</label>
                    <input class="form-control" name="last_name" value="{{old('last_name')}}">
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label>{{__('Email (Username)')}}</label>
            <input class="form-control" name="email" value="{{old('email')}}">
        </div>
        <div class="mb-3">
            <label>{{__('Password')}}</label>
            <input class="form-control" name="password" type="password">
        </div>
        <div class="mb-3">
            <label>{{__('Confirm Password')}}</label>
            <input class="form-control" name="password_confirmation" type="password">
        </div>
        @csrf
        <button type="submit" class="btn btn-info">{{__('Save')}}</button>
    </form>
@endsection
