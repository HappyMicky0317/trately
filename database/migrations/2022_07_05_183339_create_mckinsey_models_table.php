<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMckinseyModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mckinsey_models', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedInteger('workspace_id');
            $table->unsignedInteger('admin_id')->default(0);
            $table->string('company_name')->nullable();
            $table->text('structure')->nullable();
            $table->text('strategy')->nullable();
            $table->text('system')->nullable();
            $table->text('shared_values')->nullable();
            $table->text('skill')->nullable();
            $table->text('style')->nullable();
            $table->text('staff')->nullable();
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
        Schema::dropIfExists('mckinsey_models');
    }
}
