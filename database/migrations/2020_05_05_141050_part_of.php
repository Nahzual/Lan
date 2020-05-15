<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PartOf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('part_of', function (Blueprint $table){
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('team_id');
        $table->unsignedBigInteger('tournament_id');

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('part_of');
    }
}
