<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 40);
            $table->string('korp', 10)->nullable();
            $table->string('socr', 10);
            $table->string('street_code', 17);
            $table->string('index', 6)->nullable();
            $table->string('gninmb', 4);
            $table->string('uno', 4)->nullable();
            $table->string('ocatd', 11);
            $table->integer('street_id')->unsigned()->nullable();

            $table->foreign('street_id')->references('id')->on('streets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('houses');
    }
}
