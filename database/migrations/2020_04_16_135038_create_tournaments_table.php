<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id('id_tournament');
            $table->string('name_tournament');
            $table->longText('desc_tournament');
            $table->date('opening_date_tournament');
            $table->boolean('is_finished_tournament')->default(false);
            $table->unsignedInteger('player_count_tournament');
            $table->string('match_mod_tournament');
            $table->unsignedInteger('max_player_count_tournament');
            $table->unsignedBigInteger('id_game');
            $table->timestamps();

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
        Schema::dropIfExists('tournaments');
    }
}
