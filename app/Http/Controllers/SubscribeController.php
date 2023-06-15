<?php

namespace App\Http\Controllers;

use App\Models\CreditCard;
use App\Models\PaymentGateway;
use App\Models\SubscriptionPlan;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Stripe\Stripe;
use Carbon\Carbon;

class SubscribeController extends BaseController
{
    public function subscribe(Request $request)
    {
        $request->validate([
            "id" => "required|integer",
            "term" => "required|string",
        ]);

        $plan = SubscriptionPlan::find($request->id);

        if ($plan) {



            // if already customer has account in stipe
            $workspace = Workspace::find($this->user->workspace_id);

            // Remove As on 15-05-2023


            if ($workspace->stripe_customer_id) {
                $nrd = Carbon::parse(
                    $workspace->next_renewal_date
                );
                $today = Carbon::today();
                if ($nrd->lt($today)) {
                    $nrd = $today;
                }
                if ($request->term === "monthly") {
                    $amount = $plan->price_monthly;
                    $nrd->addMonth();
                } elseif ($request->term === "yearly") {
                    $amount = $plan->price_yearly;
                    $nrd->addYear();
                } else{
                    abort(401);
                }
                $amount_x_100 = (int) $amount * 100;
                // Charge the Customer instead of the card:
                $gateway = PaymentGateway::where("api_name", "stripe")->first();

                if (!$gateway) {
                    abort(401);
                }



                Stripe::setApiKey($gateway->private_key);
                $charge = \Stripe\Charge::create([
                    "amount" => $amount_x_100,
                    "currency" => config("app.currency"),
                    "customer" => $workspace->stripe_customer_id,
                    "description" => $plan->name,
                    "statement_descriptor" => substr(config("app.name"), 0, 22), // Maximum 22 character
                ]);


                if ($charge->status = "succeeded") {
                    // all good add plan in users


                    if(!$workspace->subscription_start_date){
                        $workspace->subscription_start_date = Carbon::now();
                    }
                    $workspace->subscribed = 1;
                    $workspace->term = $request->term;
                    $workspace->next_renewal_date = $nrd;
                    $workspace->trial_end_date = null;
                    $workspace->trial_start_date = null;

                    $workspace->price = $amount;
                    $workspace->trial = 1;
                    $workspace->plan_id = $plan->id;
                    $workspace->save();


                    return redirect("/billing")->with(
                        "status",
                        "Subscribed successfully!"
                    );
                } else {
                    // redirect back with issue 
                    return redirect("/billing")->with(
                        "status",
                        "Something went wrong with paymet please contact administrator."
                    );
                }
            }

            // 








            $payment_gateways = PaymentGateway::get()->keyBy('api_name')->all();

            if (empty($payment_gateways)) {
                return response("No payment gateway is configured");
            }

            $amount = 0;

            if ($request->term === "monthly") {
                $amount = $plan->monthly;
            } elseif ($request->term === "yearly") {
                $amount = $plan->yearly;
            } elseif ($request->term === "free_plan") {
                $amount = 0;
            } else {


                abort(401, "Price is not set!");
            }

            $amount = (float) $amount;

            return \view("settings.subscribe", [
                "selected_navigation" => "billing",
                "payment_gateways" => $payment_gateways,
                "plan" => $plan,
                "amount" => $amount,
                "term" => $request->term,
            ]);
        }
    }

    public function subscribeBuyAgain()
    {
        $workspace = Workspace::find($this->user->workspace_id);
        $plan = SubscriptionPlan::find($workspace->plan_id);

        if ($plan && $workspace->stripe_customer_id) {
            $nrd = Carbon::parse(
                $workspace->next_renewal_date
            );
            $today = Carbon::today();
            if ($nrd->lt($today)) {
                $nrd = $today;
            }
            if ($workspace->term === "monthly") {
                $amount = $workspace->price;
                $nrd->addMonth();
            } elseif ($workspace->term === "yearly") {
                $amount = $workspace->price;
                $nrd->addYear();
            } else {
                abort(401);
            }
            $amount_x_100 = (int) $amount * 100;
            // Charge the Customer instead of the card:
            $gateway = PaymentGateway::where("api_name", "stripe")->first();

            if (!$gateway) {
                abort(401);
            }



            Stripe::setApiKey($gateway->private_key);
            $charge = \Stripe\Charge::create([
                "amount" => $amount_x_100,
                "currency" => config("app.currency"),
                "customer" => $workspace->stripe_customer_id,
                "description" => $plan->name,
                "statement_descriptor" => substr(config("app.name"), 0, 22), // Maximum 22 character
            ]);


            if ($charge->status = "succeeded") {
                // all good add plan in users


                if (!$workspace->subscription_start_date) {
                    $workspace->subscription_start_date = Carbon::now();
                }
                $workspace->subscribed = 1;
                $workspace->next_renewal_date = $nrd;
                $workspace->trial_end_date = null;
                $workspace->trial_start_date = null;

                $workspace->price = $amount;
                $workspace->trial = 1;
                $workspace->save();


                return redirect("/billing")->with(
                    "status",
                    "Subscribed successfully!"
                );
            } else {
                // redirect back with issue 
                return redirect("/billing")->with(
                    "status",
                    "Something went wrong with paymet please contact administrator."
                );
            }
        }
        return redirect("/billing")->with(
            "status",
            "Something went wrong with paymet."
        );
    }

