@extends('frontend.layout')
@section('title','Terms & Conditions')
@section('content')

    <section class="">
        <div class="bg-pink-light position-relative">
            <div class="pb-lg-9 pb-5 pt-7 postion-relative z-index-2">
                <div class="row mt-5">
                    <div class="col-md-8 mx-auto text-center mt-4">
                        @if (!empty($term))
                            <h2 class="text-dark">
                                {{$term->title}}
                            </h2>
                        @endif
                        <p class="text-muted">
                            {{__('Updated')}}
                            @if (!empty($term))
                                {{$term->date}}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 position-relative">
        <div id="carousel-testimonials" class="carousel slide carousel-team">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-12 col-md-7 me-lg-auto position-relative">
                                <p class="mb-1">
                                    @if (!empty($term))
                                        {!! $term->description !!}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
