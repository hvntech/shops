<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDb13 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('category');
        });

        Schema::drop('event_categories');

        Schema::table('admin_users', function (Blueprint $table) {
            $table->dropColumn('name');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('event_categories_id');
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
