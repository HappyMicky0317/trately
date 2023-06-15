<?php

namespace App\Http\Controllers;

use App\Models\SwotAnalysis;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class SwotController extends BaseController
{
    public function writeSwot(Request $request)
    {
        if ($this->modules && !in_array("swot", $this->modules)) {
            abort(401);
        }

        $model = false;

        if ($request->id) {
            $model = SwotAnalysis::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        return \view("swot.write-swot", [
            "selected_navigation" => "swot",
            "model" => $model,
        ]);
    }

    public function swotList()
    {
        if ($this->modules && !in_array("swot", $this->modules)) {
            abort(401);
        }

        $models = SwotAnalysis::where(
            "workspace_id",
            $this->user->workspace_id
        )->get();

        return \view("swot.list", [
            "selected_navigation" => "swot",
            "models" => $models,
        ]);
    }

    public function swotPost(Request $request)
    {
        $request->validate([
            "company_name" => "required|max:150",
            "id" => "nullable|integer",
        ]);

        $model = false;

        if ($request->id) {
            $model = SwotAnalysis::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        if (!$model) {
            $model = new SwotAnalysis();
            $model->uuid = Str::uuid();
            $model->workspace_id = $this->user->workspace_id;
        }

        $model->weaknesses = clean($request->weaknesses);
        $model->company_name = $request->company_name;
        $model->threats = clean($request->threats);
        $model->strengths = clean($request->strengths);
        $model->opportunities = clean($request->opportunities);

        $model->save();

        return redirect("/swot-list");
    }

    public function viewSwot(Request $request)
    {
        if ($this->modules && !in_array("swot", $this->modules)) {
            abort(401);
        }

        $model = false;

        if ($request->id) {
            $model = SwotAnalysis::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        return \view("swot.view-swot", [
            "selected_navigation" => "swot",
            "model" => $model,
        ]);
    }
}
