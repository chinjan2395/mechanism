<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::auth();
Route::get('/', ['uses' => 'HomeController@home']);

Route::group(array('prefix' => env('admin'), 'namespace' => 'Admin'), function () {
    Route::get('/admin', 'AdminController@index');

    Route::group(['middleware' => 'admin'], function () {

    });
});

Route::group(['middleware' => ['web', 'auth', 'permission']], function () {
    Route::get('dashboard', ['uses' => 'HomeController@dashboard', 'as' => 'home.dashboard']);
    //users
    Route::resource('user', 'UserController');
    Route::get('user/{user}/permissions', ['uses' => 'UserController@permissions', 'as' => 'user.permissions']);
    Route::post('user/{user}/save', ['uses' => 'UserController@save', 'as' => 'user.save']);
    Route::get('user/{user}/activate', ['uses' => 'UserController@activate', 'as' => 'user.activate']);
    Route::get('user/{user}/deactivate', ['uses' => 'UserController@deactivate', 'as' => 'user.deactivate']);
    Route::post('user/ajax_all', ['uses' => 'UserController@ajax_all']);

    //roles
    Route::resource('role', 'RoleController');
    Route::get('role/{role}/permissions', ['uses' => 'RoleController@permissions', 'as' => 'role.permissions']);
    Route::post('role/{role}/save', ['uses' => 'RoleController@save', 'as' => 'role.save']);
    Route::post('role/check', ['uses' => 'RoleController@check']);

});

Route::group(['middleware' => ['web']], function () {
    Route::resource('posts', 'PostsController');
    Route::resource('sheet', 'SheetController');

    //entry
    Route::resource('entry', 'EntryController');

    // API
    // entry
    Route::resource('api/entry', 'Api\\EntryController');
    Route::get('api/entry/{csrf}/csrf', 'Api\\EntryController@csrf');
});

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::resource('admin/product', 'Admin\\ProductController');
    Route::get('admin', 'Admin\\ProductController');
});