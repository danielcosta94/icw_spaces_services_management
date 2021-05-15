<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpacePopularitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('space_popularities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('space_id');
            $table->unsignedInteger('action_type_id');
            $table->timestamp('created_at');

            $table->foreign('space_id')->references('id')->on('spaces')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('action_type_id')->references('id')->on('action_types')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('space_popularities');
    }
}
