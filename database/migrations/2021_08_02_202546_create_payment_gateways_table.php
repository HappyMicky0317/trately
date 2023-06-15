<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('api_name');
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('api_key')->nullable();
            $table->string('api_username')->nullable();
            $table->string('api_password')->nullable();
            $table->string('public_key')->nullable();
            $table->string('private_key')->nullable();
            $table->string('currency')->nullable();
            $table->text('description')->nullable();
            $table->text('instruction')->nullable();
            $table->boolean('active')->default(1);
            $table->boolean('live')->default(1);
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
        Schema::dropIfExists('payment_gateways');
    }
}
