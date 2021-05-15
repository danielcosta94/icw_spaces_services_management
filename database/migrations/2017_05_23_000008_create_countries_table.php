<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->string('code', 5)->primary();
            $table->string('name', 60)->unique();
            $table->string('currency_code', 5);
            $table->string('calling_code_id')->unique();
            $table->string('flag_path', 150)->unique();

            $table->foreign('currency_code')->references('code')->on('currencies')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
