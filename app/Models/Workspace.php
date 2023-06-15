<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    use HasFactory;

    public static function getMaximumAllowedUsers($workspace)
    {
        if($workspace->subscribed && $workspace->plan_id)
        {
            $plan = SubscriptionPlan::find($workspace->plan_id);


            if($plan)
            {
                return $plan->maximum_allowed_users;
            }
        }
        return null;
    }

    public static function getPlan($workspace)
    {
        if($workspace->subscribed && $workspace->plan_id)
        {
            return SubscriptionPlan::find($workspace->plan_id);
        }
        return null;
    }

    public static function usersCount($workspace_id)
    {
        return User::where('workspace_id',$workspace_id)->count();
    }

}
