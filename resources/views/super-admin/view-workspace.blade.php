@extends('layouts.super-admin-portal')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class=" mb-5">
                <div class="row">
                    <div class=" col-12 col-lg-8 m-auto">

                       <div class="card">
                           <div class="card-body">

                               <h5 class="text-secondary fw-bolder">
                                   {{__('Workspace Details')}}
                               </h5>
                               <hr>

                               <ul class="list-group">

                                   <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">{{__('Name:')}}</strong> {{$app_workspace->name}}</li>
                                   <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">{{__('Plan Name:')}}</strong>@if($app_workspace->id !== $user->workspace_id)
                                           @if(isset($plans[$app_workspace->plan_id]))
                                               {{$plans[$app_workspace->plan_id]->name}}
                                           @endif
                                       @else
                                           <p class="text-xs font-weight-bold mb-0">{{__('Super Admin')}}</p>
                                       @endif</li>

                                   <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">{{__('Account Created:')}}</strong> {{(\App\Supports\DateSupport::parse($app_workspace->created_at))->format(config('app.date_time_format'))}}</li>
                                   <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">{{__('Status')}}</strong>@if($app_workspace->id !== $user->workspace_id)
                                           @if($app_workspace->subscribed)
                                               <span class="badge badge-sm bg-gradient-success">{{__('Subscribed')}}</span>
                                           @else
                                               <span class="badge badge-sm bg-warning">{{__('Not Subscribed')}}</span>
                                           @endif
                                       @endif
                                   </li>

                               </ul>

                               <h5 class="text-secondary fw-bolder mt-4">
                                   {{__('Workspace Users')}}
                               </h5>
                               <hr>
                               <table class="table table-light">
                                   <thead>
                                   <tr>
                                       <th>{{__('Name')}}</th>
                                       <th scope="col">{{__('Email')}}</th>
                                       <th scope="col">{{__('Phone')}}</th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                   @foreach($users_in_this_workspace as $app_user)
                                       <tr>

                                           <td class="ms-3"><strong class="ms-3">{{$app_user->first_name}} {{$app_user->lastt_name}}</strong></td>
                                           <td> {{$app_user->email}}</td>
                                           <td> {{$app_user->mobile_number}}</td>
                                       </tr>
                                   @endforeach


                                   </tbody>
                               </table>




                               @if($app_workspace->id !== $user->workspace_id)
                                   @if($app_workspace->active)
                                       <a href="/view-workspace?id=2&action=suspend" class="btn btn-danger mt-4" >{{__('Suspend Workspace')}}</a>
                                       @else
                                       <a href="/view-workspace?id=2&action=activate" class="btn btn-success mt-4" >{{__('Activate Workspace')}}</a>
                                   @endif
                                 @endif

                           </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



