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
          $table->unsignedBigInteger('lan_id');
          $table->unsignedBigInteger('shopping_id');
          $table->foreign('lan_id')->references('id')->on('lans')->onDelete('cascade');
          $table->foreign('shopping_id')->references('id')->on('shoppings')->onDelete('cascade');
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
