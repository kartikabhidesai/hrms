<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFromAndSubjectToCommunicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('communication', function (Blueprint $table) {
            $table->string('subject')->after('file')->nullable();
            $table->string('from')->after('subject')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('communication', function (Blueprint $table) {
            $table->dropColumn('subject');
            $table->dropColumn('from');
        });
    }
}
