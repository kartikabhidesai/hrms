<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHolidayReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holiday_report', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->nullable();
            $table->integer('employee_id');
            $table->integer('department_id');
            $table->string('holiday_report_number', 128);
            $table->date('download_date');
            $table->timestamps();
        });
         DB::table('system_generate_no')->insert(
        array('report_name' => 'holiday_report','generated_no' => '0001'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('holiday_report');
    }
}
