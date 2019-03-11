<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruitmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->string('task',255)->nullable();
            $table->integer('department_id');
            $table->string('responsibility',255)->nullable();
            $table->string('requirement',255)->nullable();
            $table->string('experience_level',255)->nullable();
            $table->string('jobtime',255)->nullable();
            $table->string('contract',255)->nullable();
            $table->string('salary',255)->nullable();
            $table->string('email',255)->nullable();
            $table->string('conatact_us',255)->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('job_id',255)->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('recruitment');
    }
}
