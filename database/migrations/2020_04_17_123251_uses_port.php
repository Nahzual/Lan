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
          $table->unsignedBigInteger('id_port');
          $table->unsignedBigInteger('id_game');
          $table->unsignedBigInteger('id_lan');
          $table->foreign('id_port')->references('id_connexionport')->on('connexionports')->onDelete('cascade');
          $table->foreign('id_game')->references('id_game')->on('games')->onDelete('cascade');
          $table->foreign('id_lan')->references('id')->on('lans')->onDelete('cascade');
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
