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
            $table->string('gender');
            $table->string('lastName');
            $table->string('firstName');
            $table->dateTime('date_of_birth')->nullable();
            $table->text('address');
            $table->string('postcode');
            $table->string('city');
            $table->string('country')->default('Belgium');
            $table->string('phone');
            $table->dateTime('member_since')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('rfid', 60);
//            $table->string('token_valid', 60);
            $table->boolean('is_public')->nullable();
//            $table->boolean('is_valid')->default(false);
            $table->boolean('is_active')->nullable();
            $table->string('totp')->default(null);
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
