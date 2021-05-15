<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpacePricePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('space_price_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('space_id');
            $table->unsignedInteger('payment_plan_type_id');
            $table->boolean('active');
            $table->decimal('price', 10, 2);

            $table->timestamps();

            $table->unique(['space_id', 'payment_plan_type_id'], 'unique_space_id_payment_id');
            $table->foreign('space_id')->references('id')->on('spaces')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('payment_plan_type_id')->references('id')->on('payment_plan_types')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('space_price_plans');
    }
}
