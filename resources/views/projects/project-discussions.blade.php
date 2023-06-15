@extends('layouts.primary')
@section('content')
    <div class="row mb-4">
        <div class="mt-lg-0">
            <div class="card" id="basic-info">
                <div class="card-header">

                    <div class="float-end">
                        <a href="/projects" type="button" class="btn btn-sm btn-info">
                            {{__('Product Plans')}}
                        </a>
                        <a href="/create-project?id={{$project->id}}" type="button"
                           class="btn btn-sm bg-gradient-secondary">{{__('Edit')}}</a>
                    </div>
                    <span>
                        <h5 class="">{{$project->title}}</h5>
                        <span class="badge bg-purple-light  font-weight-bold">{{$project->status}}</span></span>
                </div>
                <div class="ms-4">
                    <div class="pt-0">
                        <div class="row">
                            <div class="col-md-2">
                                <span>
                                    <div class="ms-auto">
                                        <span class="badge badge-sm bg-gradient-faded-light text-dark fw-bolder mb-1">
                                        @if(!empty($project->start_date))
                                        {{$project->start_date->format(config('app.date_format'))}}
                                        @endif
                                        </span>
                                        <p class="text-sm fw-bolder text-black-50">{{__('Start date')}}</p>
                                    </div>
                                </span>
                            </div>
                            <div class="col-md-2">
                                <span>
                                   <div class="ms-auto">
                                    <span class="badge badge-sm bg-gradient-faded-light text-dark fw-bolder mb-1">
                                    @if(!empty($project->end_date))
                                    {{$project->end_date->format(config('app.date_format'))}}
                                     @endif
                                    </span>
                                    <p class="text-sm fw-bolder text-black-50">{{__('Due date')}}</p>
                                   </div>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex">
                                    @if($project->members)
                                        @foreach(json_decode($project->members) as $member)
                                            @if(isset($users[$member]))
                                                <div class="col-md-2 text-center">

                                                    @if(!empty($users[$member]->photo))
                                                        <a href="javascript:"
                                                           class="avatar avatar-md rounded-circle border border-secondary">
                                                            <img class="p-1"
                                                                 src="{{PUBLIC_DIR}}/uploads/{{$users[$member]->photo}}">
                                                        </a>
                                                    @else
                                                        <div
                                                            class="avatar avatar-md rounded-circle bg-purple-light  border-radius-md p-2"> <h6 class="text-purple mt-1">{{$users[$member]->first_name[0]}}{{$users[$member]->last_name[0]}}</h6>
                                                        </div>
                                            @endif
                                       <p class="mb-0 text-sm">{{$users[$member]->first_name}}</p>
                                        </div>
                                            @endif
                                        @endforeach
                                    @endif
                                    <div class="col-md-2 text-center">
                                        <a href="/create-project?id={{$project->id}}"
                                           class="avatar avatar-md border-1 rounded-circle bg-gradient-light">
                                            <i class="fas fa-plus text-white"></i>
                                        </a>
                                    </div>
                               </div>
                           </div>
                       </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-sm btn-success " data-bs-toggle="" href="/view-project?id={{$project->id}}"
                           role="button" aria-selected="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-file-text">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                            <span class="ms-1">{{__('Overview')}}</span>
                        </a>
                        <a class="btn btn-sm btn-info " data-bs-toggle=""
                           href="/view-project-discussion?id={{$project->id}}" role="button" aria-selected="false">


                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-message-square">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                            <span class="ms-1">{{__('Discussions')}}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">

                    <!-- Comments -->
                    <div class="mb-1">

                        @foreach($replies as $reply)

                            <div class="d-flex mt-3">
                                <div class="flex-shrink-0">
                                    <div class=" me-3 ">
                                        @if(!empty($users[$reply->admin_id]->photo))
                                            <a href="javascript:" class=" avatar avatar-md rounded-circle ">
                                                <img alt="" class="avatar rounded-circle flex-shrink-0"
                                                     src="{{PUBLIC_DIR}}/uploads/{{$users[$reply->admin_id]->photo}}">
                                            </a>
                                        @else
                                            <div
                                                class="avatar avatar-md rounded-circle bg-purple-light  border-radius-md p-2">
                                                <h6 class="text-purple mt-1">{{$users[$reply->admin_id]->first_name[0]}}{{$users[$reply->admin_id]->last_name[0]}}</h6>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fw-bolder mt-0">
                                        @if($reply->admin_id)
                                            @if(!empty($users[$reply->admin_id]))
                                                {{$users[$reply->admin_id]->first_name}} {{$users[$reply->admin_id]->last_name}}
                                            @endif
                                        @endif
                                    </h6>
                                    <p class="text-sm">
                                        {!! $reply->message !!}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                        <div class="d-flex mt-4">
                            <div class="flex-shrink-0">
                            </div>
                            <div class="flex-grow-1 my-auto">
                                <form method="post" action="/save-project-message">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="list-unstyled">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <textarea class="form-control ms-2" name="message" placeholder="Write your comment"
                                              rows="2"></textarea>

                                    <input type="hidden" name="project_id" value="{{$project->id}}">

                                    @csrf
                                    <button type="submit" class="btn btn-info  ms-2 btn-sm mt-3">{{__('Send')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
