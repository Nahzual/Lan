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
          $table->unsignedBigInteger('id_shopping');
          $table->unsignedBigInteger('id_material');
          $table->unsignedInteger('quantity');
          $table->foreign('id_shopping')->references('id_shopping')->on('shoppings')->onDelete('cascade');
          $table->foreign('id_material')->references('id_material')->on('materials')->onDelete('cascade');
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
