@extends('install.base')
@section('content')


    <h3>
        {{__('StartupKit Installation')}}

    </h3>
    <p>
        {{__('Database connection was successful! On the next step, system will import the primary data.')}}

    </p>

    <p>
        {{__('While importing the database, it might take some time depending on your system. Click Continue Once!')}}
    </p>


    <a class="btn btn-info mt-3" href="{{route('import.sql')}}">
        {{__('Continue')}}

    </a>

@endsection
