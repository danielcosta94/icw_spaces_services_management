<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceAvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_availabilties', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('service_id');
            $table->enum('day_week', array('monday','tuesday','wednesday','thursday','friday','saturday','sunday'));
            $table->unsignedTinyInteger('opening_hour');
            $table->unsignedTinyInteger('closing_hour');

            $table->unique(['service_id', 'day_week']);
            $table->foreign('service_id')->references('id')->on('services')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_availabilties');
    }
}
