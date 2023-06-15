@extends('layouts.primary')
@section('content')
    <div class=" row">
        <div class="col">
            <h5 class="mb-2 text-secondary fw-bolder">
                {{__('Notes')}}
            </h5>
        </div>
        <div class="col text-end">
            <a href="/add-note" type="button" class="btn btn-info">{{__('Take New Note')}}</a>
        </div>
    </div>
    <div class="row" data-masonry='{"percentPosition": true }'>
        @foreach($notes as $note)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if(!empty($note->cover_photo))
                        <img src="{{PUBLIC_DIR}}/uploads/{{$note->cover_photo}}" class="card-img-top" alt="...">
                    @endif

                    <div class="card-body">
                        <p class="mb-1 pt-2 text-bold">{{$note->topic}}</p>
                        <h5 class="card-title">{{$note->title}}</h5>
                        <p class="card-text"> {!!substr($note->notes,0,400)!!} </p>
                        <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto"
                           href="/view-note?id={{$note->id}}">
                            {{__('Read More')}}
                            <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
