@extends('layouts.super-admin-portal')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="mb-5">
                <div class="row">
                    <div class="col-12 col-lg-8 m-auto">
                        <form action="/save-workspace" method="post" class="multisteps-form__form mb-8">
                            <!--single form panel-->

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="list-unstyled">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div>
                                <h5 class="font-weight-bolder mb-0">
                                    {{__('Edit Workspace')}}
                                </h5>
                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{__('Workspace Name')}}</label>
                                            <input name="name" class="multisteps-form__input form-control" type="text"
                                                   @if (!empty($workspace)) value="{{$workspace->name}}" @endif />
                                        </div>
                                        @if($workspace->id !== $user->workspace_id)
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">
                                                    {{__('Choose a plan ')}}

                                                </label><span class="text-danger">*</span>

                                                <select class="form-select" aria-label="Default select example" name="plan_id">   <option value="0">{{__('None')}}</option>@foreach ($plans as $plan)

                                                        <option value="{{$plan->id}}"
                                                                @if (!empty($workspace))
                                                                @if ($workspace->plan_id == $plan->id)
                                                                selected
                                                            @endif
                                                            @endif
                                                        >{{$plan->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label>{{__('Next Renewal Date')}}</label>
                                                <input class="form-control" type="date" name="next_renewal_date" value="{{$workspace->next_renewal_date ?? ''}}">
                                            </div>

                                        @endif

                                    </div>

                                </div>
                            </div>


                            <!--single form panel-->
                            @csrf

                            @if (!empty($workspace))
                                <input type="hidden" name="id" value="{{$workspace->id}}">
                            @endif
                            <div class="button-row  mt-4">
                                <button class="btn btn-info ms-auto mb-0 js-btn-next" type="submit">{{__('Submit')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



