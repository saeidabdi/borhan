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

Route::get('/', 'HomeController@index');

Route::group(['prefix'=>'user'],function(){
    Route::post('/login', 'UserController@login');
    Route::get('/index', 'UserController@index');
    Route::get('/getuser', 'UserController@getuser');
    Route::get('/branch', 'UserController@branch');
    Route::post('/add_branch', 'UserController@add_branch');
    Route::get('/get_branch', 'UserController@get_branch');
});
