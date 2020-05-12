<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Contains extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('contains', function (Blueprint $table) {
		  $table->id();
          $table->unsignedBigInteger('shopping_id');
          $table->unsignedBigInteger('material_id');
          $table->foreign('shopping_id')->references('id')->on('shoppings')->onDelete('cascade');
          $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('contains');

    }
}
