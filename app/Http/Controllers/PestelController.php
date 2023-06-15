<?php

namespace App\Http\Controllers;

use App\Models\PestelAnalysis;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PestelController extends BaseController
{
    //

    public function writePestel(Request $request)
    {
        if ($this->modules && !in_array("pestle", $this->modules)) {
            abort(401);
        }

        $model = false;

        if ($request->id) {
            $model = PestelAnalysis::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        return \view("pestel.write-pest", [
            "selected_navigation" => "pestel",
            "model" => $model,
        ]);
    }

    public function pestelList()
    {
        if ($this->modules && !in_array("pestle", $this->modules)) {
            abort(401);
        }

        $models = PestelAnalysis::where(
            "workspace_id",
            $this->user->workspace_id
        )->get();

        return \view("pestel.list", [
            "selected_navigation" => "pestel",
            "models" => $models,
        ]);
    }


    public function pestelPost(Request $request)
    {
        $request->validate([
            "company_name" => "required|max:150",
            "id" => "nullable|integer",
        ]);

        $model = false;

        if ($request->id) {
            $model = PestelAnalysis::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        if (!$model) {
            $model = new PestelAnalysis();
            $model->uuid = Str::uuid();
            $model->workspace_id = $this->user->workspace_id;
        }

        $model->company_name = $request->company_name;
        $model->social = clean($request->social);
        $model->political = clean($request->political);
        $model->technological = clean($request->technological);
        $model->economic = clean($request->economic);
        $model->legal = clean($request->legal);
        $model->environmental = clean($request->environmental);
        $model->save();

        return redirect("/pestle-list");
    }


    public function viewPestel(Request $request)
    {
        if ($this->modules && !in_array("pestle", $this->modules)) {
            abort(401);
        }

        $model = false;

        if ($request->id) {
            $model = PestelAnalysis::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        return \view("pestel.view-pest", [
            "selected_navigation" => "pestel",
            "model" => $model,
        ]);
    }
}
