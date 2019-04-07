<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemGenerateNoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_generate_no', function (Blueprint $table) {
            $table->increments('id');
            $table->string('report_name',255);
            $table->string('generated_no',255);
            $table->timestamps();
        });

        DB::table('system_generate_no')->insert(
        array('report_name' => 'ticket_report','generated_no' => '0001'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_generate_no');
    }
}
