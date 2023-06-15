<form action="/save-event" method="post" id="form_main">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if($event)
        <h4>{{__('Edit')}}</h4>
    @else
        <h4>{{__('Add New Event')}}</h4>
    @endif
    <div id="sp_result_div"></div>

    <div class="form-group">
        <label for="example-email-input" class="form-control-label">{{__('Name')}}</label>
        <input class="form-control" name="title" type="text" id="name" value="{{$event->title ?? ''}}">
    </div>
    <div class="row mt-4">
        <div class="col-6">
            <label class="form-label">{{__('Start Date & Time')}}</label>
            <input class="form-control" name="start_date" type="datetime" id="start_date" value="{{$date}}">
        </div>
        <div class="col-6">
            <label class="form-label">{{__('End Date & Time')}}</label>
            <input class="form-control " name="end_date" type="datetime" id="end_date"


                   @if(!empty($event))
                   value="{{$event->end_date}}"
                   @else
                   value="{{date('Y-m-d')}}"
                @endif>
        </div>
    </div>
    <label class="mt-4 text-sm mb-0">{{__('Event Description')}}</label>
    <p class="form-text text-muted text-xs ms-1">
        {{__('Write a description of the event')}}
    </p>
        <div class="form-group">

        <textarea class="form-control" rows="10" id="description"
                  name="description">@if (!empty($event)){!! $event->description !!}@endif</textarea>
        </div>
    @csrf
    @if($event)
        <input type="hidden" name="id" value="{{$event->id}}">
    @endif
    <div class="text-right mt-4">

        <button type="submit" id="btn_submit" class="btn btn-info">
            {{__('Save')}}
        </button>
    </div>
</form>




