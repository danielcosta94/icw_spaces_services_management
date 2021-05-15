<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpaceReservedExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('space_reserved_extras', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('space_reservation_id');
            $table->timestamp('date_reservation');
            $table->string('name', 60);
            $table->string('description', 200);
            $table->decimal('price', 10, 2);
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('payment_plan_type_id')->nullable();

            $table->timestamps();

            $table->foreign('space_reservation_id')->references('id')->on('space_bookings')->onUpdate('no action')->onDelete('no action');
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
        Schema::dropIfExists('space_reserved_extras');
    }
}
