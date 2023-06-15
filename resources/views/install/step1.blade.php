@extends('install.base')
@section('content')

    <h3>
        {{__(' Checking File Permissions')}}

    </h3>

    <ul class="list-group mt-3">
        <li class="list-group-item border-0 ps-0 pt-0 text-sm">
            <strong class="text-dark">

                {{__(' Env file (.env) write permission:')}}

            </strong>

            @if($write_permission_env)
                {{__(' Writable (Great!)')}}
            @else
                {{__(' Unable to write .env file')}}
            @endif

        </li>
        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong
                class="text-dark">{{__('RouteServiceProvider.php:')}}</strong>

            @if($write_permission_route_service_provider)
                {{__(' Writable (Great!)')}}
            @else
                {{__('Unable to write RouteServiceProvider.php')}}

            @endif

        </li>
    </ul>

    <a class="btn btn-info mt-3" href="{{route('step2')}}">{{__('Continue')}}</a>

@endsection
