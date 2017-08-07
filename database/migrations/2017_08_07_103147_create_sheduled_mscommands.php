<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSheduledMscommands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduled_mscommands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cron');
            $table->integer('mscommand_id')->unsigned();

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
        Schema::drop('scheduled_mscommands');
    }
}
