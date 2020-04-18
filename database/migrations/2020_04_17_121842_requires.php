<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Requires extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('requires', function (Blueprint $table) {
		  $table->id();
          $table->unsignedBigInteger('id_lan');
          $table->unsignedBigInteger('id_shopping');
          $table->foreign('id_lan')->references('id')->on('lans')->onDelete('cascade');
          $table->foreign('id_shopping')->references('id_shopping')->on('shoppings')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('requires');
    }
}
