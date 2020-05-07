<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AssignedTo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
			Schema::create('assigned_to', function (Blueprint $table) {
		  	$table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('task_id');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assigned_to');
    }
}
