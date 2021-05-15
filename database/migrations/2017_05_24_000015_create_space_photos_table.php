<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpacePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('space_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('photo_type', array('main', 'secondary'));
            $table->unsignedInteger('space_id');
            $table->string('path', 150)->unique();
            $table->timestamp('uploaded_at');

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
        Schema::dropIfExists('space_photos');
    }
}
