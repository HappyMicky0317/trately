<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStartupCanvasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('startup_canvases', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedInteger('workspace_id');
            $table->unsignedInteger('admin_id')->default(0);
            $table->unsignedInteger('product_id')->default(0);
            $table->string('company_name')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('problems')->nullable();
            $table->text('solutions')->nullable();
            $table->text('value_propositions')->nullable();
            $table->text('unfair_advantage')->nullable();
            $table->text('channels')->nullable();
            $table->text('key_matrices')->nullable();
            $table->text('customer_segments')->nullable();
            $table->text('revenue_stream')->nullable();
            $table->text('cost_structure')->nullable();
            $table->text('team')->nullable();
            $table->text('market')->nullable();
            $table->text('risks')->nullable();
            $table->text('performance')->nullable();
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
        Schema::dropIfExists('startup_canvases');
    }
}
