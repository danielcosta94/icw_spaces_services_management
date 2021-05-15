<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpaceBookingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('space_booking_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('space_booking_id');
            $table->unsignedTinyInteger('hour');
            $table->date('date');

            $table->foreign('space_booking_id')->references('id')->on('space_bookings')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('space_booking_details');
    }
}
