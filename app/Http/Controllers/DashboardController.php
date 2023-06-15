<?php

namespace App\Http\Controllers;

use App\Models\BusinessModel;
use App\Models\Calendar;
use App\Models\Investor;
use App\Models\Note;
use App\Models\NoticeBoard;
use App\Models\PaymentGateway;
use App\Models\Projects;
use App\Models\Setting;
use App\Models\SubscriptionPlan;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

class DashboardController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function dashboard()
    {

        $ldate = date("Y-m-d H:i:s");
        $today = Carbon::now();

        $todos = Task::orderBy("id", "desc")
            ->where("workspace_id", $this->user->workspace_id)
            ->limit(4)
            ->get();
        $recent_events = Calendar::orderBy("id", "desc")
            ->where("workspace_id", $this->user->workspace_id)
            ->limit(5)
            ->get();

        $total_notes = Note::where(
            "workspace_id",
            $this->user->workspace_id
        )->count();
        $total_projects = Projects::where(
            "workspace_id",
            $this->user->workspace_id
        )->count();
        $total_models = BusinessModel::where(
            "workspace_id",
            $this->user->workspace_id
        )->count();
        $total_users = User::where(
            "workspace_id",
            $this->user->workspace_id
        )->count();

        $recent_projects = Projects::orderBy("id", "desc")
            ->where("workspace_id", $this->user->workspace_id)
            ->limit(5)
            ->get();
        $recent_investors = Investor::orderBy("id", "desc")
            ->where("workspace_id", $this->user->workspace_id)
            ->limit(5)
            ->get();
        $recent_notes = Note::orderBy("id", "desc")
            ->where("workspace_id", $this->user->workspace_id)
            ->limit(5)
            ->get();
        $recent_note = Note::orderBy("id", "desc")
            ->where("workspace_id", $this->user->workspace_id)
            ->first();
        $recent_notice = NoticeBoard::orderBy("id", "desc")

            ->first();
        $users = User::all()
            ->keyBy("id")
            ->all();

        $products = Projects::where("workspace_id", $this->user->workspace_id)
            ->get()
            ->keyBy("id")
            ->all();


        $super_admin_settings = Setting::getSuperAdminSettings();
        $workspace = $this->workspace;
        $trial_will_expire = null;
        if(!empty($super_admin_settings['free_trial_days']) && $workspace->trial == 1)
        {
            $free_trial_days = $super_admin_settings['free_trial_days'];
            $free_trial_days = (int) $free_trial_days;
            $workspace_creation_date = $workspace->created_at;
            $trial_will_expire = strtotime($workspace_creation_date) + ($free_trial_days*24*60*60);
            $trial_will_expire =  Carbon::parse($workspace->trial_end_date)->diffInDays(Carbon::now());

            // $trial_will_expire = Carbon::createFromTimestamp($trial_will_expire);

        }

        return \view("dashboard", [
            "selected_navigation" => "dashboard",

            "total_notes" => $total_notes,
            "total_projects" => $total_projects,
            "ldate" => $ldate,
            "today" => $today,
            "recent_projects" => $recent_projects,
            "recent_investors" => $recent_investors,
            "todos" => $todos,
            "recent_events" => $recent_events,
            "recent_notes" => $recent_notes,
            "recent_notice" =>  $recent_notice,
            "recent_note" => $recent_note,
            "total_models" => $total_models,
            "total_users" => $total_users,
            "users" => $users,
            "products" => $products,
            'trial_will_expire' => $trial_will_expire,
        ]);
    }

    public function validatePaypalSubscription(Request $request)
    {

        $paypal_gateway = PaymentGateway::where('api_name', 'paypal')->first();

        if($paypal_gateway)
        {

            $client_id = $paypal_gateway->username;
            $client_secret = $paypal_gateway->password;

            if(!empty($client_id) && !empty($client_secret))
            {

                // get access token

                $url = 'https://api.paypal.com/v1/oauth2/token';

                $response = Http::withBasicAuth($client_id, $client_secret)->post([
                    'grant_type' => 'client_credentials',
                ]);

                $access_token = $response->json()['access_token'];





                $subscription_id = $request->input('subscription_id');
                $url = 'https://api.paypal.com/v1/billing/subscriptions/'.$subscription_id;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Authorization: Bearer '.$access_token,
                ));
                $result = curl_exec($ch);
                curl_close($ch);
                $result = json_decode($result, true);
                if(!empty($result['status']) && $result['status'] == 'ACTIVE')
                {
                    $plan_id = $result['plan_id'];
                    $plan = SubscriptionPlan::where('paypal_plan_id', $plan_id)->first();
                    if(!empty($plan))
                    {
                        $this->workspace->plan_id = $plan->id;
                        $this->workspace->subscribed = 1;
                        $this->workspace->save();
                    }

                }
            }

            return redirect(config('app.url')."/dashboard");

        }


    }
}
