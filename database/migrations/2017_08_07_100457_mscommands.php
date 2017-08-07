<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Mscommands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mscommands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('sensor_id')->unsigned();
            $table->integer('command')->unsigned();
            $table->integer('ack')->unsigned();
            $table->integer('type')->unsigned();
            $table->string('payload');
            $table->string('url');

            $table->foreign('sensor_id')->references('id')->on('sensors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mscommands');
    }
}
