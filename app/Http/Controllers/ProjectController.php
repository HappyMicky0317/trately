<?php

namespace App\Http\Controllers;


use App\Models\ProjectReply;
use App\Models\Projects;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends BaseController
{
    public function projects()
    {
        if ($this->modules && !in_array("projects", $this->modules)) {
            abort(401);
        }

        $projects = Projects::where("workspace_id", $this->user->workspace_id)
        ->get();

        $users = User::all()
            ->keyBy("id")
            ->all();


        return \view("projects.projects", [
            "selected_navigation" => "projects",
            "projects" => $projects,
            "users" => $users,
        ]);
    }
    public function createProject(Request $request)
    {
        $project = false;
        $members = [];

        if ($request->id) {
            $project = Projects::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        $other_users = User::where("workspace_id", $this->user->workspace_id)
            ->get();

        if ($project && $project->members) {
            $members = json_decode($project->members, true);
        }

        return \view("projects.create-project", [
            "selected_navigation" => "projects",
            "project" => $project,
            "other_users" => $other_users,
            "members" => $members,
        ]);
    }

    public function projectView(Request $request)
    {
        if ($this->modules && !in_array("projects", $this->modules)) {
            abort(401);
        }

        $project = false;

        if ($request->id) {
            $project = Projects::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        $users = User::all()
            ->keyBy("id")
            ->all();
        $members = [];
        if ($project && $project->members) {
            $members = json_decode($project->members, true);
        }

        return \view("projects.view-project", [
            "selected_navigation" => "projects",
            "project" => $project,
            "members" => $members,
            "users" => $users,
        ]);
    }

    public function projectViewDiscussion(Request $request)
    {
        if ($this->modules && !in_array("projects", $this->modules)) {
            abort(401);
        }

        $project = false;
        if ($request->id) {
            $project = Projects::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }
        $replies = ProjectReply::where("project_id", $project->id)
            ->orderBy("id", "desc")
            ->get();
        $users = User::all()
            ->keyBy("id")
            ->all();

        $members = [];
        if ($project && $project->members) {
            $members = json_decode($project->members, true);
        }

        return \view("projects.project-discussions", [
            "selected_navigation" => "projects",
            "project" => $project,
            "replies" => $replies,
            "users" => $users,
            "members" => $members,
        ]);
    }

    public function projectPost(Request $request)
    {
        $request->validate([
            "title" => "required|max:150",
            "id" => "nullable|integer",
            "members" => "required",
        ]);

        $project = false;
        $members = [];
        if ($request->members) {
            $members = json_encode($request->members);
        }

        if ($request->id) {
            $project = Projects::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        if (!$project) {
            $project = new Projects();
            $project->uuid = Str::uuid();
            $project->workspace_id = $this->user->workspace_id;
        }

        $project->title = $request->title;

        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->summary = $request->summary;
        $project->members = $members;
        $project->status = $request->status;
        $project->message = $request->message;
        $project->description = $request->description;
        $project->save();

        return redirect("/projects");
    }

    public function projectMessagePost(Request $request)
    {
        $request->validate([
            "message" => "required|string",
            "id" => "nullable|integer",
        ]);

        $project = false;

        if ($request->id) {
            $project = Projects::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        if (!$project) {
            $project = new ProjectReply();
            $project->uuid = Str::uuid();
            $project->workspace_id = $this->user->workspace_id;
        }

        $project->project_id = $request->project_id;
        $project->admin_id = $this->user->id;
        $project->message = $request->message;

        $project->save();

        return redirect()->back();
    }
}
