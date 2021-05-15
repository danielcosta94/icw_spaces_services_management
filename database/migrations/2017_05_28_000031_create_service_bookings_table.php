<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_client_id');
            $table->unsignedInteger('service_id');
            $table->unsignedInteger('service_price_plan');
            $table->string('payment_stripe_id', 100)->nullable();
            $table->timestamp('date_reservation');
            $table->enum('status_reservation', array('Cancelled', 'Requested', 'Denied', 'Waiting_Payment', 'Waiting_Refund', 'Refund_Paid', 'Reserved', 'Finished'));
            $table->unsignedInteger('quantity');
            $table->decimal('price_unit', 10, 2);
            $table->unsignedInteger('discount');
            $table->string('currency', 45);
            $table->timestamp('date_cancellation')->nullable();

            $table->foreign('user_client_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('no action');
            $table->foreign('service_id')->references('id')->on('services')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_bookings');
    }
}
