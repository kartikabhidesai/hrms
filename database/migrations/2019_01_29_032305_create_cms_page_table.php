<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_page', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('description');
            $table->integer('is_active')->default('1');
            $table->timestamps();
        });

        DB::table('cms_page')->insert(
        array('name' => 'Home Page','description' => 'test','is_active' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')) );
        DB::table('cms_page')->insert(
         array('name' => 'About us Page','description' => 'test','is_active' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('cms_page')->insert(
        array('name' => 'Support Page','description' => 'test','is_active' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('cms_page')->insert(
        array('name' => 'Login Page','description' => 'test','is_active' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('cms_page')->insert(
        array('name' => 'Signup Page','description' => 'test','is_active' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('cms_page')->insert(
        array('name' => 'Disclaimer Page','description' => 'test','is_active' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('cms_page')->insert(
        array('name' => 'Services Page','description' => 'test','is_active' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('cms_page')->insert(
        array('name' => 'Term and Condition Page','description' => 'test','is_active' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('cms_page')->insert(
        array('name' => 'Enquiry and contact Page ','description' => 'test','is_active' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('cms_page')->insert(
        array('name' => 'Login and register with social site','description' => 'Login and register with 
            social site ','is_active' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('cms_page')->insert(
        array('name' => 'Plan and package page','description' => 'plan and package page','is_active' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('cms_page')->insert(
        array('name' => 'Get free trial account ','description' => 'get free trial account','is_active' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('cms_page')->insert(
        array('name' => 'User guide page','description' => 'User guide page','is_active' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('cms_page')->insert(
        array('name' => 'Video tutorial about the requested feature','description' => 'video tutorial about the requested feature','is_active' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('cms_page')->insert(
        array('name' => 'client portfolio page','description' => 'client portfolio page ','is_active' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('cms_page')->insert(
        array('name' => 'Testimonial pages ','description' => 'testimonial pages ','is_active' => '1'));
        DB::table('cms_page')->insert(
        array('name' => 'FAQ Page','description' => 'FAQ Page ','is_active' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('cms_page')->insert(
        array('name' => 'Blog Page','description' => 'Blog Page ','is_active' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('cms_page')->insert(
        array('name' => 'News and event page','description' => 'News and event page','is_active' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('cms_page')->insert(
        array('name' => 'Knowladge base page','description' => 'knowladge base page','is_active' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
        DB::table('cms_page')->insert(
        array('name' => 'Ticket support page','description' => 'Ticket support page','is_active' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_page');
    }
}
