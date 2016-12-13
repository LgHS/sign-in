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
            $table->dateTime('birthdate');
            $table->text('address');
            $table->string('postcode');
            $table->string('country')->default('Belgique');
            $table->string('phone');
            $table->dateTime('member_since');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('token_valid', 60);
            $table->boolean('is_public')->default(false);
            $table->boolean('is_valid')->default(False);
            $table->boolean('is_active')->default(true);
            $table->string('totp')->default(NULL);
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
