<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsesPort extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('uses_port', function (Blueprint $table) {
          $table->bigInteger('id_port');
          $table->bigInteger('id_game');
          $table->foreign('id_port')->references('id_connexionport')->on('connexionport')->onDelete('cascade');
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
      Schema::dropIfExists('uses_port');
    }
}
