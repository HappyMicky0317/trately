<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PaymentGateway extends Model
{
    public static function enablePayStack()
    {
        if(!Schema::hasColumn('subscription_plans','paystack_monthly_plan_id'))
        {
            Schema::table('subscription_plans', function (Blueprint $table) {
                $table->string('paystack_monthly_plan_id')->nullable();
                $table->string('paystack_yearly_plan_id')->nullable();
            });

            Schema::table('workspaces', function (Blueprint $table) {
                $table->string('paystack_billing_profile')->nullable();
            });

        }
    }

    public static function hasPayStack()
    {
        return PaymentGateway::where('api_name','paystack')->first();
    }
}
