<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lans', function (Blueprint $table) {
            $table->id();
			      $table->string('name');
			      $table->integer('max_num_registrants');
			      $table->date('opening_date');
            $table->integer('duration');
            $table->integer('budget');
            $table->tinyInteger('waiting_lan')->default(1);
            $table->unsignedBigInteger('location_id');
            $table->timestamps();

            $table->foreign('location_id')->references('id_location')->on('locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lans');
    }
}
