<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CanPlay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('can_play', function (Blueprint $table) {
          $table->bigInteger('id_lan');
          $table->bigInteger('id_game');
          $table->foreign('id_lan')->references('id')->on('lans')->onDelete('cascade');
          $table->foreign('id_game')->references('id_game')->on('games')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('can_play');

    }
}
