<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitDb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject', 256);
            $table->text('description');
            $table->string('url', 256);
            $table->unsignedInteger('created_by');
            $table->timestamps();
        });

        Schema::create('admin_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 128);
            $table->string('password', 128);
            $table->string('first_name', 64);
            $table->string('last_name', 64);
            $table->tinyInteger('status');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 64);
            $table->string('last_name', 64);
            $table->string('email', 128);
            $table->string('mobile_phone', 16);
            $table->string('avatar', 256);
            $table->string('password', 128);
            $table->timestamps();
        });

        Schema::create('partners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 128);
            $table->string('logo', 256);
            $table->string('banner', 256);
            $table->text('description');
            $table->unsignedInteger('created_by');
            $table->timestamps();
        });

        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('partners_id');
            $table->string('name', 128);
            $table->string('link', 256);
            $table->string('thumbnail', 256);
            $table->text('description');
            $table->dateTime('upload_date');
            $table->timestamps();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('event_categories_id');
            $table->string('name', 128);
            $table->dateTime('datetime');
            $table->text('description');
            $table->unsignedInteger('fee');
            $table->string('location', 256);
            $table->text('notes');
            $table->string('event_banner', 256);
            $table->unsignedInteger('partners_id');
            $table->unsignedInteger('created_by');
            $table->timestamps();
        });

        Schema::create('event_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_name', 128);
            $table->unsignedInteger('created_by');
            $table->timestamps();
        });

        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('partner_id');
            $table->unsignedInteger('news_categories_id');
            $table->string('name', 128);
            $table->text('description');
            $table->string('banner', 256);
            $table->unsignedInteger('created_by');
            $table->timestamps();
        });

        Schema::create('news_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_name', 128);
            $table->unsignedInteger('created_by');
            $table->timestamps();
        });

        Schema::create('user_likes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('users_id');
            $table->unsignedInteger('like_content_id');
            $table->tinyInteger('type');
            $table->timestamps();
        });

        Schema::create('user_like_events', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('users_id');
            $table->unsignedInteger('events_id');
            $table->string('name', 128);
            $table->string('email', 128);
            $table->text('message');
            $table->timestamps();
        });

        Schema::create('user_event_registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('users_id');
            $table->unsignedInteger('events_id');
            $table->string('name', 128);
            $table->string('email', 128);
            $table->string('contact_number', 16);
            $table->timestamps();
        });

        Schema::create('user_follow_partners', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_follow_partners');
            $table->unsignedInteger('partners_id');
            $table->tinyInteger('status');
            $table->timestamps();
        });

        Schema::create('user_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('users_id');
            $table->unsignedInteger('comment_content_id');
            $table->text('comment');
            $table->tinyInteger('type');
            $table->timestamps();
        });

        Schema::create('user_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('users_id');
            $table->unsignedInteger('history_content_id');
            $table->tinyInteger('type');
            $table->timestamps();
        });

        Schema::create('page_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->text('text');
            $table->tinyInteger('type');
            $table->timestamps();
        });

        Schema::create('page_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
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
