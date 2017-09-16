<?php

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
            $table->uuid('uuid');
            $table->string('username')->unique();
            $table->string('gender')->nullable();
            $table->string('lastName')->nullable();
            $table->string('firstName')->nullable();
            $table->dateTime('date_of_birth')->nullable();
            $table->text('address')->nullable();
            $table->string('postcode')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->dateTime('member_since')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('rfid', 60)->nullable();
            $table->boolean('is_public')->nullable();
            $table->boolean('is_active')->nullable();
            $table->string('totp')->nullable()->default(null);
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
        Schema::drop('users');
    }
}
