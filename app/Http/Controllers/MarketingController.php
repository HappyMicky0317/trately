<?php

namespace App\Http\Controllers;

use App\Models\MarketingPlan;
use App\Models\Projects;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MarketingController extends BaseController
{
    //

    public function writeMarketingPlan(Request $request)
    {
        if ($this->modules && !in_array("marketing_plan", $this->modules)) {
            abort(401);
        }

        $model = false;

        if ($request->id) {
            $model = MarketingPlan::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }
        $products = Projects::where("workspace_id", $this->user->workspace_id)
            ->get()
            ->keyBy("id")
            ->all();
        $users = User::all()
            ->keyBy("id")
            ->all();


        return \view("marketing.add", [
            "selected_navigation" => "marketing-plans",
            "model" => $model,
            "products" => $products,
            "users" => $users,
        ]);
    }

    public function marketingPlans()
    {
        if ($this->modules && !in_array("marketing_plan", $this->modules)) {
            abort(401);
        }

        $models = MarketingPlan::where(
            "workspace_id",
            $this->user->workspace_id
        )->get();
        $products = Projects::where("workspace_id", $this->user->workspace_id)
            ->get()
            ->keyBy("id")
            ->all();
        $users = User::all()
            ->keyBy("id")
            ->all();

        return \view("marketing.list", [
            "selected_navigation" => "marketing-plans",
            "models" => $models,
            "products" => $products,
            "users" => $users,
        ]);
    }


    public function marketingPlanPost(Request $request)
    {
        $request->validate([
            "company_name" => "required|max:150",
            "id" => "nullable|integer",
        ]);

        $model = false;

        if ($request->id) {
            $model = MarketingPlan::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        if (!$model) {
            $model = new MarketingPlan();
            $model->uuid = Str::uuid();
            $model->workspace_id = $this->user->workspace_id;
        }


        $model->company_name = $request->company_name;
        $model->product_id = $request->product_id;
        $model->summary = clean($request->summary);
        $model->description = clean($request->description);
        $model->business_initiatives = clean($request->business_initiatives);
        $model->team = clean($request->team);
        $model->target_market = clean($request->target_market);
        $model->budget = clean($request->budget);
        $model->marketing_channels = clean($request->marketing_channels);
        $model->save();

        return redirect("/marketing-plans");
    }


    public function viewMarketingPlan(Request $request)
    {
        if ($this->modules && !in_array("notes", $this->modules)) {
            abort(401);
        }

        $model = false;
        $users = User::all()
            ->keyBy("id")
            ->all();

        if ($request->id) {
            $model = MarketingPlan::where("workspace_id", $this->user->workspace_id)
                ->where("id", $request->id)
                ->first();
        }

        return \view("marketing.view", [
            "selected_navigation" => "marketing-plans",
            "model" => $model,
            "users" => $users,
        ]);
    }
}
