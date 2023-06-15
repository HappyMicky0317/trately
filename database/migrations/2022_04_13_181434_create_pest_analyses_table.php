<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePestAnalysesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pest_analyses', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedInteger('workspace_id');
            $table->unsignedInteger('admin_id')->default(0);
            $table->string('company_name')->nullable();
            $table->text('political')->nullable();
            $table->text('economic')->nullable();
            $table->text('social')->nullable();
            $table->text('technological')->nullable();
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
        Schema::dropIfExists('pest_analyses');
    }
}
