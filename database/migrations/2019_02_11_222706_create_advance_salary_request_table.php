<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvanceSalaryRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advance_salary_request', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->integer('employee_id');
            $table->integer('company_id');
            $table->integer('department_id');
            $table->date('date_of_submit');
            $table->text('comments')->nullable();
            $table->string('file_name',255);
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
        Schema::dropIfExists('advance_salary_request');
    }
}
