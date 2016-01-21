<?php

/****************   Model binding into route **************************/
Route::model('material', 'App\Material');
Route::model('materialscategory', 'App\MaterialsCategory');
Route::model('language', 'App\Language');
Route::model('photoalbum', 'App\PhotoAlbum');
Route::model('photo', 'App\Photo');
Route::model('user', 'App\User');
Route::pattern('id', '[0-9]+');
Route::pattern('slug', '[0-9a-z-_]+');

/***************    Auth  routes  **********************************/
Route::group(['middleware' => 'auth'], function () {

    Route::get('options', 'MaterialsController@getOptions');
    Route::post('options', 'MaterialsController@postOptions');

    Route::get('material/edit_options/{id}', ['as' => 'material/edit_options', 'uses' => 'MaterialsController@getEditOptions']);
    Route::post('material/edit_options/{id}', ['as' => 'material/edit_options', 'uses' => 'MaterialsController@postEditOptions']);


    Route::post('material/{id}/edit_category', ['as' => 'material.edit_category', 'uses' => 'MaterialsController@editCategory']);
    Route::patch('material/{id}/edit_category', ['as' => 'material.update_category', 'uses' => 'MaterialsController@updateCategory']);

    Route::post('material/{id}/edit_file', ['as' => 'material.edit_file', 'uses' => 'MaterialsController@editFile']);
    Route::patch('material/{id}/edit_file', ['as' => 'material.update_file', 'uses' => 'MaterialsController@updateFile']);

    Route::get('material.get_download/{path}/{filename}', ['as' => 'material.get_download', 'uses' => 'MaterialsController@getDownload']);

    Route::get('material.destroy_file/{file}', ['as' => 'material.destroy_file', 'uses' => 'MaterialsController@destroyFile']);


    Route::resource('category', 'MaterialCategoryController',
        ['except' => ['show']]);
    Route::resource('material', 'MaterialsController',
        ['except' => ['show']]);

    Route::get('addLike', ['as' => 'addLike', 'uses' => 'MaterialsController@addLike']);

    Route::post('addStars', array('as' => 'addStars', 'uses' => 'MaterialsController@addStars'));

    Route::post('togglePrivate', array('as' => 'togglePrivate', 'uses' => 'MaterialsController@togglePrivate'));

});

/***************    Site routes  **********************************/
Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('about', 'PagesController@about');
Route::get('contact', 'PagesController@contact');

Route::get('materials', 'MaterialsController@index');
Route::get('material/{slug}', 'MaterialsController@show');

Route::post('search', array('as' => 'search', 'uses' => 'MaterialsController@search'));

Route::get('user/activate', 'Admin\UserController@activate');
Route::get('user/verify/{code}', 'Admin\UserController@verify');



Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'activated']], function () {

    # Admin Dashboard
    Route::get('dashboard', 'Admin\DashboardController@index');

    # Users

    Route::get('user/data', 'Admin\UserController@data');
    Route::get('user/{user}/show', 'Admin\UserController@show');
    Route::get('user/{user}/edit', 'Admin\UserController@edit');
    Route::get('user/{user}/delete', 'Admin\UserController@delete');
    Route::get('user/{user}/home', 'Admin\UserController@home');
    Route::get('user/home', 'Admin\UserController@home');
    Route::resource('user', 'Admin\UserController');
});


