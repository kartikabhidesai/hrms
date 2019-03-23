<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkingDaySettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_day_setting', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->string('region',255)->nullable();
            $table->string('time_zone',255)->nullable();
            $table->tinyInteger('monday_status');
            $table->tinyInteger('monday_work');
            $table->time('monday_from');
            $table->time('monday_to');
            $table->tinyInteger('tuesday_status');
            $table->tinyInteger('tuesday_work');
            $table->time('tuesday_from');
            $table->time('tuesday_to');
            $table->tinyInteger('wednesday_status');
            $table->tinyInteger('wednesday_work');
            $table->time('wednesday_from');
            $table->time('wednesday_to');
            $table->tinyInteger('thursday_status');
            $table->tinyInteger('thursday_work');
            $table->time('thursday_from');
            $table->time('thursday_to');
            $table->tinyInteger('friday_status');
            $table->tinyInteger('friday_work');
            $table->time('friday_from');
            $table->time('friday_to');
            $table->tinyInteger('saturday_status');
            $table->tinyInteger('saturday_work');
            $table->time('saturday_from');
            $table->time('saturday_to');
            $table->tinyInteger('sunday_status');
            $table->tinyInteger('sunday_work');
            $table->time('sunday_from');
            $table->time('sunday_to');
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
        Schema::dropIfExists('working_day_setting');
    }
}
