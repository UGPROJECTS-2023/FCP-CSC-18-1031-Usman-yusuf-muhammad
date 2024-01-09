<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname','80');
            $table->string('lastname','80');
            $table->string('middlename','80')->nullable();
            $table->string('staffId','30')->unique();
            $table->string('email','100');
            $table->string('phone','11');
            $table->string('picture','20');
            $table->string('officeNo','15');
            $table->integer('privilege')->current_timestamp();
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
        Schema::dropIfExists('admins');
    }
}
