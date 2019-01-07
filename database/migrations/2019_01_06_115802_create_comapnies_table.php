<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComapniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comapnies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name', 255);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('company_image', 255)->nullable();
            $table->enum('status', ['ACTIVE', 'DE-ACTIVE'])->default('ACTIVE');
            $table->enum('subcription', ['PREMIUM','GOLD','SILVER'])->default('PREMIUM');
            $table->timestamp('expiry_at');
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
        Schema::dropIfExists('comapnies');
    }
}
