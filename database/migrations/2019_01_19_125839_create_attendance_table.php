<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('user_id');
            $table->integer('department_id');
            $table->integer('emp_id');
            $table->enum('attendance',['0','1']);
            $table->string('reason', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * php artisan make:migration alter_change_attendance_fild --table=attendance

     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance');
    }
}
