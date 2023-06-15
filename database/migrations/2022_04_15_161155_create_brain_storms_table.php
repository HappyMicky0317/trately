<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrainStormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brain_storms', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedInteger('workspace_id');
            $table->unsignedInteger('admin_id')->default(0);
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->longText('src')->nullable();
            $table->text('description')->nullable();
            $table->string('shareable_key')->nullable();
            $table->boolean('is_public')->default(0);
            $table->unsignedInteger('sort_order')->default(0);
            $table->unsignedInteger('group_id')->default(0);
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
        Schema::dropIfExists('brain_storms');
    }
}
