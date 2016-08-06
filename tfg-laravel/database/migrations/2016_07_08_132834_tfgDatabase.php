<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TfgDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('brand');
            $table->string('status');
            $table->string('linkID');
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            //Relacionar amb taula Users.
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('data', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('temp');
            $table->string('hum');
            $table->string('gas');
            $table->string('luz');
            $table->string('noise');
            $table->string('poslon');
            $table->string('poslat');
            $table->integer('board_id')->unsigned();

            //Relacionar amb taula Users.
            $table->foreign('board_id')->references('id')->on('board');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::drop('data');
        Schema::drop('board');
    }
}
