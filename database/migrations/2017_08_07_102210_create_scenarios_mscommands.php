<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScenariosMscommands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scenarios_mscommands', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('scenario_id')->unsigned();
            $table->integer('mscommand_id')->unsigned();

            $table->foreign('scenario_id')->references('id')->on('scenarios');
            $table->foreign('mscommand_id')->references('id')->on('mscommands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('scenarios_mscommands');
    }
}
