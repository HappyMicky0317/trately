<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedInteger('workspace_id');
            $table->unsignedInteger('admin_id')->default(0);
            $table->unsignedInteger('owner_id')->nullable();
            $table->unsignedInteger('assignee_id')->nullable();
            $table->unsignedInteger('contact_id')->nullable();
            $table->unsignedInteger('ticket_id')->nullable();
            $table->unsignedInteger('deal_id')->nullable();
            $table->unsignedInteger('priority_id')->nullable();
            $table->string('status')->nullable();
            $table->string('subject');
            $table->text('description')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->dateTime('start_date')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
