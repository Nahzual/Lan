<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->string('pseudo')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('tel_user',10);
            $table->unsignedInteger('rank_user')->default(0);
            $table->unsignedBigInteger('location_id');
	        $table->unsignedSmallInteger('theme')->default(0);
	        $table->unsignedSmallInteger('language')->default(0);
            $table->foreign('location_id')->references('id')->on('locations');
            $table->rememberToken();
            $table->timestamps();
						$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
