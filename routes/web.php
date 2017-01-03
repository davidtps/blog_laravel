<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/','Admin\LoginController@index');
Route::match(['get','post'],'admin/login','Admin\LoginController@login');

Route::get('admin/index', 'Admin\IndexController@index');
Route::get('admin/info', 'Admin\IndexController@info');

Route::get('admin/verifycode','Admin\LoginController@verifycode');
Route::get('admin/encyty','Admin\IndexController@encyty');
