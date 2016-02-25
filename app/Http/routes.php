<?php

/****************   Model binding into route **************************/
Route::model('material', 'App\Material');
Route::model('materialscategory', 'App\MaterialsCategory');
Route::model('language', 'App\Language');
Route::model('user', 'App\User');
Route::pattern('id', '[0-9]+');
Route::pattern('slug', '[0-9a-z-_]+');

/***************    Site routes  **********************************/
Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('start_here', 'PagesController@startHere');
Route::get('why', 'PagesController@why');
Route::get('services', 'PagesController@services');
Route::get('content', 'PagesController@content');
Route::get('contact', ['as' => 'contact', 'uses' => 'PagesController@contact']);


Route::get('materials', 'MaterialsController@index');
Route::get('material/{slug}', 'MaterialsController@show');

Route::post('search', array('as' => 'search', 'uses' => 'MaterialsController@search'));
Route::post('filter', array('as' => 'filter', 'uses' => 'MaterialsController@postFilter'));
Route::get('filter', array('as' => 'filter', 'uses' => 'MaterialsController@postFilter'));
Route::patch('filter', array('as' => 'filter', 'uses' => 'MaterialsController@postFilter'));


Route::get('images/{filename}', function ($filename) {
    return Image::make(storage_path() . '/app/thumbs/' . $filename)->response();
});

Route::get('imagesIndex/{filename}', function ($filename) {
    $img = Image::make(storage_path() . '/app/thumbs/' . $filename);
    $img->fit(360, 240);
    return $img->response();
});

/***************    Auth  routes  **********************************/
Route::group(['middleware' => 'auth'], function () {

    Route::get('options', 'MaterialsController@getOptions');
    Route::post('options', 'MaterialsController@postOptions');

    Route::post('feedback', 'MaterialsController@feedback');

    Route::get('material/edit_options/{id}', ['as' => 'material/edit_options', 'uses' => 'MaterialsController@getEditOptions']);
    Route::post('material/edit_options/{id}', ['as' => 'material/edit_options', 'uses' => 'MaterialsController@postEditOptions']);


    Route::post('material/{id}/edit_category', ['as' => 'material.edit_category', 'uses' => 'MaterialsController@editCategory']);
    Route::patch('material/{id}/edit_category', ['as' => 'material.update_category', 'uses' => 'MaterialsController@updateCategory']);

    Route::post('material/{id}/edit_file', ['as' => 'material.edit_file', 'uses' => 'MaterialsController@editFile']);
    Route::patch('material/{id}/edit_file', ['as' => 'material.update_file', 'uses' => 'MaterialsController@updateFile']);

    Route::get('material.get_download/{file}', ['as' => 'material.get_download', 'uses' => 'MaterialsController@getDownload']);

    Route::get('remove_file/{file}', ['as' => 'remove_file', 'uses' => 'MaterialFileController@removeFile']);


    Route::resource('category', 'MaterialCategoryController',
        ['except' => ['show']]);
    Route::resource('material', 'MaterialsController',
        ['except' => ['show, index']]);

    Route::get('addLike/{id}', ['as' => 'addLike', 'uses' => 'MaterialsController@addLike']);
    Route::post('addLike/{id}', ['as' => 'addLike', 'uses' => 'MaterialsController@addLike']);

    Route::post('addStars', array('as' => 'addStars', 'uses' => 'MaterialsController@addStars'));

    Route::get('togglePrivate/{id}', array('as' => 'togglePrivate', 'uses' => 'MaterialsController@togglePrivate'));
    Route::post('togglePrivate/{id}', array('as' => 'togglePrivate', 'uses' => 'MaterialsController@togglePrivate'));
    Route::get('destroy/{id}', array('as' => 'destroy', 'uses' => 'MaterialsController@destroy'));

});

Route::group(['middleware' => 'auth'], function () {
    Route::post('upload', ['as' => 'upload-post', 'uses' => 'MaterialFileController@postUpload']);
    Route::post('upload/delete', ['as' => 'upload-remove', 'uses' => 'MaterialFileController@deleteUpload']);

});


Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('user/activate', 'Admin\UserController@activate');
Route::get('user/verify/{code}', 'Admin\UserController@verify');
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


