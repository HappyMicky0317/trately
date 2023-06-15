<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('paypal_plan_id')->nullable();
            $table->string('stripe_plan_id')->nullable();
            $table->unsignedDecimal('price_monthly')->nullable();
            $table->unsignedDecimal('price_yearly')->nullable();
            $table->unsignedDecimal('price_two_years')->nullable();
            $table->unsignedDecimal('price_three_years')->nullable();
            $table->text('description')->nullable();
            $table->text('features')->nullable();
            $table->text('modules')->nullable();
            $table->unsignedInteger('maximum_allowed_users')->default(0);
            $table->boolean('has_modules')->default(0);
            $table->boolean('free')->default(0);
            $table->boolean('active')->default(1);
            $table->boolean('featured')->default(0);
            $table->boolean('per_user_pricing')->default(0);
            $table->unsignedInteger('users_limit')->default(0);
            $table->unsignedInteger('max_file_upload_size')->default(0);
            $table->unsignedInteger('file_space_limit')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_plans');
    }
}
