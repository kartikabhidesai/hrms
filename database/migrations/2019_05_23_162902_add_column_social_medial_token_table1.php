<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class AddColumnSocialMedialTokenTable1 extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('social_media_token', function (Blueprint $table) {
             $table->renameColumn('account_key', 'account_id');
			 $table->string('account_type')->default('facebook')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('social_media_token', function (Blueprint $table) {
            //
        });
    }
}
