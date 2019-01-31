<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_title',255);
            $table->string('site_tagline',255);
            $table->string('email',255);
            $table->timeTz('timezone');
            $table->string('dateformate',255);
            $table->string('timeformate',255);
            $table->string('weekstart',255);
            $table->string('language',255);
            $table->string('siteurl',255);
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
        Schema::dropIfExists('setting');
    }
}
