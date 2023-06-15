<?php

namespace App\Http\Controllers;

use App\Models\PestAnalysis;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PestController extends BaseController
{
    //

    public function writePest(Request $request)
    {
        if ($this->modules && !in_array("pest", $this->modules)) {
            abort(401);
        }

        $model = false;

        if ($request->id) {
            $model = PestAnalysis::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        return \view("pest.write-pest", [
            "selected_navigation" => "pest",
            "model" => $model,
        ]);
    }

    public function pestList()
    {
        if ($this->modules && !in_array("pest", $this->modules)) {
            abort(401);
        }

        $models = PestAnalysis::where(
            "workspace_id",
            $this->user->workspace_id
        )->get();

        return \view("pest.list", [
            "selected_navigation" => "pest",
            "models" => $models,
        ]);
    }


    public function pestPost(Request $request)
    {
        $request->validate([
            "company_name" => "required|max:150",
            "id" => "nullable|integer",
        ]);

        $model = false;

        if ($request->id) {
            $model = PestAnalysis::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        if (!$model) {
            $model = new PestAnalysis();
            $model->uuid = Str::uuid();
            $model->workspace_id = $this->user->workspace_id;
        }


        $model->company_name = $request->company_name;
        $model->social = clean($request->social);
        $model->political = clean($request->political);
        $model->technological = clean($request->technological);
        $model->economic = clean($request->economic);

        $model->save();

        return redirect("/pest-list");
    }


    public function viewPest(Request $request)
    {
        if ($this->modules && !in_array("pest", $this->modules)) {
            abort(401);
        }

        $model = false;

        if ($request->id) {
            $model = PestAnalysis::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        return \view("pest.view-pest", [
            "selected_navigation" => "pest",
            "model" => $model,
        ]);
    }
}
