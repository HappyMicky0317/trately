<?php

namespace App\Http\Controllers;

use App\Models\MckinseyModel;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MckinseyController extends BaseController
{
    //
    public function NewMckinseyModels(Request $request)
    {
        if ($this->modules && !in_array("mckinsey", $this->modules)) {
            abort(401);
        }

        $model = false;

        if ($request->id) {
            $model = MckinseyModel::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        return \view("mckinsey.new", [
            "selected_navigation" => "mckinsey",
            "model" => $model,
        ]);
    }
    public function mckinseyModels()
    {
        if ($this->modules && !in_array("mckinsey", $this->modules)) {
            abort(401);
        }

        $models = MckinseyModel::where(
            "workspace_id",
            $this->user->workspace_id
        )->get();

        return \view("mckinsey.list", [
            "selected_navigation" => "mckinsey",
            "models" => $models,
        ]);
    }
    public function MckinseyModelPost(Request $request)
    {
        $request->validate([
            "company_name" => "required|max:150",
            "id" => "nullable|integer",
        ]);

        $model = false;

        if ($request->id) {
            $model = MckinseyModel::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        if (!$model) {
            $model = new MckinseyModel();
            $model->uuid = Str::uuid();
            $model->workspace_id = $this->user->workspace_id;
        }

        $model->company_name = $request->company_name;
        $model->structure = clean($request->structure);
        $model->strategy = clean($request->strategy);
        $model->system = clean($request->system);
        $model->shared_values = clean($request->shared_values);
        $model->skill = clean($request->skill);
        $model->style = clean($request->style);
        $model->staff = clean($request->staff);
        $model->save();

        return redirect("/mckinsey-models");
    }

    public function ViewMckinseyModel(Request $request)
    {
        if ($this->modules && !in_array("mckinsey", $this->modules)) {
            abort(401);
        }

        $model = false;

        if ($request->id) {
            $model = MckinseyModel::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        return \view("mckinsey.view", [
            "selected_navigation" => "mckinsey",
            "model" => $model,
        ]);
    }
}
