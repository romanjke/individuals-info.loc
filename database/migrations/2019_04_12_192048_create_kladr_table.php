<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKladrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kladr', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 40);
            $table->string('socr', 10);
            $table->string('code', 13);
            $table->string('region', 2)->nullable();
            $table->string('district', 3)->nullable();
            $table->string('city', 3)->nullable();
            $table->string('town', 3)->nullable();
            $table->string('relevance', 2)->nullable();
            $table->string('index', 6)->nullable();
            $table->string('gninmb', 4)->nullable();
            $table->string('uno', 4)->nullable();
            $table->string('ocatd', 11);
            $table->string('status', 1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kladr');
    }
}
