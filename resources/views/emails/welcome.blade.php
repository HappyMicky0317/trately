@component('mail::message')
# {{__('Welcome')}} {{$user->first_name}}!

{{__('Thanks For Signing Up. We’re thrilled to see you here!')}}

@component('mail::button', ['url' => config('app.url')])
        {{__('Login')}}
@endcomponent

{{__('Thanks')}},<br>
{{ config('app.name') }}
@endcomponent
