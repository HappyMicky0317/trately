@extends('layouts.super-admin-portal')
@section('content')

    @if ($errors->any())
        <div class="alert bg-pink-light text-danger">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="/activate-license" >
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">{{__('Purchase Code')}}</label>
            <input type="text" name="purchase_code" class="form-control" value="{{$settings['purchase_code'] ?? ''}}">
            <div id="emailHelp" class="form-text">{{__('Get the purchase code from codecanyon and submit here')}}</div>
        </div>

        @csrf

        <button type="submit" class="btn btn-info">{{__('Submit')}}</button>
    </form>

@endsection
