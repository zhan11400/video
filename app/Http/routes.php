<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('pc.welcome');
});

//后台地址
Route::get('admin/login', 'Admin\LoginController@index');


//PC首页
Route::get('pc/index', 'Pc\IndexController@index');
