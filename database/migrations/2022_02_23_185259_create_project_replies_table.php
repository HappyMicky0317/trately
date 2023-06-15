<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_replies', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid');
            $table->unsignedInteger('workspace_id');
            $table->unsignedInteger('visitor_id')->default(0);
            $table->unsignedInteger('admin_id')->default(0);
            $table->unsignedInteger('agent_id')->default(0);
            $table->unsignedInteger('project_id')->default(0);
            $table->text('message')->nullable();
            $table->boolean('is_private')->default(0);
            $table->boolean('agent_can_view')->default(1);
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
        Schema::dropIfExists('project_replies');
    }
}
