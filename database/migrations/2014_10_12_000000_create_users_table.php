<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('firstName',20);
            $table->string('lastName',20);
            $table->string('middleName',20)->nullable();
            $table->string('regNo',20);
            $table->string('email',70);
            $table->string('phone',14);
            $table->varchar('picture',25);
            $table->integer('verify')->nullable();
            $table->string('password','255');
            $table->rememberToken()->nullable();
            $table->timestamps();
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
