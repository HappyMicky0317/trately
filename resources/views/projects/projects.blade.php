@extends('layouts.primary')
@section('content')

    <div class=" row">
        <div class="col">
            <h5 class=" text-secondary fw-bolder">
                {{__('Product Ideas')}}
            </h5>
        </div>
        <div class="col text-end">
            <a href="/create-project" type="button" class="btn btn-info text-white">{{__('Plan Product ')}}</a>
        </div>
    </div>
    <div class="card ">
        <div class=" card-body table-responsive">
            <table class="table align-items-center mb-0" id="cloudonex_table">
                <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('Product Name')}}</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('Members')}}</th>

                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{__('Due Date')}}</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{__('Status')}}</th>

                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{__('Action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($projects as $project)
                    <tr>
                        <td>
                            <div class="d-flex px-2">
                                <div class="avatar avatar-md me-3 bg-purple-light  border-radius-md p-2">
                                    <h5 class="mt-2 text-purple">{{$project->title['0']}}</h5>
                                </div>

                                <div class="my-auto">
                                    <h6 class="text-sm mb-0 ms-1">{{$project->title}}</h6>
                                </div>
                            </div>
                        </td>
                        <td class="">

                            <div class="avatar-group d-flex mt-2">
                                @if($project->members)
                                    @foreach(json_decode($project->members) as $member)
                                        @if(isset($users[$member]))

                                            @if(!empty($users[$member]->photo))
                                                <a href="javascript:" class="avatar avatar-sm rounded-circle"
                                                   data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                   title="{{$users[$member]->first_name}}">
                                                    <img src="{{PUBLIC_DIR}}/uploads/{{$users[$member]->photo}}"
                                                         alt="team1">
                                                </a>

                                            @else
                                                <div class="avatar avatar-sm  rounded-circle bg-success-light">
                                                    <p class="mt-3 text-success text-uppercase"><span>{{$users[$member]->first_name[0]}}{{$users[$member]->last_name[0]}}</span>
                                                    </p>
                                                </div>

                                            @endif

                                        @endif
                                    @endforeach


                                @endif


                            </div>
                        </td>

                        <td>
                            <p class="text-xs font-weight-bold mb-0">

                                @if(!empty($project->end_date))
                                    {{(\App\Supports\DateSupport::parse($project->end_date))->format(config('app.date_format'))}}

                                @endif
                            </p>
                        </td>

                        <td>
                            <span class="badge badge-dot me-4">
                            <i class="bg-info"></i>
                            <span class="badge bg-purple-light font-weight-bold">{{$project->status}}</span>
                            </span>
                        </td>
                        <td>
                            <div>
                                <div class="dropstart">
                                    <a href="javascript:" class="text-secondary" id="dropdownMarketingCard"
                                       data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3"
                                        aria-labelledby="dropdownMarketingCard">
                                        <li><a class="dropdown-item border-radius-md"
                                               href="/create-project?id={{$project->id}}">{{__('Edit')}}</a></li>

                                        <li><a class="dropdown-item border-radius-md"
                                               href="/view-project?id={{$project->id}}">{{__('See Details')}}</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item border-radius-md text-danger"
                                               href="/delete/project/{{$project->id}}">{{__('Delete')}}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
