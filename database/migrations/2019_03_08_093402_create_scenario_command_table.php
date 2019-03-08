<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScenarioCommandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scenario_command', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('scenario_id');
            $table->unsignedInteger('command_id');
            $table->unsignedInteger('ordre')->default(1);
            $table->timestamps();

            $table->foreign('scenario_id')->references('id')->on('scenarios');
            $table->foreign('command_id')->references('id')->on('commands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scenario_command');
    }
}
