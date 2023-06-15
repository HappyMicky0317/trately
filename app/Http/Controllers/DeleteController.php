<?php

namespace App\Http\Controllers;


use App\Models\Blog;
use App\Models\BrainStorm;
use App\Models\BusinessModel;
use App\Models\BusinessPlan;
use App\Models\Calendar;

use App\Models\Document;


use App\Models\Image;

use App\Models\Investor;
use App\Models\MarketingPlan;
use App\Models\MckinseyModel;
use App\Models\Note;
use App\Models\NoticeBoard;
use App\Models\PestAnalysis;
use App\Models\PestelAnalysis;
use App\Models\PorterModel;
use App\Models\Projects;

use App\Models\Report;
use App\Models\StartupCanvas;
use App\Models\SubscriptionPlan;
use App\Models\SwotAnalysis;
use App\Models\Task;

use App\Models\User;

use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteController extends BaseController
{
    //
    public function delete($action, $id)
    {
        switch ($action) {
            case "event":
                $event = Calendar::where(
                    "workspace_id",
                    $this->user->workspace_id
                )
                    ->where("id", $id)
                    ->first();
                if ($event) {
                    $event->delete();
                    return redirect("/calendar");
                }

                break;

            case "note":
                $note = Note::where("workspace_id", $this->user->workspace_id)
                    ->where("id", $id)
                    ->first();
                if ($note) {
                    $note->delete();
                    return redirect("/notes");
                }

                break;

            case "project":
                $project = Projects::where(
                    "workspace_id",
                    $this->user->workspace_id
                )
                    ->where("id", $id)
                    ->first();
                if ($project) {
                    $project->delete();
                    return redirect("/projects");
                }

                break;

            case "staff":

                if (config("app.environment") === "demo") {
                    session()->flash("error", "Deleting staff is not allowed in demo.");
                    return redirect("/staff");
                }

                $workspace = Workspace::find($this->user->workspace_id);
                $staff = User::where("workspace_id", $this->user->workspace_id)
                    ->where("id", $id)
                    ->first();

                if ($staff) {
                    if(!$workspace->owner_id && ($staff->id != $workspace->owner_id) ){
                        if ($staff->id === $this->user->id) {
                            abort(401);
                        }

                        $staff->delete();

                        return redirect("/staff");
                    }
                }

                break;

            case "document":
                $document = Document::where(
                    "workspace_id",
                    $this->user->workspace_id
                )
                    ->where("id", $id)
                    ->first();
                if ($document) {
                    if (Storage::exists("public/" . $document->path)) {
                        Storage::delete("public/" . $document->path);
                    }

                    $document->delete();

                    return redirect("/documents");
                }

                break;

            case "subscription-plan":
                $plan = SubscriptionPlan::find($id);

                if ($plan) {
                    $plan->delete();
                    return redirect("/subscription-plans");
                }

                break;

            case "business-plan":
                $plan = BusinessPlan::where(
                    "workspace_id",
                    $this->user->workspace_id
                )
                    ->where("id", $id)
                    ->first();
                if ($plan) {
                    $plan->delete();
                    return redirect("/business-plans");
                }

                break;
            case "business-model":
                $model = BusinessModel::where(
                    "workspace_id",
                    $this->user->workspace_id
                )
                    ->where("id", $id)
                    ->first();
                if ($model) {
                    $model->delete();
                    return redirect("/business-models");
                }

                break;

            case "swot":
                $model = SwotAnalysis::where(
                    "workspace_id",
                    $this->user->workspace_id
                )
                    ->where("id", $id)
                    ->first();
                if ($model) {
                    $model->delete();
                    return redirect("/swot-list");
                }

                break;
            case "pest":
                $model = PestAnalysis::where(
                    "workspace_id",
                    $this->user->workspace_id
                )
                    ->where("id", $id)
                    ->first();
                if ($model) {
                    $model->delete();
                    return redirect("/pest-list");
                }

                break;
            case "pestle":
                $model = PestelAnalysis::where(
                    "workspace_id",
                    $this->user->workspace_id
                )
                    ->where("id", $id)
                    ->first();
                if ($model) {
                    $model->delete();
                    return redirect("/pestle-list");
                }

                break;
            case "mckinsey":
                $model = MckinseyModel::where(
                    "workspace_id",
                    $this->user->workspace_id
                )
                    ->where("id", $id)
                    ->first();
                if ($model) {
                    $model->delete();
                    return redirect("/mckinsey-models");
                }

                break;

            case "porter":
                $model = PorterModel::where(
                    "workspace_id",
                    $this->user->workspace_id
                )
                    ->where("id", $id)
                    ->first();
                if ($model) {
                    $model->delete();
                    return redirect("/porter-models");
                }

                break;


            case "canvas":
                $canvas = BrainStorm::where(
                    "workspace_id",
                    $this->user->workspace_id
                )
                    ->where("id", $id)
                    ->first();
                if ($canvas) {
                    $canvas->delete();
                    return redirect("/brainstorming-list");
                }

                break;

            case "startup-canvas":
                $canvas = StartupCanvas::where(
                    "workspace_id",
                    $this->user->workspace_id
                )
                    ->where("id", $id)
                    ->first();
                if ($canvas) {
                    $canvas->delete();
                    return redirect("/startup-canvases");
                }

                break;
            case "investor":
                $investor = Investor::where(
                    "workspace_id",
                    $this->user->workspace_id
                )
                    ->where("id", $id)
                    ->first();
                if ($investor) {
                    $investor->delete();
                    return redirect("/startup-canvases");
                }

                break;

            case "task":
                $task = Task::where("workspace_id", $this->user->workspace_id)
                    ->where("id", $id)
                    ->first();
                if ($task) {
                    $task->delete();
                    return redirect("/admin/tasks/list");
                }

                break;
            case "marketing-plan":
                $plan = MarketingPlan::where("workspace_id", $this->user->workspace_id)
                    ->where("id", $id)
                    ->first();
                if ($plan) {
                    $plan->delete();
                    return redirect("/marketing-plans");
                }

                break;

            case "report":

                $plan = Report::where("workspace_id", $this->user->workspace_id)
                    ->where("id", $id)
                    ->first();

                if ($plan) {
                    $plan->delete();
                    return redirect("/reports");
                }

                break;

            case "blog":
                $blog = Blog::where("id", $id)->first();

                if ($blog) {
                    $blog->delete();
                    return redirect("/blogs");
                }

                break;
            case "notice":
                $notice = NoticeBoard::where("id", $id)->first();

                if ($notice) {
                    $notice->delete();
                    return redirect("/notice-list");
                }

                break;
        }
    }
}
