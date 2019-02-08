<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AleterLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leaves', function (Blueprint $table) {
            //
             $table->integer('emp_id')->after('id');
             $table->integer('cmp_id')->after('emp_id');
             $table->integer('type_of_req_id')->after('cmp_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leaves', function (Blueprint $table) {
            //
            $table->dropColumn('emp_id');
            $table->dropColumn('cmp_id');
            $table->dropColumn('type_of_req_id');
        });
    }
}
