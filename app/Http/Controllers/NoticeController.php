<?php

namespace App\Http\Controllers;

use App\Models\NoticeBoard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NoticeController extends BaseController
{
    //
    public function noticeList()
    {
        $notices = NoticeBoard::where("workspace_id", $this->user->workspace_id)->get();

        return \view("notice.list", [
            "selected_navigation" => "notice",
            "notices" => $notices,
        ]);
    }

    public function writeNotice(Request $request)
    {
        $notice = false;

        if ($request->id) {
            $notice = NoticeBoard::where("workspace_id", $this->user->workspace_id)
                ->where("id", $request->id)
                ->first();
        }

        return \view("notice.new", [
            "selected_navigation" => "notice",
            "notice" => $notice,
        ]);
    }

//    public function viewBlog(Request $request)
//    {
//        $notice = false;
//        $users = User::all()
//            ->keyBy("id")
//            ->all();
//
//        if ($request->id) {
//            $notice = NoticeBoard::where("workspace_id", $this->user->workspace_id)
//                ->where("id", $request->id)
//                ->first();
//        }
//
//        return \view("blog.view-blog", [
//            "selected_navigation" => "blogs",
//            "blog" => $notice,
//            "users" => $users,
//        ]);
//    }

    public function noticePost(Request $request)
    {
        $request->validate([
            "title" => "required|max:150",
            "id" => "nullable|integer",

            "cover_photo" => "nullable|file",
        ]);

        $notice = false;

        if ($request->id) {
            $notice = NoticeBoard::where("workspace_id", $this->user->workspace_id)
                ->where("id", $request->id)
                ->first();
        }

        if (!$notice) {
            $notice = new NoticeBoard();
            $notice->uuid = Str::uuid();
            $notice->workspace_id = $this->user->workspace_id;
        }
        $cover_path = null;

        if ($request->cover_photo) {
            $cover_path = $request
                ->file("cover_photo")
                ->store("media", "uploads");
        }

        if (!empty($cover_path)) {
            $notice->cover_photo = $cover_path;
        }

        $notice->title = $request->title;
        $notice->status = $request->status;
        $notice->topic = $request->topic;
        $notice->slug = $request->slug;
        $notice->admin_id = $this->user->id;
        $notice->notes = clean($request->notes);
        $notice->save();

        return redirect("/notice-list");
    }
}
