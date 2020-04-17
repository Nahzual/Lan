<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Needs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('needs', function (Blueprint $table) {
          $table->bigInteger('id_material');
          $table->bigInteger('id_lan');
          $table->unsignedInteger('quantity');
          $table->foreign('id_lan')->references('id')->on('lans')->onDelete('cascade');
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
      Schema::dropIfExists('needs');
    }
}
