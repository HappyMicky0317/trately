<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends BaseController
{
    //

    public function download($id)
    {
        $document = Document::where("workspace_id", $this->user->workspace_id)
            ->where("id", $id)
            ->first();
        if ($document) {
            $path = public_path("uploads/" . $document->path);
            $secondary_path = storage_path("app/public/" . $document->path);

            if (file_exists($path)) {
                return response()->download($path);
            } elseif (file_exists($secondary_path)) {
                return response()->download($secondary_path);
            }

            return redirect("/documents");
        }
    }
}
