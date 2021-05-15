<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpaceAvailabiltiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('space_availabilties', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('space_id');
            $table->enum('day_week', array('monday','tuesday','wednesday','thursday','friday','saturday','sunday'));
            $table->unsignedTinyInteger('opening_hour');
            $table->unsignedTinyInteger('closing_hour');

            $table->unique(['space_id', 'day_week']);
            $table->foreign('space_id')->references('id')->on('spaces')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('space_availabilties');
    }
}
