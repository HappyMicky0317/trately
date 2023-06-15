<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketingPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketing_plans', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedInteger('workspace_id');
            $table->unsignedInteger('admin_id')->default(0);
            $table->unsignedInteger('product_id')->default(0);
            $table->string('company_name')->nullable();
            $table->text('summary')->nullable();
            $table->text('description')->nullable();
            $table->text('business_initiatives')->nullable();
            $table->text('team')->nullable();
            $table->text('target_market')->nullable();
            $table->text('budget')->nullable();
            $table->text('marketing_channels')->nullable();
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
        Schema::dropIfExists('marketing_plans');
    }
}
