<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('service_type_id');
            $table->string('name', 60);
            $table->boolean('active')->default(true);
            $table->boolean('validated')->default(false);
            $table->string('description', 500);
            $table->unsignedMediumInteger('radius_action');
            $table->string('distance_unit_symbol', 5);
            $table->string('photo_path');
            $table->string('email', 120);
            $table->string('mobile');
            $table->string('telephone')->nullable();
            $table->string('website')->nullable();
            $table->decimal('latitude', 22, 20);
            $table->decimal('longitude', 23, 20);
            $table->timestamp('created_at');

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('no action');
            $table->foreign('service_type_id')->references('id')->on('business_verticals')->onUpdate('cascade')->onDelete('no action');
            $table->foreign('distance_unit_symbol')->references('symbol')->on('distance_units')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
