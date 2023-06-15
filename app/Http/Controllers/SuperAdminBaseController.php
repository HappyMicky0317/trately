<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\SubscriptionPlan;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class SuperAdminBaseController extends Controller
{
    protected $settings;
    protected $user;
    protected $workspace;
    protected $modules;
    public function __construct()
    {
        parent::__construct();
        $this->middleware("auth");

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            $this->workspace = Workspace::find($this->user->workspace_id);

            $settings_data = Setting::where(
                "workspace_id",
                $this->user->workspace_id
            )->get();
            $settings = [];

            foreach ($settings_data as $setting) {
                $settings[$setting->key] = $setting->value;
            }
            $this->settings = $settings;
            View::share("settings", $settings);
            View::share("user", $this->user);
            View::share("workspace", $this->workspace);

            $this->modules = null;

            if ($this->workspace->plan_id) {
                $plan = SubscriptionPlan::find($this->workspace->plan_id);
                if ($plan && $plan->modules) {
                    $this->modules = json_decode($plan->modules);
                }
            }

            View::share("modules", $this->modules);

            if (!$this->user || !$this->user->super_admin) {
                header("location: " . config("app.url") . "/super-admin/");
                exit();
            }

            $language = $this->user->language ?? "en";
            \App::setLocale($language);

            return $next($request);
        });
    }
}
