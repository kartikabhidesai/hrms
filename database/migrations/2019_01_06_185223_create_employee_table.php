<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('father_name', 255);
            $table->date('date_of_birth');
            $table->enum('gender', ['Male', 'Female'])->default('Male');
            $table->string('phone', 128);
            $table->text('local_address',1000);
            $table->text('permanent_address',1000);

            $table->integer('nationality')->nullable();
            $table->enum('martial_status', ['Married', 'Unmarried'])->default('Unmarried');
            $table->string('photo', 255);
            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('employee_id', 255);
            
            $table->integer('department')->nullable();
            $table->integer('designation')->nullable();
            $table->date('date_of_joining')->nullable();
            $table->float('joining_salary', 8, 2);
            $table->enum('status', ['Active', 'Inactive'])->default('Inactive');
            $table->string('account_holder_name', 255)->nullable();
            $table->string('account_number', 255)->nullable();
            $table->string('bank_name', 255)->nullable();
            $table->text('branch', 500)->nullable();
            $table->string('resume_file', 255)->nullable();
            $table->string('offer_letter', 255)->nullable();
            $table->string('joining_letter', 255)->nullable();
            $table->string('contact_agreement', 255)->nullable();
            $table->string('other', 255)->nullable();
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
        Schema::dropIfExists('employee');
    }
}
