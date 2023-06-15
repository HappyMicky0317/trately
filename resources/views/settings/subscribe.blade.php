@extends('layouts.primary')
@section('head')
    @if(!empty($payment_gateways['stripe']) && !empty($payment_gateways['stripe']->public_key))
        <script src="https://js.stripe.com/v3/"></script>
    @endif
    @if(!empty($payment_gateways['paypal']) && !empty($payment_gateways['paypal']->username && !empty($plan->paypal_plan_id)))
        <script src="https://www.paypal.com/sdk/js?client-id={{$payment_gateways['paypal']->username}}&vault=true&intent=subscription">
        </script>
    @endif
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="fw-bolder">{{$plan->name}}</h4>
            <div class="text-purple mb-3">{!! $plan->description !!}</div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(!empty($payment_gateways))

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @if(!empty($payment_gateways['stripe']))
                        <li class="nav-item" role="presentation">
                            <button class="nav-link  text-dark fw-bolder @if(array_key_first($payment_gateways) === 'stripe') active @endif" id="home-tab" data-bs-toggle="tab" data-bs-target="#gateway-stripe" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">{{__('Credit/Debit Card')}}</button>
                        </li>
                    @endif
                    @if(!empty($payment_gateways['paypal']) && !empty($payment_gateways['paypal']->username && !empty($plan->paypal_plan_id)))
                        <li class="nav-item" role="presentation">
                            <button class="nav-link  text-dark fw-bolder @if(array_key_first($payment_gateways) === 'paypal') active @endif" id="home-tab" data-bs-toggle="tab" data-bs-target="#gateway-paypal" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">{{__('PayPal')}}</button>
                        </li>
                    @endif
                        @if(!empty($payment_gateways['paystack']) && !empty($payment_gateways['paystack']->public_key))
                            <li class="nav-item" role="presentation">
                                <button class="nav-link  text-dark fw-bolder @if(array_key_first($payment_gateways) === 'paystack') active @endif" id="paystack-tab" data-bs-toggle="tab" data-bs-target="#gateway-paystack" type="button" role="tab" aria-controls="paystack-tab-pane" aria-selected="true">{{__('Paystack')}}</button>
                            </li>
                        @endif
                    @if(!empty($payment_gateways['bank']) && !empty($payment_gateways['bank']->name))
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-dark fw-bolder @if(array_key_first($payment_gateways) === 'bank') active @endif" id="tab" data-bs-toggle="tab" data-bs-target="#gateway-bank" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">{{__('Pay via Bank')}}</button>
                        </li>
                    @endif
                </ul>
                <div class="tab-content" id="myTabContent">
                    @if(!empty($payment_gateways['stripe']))
                        <div class="tab-pane fade @if(array_key_first($payment_gateways) === 'stripe') show active @endif" id="gateway-stripe" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <div id="stripeDiv" class="my-3 p-3">
                                <form action="/payment-stripe" method="post" id="payment-form">
                                    <div class="form-row">
                                        <label for="card-element">
                                            {{__('Credit or debit card')}}
                                        </label>
                                        <div id="card-element" class="form-control">
                                            <!-- A Stripe Element will be inserted here. -->
                                        </div>

                                        <!-- Used to display form errors. -->
                                        <div id="card-errors" role="alert"></div>
                                    </div>

                                    <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                    <input type="hidden" name="term" value="{{$term}}">

                                    @csrf

                                    <button class="btn btn-info mt-4" id="btnStripeSubmit"
                                    >{{__('Submit Payment')}}</button>

                                </form>
                            </div>
                        </div>
                    @endif


                    <div class="tab-pane fade @if(array_key_first($payment_gateways) === 'paypal') show active @endif" id="gateway-paypal" role="tabpanel">
                        @if(!empty($payment_gateways['paypal']) && !empty($payment_gateways['paypal']->username && !empty($plan->paypal_plan_id)))

                            <div id="paypal-button-container"></div>

                        @endif
                    </div>


                        @if(!empty($payment_gateways['paystack']) && !empty($payment_gateways['paystack']->public_key))
                            <div class="tab-pane fade @if(array_key_first($payment_gateways) === 'stripe') show active @endif" id="gateway-paystack" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                <div id="stripeDiv" class="my-3 p-3">
                                    <form action="/payment-paystack" method="post" id="payment-form">
                                        <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                        <input type="hidden" name="term" value="{{$term}}">
                                        @csrf
                                        <input type="hidden" name="gateway_api_name" value="paystack">
                                        <button type="submit" class="btn btn-info">{{__('Pay')}}</button>
                                    </form>
                                </div>
                            </div>
                        @endif

                    @if(!empty($payment_gateways['bank']))
                        <div class="tab-pane fade @if(array_key_first($payment_gateways) === 'bank') show active @endif" id="gateway-bank" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <div id="bankDiv" class="my-3 p-3">
                                <div class="form-row">
                                    <h5>
                                        {{__('Payment Instruction')}}
                                    </h5>

                                    <div>
                                        {!! $payment_gateways['bank']->instruction!!}
                                    </div>
                                    <!-- Used to display form errors. -->

                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            @endif
        </div>
    </div>



@endsection

@section('script')
    <script>

        jQuery(document).ready(function () {
            "use strict";

            @if(!empty($payment_gateways['stripe']) && !empty($payment_gateways['stripe']->public_key))
            // Dynamic JS for Stripe
            var stripe = Stripe('{{$payment_gateways['stripe']->public_key}}');


            var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
                base: {
                    color: '#32325d',
                    lineHeight: '18px',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

// Create an instance of the card Element.
            var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

// Handle real-time validation errors from the card Element.
            card.addEventListener('change', function (event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

// Handle form submission.
            var form = document.getElementById('payment-form');
            var $btnStripeSubmit = $('#btnStripeSubmit');
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                $btnStripeSubmit.prop('disabled', true);
                stripe.createToken(card).then(function (result) {
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                        $btnStripeSubmit.prop('disabled', false);
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);

                    }
                });
            });

// Submit the form with the token ID.
            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'token_id');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }
            @endif

            @if(!empty($payment_gateways['paypal']) && !empty($payment_gateways['paypal']->username && !empty($plan->paypal_plan_id)))
            paypal.Buttons({
                createSubscription: function(data, actions) {
                    return actions.subscription.create({
                        'plan_id': '{{$plan->paypal_plan_id}}' // Creates the subscription
                    });
                },
                onApprove: function(data, actions) {
                    window.location = '{{config('app.url')}}/validate-paypal-subscription?subscription_id=' + data.subscriptionID;
                }
            }).render('#paypal-button-container'); // Renders the PayPal button
            @endif

        });
    </script>
@endsection
