<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('tasks', function (Blueprint $table) {
			$table->id();
			$table->string('name_task');
			$table->longText('desc_task');
			$table->date('deadline_task');
			$table->unsignedBigInteger('lan_id');

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
		Schema::dropIfExists('tasks');
	}
}
