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
		  $table->id();
          $table->unsignedBigInteger('id_team');
          $table->unsignedBigInteger('id_match');
          $table->foreign('id_team')->references('id')->on('teams')->onDelete('cascade');
          $table->foreign('id_match')->references('id')->on('matchs')->onDelete('cascade');
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
