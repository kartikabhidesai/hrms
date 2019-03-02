<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunicationReplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communication_reply', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('communication_id')->nullable();
            $table->integer('employee_id');
            $table->integer('company_id');
            $table->Text('message');
            $table->string('file')->nullable();
            $table->string('subject')->nullable();
            $table->integer('is_read');
            $table->timestamps();
            $table->string('from')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('communication_reply');
    }
}
