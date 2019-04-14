<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 40);
            $table->string('socr', 10);
            $table->string('code', 17);
            $table->string('index', 6)->nullable();
            $table->string('gninmb', 4);
            $table->string('uno', 4)->nullable();
            $table->string('ocatd', 11)->nullable();
            $table->integer('kladr_id')->unsigned()->nullable();

            $table->foreign('kladr_id')->references('id')->on('kladr')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('streets');
    }
}
