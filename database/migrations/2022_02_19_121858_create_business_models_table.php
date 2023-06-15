<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_models', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedInteger('workspace_id');
            $table->unsignedInteger('admin_id')->default(0);
            $table->unsignedInteger('product_id')->default(0);
            $table->string('company_name')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('partners')->nullable();
            $table->text('activities')->nullable();
            $table->text('resources')->nullable();
            $table->text('value_propositions')->nullable();
            $table->text('customer_relationships')->nullable();
            $table->text('channels')->nullable();
            $table->text('customer_segments')->nullable();
            $table->text('cost_structure')->nullable();
            $table->text('revenue_stream')->nullable();

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
        Schema::dropIfExists('business_models');
    }
}
