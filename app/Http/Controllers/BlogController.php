<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends BaseController
{
    public function blogs()
    {
        $blogs = Blog::where("workspace_id", $this->user->workspace_id)->get();

        return \view("blog.blogs", [
            "selected_navigation" => "blogs",
            "blogs" => $blogs,
        ]);
    }

    public function writeBlog(Request $request)
    {
        $blog = false;

        if ($request->id) {
            $blog = Blog::where("workspace_id", $this->user->workspace_id)
                ->where("id", $request->id)
                ->first();
        }

        return \view("blog.write-blog", [
            "selected_navigation" => "blogs",
            "blog" => $blog,
        ]);
    }

    public function viewBlog(Request $request)
    {
        $blog = false;
        $users = User::all()
            ->keyBy("id")
            ->all();

        if ($request->id) {
            $blog = Blog::where("workspace_id", $this->user->workspace_id)
                ->where("id", $request->id)
                ->first();
        }

        return \view("blog.view-blog", [
            "selected_navigation" => "blogs",
            "blog" => $blog,
            "users" => $users,
        ]);
    }

    public function blogPost(Request $request)
    {
        $request->validate([
            "title" => "required|max:150",
            "id" => "nullable|integer",
            "topic" => "required|string",
            "cover_photo" => "nullable|file|mimes:jpeg,png,jpg,gif,svg",
        ]);

        $blog = false;

        if ($request->id) {
            $blog = Blog::where("workspace_id", $this->user->workspace_id)
                ->where("id", $request->id)
                ->first();
        }

        if (!$blog) {
            $blog = new Blog();
            $blog->uuid = Str::uuid();
            $blog->workspace_id = $this->user->workspace_id;
        }
        $cover_path = null;

        if ($request->cover_photo) {
            $cover_path = $request
                ->file("cover_photo")
                ->store("media", "uploads");
        }

        if (!empty($cover_path)) {
            $blog->cover_photo = $cover_path;
        }

        $blog->title = $request->title;
        $blog->topic = $request->topic;
        $blog->slug = $request->slug;
        $blog->admin_id = $this->user->id;
        $blog->notes = clean($request->notes);
        $blog->save();

        return redirect("/blogs");
    }
}
