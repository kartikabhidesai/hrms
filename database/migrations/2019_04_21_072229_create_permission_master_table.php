<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_master', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->integer('is_active');
            $table->enum('type', ['COMPANY', 'ADMIN'])->default('COMPANY');
            $table->timestamps();
        });

        DB::table('permission_master')->insert( array('name' => 'Salary', 'is_active' => '1', 'type' => 'COMPANY', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s') ));
        DB::table('permission_master')->insert( array('name' => 'Attedance', 'is_active' => '1', 'type' => 'COMPANY', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('permission_master')->insert( array('name' => 'Task', 'is_active' => '1', 'type' => 'COMPANY', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('permission_master')->insert( array('name' => 'Ticket', 'is_active' => '1', 'type' => 'COMPANY', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('permission_master')->insert( array('name' => 'Performance', 'is_active' => '1', 'type' => 'COMPANY', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('permission_master')->insert( array('name' => 'CMS Page', 'is_active' => '1', 'type' => 'ADMIN', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('permission_master')->insert( array('name' => 'Client', 'is_active' => '1', 'type' => 'ADMIN', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('permission_master')->insert( array('name' => 'Communication', 'is_active' => '1', 'type' => 'ADMIN', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('permission_master')->insert( array('name' => 'SMS', 'is_active' => '1', 'type' => 'ADMIN', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('permission_master')->insert( array('name' => 'ALL', 'is_active' => '1', 'type' => 'ADMIN', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_master');
    }
}
