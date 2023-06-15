@extends('layouts.super-admin-portal')
@section('content')
     <div class=" row mb-2">
        <div class="col">
            <h5 class=" text-secondary fw-bolder">
                {{__('Users')}}
            </h5>
        </div>
        <div class="col text-end">
            <a class="btn btn-info " href="/add-user"><i class="fas fa-plus"></i>&nbsp;&nbsp;
                {{__(' Add New User')}}
            </a>
        </div>
    </div>
<div class="">
        <div class="row">
            <div class="col-12">
                <div class="card card-body mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="  table align-items-center mb-0" id="cloudonex_table">
                                <thead >
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('User')}}</th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('Workspace Name')}}</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('Account Created')}}</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($users as $workspace_user)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    @if(empty($workspace_user['photo']))
                                                        <div
                                                            class="avatar avatar-md rounded-circle bg-purple-light  border-radius-md p-2 ">
                                                            <h6 class="text-uppercase text-purple ">{{$workspace_user->first_name['0']}}{{$workspace_user->last_name['0']}}</h6>
                                                        </div>
                                                    @else

                                                        <img src="{{PUBLIC_DIR}}/uploads/{{$workspace_user->photo}}"
                                                             alt="" class="avatar avatar-md shadow-sm">
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column justify-content-center px-3">
                                                    <h6 class="mb-0 text-sm">{{$workspace_user->first_name}} {{$workspace_user->last_name}}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{$workspace_user->email}}</p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle text-center text-sm fw-bolder">
                                            @if(!empty($workspaces[$workspace_user->workspace_id]))
                                                {{$workspaces[$workspace_user->workspace_id]->name}}
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold"> {{(\App\Supports\DateSupport::parse($workspace_user->created_at))->format(config('app.date_time_format'))}} </span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="ms-auto text-end">
                                                <a class="btn btn-link text-dark px-3 mb-0" href="/user-edit/{{$workspace_user->id}}"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>{{__('Edit')}}</a>

                                                <a class="btn btn-link text-dark px-3 mb-0"
                                                   href="/user-profile?id={{$workspace_user->id}}"><i
                                                        class="fas fa-file-alt text-dark me-2"
                                                        aria-hidden="true"></i>{{__('View')}}</a>

                                                @if($user->id != $workspace_user->id)

                                                    <a class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                       href="/delete-user/{{$workspace_user->id}}"><i
                                                            class="far fa-trash-alt me-2"></i>{{__('Delete')}}</a>

                                                @endif

                                            </div>

                                        </td>
                                    </tr>

                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        "use strict";
        $(document).ready(function () {
            $('#cloudonex_table').DataTable(
            );

        });
    </script>
@endsection

