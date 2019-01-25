<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayRollTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('pay_roll', function (Blueprint $table) {
            $table->increments('id');
            $table->float('salary_grade', 10, 2);
            $table->float('basic_salary', 10, 2);
            $table->decimal('over_time', 10, 2);
            $table->string('department', 255)->nullable();;
            $table->date('due_date')->nullable();
            $table->string('housing', 255);
            $table->string('medical', 255);
            $table->string('transportation', 255);
            $table->string('travel', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('pay_roll');
    }

}
