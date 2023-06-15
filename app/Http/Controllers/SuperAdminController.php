<?php

namespace App\Http\Controllers;

use App\Models\ContactSection;
use App\Models\CookiePolicy;
use App\Models\LandingPage;
use App\Models\PaymentGateway;
use App\Models\PrivacyPolicy;
use App\Models\Setting;
use App\Models\SubscriptionPlan;
use App\Models\Terms;
use App\Models\User;
use App\Models\Workspace;
use App\Supports\UpdateSupport;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class SuperAdminController extends SuperAdminBaseController
{
    public function dashboard()
    {
        $total_users = User::count();
        $total_workspaces = Workspace::count();
        $total_plans = SubscriptionPlan::count();

        $recent_workspaces = Workspace::orderBy("id", "desc")
            ->limit(5)
            ->get();
        $recent_users = User::orderBy("id", "desc")
            ->limit(5)
            ->get();
        $recent_plans = SubscriptionPlan::orderBy("id", "desc")
            ->limit(5)
            ->get();

        $workspaces = Workspace::all()
            ->keyBy("id")
            ->all();
        $plans = SubscriptionPlan::all()
            ->keyBy("id")
            ->all();

        return \view("super-admin-dashboard", [
            "selected_navigation" => "sdashboard",
            "total_users" => $total_users,
            "total_workspaces" => $total_workspaces,
            "recent_workspaces" => $recent_workspaces,
            "recent_users" => $recent_users,
            "recent_plans" => $recent_plans,
            "total_plans" => $total_plans,
            "workspaces" => $workspaces,
            "plans" => $plans,
        ]);
    }

    public function updateSchema()
    {

        $current_build_id = config('app.build_id',1);
        UpdateSupport::updateSchema();
        $setting = Setting::where('workspace_id',$this->user->workspace_id)
            ->where('key','installed_build_id')
            ->first();
        if(!$setting)
        {
            $setting = new Setting();
            $setting->workspace_id = $this->user->workspace_id;
            $setting->key = 'installed_build_id';
        }

        $setting->value = $current_build_id;
        $setting->save();




        return redirect(config('app.url').'/super-admin/dashboard');
    }

    public function users()
    {
        $users = User::all();

        $workspaces = Workspace::all()
            ->keyBy("id")
            ->all();

        return \view("super-admin.users", [
            "selected_navigation" => "users",
            "users" => $users,
            "workspaces" => $workspaces,
        ]);
    }
    public function workspaces()
    {
        $users = User::all();

        $workspaces = Workspace::all()
            ->keyBy("id")
            ->all();
        $plans = SubscriptionPlan::all()
            ->keyBy("id")
            ->all();

        return \view("super-admin.workspaces", [
            "selected_navigation" => "workspaces",
            "users" => $users,
            "workspaces" => $workspaces,
            "plans" => $plans,
        ]);
    }


    public function saveWorkspace(Request $request)
    {
        $request->validate([
            "id" => "nullable|integer",
        ]);

        $workspace = false;

        if ($request->id) {
            $workspace = Workspace::find($request->id);
        }

        $workspace->name = $request->name;
        $workspace->plan_id = $request->plan_id;
        if($request->plan_id)
        {
            $workspace->subscribed = 1;
        }
        else{
            $workspace->subscribed = 0;
        }
        if($request->next_renewal_date)
        {
            $workspace->next_renewal_date = $request->next_renewal_date;
        }
        $workspace->save();

        return redirect("/workspaces");
    }

    public function activateLicense()
    {

        return \view("super-admin.activate-license", [
            "selected_navigation" => "sdashboard",
        ]);
    }


    public function editWorkspace(Request $request)
    {
        $users = User::all();
        $plans = SubscriptionPlan::all()
            ->keyBy("id")
            ->all();


        $workspaces = Workspace::all()
            ->keyBy("id")
            ->all();
        $workspace =false;

        if ($request->id) {
            $workspace = Workspace::find($request->id);
        }

        return \view("super-admin.edit-workspaces", [
            "selected_navigation" => "workspaces",
            "users" => $users,
            "workspaces" => $workspaces,
            "workspace" => $workspace,
            "plans" => $plans,
        ]);
    }

    public function viewWorkspace(Request $request)
    {
        $request->validate([
            "id" => "required|integer",
        ]);

        $users = User::all();
        $plans = SubscriptionPlan::all()
            ->keyBy("id")
            ->all();

        $app_workspace = Workspace::find($request->id);

        if($request->query('action'))
        {
            if($request->query('action') == 'suspend')
            {
                $app_workspace->active = 0;
                $app_workspace->save();
            }

            if($request->query('action') == 'activate')
            {
                $app_workspace->active = 1;
                $app_workspace->save();
            }

            return redirect()->back();

        }


        $workspaces = Workspace::all()
            ->keyBy("id")
            ->all();

        $users_in_this_workspace = User::where('workspace_id',$app_workspace->id)->get();


        return \view("super-admin.view-workspace", [
            "selected_navigation" => "workspaces",
            "users" => $users,
            "workspaces" => $workspaces,
            "app_workspace" => $app_workspace,
            "plans" => $plans,
            "users_in_this_workspace" => $users_in_this_workspace,
        ]);


    }


    public function saasPlans()
    {
        $plans = SubscriptionPlan::all();

        return \view("super-admin.plans", [
            "selected_navigation" => "saas-plans",
            "plans" => $plans,
        ]);
    }
    public function createSaasPlan(Request $request)
    {
        $plan= false;
        $plan_modules = [];
        $features = [];
        if($request->id)
        {
            $plan = SubscriptionPlan::find($request->id);
            if($plan)
            {
                if($plan->modules)
                {
                    $plan_modules = json_decode($plan->modules);
                }
                if($plan->features)
                {
                    $features = json_decode($plan->features);
                }

            }
        }


        $available_modules = SubscriptionPlan::availableModules();

        return \view("super-admin.create-plan", [
            "selected_navigation" => "saas-plans",
            "plan" => $plan,
            "available_modules" => $available_modules,
            "plan_modules" => $plan_modules,
            "features" =>  $features,
        ]);
    }
    public function subscriptionPlanPost(Request $request)
    {
        $request->validate([
            "name" => "required|max:150",
            "id" => "nullable|integer",
            "features" => "nullable|array",
            "maximum_allowed_users" => "required|integer",
            "price_yearly" => "required|numeric",
            "price_monthly" => "required|numeric",
            "paypal_plan_id" => "nullable|string",
            "max_file_upload_size" => "nullable|integer",
            "file_space_limit" => "nullable|integer",
        ]);

        $plan = false;

        if ($request->id) {
            $plan = SubscriptionPlan::find($request->id);
        }

        if (!$plan) {
            $plan = new SubscriptionPlan();
        }

        $plan->name = $request->name;

        $plan->price_yearly = $request->price_yearly;
        $plan->price_monthly = $request->price_monthly;
        $plan->maximum_allowed_users = $request->maximum_allowed_users;
        $plan->max_file_upload_size = $request->max_file_upload_size;
        $plan->file_space_limit = $request->file_space_limit;
        $plan->paypal_plan_id = $request->paypal_plan_id;
        $plan->description = clean($request->description);

        if($request->has('paystack_monthly_plan_id'))
        {
            $plan->paystack_monthly_plan_id = $request->paystack_monthly_plan_id;
        }

        if($request->has('paystack_yearly_plan_id'))
        {
            $plan->paystack_yearly_plan_id = $request->paystack_yearly_plan_id;
        }

        $features = [];

        foreach ($request->features as $feature) {
            if (!empty($feature)) {
                $features[] = $feature;
            }
        }

        if (!empty($features)) {
            $plan->features = json_encode($features);
        }

        $modules = null;

        $available_modules = SubscriptionPlan::availableModules();

        foreach ($available_modules as $key => $value) {
            if ($request->$key) {
                $modules[] = $key;
            }
        }

        if ($modules) {
            $plan->modules = json_encode($modules);
        }

        $plan->save();

        return redirect("/subscription-plans");
    }

    public function userProfile(Request $request)
    {
        $skit_user  = false;
        $skit_user_workspace = false;
        $plan = false;

        if($request->id)
        {
            $skit_user = User::find($request->id);

            $skit_user_workspace = Workspace::find($skit_user->workspace_id);

            if(  $skit_user_workspace->plan_id)
            {
                $plan = SubscriptionPlan::find( $skit_user_workspace->plan_id);
            }


        }


        return \view("super-admin.user-profile", [
            "selected_navigation" => "users",
            "layout" => "super-admin-portal",
            "skit_user" => $skit_user ,
            "skit_user_workspace"=>  $skit_user_workspace,
            "plan"=> $plan,
        ]);
    }
    public function addUser(Request $request)
    {
        $focus_user = false;

        if ($request->id) {
            $focus_user = User::find($request->id);
        }

        return \view("super-admin.add-new-user", [
            "selected_navigation" => "users",

            "layout" => "super-admin-portal",
            "focus_user" => $focus_user,
        ]);
    }
    public function adminProfile(Request $request)
    {
        $available_languages = User::$available_languages;
        $workspace = Workspace::find($this->user->workspace_id);

        return \view("profile.profile", [
            "selected_navigation" => "profile",
            "layout" => "super-admin-portal",
            "available_languages" => $available_languages,
            "workspace" => $workspace,
        ]);
    }

    public function adminSetting(Request $request)
    {
        $workspace = Workspace::find($this->user->workspace_id);
        $available_languages = User::$available_languages;

        return \view("settings.settings", [
            "selected_navigation" => "settings",
            "layout" => "super-admin-portal",
            "workspace" => $workspace,
            "available_languages" => $available_languages,
        ]);
    }

    public function paymentGateways()
    {
        $users = User::all();
        $payment_gateways = PaymentGateway::all()
            ->keyBy("api_name")
            ->all();

        return \view("super-admin.payment-gateways", [
            "selected_navigation" => "payment-gateways",
            "users" => $users,
            "payment_gateways" => $payment_gateways,
        ]);
    }

    public function configurePaymentGateway(Request $request)
    {
        $request->validate([
            "api_name" => "required|string",
        ]);

        $api_name = $request->api_name;
        $gateway = PaymentGateway::where("api_name", $api_name)->first();

        return \view("super-admin.configure-payment-gateway", [
            "selected_navigation" => "payment-gateways",
            "gateway" => $gateway,
            "api_name" => $api_name,
        ]);
    }

    public function configurePaymentGatewayPost(Request $request)
    {
        $api_name= $request->api_name;

        $payment_gateway = PaymentGateway::where("api_name",$api_name)->first();

        if (!$payment_gateway) {
            $payment_gateway = new PaymentGateway();
            $payment_gateway->api_name = $api_name;
        }

        if($api_name === 'paypal')
        {
            $payment_gateway->name = "Paypal";
            $payment_gateway->api_name = $api_name;
            $payment_gateway->username = $request->username;
            $payment_gateway->password = $request->password;
        }
        elseif ($api_name === 'stripe')
        {
            $payment_gateway->name = "Stripe";
            $payment_gateway->api_name = $api_name;
            $payment_gateway->private_key = $request->private_key;
            $payment_gateway->public_key = $request->public_key;
        }
        elseif ($api_name === 'bank')
        {
            $payment_gateway->name = "bank";
            $payment_gateway->api_name = $api_name;
            $payment_gateway->instruction = $request->instruction;
        }
        elseif ($api_name === "paystack") {

            PaymentGateway::enablePayStack();

            $payment_gateway->name = "paystack";
            $payment_gateway->api_name = $api_name;
            $payment_gateway->private_key = $request->private_key;
            $payment_gateway->public_key = $request->public_key;

        }

        $payment_gateway->save();

        return redirect("/payment-gateways");
    }

    public function deleteWorkspace($id)
    {
        $workspace = Workspace::find($id);

        if ($workspace) {
            if ($this->workspace->id === $workspace->id) {
                return redirect("/workspaces");
            }

            User::where('workspace_id',$id)->delete();

            $workspace->delete();
            return redirect("/workspaces");
        }
    }
    public function deleteUser($id)
    {
        $user = User::find($id);

        if ($user) {
            if ($this->user->id === $user->id) {
                return redirect("/users");
            }

            $user->delete();
            return redirect("/users");
        }
    }




    public function newsletterEmail()
    {
        $emails = Newsletter::all();

        $workspaces = Workspace::all()
            ->keyBy("id")
            ->all();

        return \view("super-admin.newsletter", [
            "selected_navigation" => "emails",
            "emails" => $emails,
            "workspaces" => $workspaces,
        ]);
    }



    public function emailSetting(Request $request)
    {
        $workspace = Workspace::find($this->user->workspace_id);

        return \view("super-admin.email-settings", [
            "selected_navigation" => "email-settings",
            "layout" => "super-admin-portal",
            "workspace" => $workspace,
        ]);
    }


    public function saveEmailSetting(Request $request)
    {
        $request->validate([
            'smtp_host' => 'nullable|string|max:200',
            'smtp_username' => 'nullable|string|max:200',
            'smtp_password' => 'nullable|string|max:200',
            'smtp_port' => 'nullable|integer|max:65536',
        ]);

        Setting::updateSettings($this->workspace->id,'smtp_host',$request->smtp_host);
        Setting::updateSettings($this->workspace->id,'smtp_username',$request->smtp_username);
        Setting::updateSettings($this->workspace->id,'smtp_password',$request->smtp_password);
        Setting::updateSettings($this->workspace->id,'smtp_port',$request->smtp_port);

        return redirect("/email-setting");
    }



    public function landingPage()
    {

        $landingpage = LandingPage::first();

        return \view('super-admin.landing-page',[
            'selected_navigation' => 'landing-page',
            'selected_sub_navigation' => 'homepage',

            'landingpage' => $landingpage,

        ]);

    }

    public function pages()
    {
        $posts = Post::all();
        return \view('super-admin.pages',[
            'selected_navigation' => 'page-editor',
            'posts' => $posts,
        ]);
    }

    public function page(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer',
        ]);
        $post = null;
        if($request->id)
        {
            $post = Post::find($request->id);
        }
        return \view('super-admin.page',[
            'selected_navigation' => 'page-editor',
            'post' => $post,
        ]);
    }

    public function pageEditor(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);
        $post = Post::find($request->id);

        if($post)
        {
            return \view('super-admin.page-editor',[
                'selected_navigation' => 'page-editor',
                'post' => $post,
            ]);
        }



    }


    public function savePost(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer',
            'sort_order' => 'required|integer',
            'menu_name' => 'required|string|max:100',
            'title' => 'required|string|max:200',
        ]);

        $post = null;
        if($request->id)
        {
            $post = Post::find($request->id);
        }

        if(!$post)
        {
            $post = new Post();
        }

        $post->menu_name = $request->menu_name;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->sort_order = $request->sort_order;
        $post->save();

        return redirect(config('app.url').'/super-admin/pages');

    }

    public function heroSection(Request $request)
    {


        $request->validate([

            'background_image' => 'nullable|file|mimes:jpg,png',

        ]);
        $post = LandingPage::first();

        if(!$post)
        {
            $post = new LandingPage();
        }

        if($request->background_image)
        {
            $path = $request->file('background_image')->store('media', 'uploads');


        }
        if (!empty($path)) {
            $post->background_image = $path;
        }

        $post->hero_title = $request->hero_title;
        $post->hero_subtitle = $request->hero_subtitle;
        $post->hero_paragraph = $request->hero_paragraph;

        $post->save();

        return redirect(config('app.url').'/landingpage');

    }

    public function feature1Section(Request $request)
    {
        $request->validate([
            'feature1_image' => 'nullable|file|mimes:jpg,png',
        ]);
        $post = LandingPage::first();

        if(!$post)
        {
            $post = new LandingPage();
        }

        if($request->feature1_image)
        {
            $path = $request->file('feature1_image')->store('media', 'uploads');

        }
        if (!empty($path)) {
            $post->feature1_image = $path;
        }

        $post->feature1_title = $request->feature1_title;
        $post->feature1_subtitle = $request->feature1_subtitle;

        $post->feature1_one = $request->feature1_one;
        $post->feature1_one_paragraph = $request->feature1_one_paragraph;

        $post->feature1_two = $request->feature1_two;
        $post->feature1_two_paragraph = $request->feature1_two_paragraph;

        $post->feature1_three = $request->feature1_three;
        $post->feature1_three_paragraph = $request->feature1_three_paragraph;

        $post->feature1_three = $request->feature1_three;
        $post->feature1_three_paragraph = $request->feature1_three_paragraph;

        $post->feature1_four = $request->feature1_four;
        $post->feature1_four_paragraph = $request->feature1_four_paragraph;

        $post->feature1_five = $request->feature1_five;
        $post->feature1_five_paragraph = $request->feature1_five_paragraph;

        $post->feature1_six = $request->feature1_six;
        $post->feature1_six_paragraph = $request->feature1_six_paragraph;


        $post->feature1_image_title = $request->feature1_image_title;
        $post->feature1_image_subtitle = $request->feature1_image_subtitle;

        $post->save();

        return redirect(config('app.url').'/landingpage');

    }

    public function feature2Section(Request $request)
    {


        $post = LandingPage::first();

        if(!$post)
        {
            $post = new LandingPage();
        }



        $post->feature2_one = $request->feature2_one;
        $post->feature2_one_paragraph = $request->feature2_one_paragraph;

        $post->feature2_two = $request->feature2_two;
        $post->feature2_two_paragraph = $request->feature2_two_paragraph;

        $post->feature2_three = $request->feature2_three;
        $post->feature2_three_paragraph = $request->feature2_three_paragraph;

        $post->feature2_four = $request->feature2_four;
        $post->feature2_four_paragraph = $request->feature2_four_paragraph;

        $post->feature2_five = $request->feature2_five;
        $post->feature2_five_paragraph = $request->feature2_five_paragraph;

        $post->feature2_six = $request->feature2_six;
        $post->feature2_six_paragraph = $request->feature2_six_paragraph;

        $post->feature2_seven = $request->feature2_seven;
        $post->feature2_seven_paragraph = $request->feature2_seven_paragraph;

        $post->feature2_eight = $request->feature2_eight;
        $post->feature2_eight_paragraph = $request->feature2_eight_paragraph;


        $post->feature2_title = $request->feature2_title;
        $post->feature2_subtitle = $request->feature2_subtitle;

        $post->save();

        return redirect(config('app.url').'/landingpage');

    }

    public function partnerSection(Request $request)
    {


        $request->validate([


            'partners_avatar1' => 'nullable|file|mimes:jpg,png',
            'partners_avatar2' => 'nullable|file|mimes:jpg,png',
            'partners_avatar3' => 'nullable|file|mimes:jpg,png',
            'partners_avatar4' => 'nullable|file|mimes:jpg,png',
            'partners_avatar5' => 'nullable|file|mimes:jpg,png',
            'partners_avatar6' => 'nullable|file|mimes:jpg,png',
            'partners_avatar7' => 'nullable|file|mimes:jpg,png',
            'partners_avatar8' => 'nullable|file|mimes:jpg,png',

        ]);
        $post = LandingPage::first();

        if(!$post)
        {
            $post = new LandingPage();
        }



        if($request->partners_avatar2)
        {
            $path = $request->file('partners_avatar2')->store('media', 'uploads');


        }
        if (!empty($path)) {
            $post->partners_avatar2 = $path;
        }


        if($request->partners_avatar3)
        {
            $path = $request->file('partners_avatar3')->store('media', 'uploads');


        }
        if (!empty($path)) {
            $post->partners_avatar3 = $path;
        }

        if($request->partners_avatar4)
        {
            $path = $request->file('partners_avatar4')->store('media', 'uploads');

        }

        if (!empty($path)) {
            $post->partners_avatar4 = $path;
        }
        if($request->partners_avatar5)
        {
            $path = $request->file('partners_avatar5')->store('media', 'uploads');


        }
        if (!empty($path)) {
            $post->partners_avatar5 = $path;
        }

        if($request->partners_avatar6)
        {
            $path = $request->file('partners_avatar6')->store('media', 'uploads');


        }
        if (!empty($path)) {
            $post->partners_avatar6 = $path;
        }

        if($request->partners_avatar7)
        {
            $path = $request->file('partners_avatar7')->store('media', 'uploads');


        }
        if (!empty($path)) {
            $post->partners_avatar7 = $path;
        }
        if($request->partners_avatar8)
        {
            $path = $request->file('partners_avatar8')->store('media', 'uploads');


        }
        if (!empty($path)) {
            $post->partners_avatar8 = $path;
        }

        if($request->partners_avatar1)
        {
            $path = $request->file('partners_avatar1')->store('media', 'uploads');


        }
        if (!empty($path)) {
            $post->partners_avatar1 = $path;
        }

        $post->partners_title = $request->partners_title;
        $post->partners_subtitle = $request->partners_subtitle;
        $post->partners_paragraph = $request->partners_paragraph;

        $post->save();

        return redirect(config('app.url').'/landingpage');

    }


    public function story1Section(Request $request)
    {
        $request->validate([

            'story1_image' => 'nullable|file|mimes:jpg,png',
        ]);

        $post = LandingPage::first();

        if(!$post)
        {
            $post = new LandingPage();
        }

        if($request->story1_image)
        {
            $path = $request->file('story1_image')->store('media', 'uploads');

        }
        if (!empty($path)) {
            $post->story1_image = $path;
        }

        $post->story1_title = $request->story1_title;
        $post->story1_paragrapgh = $request->story1_paragrapgh;


        $post->save();

        return redirect(config('app.url').'/landingpage');

    }

    public function story2Section(Request $request)
    {
        $request->validate([

            'story2_image' => 'nullable|file|mimes:jpg,png',
        ]);

        $post = LandingPage::first();

        if(!$post)
        {
            $post = new LandingPage();
        }

        if($request->story2_image)
        {
            $path = $request->file('story2_image')->store('media', 'uploads');

        }
        if (!empty($path)) {
            $post->story2_image = $path;
        }

        $post->story2_title = $request->story2_title;
        $post->story2_paragrapgh = $request->story2_paragrapgh;
        $post->save();

        return redirect(config('app.url').'/landingpage');

    }
    public function newsletterSection(Request $request)
    {

        $post = LandingPage::first();

        if(!$post)
        {
            $post = new LandingPage();
        }

        $post->newsletter_title = $request->newsletter_title;
        $post->newsletter_paragraph = $request->newsletter_paragraph;
        $post->save();

        return redirect(config('app.url').'/landingpage');

    }

    public function numberSection(Request $request)
    {

        $post = LandingPage::first();

        if(!$post)
        {
            $post = new LandingPage();
        }

        $post->number1 = $request->number1;
        $post->number1_title = $request->number1_title;
        $post->number1_paragraph = $request->number1_paragraph;
        $post->number2 = $request->number2;
        $post->number2_title = $request->number2_title;
        $post->number2_paragraph = $request->number2_paragraph;
        $post->number3 = $request->number3;
        $post->number3_title = $request->number3_title;
        $post->number3_paragraph = $request->number3_paragraph;

        $post->save();

        return redirect(config('app.url').'/landingpage');

    }



    public function pricingPage()
    {

        $landingpage = PricingPage::first();
        $plans = SubscriptionPlan::all();

        return \view('super-admin.pricing-page-editor',[
            'selected_navigation' => 'landing-page',
            'selected_sub_navigation' => 'pricing-page-editor',

            'landingpage' => $landingpage,
            'plans' =>   $plans,

        ]);

    }


    public function pricingHeroSection(Request $request)
    {

        $post = PricingPage::first();

        if(!$post)
        {
            $post = new PricingPage();
        }

        $post->hero_title = $request->hero_title;
        $post->hero_subtitle = $request->hero_subtitle;
        $post->save();

        return redirect(config('app.url').'/pricingpage');

    }

    public function calltoactionSection(Request $request)
    {

        $post = LandingPage::first();

        if(!$post)
        {
            $post = new LandingPage();
        }

        $post->calltoaction_title = $request->calltoaction_title;

        $post->calltoaction_subtitle = $request->calltoaction_subtitle;


        $post->save();

        return redirect(config('app.url').'/landingpage');

    }
    public function privacyPage()
    {
        $privacy = PrivacyPolicy::first();

        return \view('super-admin.privacy-page-editor',[
            'selected_navigation' => 'privacy-page-editor',

            'privacy' => $privacy,

        ]);

    }
    public function termsPage()
    {
        $term = Terms::first();

        return \view('super-admin.terms-page-editor',[
            'selected_navigation' => 'terms',

            'term' => $term,

        ]);

    }

    public function savePrivacy(Request $request)
    {

        $post = PrivacyPolicy::first();

        if(!$post)
        {
            $post = new PrivacyPolicy();
        }

        $post->date = $request->date;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();

        return redirect(config('app.url').'/privacypage');

    }

    public function saveTerms(Request $request)
    {

        $post = Terms::first();

        if(!$post)
        {
            $post = new Terms();
        }

        $post->date = $request->date;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();

        return redirect(config('app.url').'/termspage');

    }


    public function footer()
    {

        $contact = ContactSection::first();

        return \view('super-admin.footer',[
            'selected_navigation' => 'footer',

            'contact' => $contact,

        ]);

    }

    public function footerSection(Request $request)
    {

        $post = ContactSection::first();
        if(!$post)
        {
            $post = new ContactSection();
        }

        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->email = $request->email;
        $post->phone_number = $request->phone_number;
        $post->address_1 = $request->address_1;
        $post->facebook = $request->facebook;
        $post->youtube = $request->youtube;
        $post->twitter = $request->twitter;
        $post->save();

        return redirect(config('app.url').'/footer');

    }
    public function cookiePage()
    {
        $term = CookiePolicy::first();

        return \view('super-admin.cookie-page-editor',[
            'selected_navigation' => 'landing-page',
            'selected_sub_navigation' => 'cookie-page-editor',
            'term' => $term,
        ]);

    }
    public function saveCookie(Request $request)
    {

        $post = CookiePolicy::first();

        if(!$post)
        {
            $post = new CookiePolicy();
        }

        $post->date = $request->date;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();

        return redirect(config('app.url').'/cookiepage');

    }





}


