<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldInTaskTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('tasks', function (Blueprint $table) {
            $table->integer('complete_progress');
            $table->string('task_status');
            $table->string('emp_updated_file');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('complete_progress');
            $table->dropColumn('task_status');
            $table->dropColumn('emp_updated_file');
        });
    }

}
