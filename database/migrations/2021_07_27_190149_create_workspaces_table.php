<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkspacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workspaces', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('plan_id')->default(0);
            $table->unsignedInteger('owner_id')->default(0);
            $table->boolean('active')->default(1);
            $table->boolean('subscribed')->default(0);
            $table->string('term')->nullable();
            $table->date('subscription_start_date')->nullable();
            $table->date('next_renewal_date')->nullable();
            $table->unsignedDecimal('price')->nullable();
            $table->boolean('trial')->default(1);
            $table->date('trial_start_date')->nullable();
            $table->date('trial_end_date')->nullable();
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
        Schema::dropIfExists('workspaces');
    }
}
