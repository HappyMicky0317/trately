@extends('install.base')
@section('content')
    <h3>{{__('StartupKit Installation')}}</h3>
    <p>
        <strong>{{__('Congratulations!')}}</strong>
    </p>
    <p>
        {{__('Installation is complete.')}}
    </p>
    <a class="btn btn-info mt-3" href="{{config('app.url')}}">
        {{__('Go to Login')}}
    </a>
@endsection
