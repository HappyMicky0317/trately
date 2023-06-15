<?php

namespace App\Http\Controllers;

use App\Models\BrainStorm;
use App\Models\BusinessModel;
use App\Models\BusinessPlan;
use App\Models\Calendar;
use App\Models\Goal;
use App\Models\GoalPlan;
use App\Models\Projects;
use App\Models\Setting;

use App\Models\StartupCanvas;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PlansController extends BaseController
{
    public function calendarAction(Request $request, $action = "")
    {
        if ($this->modules && !in_array("calendar", $this->modules)) {
            abort(401);
        }

        switch ($action) {
            case "":
                $events = Calendar::where(
                    "workspace_id",
                    $this->user->workspace_id
                )->get();

                return \view("plans.calendar", [
                    "selected_navigation" => "calendar",
                    "events" => $events,
                ]);
                break;

            case "event":
                $request->validate([
                    "id" => "nullable|integer",
                ]);

                $event = false;

                if ($request->id) {
                    $event = Calendar::where(
                        "workspace_id",
                        $this->user->workspace_id
                    )
                        ->where("id", $request->id)
                        ->first();
                }

                if ($event) {
                    $date = $event->start_date;
                } else {
                    $date = $request->date ?? date("Y-m-d");
                }

                return \view("plans.event", [
                    "selected_navigation" => "calendar",
                    "event" => $event,
                    "date" => $date,
                ]);
                break;
        }
    }

    public function eventPost(Request $request)
    {
        if ($this->modules && !in_array("calendar", $this->modules)) {
            abort(401);
        }
        $request->validate([
            "title" => "required|max:150",
            "id" => "nullable|integer",
        ]);

        $event = false;

        if ($request->id) {
            $event = Calendar::where("workspace_id", $this->user->workspace_id)
                ->where("id", $request->id)
                ->first();
        }

        if (!$event) {
            $event = new Calendar();
            $event->uuid = Str::uuid();
            $event->workspace_id = $this->user->workspace_id;
        }

        $event->title = $request->title;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->description = $request->description;
        $event->save();

        return redirect("/calendar");
    }

    public function businessPlans()
    {
        if ($this->modules && !in_array("business_plan", $this->modules)) {
            abort(401);
        }

        $plans = BusinessPlan::where(
            "workspace_id",
            $this->user->workspace_id
        )->get();

        return \view("plans.business-plans", [
            "selected_navigation" => "business-plans",
            "plans" => $plans,
        ]);
    }

    public function writeBusinessPlans(Request $request)
    {
        if ($this->modules && !in_array("business_plan", $this->modules)) {
            abort(401);
        }

        $plan = false;
        if ($request->id) {
            $plan = BusinessPlan::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        return \view("plans.write-business-plan", [
            "selected_navigation" => "business-plans",
            "plan" => $plan,
        ]);
    }

    public function viewBusinessPlan(Request $request)
    {
        if ($this->modules && !in_array("business_plan", $this->modules)) {
            abort(401);
        }

        $plan = false;

        if ($request->id) {
            $plan = BusinessPlan::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        return \view("plans.view-business-plan", [
            "selected_navigation" => "business-plans",
            "plan" => $plan,
        ]);
    }

    public function businessPlanPost(Request $request)
    {
        $request->validate([
            "company_name" => "required|max:150",
            "name" => "required|max:150",
            "id" => "nullable|integer",
            "logo" => "nullable|file|mimes:jpg,png",
            "file" => "nullable|file|mimes:jpg,pdf,png,jpeg,doc,docx",

        ]);

        $plan = false;

        if ($request->id) {
            $plan = BusinessPlan::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        if (!$plan) {
            $plan = new BusinessPlan();
            $plan->uuid = Str::uuid();
            $plan->workspace_id = $this->user->workspace_id;
        }

        $plan->name = $request->name;
        $path = null;
        if ($request->logo) {
            $path = $request->file("logo")->store("media", "uploads");

        }
        if (!empty($path)) {
            $plan->logo = $path;
        }
        $file_path = null;
        if ($request->file) {
            $file_path = $request->file("file")->store("media", "uploads");

        }
        if (!empty($file_path)) {
            $plan->file = $file_path;
        }
        $plan->date = $request->date;
        $plan->email = $request->email;
        $plan->phone = $request->phone;
        $plan->website = $request->website;
        $plan->company_name = $request->company_name;
        $plan->ex_summary = clean($request->ex_summary);
        $plan->description = clean($request->description);
        $plan->m_analysis = clean($request->m_analysis);
        $plan->management = clean($request->management);
        $plan->product = clean($request->product);
        $plan->marketing = clean($request->marketing);
        $plan->budget = $request->budget;
        $plan->investment = clean($request->investment);
        $plan->finance = clean($request->finance);
        $plan->appendix = clean($request->appendix);
        $plan->save();

        return redirect("/business-plans");
    }

    public function businessModel(Request $request)
    {
        if ($this->modules && !in_array("business_model", $this->modules)) {
            abort(401);
        }

        $model = false;

        if ($request->id) {
            $model = BusinessModel::where(
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

        return \view("business-model.design-business-model", [
            "selected_navigation" => "business-models",
            "model" => $model,
            "products" => $products,
            "users" => $users,
        ]);
    }

    public function businessModels(Request $request)
    {
        if ($this->modules && !in_array("business_model", $this->modules)) {
            abort(401);
        }
        $request->validate([
            "company_name" => "nullable|string",
            "product_id" => "nullable|integer",

        ]);

        $models = BusinessModel::where(
            "workspace_id",
            $this->user->workspace_id
        );

        if ($request->company_name) {
            $models =  $models->where("company_name", "like", "%{$request->company_name}%");
        }
        if ($request->product_id) {
            $models =   $models->where("product_id","like", "%{$request->product_id}%");
        }


//        $models = BusinessModel::where(
//            "workspace_id",
//            $this->user->workspace_id
//        )->get();

        $models = $models->orderBy("id", "desc")->paginate(10);

        $products = Projects::where("workspace_id", $this->user->workspace_id)
            ->get()
            ->keyBy("id")
            ->all();
        $users = User::all()
            ->keyBy("id")
            ->all();




        return \view("business-model.business-models", [
            "selected_navigation" => "business-models",
            "models" => $models,
            "products" => $products,
            "users" => $users,
        ]);
    }

    public function businessModelPost(Request $request)
    {
        $request->validate([
            "company_name" => "required|max:150",
            "id" => "nullable|integer",
        ]);

        $model = false;

        if ($request->id) {
            $model = BusinessModel::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        if (!$model) {
            $model = new BusinessModel();
            $model->uuid = Str::uuid();
            $model->workspace_id = $this->user->workspace_id;
        }

        $model->email = $request->email;
        $model->company_name = $request->company_name;
        $model->partners = clean($request->partners);
        $model->activities = clean($request->activities);
        $model->resources = clean($request->resources);
        $model->product_id = $request->product_id;
        $model->admin_id = $this->user->id;
        $model->value_propositions = clean($request->value_propositions);
        $model->customer_relationships = clean(
            $request->customer_relationships
        );
        $model->channels = clean($request->channels);
        $model->customer_segments = clean($request->customer_segments);
        $model->cost_structure = clean($request->cost_structure);
        $model->revenue_stream = clean($request->revenue_stream);
        $model->save();

        return redirect("/design-business-model?id=" . $model->id);
    }

    public function viewBusinessModel(Request $request)
    {
        if ($this->modules && !in_array("business_model", $this->modules)) {
            abort(401);
        }

        $model = false;

        if ($request->id) {
            $model = BusinessModel::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        return \view("business-model.view-model", [
            "selected_navigation" => "business-models",
            "model" => $model,
        ]);
    }

    public function startupCanvas(Request $request)
    {
        if ($this->modules && !in_array("startup_canvas", $this->modules)) {
            abort(401);
        }

        $model = false;

        if ($request->id) {
            $model = StartupCanvas::where(
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



        return \view("startup-canvas.design-business-model", [
            "selected_navigation" => "startup-canvas",
            "model" => $model,
            "products" => $products,
            "users" => $users,
        ]);
    }

    public function startupCanvases(Request $request)
    {
        if ($this->modules && !in_array("startup_canvas", $this->modules)) {
            abort(401);
        }

        $request->validate([
            "company_name" => "nullable|string",
            "product_id" => "nullable|integer",

        ]);

        $models = StartupCanvas::where(
            "workspace_id",
            $this->user->workspace_id
        );

        if ($request->company_name) {
            $models =  $models->where("company_name", "like", "%{$request->company_name}%");
        }
        if ($request->product_id) {
            $models =   $models->where("product_id","like", "%{$request->product_id}%");
        }
        $models = $models->orderBy("id", "desc")->paginate(10);

        $products = Projects::where("workspace_id", $this->user->workspace_id)
            ->get()
            ->keyBy("id")
            ->all();
        $users = User::all()
            ->keyBy("id")
            ->all();

        return \view("startup-canvas.business-models", [
            "selected_navigation" => "startup-canvas",
            "models" => $models,
            "products" => $products,
            "users" => $users,
        ]);
    }

    public function viewStartupCanvas(Request $request)
    {
        if ($this->modules && !in_array("startup_canvas", $this->modules)) {
            abort(401);
        }

        $model = false;

        if ($request->id) {
            $model = StartupCanvas::where(
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


        return \view("startup-canvas.view-model", [
            "selected_navigation" => "startup-canvas",
            "model" => $model,
            "products" => $products,
            "users" => $users,
        ]);
    }


    public function startupCanvasPost(Request $request)
    {
        if ($this->modules && !in_array("startup_canvas", $this->modules)) {
            abort(401);
        }
        $request->validate([
            "company_name" => "required|max:150",
            "id" => "nullable|integer",
        ]);

        $model = false;

        if ($request->id) {
            $model = StartupCanvas::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        if (!$model) {
            $model = new StartupCanvas();
            $model->uuid = Str::uuid();
            $model->workspace_id = $this->user->workspace_id;
        }

        $model->email = $request->email;
        $model->product_id = $request->product_id;
        $model->admin_id = $this->user->id;

        $model->company_name = $request->company_name;
        $model->market = clean($request->market);
        $model->value_propositions = clean($request->value_propositions);
        $model->unfair_advantage = clean(
            $request->unfair_advantage
        );
        $model->channels = clean($request->channels);
        $model->problems = clean($request->problems);
        $model->solutions = clean($request->solutions);
        $model->key_matrices = clean($request->key_matrices);
        $model->customer_segments = clean($request->customer_segments);
        $model->cost_structure = clean($request->cost_structure);

        $model->revenue_stream = clean($request->revenue_stream);
        $model->save();

        return redirect("/startup-canvases");
    }

    public function brainStorm(Request $request)
    {
        if ($this->modules && !in_array("brainstorm", $this->modules)) {
            abort(401);
        }

        $canvas = false;

        if ($request->id) {
            $canvas = BrainStorm::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        return \view("plans.brainstorm", [
            "selected_navigation" => "brainstorm",
            "canvas" => $canvas,
        ]);
    }
    public function brainStormList(Request $request)
    {
        if ($this->modules && !in_array("brainstorm", $this->modules)) {
            abort(401);
        }

        $users = User::all()
            ->keyBy("id")
            ->all();




        $canvases = BrainStorm::where(
            "workspace_id",
            $this->user->workspace_id
        )->get();



        return \view("plans.brainstorm-list", [
            "selected_navigation" => "brainstorm",
            "canvases" => $canvases,
            "users" => $users,
        ]);
    }



    public function saveCanvas(Request $request)
    {
        if ($this->modules && !in_array("brainstorm", $this->modules)) {
            abort(401);
        }
        $request->validate([
            "title" => "required|max:150",
            "id" => "nullable|integer",
        ]);

        $canvas = false;

        if ($request->id) {
            $canvas = BrainStorm::where("workspace_id", $this->user->workspace_id)
                ->where("id", $request->id)
                ->first();
        }

        if (! $canvas) {
            $uuid = Str::uuid();
            $canvas = new BrainStorm();
            $canvas->uuid = $uuid;
            $canvas->workspace_id = $this->user->workspace_id;
        }
        else{
            $uuid = $canvas->uuid;
        }
//        $cover_path = null;
//
//        if ($request->cover_photo) {
//            $cover_path = $request
//                ->file("cover_photo")
//                ->store("media", "uploads");
//        }
//
//        if (!empty($cover_path)) {
//            $note->cover_photo = $cover_path;
//        }

        ray($request->input('image'));

        if($request->input('image'))
        {
            try{
                $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->input('image')));
                file_put_contents(public_path() . "/uploads/brainstorming/$uuid.png",$data);
            }catch (\Exception $e)
            {
                ray($e->getMessage());
            }
        }


        $canvas->title = $request->title;
        $canvas->admin_id = $this->user->id;
        $canvas->src = $request->src;
        $canvas->save();

        return [
            'url' => '/brainstorming?id='.$canvas->id,
        ];
    }
}
