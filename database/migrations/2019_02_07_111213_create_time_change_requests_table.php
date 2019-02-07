<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeChangeRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_change_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('employee_id');
            $table->integer('company_id');
            $table->integer('department_id');
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->date('date_of_submit')->nullable();
            $table->string('request_type')->nullable();
            $table->string('total_hours')->nullable();
            $table->string('request_description')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('time_change_requests');
    }
}
