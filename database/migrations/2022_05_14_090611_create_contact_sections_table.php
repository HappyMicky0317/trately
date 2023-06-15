<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('admin_id')->default(0);
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('phone_number')->nullable()->unique();
            $table->string('twitter')->nullable()->unique();
            $table->string('facebook')->nullable()->unique();
            $table->string('linkedin')->nullable()->unique();
            $table->string('youtube')->nullable()->unique();
            $table->string('address_1')->nullable()->unique();
            $table->string('address_2')->nullable()->unique();
            $table->string('zip')->nullable()->unique();
            $table->string('city')->nullable()->unique();
            $table->string('state')->nullable()->unique();
            $table->string('country')->nullable()->unique();
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
        Schema::dropIfExists('contact_sections');
    }
}
