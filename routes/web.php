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


use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'Home\IndexController@index');
    Route::get('/cate', 'Home\IndexController@cate');
    Route::get('/article', 'Home\IndexController@artList');
    Route::get('admin/verifycode', 'Admin\LoginController@verifycode');
    Route::get('admin/encyty', 'Admin\IndexController@encyty');
    Route::match(['get', 'post'], 'admin/login', 'Admin\LoginController@login');

});
Route::group(['middleware' => ['web', 'admin.login'], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
//    Route::match(['get', 'post'], 'login', 'LoginController@login');
    Route::get('quit', 'LoginController@quit');
    Route::match(['get'], 'index', 'IndexController@index');
    Route::match(['get'], 'info', 'IndexController@info');
    Route::match(['get', 'post'], 'jumppass', 'IndexController@jumppass');
    Route::match(['get', 'post'], 'modifypass', 'IndexController@modifypass');
//类别管理
    Route::post('cate/changeOrder', 'CategoryController@changeOrder');
    Route::resource('cate', 'CategoryController');
//文章管理
    Route::resource('article', 'ArticleController');
    Route::match(['get', 'post'], 'article/upload', 'ArticleController@upload');

//友情链接
    Route::post('links/changeOrder', 'LinksController@changeOrder');
    Route::resource('links', 'LinksController');
//自定义导航
    Route::post('navs/changeOrder', 'NavsController@changeOrder');
    Route::resource('navs', 'NavsController');
//网站配置管理
    Route::get('config/putfile', 'ConfigController@putFile');
    Route::resource('config', 'ConfigController');
    Route::post('config/changeOrder', 'ConfigController@changeOrder');
    Route::post('config/modifyContent', 'ConfigController@modifyContent');
});
