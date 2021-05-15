<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpaceBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('space_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id_client');
            $table->unsignedInteger('space_id');
            $table->string('space_price_plan', 15);
            $table->enum('status_booking', array('Reserved', 'Check-In', 'Check-Out', 'Cancelled'));
            $table->string('payment_stripe_id', 100);
            $table->timestamp('date_reservation');
            $table->decimal('price_unit', 10, 2);
            $table->unsignedTinyInteger('duration');
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->string('currency', 45);
            $table->timestamp('date_cancellation')->nullable();

            $table->foreign('user_id_client')->references('id')->on('users')->onUpdate('no action')->onDelete('no action');
            $table->foreign('space_id')->references('id')->on('spaces')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('space_bookings');
    }
}
