<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spaces', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('space_type_id');
            $table->string('name', 60);
            $table->boolean('active')->default(true);
            $table->boolean('validated')->default(false);
            $table->unsignedInteger('business_vertical_id');
            $table->unsignedSmallInteger('capacity');
            $table->string('description', 500);
            $table->string('email', 120);
            $table->string('telephone_number', 60);
            $table->string('website', 70)->nullable();
            $table->decimal('latitude', 22, 20);
            $table->decimal('longitude', 23, 20);
            $table->timestamp('created_at');

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('no action');
            $table->foreign('space_type_id')->references('id')->on('space_types')->onUpdate('cascade')->onDelete('no action');
            $table->foreign('business_vertical_id')->references('id')->on('business_verticals')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spaces');
    }
}
