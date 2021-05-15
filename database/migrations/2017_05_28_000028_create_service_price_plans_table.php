<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicePricePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_price_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('service_id');
            $table->unsignedInteger('payment_plan_type_id');
            $table->boolean('active');
            $table->decimal('price', 10, 2);
            $table->timestamps();

            $table->unique(['service_id', 'payment_plan_type_id'], 'unique_service_id_payment_id');
            $table->foreign('service_id')->references('id')->on('services')->onUpdate('cascade')->onDelete('no action');
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
        Schema::dropIfExists('service_price_plans');
    }
}
