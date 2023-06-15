@extends('layouts.primary')

@section('content')



    <div class=" row mt-1 d-print-none">
        <div class="col">
            <h5 class="text-secondary fw-bolder">
                {{__('Startup Canvas of')}} {{$model->company_name}}
            </h5>
        </div>
        <div class="col text-end">

            <a href="#" onclick="window.print()"
               class="btn bg-gradient-dark btn-sm add_event waves-effect waves-light">{{__('Print')}}</a>
            <a href="/design-startup-canvas?id={{$model->id}}"
               class="btn btn-sm btn-warning add_event waves-effect waves-light">{{__('Edit')}}</a>
            <a href="/delete/business-model/{{$model->id}}"
               class="btn btn-sm btn-danger add_event waves-effect waves-light">{{__('Delete')}}</a>
        </div>
    </div>
    <div class="">
        <div class="">
            <p class="text-sm">{{__('Company Name')}}: <span class="text-dark fw-bolder">{{$model->company_name}}</span></p>


            <p class="text-sm">{{__('Related Product')}}:<span class="text-dark fw-bolder"> @if(!empty($products[$model->product_id]))
                        @if(isset($products[$model->product_id]))
                            {{$products[$model->product_id]->title}}
                        @endif
                    @endif</span></p>
            <p class="text-sm">{{__('Designed By')}}:<span class="text-purple fw-bolder"> @if(isset($users[$model->admin_id]))
                        {{$users[$model->admin_id]->first_name}} {{$users[$model->admin_id]->last_name}}
                    @endif</span></p>
            <p class="text-sm">{{__('Created At')}}:
                <span class="badge bg-secondary">{{(\App\Supports\DateSupport::parse($model->created_at))->format(config('app.date_format'))}}</span></p>




            <div class="table-responsive bg-yellow-light">
                <table class="table align-items-center mb-0  table-bordered">
                    <thead>
                    <tr>
                        <th class=""><label>{{__('Problems')}}</label>
                        </th>
                        <th class=""><label>{{__('Solutions')}}</label>

                        </th>
                        <th class=""><label>{{__('Unique Value Propositions')}}</label>

                        </th>
                        <th class=""><label>{{__('Unfair Advantage')}}</label>

                        </th>

                        <th scope="col"><label>{{__('Customer Segments')}}</label>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="">
                            {!!clean($model->problems)!!}
                        </td>
                        <td>
                            {!!clean($model->solutions)!!}</td>
                        <td>
                            {!!clean($model->value_propositions)!!}
                        </td>
                        <td>
                            {!!clean($model->unfair_advantage)!!}
                        </td>
                        <td>{!!clean($model->customer_segments)!!}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <label>{{__('Key Metrics')}}</label>

                            <p>{!!clean($model->key_matrices)!!}</p>
                        </td>
                        <td></td>

                        <td>
                            <label>{{__('Channels')}}</label>
                            <p>{!!clean($model->channels)!!}</p>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <label>{{__('Cost Structure')}}</label>
                            {!!clean($model->cost_structure)!!}

                        </td>
                        <td colspan="3"><label>{{__('Revenue Stream')}}</label>
                            {!!clean($model->revenue_stream)!!}

                        </td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
