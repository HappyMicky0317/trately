@extends('install.base')
@section('content')

    <h3>{{__('Database Info')}}</h3>

    @if($has_error)
        <p class="text-danger">
            {{__('Unable to connect the Database. Try Again.')}}

        </p>
    @endif

    <form method="POST" action="{{ route('db.installation') }}">
        @csrf
        <div class="mb-3">
            <label for="db_host">{{__('Database Host')}}</label>
            <input type="text" class="form-control" id="db_host" name="DB_HOST" required autocomplete="off">
            <input type="hidden" name="types[]" value="DB_HOST">
        </div>
        <div class="mb-3">
            <label for="db_name">{{__('Database Name')}}</label>
            <input type="text" class="form-control" id="db_name" name="DB_DATABASE" required autocomplete="off">
            <input type="hidden" name="types[]" value="DB_DATABASE">
        </div>
        <div class="mb-3">
            <label for="db_user">{{__('Database Username')}}</label>
            <input type="text" class="form-control" id="db_user" name="DB_USERNAME" required autocomplete="off">
            <input type="hidden" name="types[]" value="DB_USERNAME">
        </div>
        <div class="mb-3">
            <label for="db_pass">{{__('Database Password')}}</label>
            <input type="password" class="form-control" id="db_pass" name="DB_PASSWORD" autocomplete="off">
            <input type="hidden" name="types[]" value="DB_PASSWORD">
        </div>
        <button type="submit" class="btn btn-info">{{__('Continue')}}</button>
    </form>
@endsection
