<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewFieldsToEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee', function (Blueprint $table) {
            $table->string('religion')->after('other');
            $table->string('driver_license', 255)->nullable()->after('religion');
            $table->string('iqama_id', 255)->nullable()->after('driver_license');
            $table->date('iqama_expire_date')->nullable()->after('iqama_id');
            $table->string('passport', 255)->nullable()->after('iqama_expire_date');
            $table->date('passport_expire_date')->nullable()->after('passport');
            $table->string('job_title')->nullable()->after('passport_expire_date');
            $table->string('employee_type')->nullable()->after('job_title');
            $table->string('national_id', 255)->nullable()->after('employee_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee', function (Blueprint $table) {
            $table->dropColumn('religion');
            $table->dropColumn('driver_license');
            $table->dropColumn('iqama_id');
            $table->dropColumn('iqama_expire_date');
            $table->dropColumn('passport');
            $table->dropColumn('passport_expire_date');
            $table->dropColumn('job_title');
            $table->dropColumn('employee_type');
            $table->dropColumn('national_id');
        });
    }
}
