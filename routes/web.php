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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/api/user', 'Api\UserApiController@user_get');      //user get 接口
Route::post('/api/users', 'Api\UserApiController@user_post');      //user post 接口

Route::get('/testCurl', 'Text\TextController@testCurl');      //text 测试
Route::get('/text', 'Text\TextController@text')->Middleware('TextTime');      //text 测试

Route::post('/api/request', 'Api\RequestController@request');      //注册接口
Route::post('/api/login', 'Api\LoginController@login');      //登陆接口

Route::resource('/photos', 'Text\PhotoController');

