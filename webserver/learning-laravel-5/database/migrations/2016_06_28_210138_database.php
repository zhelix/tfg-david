<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Database extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user');
            $table->string('passwd');
            $table->string('name');
            $table->string('company');
            $table->string('tel');
            $table->timestamps();
        });
        Schema::create('board', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('brand');
            $table->string('linkID');
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            //Relacionar amb taula Users.
            $table->foreign('user_id')->references('id')->on('user');
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
        Schema::drop('user');
        Schema::drop('board');
        Schema::drop('data');
    }
}
