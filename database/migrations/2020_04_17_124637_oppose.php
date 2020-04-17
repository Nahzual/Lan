<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Oppose extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('oppose', function (Blueprint $table) {
          $table->bigInteger('id_user');
          $table->bigInteger('id_match');
          $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
          $table->foreign('id_match')->references('id_match')->on('matchs')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('oppose');
    }
}
