<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DocumentController extends BaseController
{
    //

    public function documents()
    {
        if ($this->modules && !in_array("documents", $this->modules)) {
            abort(401);
        }

        $documents = Document::where(
            "workspace_id",
            $this->user->workspace_id
        )->get();

        return \view("documents", [
            "selected_navigation" => "documents",
            "documents" => $documents,
        ]);
    }

    public function documentPost(Request $request)
    {
        if ($this->modules && !in_array("documents", $this->modules)) {
            abort(401);
        }

        if (config("app.environment") === "demo") {
            return;
        }
        $max_file_upload_size = 1024 * 1024 * 10;
        if(!$this->user->super_admin){
            if(!$this->plan)
            {
                return \redirect()->back()->with("error", __('You need to choose a plan to upload documents.'));
            }

            $max_file_upload_size = $this->plan->max_file_upload_size ?? 2000;
            $file_space_limit = $this->plan->file_space_limit ?? 0;
            $file_space_limit = $file_space_limit * 1000000; # convert to bytes

            $total_space_consumed = Document::where(
                "workspace_id",
                $this->user->workspace_id
            )->sum("size");

            if($total_space_consumed + $request->file("file")->getSize() > $file_space_limit)
            {
                return \redirect()->back()->with("error", __('You have exceeded the file space limit.'));
            }
        }



        $request->validate([
            "file" => "required|mimes:jpeg,bmp,png,gif,svg,pdf|max:$max_file_upload_size",
        ]);
        $path = false;
        if ($request->file) {
            $path = $request->file("file")->store("media", "uploads");
        }

        $document = new Document();
        $document->uuid = Str::uuid();
        $document->workspace_id = $this->user->workspace_id;
        $document->name = $path;
        $document->path = $path;
        $document->name = $request->file("file")->getClientOriginalName();
        $document->size = $request->file("file")->getSize();
        $document->save();
    }
}
