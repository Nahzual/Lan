<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FavoriteGames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('favorite_games', function (Blueprint $table) {
          $table->bigInteger('id_user');
          $table->bigInteger('id_game');
          $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
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
      Schema::dropIfExists('favorite_games');  
    }
}
