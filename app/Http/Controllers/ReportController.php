<?php

namespace App\Http\Controllers;

use App\Models\PorterModel;
use App\Models\Projects;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReportController extends BaseController
{
    //
    public function newReport(Request $request)
    {
        if ($this->modules && !in_array("porter", $this->modules)) {
            abort(401);
        }

        $model = false;

        if ($request->id) {
            $model = Report::where(
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

        return \view("reports.new", [
            "selected_navigation" => "report",
            "model" => $model,
            "products" => $products,
            "users" => $users,
        ]);
    }
    public function reportList()
    {
        if ($this->modules && !in_array("porter", $this->modules)) {
            abort(401);
        }

        $models = Report::where(
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

        return \view("reports.list", [
            "selected_navigation" => "report",
            "models" => $models,
            "products" => $products,
            "users" => $users,
        ]);
    }

    public function reportPost(Request $request)
    {
        $request->validate([
            "name" => "required",
            "id" => "nullable|integer",
        ]);

        $model = false;

        if ($request->id) {
            $model = Report::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        if (!$model) {
            $model = new Report();
            $model->uuid = Str::uuid();
            $model->workspace_id = $this->user->workspace_id;
        }

        $model->name = $request->name;
        $model->product_id = $request->product_id;
        $model->status = $request->status;
        $model->uncertainty_level = $request->uncertainty_level;
        $model->feasibility_level = $request->feasibility_level;
        $model->executive_summary = clean($request->executive_summary);
        $model->administrative_analysis = clean($request->administrative_analysis);
        $model->technical_analysis = clean($request->technical_analysis);
        $model->financial_analysis = clean($request->financial_analysis);
        $model->improvement_activities = clean($request->improvement_activities);
        $model->recommendations = clean($request->recommendations);
        $model->save();

        return redirect("/reports");
    }
    public function viewReport(Request $request)
    {
        if ($this->modules && !in_array("porter", $this->modules)) {
            abort(401);
        }

        $model = false;

        if ($request->id) {
            $model = Report::where(
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

        return \view("reports.view", [
            "selected_navigation" => "report",
            "model" => $model,
            "products" => $products,
            "users" => $users,
        ]);
    }
}

