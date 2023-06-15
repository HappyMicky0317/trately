<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticeBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_boards', function (Blueprint $table) {

            $table->id();
            $table->unsignedInteger("workspace_id");
            $table->uuid("uuid");
            $table->unsignedInteger("admin_id")->default(0);
            $table->string("title")->nullable();
            $table->string("topic")->nullable();
            $table->string("slug")->nullable();
            $table->text("notes")->nullable();
            $table->string("cover_photo")->nullable();
            $table
                ->enum("status", ["Draft", "Published", "Unpublished"])
                ->default("Draft");

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
        Schema::dropIfExists('notice_boards');
    }
}
