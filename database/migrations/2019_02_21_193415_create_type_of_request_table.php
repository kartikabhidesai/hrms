<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeOfRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_of_request', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->string('request_name',255);
            $table->integer('is_active')->default('1');
            $table->timestamps();
        });
        DB::table('type_of_request')->insert( array('request_name' => 'Clock in times','is_active' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')) );
        DB::table('type_of_request')->insert( array('request_name' => 'Standard or basic hours','is_active' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')) );
        DB::table('type_of_request')->insert( array('request_name' => 'Overtime hours','is_active' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')) );
        DB::table('type_of_request')->insert( array('request_name' => 'Absence','is_active' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')) );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_of_request');
    }
}
