<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDb12 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->tinyInteger('del_flag')->after('created_by');
        });

        Schema::table('admin_users', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->string('name', 128)->after('id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('avatar');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->tinyInteger('delete_flag')->after('password');
            $table->string('name', 128)->after('id');
        });

        Schema::table('partners', function (Blueprint $table) {
            $table->tinyInteger('del_flag')->after('banner');
        });

        Schema::table('videos', function (Blueprint $table) {
            $table->tinyInteger('category')->after('description');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->tinyInteger('delete_flag')->after('partners_id');
        });

        Schema::table('news', function (Blueprint $table) {
            $table->tinyInteger('delete_flag')->after('banner');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
