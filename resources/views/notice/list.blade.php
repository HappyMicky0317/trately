@extends('layouts.super-admin-portal')
@section('content')

    <div class=" row">
        <div class="col">
            <h5 class="mb-2 text-secondary fw-bolder">
                {{__('Notice List')}}
            </h5>

        </div>
        <div class="col text-end">
            <a href="/write-notice" type="button" class="btn btn-info">
                {{__('Add New Noticeboard')}}
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-body mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="cloudonex_table">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('Name')}}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{__('Created at')}}</th>
                                <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('Status')}}</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                            <tbody>
                            @foreach($notices as $notice)

                                <tr>
                                    <td class="text-center">
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">

                                            <div class="d-flex flex-column justify-content-center px-3">
                                                <h6 class="mb-0 text-sm"> {{$notice->title}} </h6>
                                                <p class="text-xs text-secondary mb-0"></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$notice->created_at}}</p>
                                    </td>

                                    <td>
                                        <h6 class="mb-0  ">
                                            @if($notice->status== 'Draft')
                                                <span class="badge bg-pink-light text-danger mb-0 ms-3">
                                    {{__('Draft')}}
                                </span>
                                            @else
                                                <span class="badge bg-success-light mb-0  text-success">
                                    {{__('Published')}}
                                </span>

                                            @endif

                                        </h6>
                                    </td>

                                    <td class="align-middle text-right">
                                        <div class="ms-auto">

                                            <a class="btn btn-link text-danger text-gradient px-3 mb-0"
                                               href="/delete/notice/{{$notice->id}}"><i
                                                    class="far fa-trash-alt me-2"></i>{{__('Delete')}}</a>

                                            <a class="btn btn-link text-dark px-3 mb-0"
                                               href="/write-notice/?id={{$notice->id}}"><i
                                                    class="fas fa-pencil-alt text-dark me-2"
                                                    aria-hidden="true"></i>{{__('Edit')}}</a>
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