    public function cancelSubscription(Request $request)
    {
        $request->validate([
            "id" => "required|integer",
        ]);
        $plan = SubscriptionPlan::find($request->id);

        if ($plan) {
            $workspace = Workspace::find($this->user->workspace_id);
            $workspace->subscribed = 0;
            $workspace->plan_id = 0;
            $workspace->save();

            return redirect("/billing")->with(
                "status",
                "Unsubscribed successfully!"
            );
        }
    }

    public function paymentStripe(Request $request)
    {
        $request->validate([
            "plan_id" => "required|integer",
            "term" => "required|string",
            "token_id" => "required",
        ]);

        $plan = SubscriptionPlan::find($request->plan_id);

        if ($plan) {
            $next_renewal_date = Carbon::today();
            $start_date = Carbon::today();
            if ($request->term === "monthly") {
                $amount = $plan->price_monthly;
                $next_renewal_date = $next_renewal_date->addMonth();
            } elseif ($request->term === "yearly") {
                $amount = $plan->price_yearly;
                $next_renewal_date = $next_renewal_date->addYear();
            } elseif ($request->term === "free_plan") {
                $amount = 0;
                $next_renewal_date = $next_renewal_date->addDays(7);
            } else {
                abort(401);
            }

            $trial_start_date = "";
            $trial_end_date = "";
            $isTrial = 0;
            $workspace = Workspace::find($this->user->workspace_id);
            // first time free perios start
            if ($workspace->trial == 0) {
                $isTrial = 1;
                if ($request->term === "monthly" || $request->term === "yearly") {
                    $start_date->addDays(7);
                    $next_renewal_date = Carbon::today()->addDays(7);
                    $trial_start_date = Carbon::today();
                    $trial_end_date = Carbon::today()->addDays(7);
                }
            }

            $gateway = PaymentGateway::where("api_name", "stripe")->first();

            if (!$gateway) {
                abort(401);
            }

            $token = $request->token_id;

            try {
                // Set your secret key: remember to change this to your live secret key in production
                // See your keys here: https://dashboard.stripe.com/account/apikeys
                Stripe::setApiKey($gateway->private_key);

                // Create a Customer:

                $customer_data = [];

                $customer_data["source"] = $token;
                $customer_data["email"] = $this->user->email;
                $customer_data["name"] =
                    $this->user->first_name . " " . $this->user->last_name;

                $customer = \Stripe\Customer::create($customer_data);

                $card = new CreditCard();
                $card->gateway_id = $gateway->id;
                $card->user_id = $this->user->id;
                $card->token = $customer->id;
                $card->save();

                // Remove As on 15-05-2023
                // $amount_x_100 = (int) $amount * 100;
                // Charge the Customer instead of the card:
                // $charge = \Stripe\Charge::create([
                //     "amount" => $amount_x_100,
                //     "currency" => config("app.currency"),
                //     "customer" => $customer->id,
                //     "description" => $plan->name,
                //     "statement_descriptor" => substr(config("app.name"), 0, 22), // Maximum 22 character
                // ]);

                $workspace = Workspace::find($this->user->workspace_id);
                $workspace->subscribed = 1;
                $workspace->term = $request->term;
                $workspace->stripe_customer_id = $customer->id;
                $workspace->subscription_start_date = $start_date;
                $workspace->next_renewal_date = $next_renewal_date;
                if ($trial_end_date && $trial_end_date) {
                    $workspace->trial_end_date = $trial_end_date;
                    $workspace->trial_start_date = $trial_start_date;
                }

                $workspace->price = $amount;
                $workspace->trial = $isTrial;
                $workspace->plan_id = $plan->id;
                $workspace->save();

                return redirect("/billing")->with(
                    "status",
                    "Subscribed successfully!"
                );
            } catch (\Exception $e) {
                return response(
                    [
                        "success" => false,
                        "errors" => [
                            "system" =>
                            "An error occurred! " . $e->getMessage(),
                        ],
                    ],
                    422
                );
            }
        }
    }

    public function paymentPaystack(Request $request)
    {
        ray($request->all());
        $request->validate([
            "plan_id" => "required|integer",
            "term" => "required|string",
        ]);

        $term = $request->term;

        $plan = SubscriptionPlan::find($request->plan_id);

        if ($plan) {
            $payment_gatway = PaymentGateway::where("api_name", "paystack")->first();
            if ($payment_gatway) {
                if ($term === "monthly") {
                    $plan_id = $payment_gatway->paystack_monthly_plan_id;
                } else {
                    $plan_id = $payment_gatway->paystack_yearly_plan_id;
                }

                $url = "https://api.paystack.co/transaction/initialize";

                $fields = [
                    'email' => $this->user->email,
                    'amount' => $plan->price_monthly * 100,
                    'plan' => $plan_id,
                    'callback_url' => config('app.url') . '/dashboard?payment=paystack&plan_id=' . $plan->id . '&term=' . $term,
                ];

                $response = Http::withToken($payment_gatway->private_key)
                    ->asForm()
                    ->post($url, $fields);

                if ($response->successful()) {
                    $response = $response->json();
                    if ($response['status']) {
                        return redirect($response['data']['authorization_url']);
                    } else {
                        return redirect("/billing")->with(
                            "error",
                            "An error occurred! " . $response['message']
                        );
                    }
                } else {
                    ray($response->body());
                    return redirect("/billing")->with(
                        "error",
                        "An error occurred! "
                    );
                }
            }
        }
    }
}
