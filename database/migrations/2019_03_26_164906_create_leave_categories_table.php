<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->string('leave_cat_name');
            $table->string('type');
            $table->string('leave_unit');
            $table->string('description');
            $table->string('applicable_for');
            $table->string('role');
            $table->string('work_location');
            $table->string('gender');
            $table->string('marital_status');
            $table->string('period');
            $table->string('for_employee_type');
            $table->string('leave_count');
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
        Schema::dropIfExists('leave_categories');
    }
}
