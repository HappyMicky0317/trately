<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends BaseController
{
    public function profile(Request $request)
    {
        $available_languages = User::$available_languages;

        return \view("profile.profile", [
            "selected_navigation" => "profile",
            "available_languages" => $available_languages,
        ]);
    }

    public function profilePost(Request $request)
    {
        $request->validate([
            "first_name" => "nullable|string|max:100",
            "last_name" => "nullable|string|max:100",
            "photo" => "nullable|file|mimes:jpg,png",
            "cover_photo" => "nullable|file|mimes:jpeg,png,jpg,gif,svg",
        ]);

        $user = $this->user;

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->language = $request->language;
        $path = null;
        if ($request->photo) {
            $path = $request->file("photo")->store("media", "uploads");

        }
        if (!empty($path)) {
            $user->photo = $path;
        }



        $cover_path = null;

        if ($request->cover_photo) {
            $cover_path = $request
                ->file("cover_photo")
                ->store("media", "uploads");
        }

        if (!empty($cover_path)) {
            $user->cover_photo = $cover_path;
        }

        $user->phone_number = $request->phone_number;

        if($request->timezone)
        {
            $user->timezone = $request->timezone;
            $user->save();
        }
        $user->save();

        if ($this->user->super_admin) {
            return redirect("/super-admin-profile");
        }

        return redirect("/profile");
    }

    public function staff()
    {
        $staffs = User::where("workspace_id", $this->user->workspace_id)->get();
        $workspace = Workspace::find($this->user->workspace_id);

        $maximum_allowed_users = Workspace::getMaximumAllowedUsers($this->workspace);
        $users_count_on_this_workspace = Workspace::usersCount($this->workspace->id);
        $plan = Workspace::getPlan($this->workspace);

        return \view("profile.staff", [
            "selected_navigation" => "team",
            "staffs" => $staffs,
            'workspace' => $workspace,
            'plan' => $plan,
            'maximum_allowed_users' => $maximum_allowed_users,
            'users_count_on_this_workspace' => $users_count_on_this_workspace,
        ]);
    }

    public function newUser(Request $request)
    {

        $maximum_allowed_users = Workspace::getMaximumAllowedUsers($this->workspace);
        $users_count_on_this_workspace = Workspace::usersCount($this->workspace->id);

        if($users_count_on_this_workspace >= $maximum_allowed_users)
        {
            abort(401);
        }
        $request->validate([
            "id" => "nullable|integer",
        ]);
        $countries = countries();

        $selected_user = false;

        if ($request->id) {
            $selected_user = User::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        return \view("profile.new-user", [
            "selected_navigation" => "team",
            "selected_user" => $selected_user,
            "countries" => $countries,
        ]);
    }

    public function userPost(Request $request)
    {

        $request->validate([
            "first_name" => "required|string|max:100",
            "last_name" => "required|string|max:100",
            "email" => "required|email",
            "phone" => "nullable|string|max:50",
            "password" => "nullable|string|max:255",
            "id" => "nullable|integer",
        ]);



        $maximum_allowed_users = Workspace::getMaximumAllowedUsers($this->workspace);
        $users_count_on_this_workspace = Workspace::usersCount($this->workspace->id);


        if($users_count_on_this_workspace >= $maximum_allowed_users)
        {
//            if(!$this->user->super_admin)
//            {
//                abort(401);
//            }
        }

        $user = false;

        if ($request->id) {

            if($this->user->super_admin)
            {
                $user = User::find($request->id);
            }
            else{
                $user = User::where("workspace_id", $this->user->workspace_id)
                    ->where("id", $request->id)
                    ->first();
            }

            if($user)
            {
                if($user->email !== $request->email)
                {
                    $exist = User::where('email',$request->email)->first();
                    if($exist)
                    {
                        return redirect()->back()->with([
                            'errors' => [
                                'user_exist' => __('User already exist with this email id.')
                            ]
                        ]);
                    }
                }
            }

        }


        if (!$user) {
            $user = new User();
            $user->workspace_id = $this->user->workspace_id;
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;

        if($request->input('password'))
        {
            $user->password = Hash::make($request->input('password'));
        }

        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->mobile_number = $request->mobile_number;
        $user->twitter = $request->twitter;
        $user->facebook = $request->facebook;
        $user->linkedin = $request->linkedin;
        $user->address_1 = $request->address_1;
        $user->address_2 = $request->address_2;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->language = $request->language;
        $user->zip = $request->zip;
        $user->save();



        if ($this->user->super_admin) {
            return redirect("/users");
        }

        return redirect("/staff");
    }

    public function userEdit(Request $request,$id)
    {


        if($this->user->super_admin)
        {
            $selected_user = User::find($request->id);
        }
        else{
            $selected_user = User::where("workspace_id", $this->user->workspace_id)
                ->where("id", $request->id)
                ->first();

            abort_unless($selected_user, 401);
        }



        $countries = countries();


        if ($selected_user){

            if($this->user->super_admin)
            {
                return \view('super-admin.add-new-user',[
                    'selected_user'=> $selected_user,
                    'countries'=> $countries,


                ]);
            }

            return \view('profile.new-user',[
                'selected_user'=> $selected_user,
                'countries'=> $countries,


            ]);

        }

    }

    public function userChangePasswordPost(Request $request)
    {
        $request->validate([
            "password" => "required",
            "new_password" => "required|confirmed",
        ]);

        $user = $this->user;

        if (!Hash::check($request->password, $user->password)) {
            return redirect("/profile")->withErrors([
                "password" => "Incorrect old password.",
            ]);
        }

        if (config("app.environment") !== "demo") {
            $user->password = Hash::make($request->new_password);
            $user->save();
        }

        return redirect("/profile");
    }
}
