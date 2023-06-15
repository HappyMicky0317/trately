<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_plans', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedInteger('workspace_id');
            $table->unsignedInteger('admin_id')->default(0);
            $table->string('logo')->nullable();
            $table->string('file')->nullable();
            $table->string('company_name')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->date('date')->nullable();
            $table->string('website')->nullable();
            $table->text('description')->nullable();
            $table->text('ex_summary')->nullable();
            $table->text('m_analysis')->nullable();
            $table->text('management')->nullable();
            $table->text('product')->nullable();
            $table->text('marketing')->nullable();
            $table->text('budget')->nullable();
            $table->text('investment')->nullable();
            $table->text('finance')->nullable();
            $table->text('appendix')->nullable();
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
        Schema::dropIfExists('business_plans');
    }
}
