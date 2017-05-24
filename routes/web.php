<?php

Route::get('/', function () {
    abort(404);
});

Route::get('/admin/login', ['uses' => 'Admin\LoginController@login', 'as' => 'admin_show_login']);
Route::post('/admin/login', ['uses' => 'Admin\LoginController@doLogin', 'as' => 'admin_login']);

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin.auth'], function () {

    Route::get('/user', ['uses' => 'UserController@index', 'as' => 'user_index']);
    Route::get('/user/data', ['uses' => 'UserController@getUsers', 'as' => 'user_data']);
    Route::get('/user/create', ['uses' => 'UserController@create', 'as' => 'user_create']);
    Route::post('/user/store', ['uses' => 'UserController@store', 'as' => 'user_store']);
    Route::get('/user/{id}', ['uses' => 'UserController@view', 'as' => 'user_view']);
    Route::get('/user/update/{id}', ['uses' => 'UserController@showUpdate', 'as' => 'user_show_update']);
    Route::post('/user/update', ['uses' => 'UserController@update', 'as' => 'user_update']);
    Route::post('/user/delete', ['uses' => 'UserController@delete', 'as' => 'user_delete']);

    Route::get('/news', ['uses' => 'NewsController@index', 'as' => 'news_lists']);
    Route::get('/news/data', ['uses' => 'NewsController@getNews', 'as' => 'news_data']);
    Route::get('/news/create', ['uses' => 'NewsController@create', 'as' => 'news_create']);
    Route::post('/news/store', ['uses' => 'NewsController@store', 'as' => 'news_store']);
    Route::get('/news/update/{newsId}', ['uses' => 'NewsController@update', 'as' => 'news_update']);
    Route::delete('/news/delete/{newsId}', ['uses' => 'NewsController@delete', 'as' => 'news_delete']);
    Route::get('/news/newsListsDelete', ['uses' => 'NewsController@newsListsDelete', 'as' => 'news_delete_lists']);

    Route::get('/news/category', ['uses' => 'NewsController@newsCategories', 'as' => 'news_category_lists']);
    Route::get('/news/category/create', ['uses' => 'NewsController@newsCategoryCreate', 'as' => 'news_category_create']);
    Route::get('/news/category/update/{newsCategoryId}', ['uses' => 'NewsController@newsCategoryUpdate', 'as' => 'news_category_update']);
    Route::delete('/news/category/delete/{newsCategoryId}', ['uses' => 'NewsController@newsCategoryDelete', 'as' => 'news_category_delete']);
    Route::post('/news/category/store', ['uses' => 'NewsController@newsCategoryStore', 'as' => 'news_category_store']);
    Route::get('/news/category/data', ['uses' => 'NewsController@getNewCategories', 'as' => 'news_category_data']);
    Route::get('/news/category/newsCategoryListsDelete', ['uses' => 'NewsController@newsCategoryListsDelete', 'as' => 'news_category_delete_lists']);

    Route::get('/video', ['uses' => 'VideoController@index', 'as' => 'video_lists']);
    Route::get('/video/data', ['uses' => 'VideoController@getVideos', 'as' => 'video_data']);
    Route::delete('/video/delete/{videoId}', ['uses' => 'VideoController@delete', 'as' => 'video_delete']);
    Route::get('/video/videoListsDelete', ['uses' => 'VideoController@videoListsDelete', 'as' => 'video_delete_lists']);
    Route::get('/video/update/{videoId}', ['uses' => 'VideoController@update', 'as' => 'video_update']);
    Route::post('/video/update/{videoId}', ['uses' => 'VideoController@store', 'as' => 'video_store']);
    Route::get('/video/create', ['uses' => 'VideoController@create', 'as' => 'video_create']);
    Route::post('/video/store', ['uses' => 'VideoController@store', 'as' => 'video_store']);

    Route::get('/event', ['uses' => 'EventController@index', 'as' => 'event_lists']);
    Route::get('/event/data', ['uses' => 'EventController@getEvents', 'as' => 'event_data']);
    Route::delete('/event/delete/{eventId}', ['uses' => 'EventController@delete', 'as' => 'event_delete']);
    Route::get('/event/eventListsDelete', ['uses' => 'EventController@eventListsDelete', 'as' => 'event_delete_lists']);
    Route::get('/event/update/{eventId}', ['uses' => 'EventController@update', 'as' => 'event_update']);
    Route::post('/event/update/{eventId}', ['uses' => 'EventController@store', 'as' => 'event_store']);
    Route::get('/event/create', ['uses' => 'EventController@create', 'as' => 'event_create']);
    Route::post('/event/store', ['uses' => 'EventController@store', 'as' => 'event_store']);
    Route::get('/event/export', ['uses' => 'EventController@index', 'as' => 'event_export']);

    Route::get('/page/{type}', ['uses' => 'PageController@index', 'as' => 'page_edit']);
    Route::post('/page', ['uses' => 'PageController@update', 'as' => 'page_update']);

    Route::get('/logout', ['uses' => 'LoginController@logout', 'as' => 'logout']);
});
