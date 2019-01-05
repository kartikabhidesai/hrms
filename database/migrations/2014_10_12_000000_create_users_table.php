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
            $table->string('name', 255);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('user_image', 255)->nullable();
            $table->enum('type', ['ADMIN', 'EMPLOYEE', 'COMPANY'])->default('EMPLOYEE');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
        array('name' => 'admin ',
            'email' => 'admin@admin.com',
            'password' => '$2y$12$SVnRH9z4fFbwGVAslC0umeId8nm6GeG2sitYuYn.cSAJ2REvv3z8G',
            'type' => 'ADMIN'));

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
