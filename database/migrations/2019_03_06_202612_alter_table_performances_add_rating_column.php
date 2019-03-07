<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePerformancesAddRatingColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('performances', function (Blueprint $table) {
            $table->integer("dependability")->after('availability')->default('0');
            $table->integer("job_knowledge")->after('dependability')->default('0');
            $table->integer("quality")->after('job_knowledge')->default('0');
            $table->integer("productivity")->after('quality')->default('0');
            $table->integer("working_relationship")->after('productivity')->default('0');
            $table->integer("honesty")->after('working_relationship')->default('0');
            $table->text('notes_and_details', 500)->after('honesty')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('performances', function (Blueprint $table) {
            //
        });
    }
}
