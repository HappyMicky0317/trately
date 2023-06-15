@extends('errors::layout')

@section('title', __('Not Found'))
@section('code', '404')


<main class="main-content mt-0">
    <section class="my-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto text-center">
                    <h1 class="display-1 text-bolder text-primary text-gradient">Error 404</h1>
                    <h2>{{__('Whoops! Page not found')}}</h2>
                    <p class="lead">{{__('The page you requested could not be found')}}</p>
                    <a href="/home" class="btn btn-dark btn-lg btn-rounded mt-4">{{__('Go to Homepage')}}</a>
                </div>

            </div>
        </div>
    </section>
</main>
