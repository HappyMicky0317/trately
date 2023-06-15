<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedInteger('workspace_id');
            $table->unsignedInteger('admin_id')->default(0);
            $table->unsignedInteger('product_id')->default(0);
            $table->string('name')->nullable();
            $table->date('date')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('executive_summary')->nullable();
            $table->text('administrative_analysis')->nullable();
            $table->text('technical_analysis')->nullable();
            $table->text('financial_analysis')->nullable();
            $table->text('improvement_activities')->nullable();
            $table->text('recommendations')->nullable();
            $table->string("status")->nullable();
            $table->string("uncertainty_level")->nullable();
            $table->string("feasibility_level")->nullable();
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
        Schema::dropIfExists('reports');
    }
}
