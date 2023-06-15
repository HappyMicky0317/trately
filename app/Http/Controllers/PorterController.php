<?php

namespace App\Http\Controllers;

use App\Models\PestelAnalysis;
use App\Models\PorterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PorterController extends BaseController
{
    //
    public function newPorter(Request $request)
    {
        if ($this->modules && !in_array("porter", $this->modules)) {
            abort(401);
        }

        $model = false;

        if ($request->id) {
            $model = PorterModel::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        return \view("porter.new", [
            "selected_navigation" => "porter",
            "model" => $model,
        ]);
    }
    public function porterList()
    {
        if ($this->modules && !in_array("porter", $this->modules)) {
            abort(401);
        }

        $models = PorterModel::where(
            "workspace_id",
            $this->user->workspace_id
        )->get();

        return \view("porter.list", [
            "selected_navigation" => "porter",
            "models" => $models,
        ]);
    }
    public function porterPost(Request $request)
    {
        $request->validate([
            "company_name" => "required|max:150",
            "id" => "nullable|integer",
        ]);

        $model = false;

        if ($request->id) {
            $model = PorterModel::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        if (!$model) {
            $model = new PorterModel();
            $model->uuid = Str::uuid();
            $model->workspace_id = $this->user->workspace_id;
        }

        $model->company_name = $request->company_name;
        $model->rivals = clean($request->rivals);
        $model->entrants = clean($request->entrants);
        $model->suppliers = clean($request->suppliers);
        $model->customers = clean($request->customers);
        $model->substitute = clean($request->substitute);

        $model->save();

        return redirect("/porter-models");
    }
    public function viewPorter(Request $request)
    {
        if ($this->modules && !in_array("porter", $this->modules)) {
            abort(401);
        }

        $model = false;

        if ($request->id) {
            $model = PorterModel::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        return \view("porter.view", [
            "selected_navigation" => "porter",
            "model" => $model,
        ]);
    }
}
