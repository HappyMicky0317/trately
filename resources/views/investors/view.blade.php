@extends('layouts.primary')
@section('content')

    <div class="row  mb-5">


        <div class="col-md-4 ">
            <div class="card bg-info mb-4 ">
                <div class="card-body">
                    <h5 class="fw-bolder text-white mb-4">{{__('Investment Details')}}</h5>
                    <h6 class="text-white">
                        Product: @if(!empty($products[$investor->product_id]))
                            @if(isset($products[$investor->product_id]))
                                {{$products[$investor->product_id]->title}}
                            @endif
                        @endif
                    </h6>
                    <h6 class="text-white">

    {{__(' Amount:')}} {{formatCurrency($investor->amount,getWorkspaceCurrency($super_settings))}}
  </h6>


      <h6 class="text-white"><span>{{__('Status:')}}</span><span class="text-success">

       {{$investor->status}}



                    </span> </h6>



</div>
</div>
<div class="card">

<div class="card-body">

  <h5 class="fw-bolder mb-4">{{__('Investor Information')}}</h5>

  <ul class="flex-row  nav ">
      @if (!empty($investor->facebook))
          <li class="nav-item ">
              <a class="nav-link " href="{{$investor->facebook}}" target="_blank">
                  <button type="button" class="btn rounded-circle bg-info-alt btn-facebook btn-icon-only">
                      <span class="btn-inner--icon"><i class="fab fa-facebook"></i></span>
                  </button>
              </a>
          </li>

      @endif

      @if (!empty($investor->linkedin))
          <li class="nav-item">
              <a class="nav-link " href="{{$investor->linkedin}}" target="_blank">
                  <button type="button" class="btn rounded-circle bg-info btn-linkedin btn-icon-only">
                      <span class="btn-inner--icon"><i class="fab fa-linkedin text-white"></i></span>
                  </button>
              </a>
          </li>

      @endif

      @if (!empty($investor->twitter))
          <li class="nav-item">
              <a class="nav-link " href="{{$investor->twitter}}" target="_blank">
                  <button type="button" class="btn rounded-circle btn-twitter btn-icon-only">
                      <span class="btn-inner--icon"><i class="fab fa-twitter"></i></span>
                  </button>
              </a>
          </li>
      @endif
  </ul>

  <ul class="list-group">
      <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong
              class="text-dark">{{__('Full Name:')}}</strong>
          {{$investor->first_name}} {{$investor->last_name}}
      </li>
      <li class="list-group-item border-0 ps-0 text-sm"><strong
              class="text-dark">{{__('Phone Number:')}}</strong>
          {{$investor->phone_number}}
      </li>
      <li class="list-group-item border-0 ps-0 text-sm"><strong
              class="text-dark">{{__('Email:')}}</strong> {{$investor->email}}</li>
      <li class="list-group-item border-0 ps-0 text-sm"><strong
              class="text-dark">{{__('Account Created:')}}</strong> {{(\App\Supports\DateSupport::parse($investor->created_at))->format(config('app.date_time_format'))}}
      </li>
      <li class="list-group-item border-0 ps-0 text-sm"><strong
              class="text-dark">{{__('Source:')}}</strong> {{$investor->source}}</li>


  </ul>
  <a class="btn btn-info btn-sm mb-0 mt-3" href="/add-investor?id={{$investor->id}}">{{__('Edit')}}</a>

</div>
</div>
</div>

<div class="col-md-8 mt-lg-0 mt-4">

<div class="card">
<div class="card-body">
<h5 class="fw-bolder mb-4">{{__('Notes')}}</h5>
{!! $investor->notes !!}
</div>
</div>

</div>
</div>

@endsection


