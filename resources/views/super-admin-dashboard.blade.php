@extends('layouts.super-admin-portal')
@section('content')

    <div class="row">

        <div class="col-md-4 mb-4">
            <div class="card bg-info">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm text-white mb-0 text-capitalize font-weight-bold">{{__(' Total Users')}}</p>
                                <h5 class="font-weight-bolder text-white mt-4 ">
                                    {{$total_users}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class=" icon icon-shape bg-purple-light  text-center">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-users text-purple mt-3">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-success">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class=" text-white text-sm mb-0 text-capitalize font-weight-bold">{{__('Total Workspaces')}}</p>

                                <h5 class="font-weight-bolder  text-white mt-4">
                                    {{$total_workspaces}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class=" icon icon-shape bg-purple-light  text-center">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-briefcase text-purple mt-3">
                                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-gradient-dark">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm text-white mb-0 text-capitalize font-weight-bold">{{__('Total Plans')}}</p><h5 class="font-weight-bolder text-white mt-4 ">
                                    {{$total_plans}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class=" icon icon-shape bg-purple-light  text-center">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class=" text-purple feather feather-hard-drive mt-2">
                                    <line x1="22" y1="12" x2="2" y2="12"></line>
                                    <path
                                        d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
                                    <line x1="6" y1="16" x2="6.01" y2="16"></line>
                                    <line x1="10" y1="16" x2="10.01" y2="16"></line>
                                </svg>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row mt-2">
        <div class="col-lg-12">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">{{__('Recent Workspaces')}}</h6>
                        </div>
                        <div class="col-6 text-end">
                            <a href="/workspaces" class="btn btn-info btn-sm mb-0">{{__('View All')}}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('Workspace Name')}}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{__('Created_at')}}</th>
                                <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{__('Plan')}}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('Status')}}</th>

                                <th class=" text-uppercase text-secondary text-xxs opacity-7">{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recent_workspaces as $workspace)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{$workspace->name}} </h6>
                                                <p class="text-xs text-secondary mb-0"></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{(\App\Supports\DateSupport::parse($workspace->created_at))->format(config('app.date_time_format'))}}

                                        </p>

                                    </td>
                                    <td class="text-xs fw-bolder text-purple text-uppercase mb-0">    @if($workspace->id !== $user->workspace_id)
                                            @if(isset($plans[$workspace->plan_id]))
                                                {{$plans[$workspace->plan_id]->name}}
                                            @endif
                                        @else
                                            <p class="text-xs font-weight-bold mb-0">{{__('super admin')}}</p>
                                        @endif

                                    </td>
                                    <td class="align-middle text-sm">
                                        @if($workspace->id !== $user->workspace_id)
                                            @if($workspace->subscribed)
                                                <span class="badge badge-sm bg-success-light text-success">{{__('Subscribed')}}</span>
                                            @else
                                                <span class="badge badge-sm bg-pink-light text-danger">{{__('Not Subscribed')}}</span>
                                            @endif
                                        @endif

                                    </td>
                                    <td class="align-middle">
                                        @if($workspace->id !== $user->workspace_id)
                                            <a class="btn btn-link text-dark px-3 mb-0"
                                               href="/edit-workspace?id={{$workspace->id}}"><i
                                                    class=" text-dark fas fa-pencil-alt me-2"></i>{{__('Edit')}}</a>


                                        @endif

                                        @if($workspace->id !== $user->workspace_id)

                                            <a class="btn btn-link text-danger text-gradient px-3 mb-0"
                                               href="/delete-workspace/{{$workspace->id}}"><i
                                                    class="far fa-trash-alt me-2"></i>{{__('Delete')}}</a>
                                        @endif
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

    <div class="row">
        <div class="col-md-7 mt-4">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>{{__('Recent Users')}}</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('User')}}</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('Account Created')}}</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recent_users as $skit_user)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                @if(empty($skit_user['photo']))
                                                    <div
                                                        class="avatar avatar-md rounded-circle bg-purple-light border-radius-md p-2 ">
                                                        <h6 class="text-uppercase text-purple ">{{$skit_user->first_name['0']}}{{$skit_user->last_name['0']}}</h6>
                                                    </div>
                                                @else

                                                    <img src="{{PUBLIC_DIR}}/uploads/{{$skit_user->photo}}" alt=""
                                                         class="avatar avatar-md">
                                                @endif
                                            </div>
                                            <div class="d-flex flex-column justify-content-center px-3">
                                                <h6 class="mb-0 text-sm">{{$skit_user->first_name}} {{$skit_user->last_name}}</h6>
                                                <p class="text-xs text-secondary mb-0">{{$skit_user->email}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span
                                            class="text-secondary text-xs font-weight-bold">{{(\App\Supports\DateSupport::parse($skit_user->created_at))->format(config('app.date_time_format'))}}</span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="ms-auto text-end">

                                            <a class="btn btn-link text-dark px-3 mb-0"
                                               href="/user-profile?id={{$skit_user->id}}"><i
                                                    class="fas fa-file-alt text-dark me-2"
                                                    aria-hidden="true"></i>{{__('View')}}</a>
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
        <div class="col-md-5 mt-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">{{__('Plans')}}</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <ul class="list-group">
                        @foreach($recent_plans as $plans)
                            <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-3 text-sm">{{$plans->name}}</h6>
                                    <span class="mb-2 text-xs">{{__('Monthly Price')}} <span
                                            class="text-dark font-weight-bold ms-sm-2">  {{formatCurrency($plans->price_monthly,getWorkspaceCurrency($settings))}}</span></span>
                                    <span class="mb-2 text-xs">{{__('Yearly Price')}} <span
                                            class="text-dark ms-sm-2 font-weight-bold"><a data-cfemail="e98c9d818887a98f808b8c9bc78a8684">  {{formatCurrency($plans->price_yearly,getWorkspaceCurrency($settings))}}</a></span></span>
                                </div>
                                <div class="ms-auto text-end">
                                    <a href="/subscription-plan?id={{$plans->id}}"
                                       class="btn btn-link text-dark text-gradient px-3 mb-0" href="javascript:"><i
                                            class="far fa-trash-alt me-2"></i>{{__('Edit')}}</a>
                                    <a href="/delete/subscription-plan/{{$plans->id}}"
                                       class="btn btn-link text-danger px-3 mb-0" href="javascript:"><i
                                            class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>{{__('Delete')}}</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
