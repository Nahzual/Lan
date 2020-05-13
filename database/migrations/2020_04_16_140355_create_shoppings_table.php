<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoppings', function (Blueprint $table) {
          $table->id();
					$table->unsignedFloat('cost_shopping');
					$table->unsignedInteger('quantity_shopping');
					$table->unsignedBigInteger('material_id');
					$table->unsignedBigInteger('lan_id');
					$table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
					$table->foreign('lan_id')->references('id')->on('lans')->onDelete('cascade');
			  });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shoppings');
    }
}
