<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Note;
use App\Models\Projects;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ActionsController extends BaseController
{
    public function notes()
    {
        if ($this->modules && !in_array("notes", $this->modules)) {
            abort(401);
        }

        $notes = Note::where("workspace_id", $this->user->workspace_id)->get();

        return \view("actions.notes", [
            "selected_navigation" => "notes",
            "notes" => $notes,
        ]);
    }

    public function addNote(Request $request)
    {
        if ($this->modules && !in_array("notes", $this->modules)) {
            abort(401);
        }

        $note = false;

        if ($request->id) {
            $note = Note::where("workspace_id", $this->user->workspace_id)
                ->where("id", $request->id)
                ->first();
        }

        return \view("actions.add-note", [
            "selected_navigation" => "notes",
            "note" => $note,
        ]);
    }

    public function viewNote(Request $request)
    {
        if ($this->modules && !in_array("notes", $this->modules)) {
            abort(401);
        }

        $note = false;
        $users = User::all()
            ->keyBy("id")
            ->all();

        if ($request->id) {
            $note = Note::where("workspace_id", $this->user->workspace_id)
                ->where("id", $request->id)
                ->first();
        }

        return \view("actions.view-note", [
            "selected_navigation" => "notes",
            "note" => $note,
            "users" => $users,
        ]);
    }

    public function notePost(Request $request)
    {
        if ($this->modules && !in_array("notes", $this->modules)) {
            abort(401);
        }
        $request->validate([
            "title" => "required|max:150",
            "id" => "nullable|integer",
            "topic" => "required|string",
            "cover_photo" => "nullable|file|mimes:jpeg,png,jpg,gif,svg",
        ]);

        $note = false;

        if ($request->id) {
            $note = Note::where("workspace_id", $this->user->workspace_id)
                ->where("id", $request->id)
                ->first();
        }

        if (!$note) {
            $note = new Note();
            $note->uuid = Str::uuid();
            $note->workspace_id = $this->user->workspace_id;
        }
        $cover_path = null;

        if ($request->cover_photo) {
            $cover_path = $request
                ->file("cover_photo")
                ->store("media", "uploads");
        }

        if (!empty($cover_path)) {
            $note->cover_photo = $cover_path;
        }

        $note->title = $request->title;
        $note->topic = $request->topic;
        $note->admin_id = $this->user->id;
        $note->notes = $request->notes;
        $note->save();

        return redirect("/notes");
    }
}
