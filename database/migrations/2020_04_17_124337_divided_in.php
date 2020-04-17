<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DividedIn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('divided_in', function (Blueprint $table) {
          $table->unsignedBigInteger('id_round');
          $table->unsignedBigInteger('id_tournament');
          $table->foreign('id_round')->references('id_round')->on('rounds')->onDelete('cascade');
          $table->foreign('id_tournament')->references('id_tournament')->on('tournaments')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('divided_in');
    }
}
