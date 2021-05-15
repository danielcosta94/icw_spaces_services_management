<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 120)->unique();
            $table->string('first_name', 60);
            $table->string('last_name', 60);
            $table->boolean('active')->default(false);
            $table->string('mobile_number', 60)->nullable();
            $table->string('telephone_number', 60)->nullable();
            $table->string('city', 75)->nullable();
            $table->string('password', 191);
            $table->unsignedInteger('user_type_id');
            $table->string('linkedin_profile', 120)->nullable()->unique();
            $table->string('facebook_profile', 120)->nullable()->unique();
            $table->string('stripe_id', 100)->nullable();
            $table->boolean('stripe_active')->default(false);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('user_type_id')->references('id')->on('user_types')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}