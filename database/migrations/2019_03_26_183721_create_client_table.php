<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('client', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('national_id');
            $table->string('work');
            $table->string('company');
            $table->date('date_of_joining');
            $table->string('bank');
            $table->integer('iban');
            $table->integer('account_number');
            $table->string('phone_number');
            $table->string('mobile_number');
            $table->string('email');
            $table->string('street');
            $table->string('city');
            $table->string('state');
            $table->integer('zipcode');
            $table->string('country');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('client');
    }

}
