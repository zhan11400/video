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
Route::get('/', 'Admin\LoginController@index');

//验证码
Route::get('verify/captcha', 'VerifyController@captcha');

//后台地址
Route::get('admin/login', 'Admin\LoginController@index');
Route::post('admin/up_login', 'Admin\LoginController@up_login');
Route::post('admin/verify_login', 'Admin\LoginController@verify_login');

Route::get('admin/index', 'Admin\IndexController@index');
Route::get('home/index', 'Admin\HomeController@index');


//PC首页
Route::get('pc/index', 'Pc\IndexController@index');
