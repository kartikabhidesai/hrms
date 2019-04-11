<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveCategoriesExperienceBased extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exprience_basd_leave_count', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('leave_categories_id');
            $table->string('employee_type','255');
            $table->string('name','255');
            $table->integer('year');
            $table->integer('month');
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
        Schema::dropIfExists('exprience_basd_leave_count');
    }
}
