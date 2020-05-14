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

Route::group(['prefix' => 'user'], function () {
    Route::post('/login', 'UserController@login');
    Route::get('/index', 'UserController@index');
    Route::get('/getuser', 'UserController@getuser');
    Route::get('/branch', 'UserController@branch');
    Route::post('/add_branch', 'UserController@add_branch');
    Route::get('/get_branch', 'UserController@get_branch');
    Route::post('/delete_branch', 'UserController@delete_branch');
    Route::get('/paye', 'UserController@paye');
    Route::post('/add_paye', 'UserController@add_paye');
    Route::get('/get_paye', 'UserController@get_paye');
    Route::post('/delete_paye', 'UserController@delete_paye');
    Route::get('/reshte', 'UserController@reshte');
    Route::post('/add_reshte', 'UserController@add_reshte');
    Route::get('/get_reshte', 'UserController@get_reshte');
    Route::post('/delete_reshte', 'UserController@delete_reshte');
    Route::get('/dars', 'UserController@dars');
    Route::post('/add_lesson', 'UserController@add_lesson');
    Route::post('/get_lesson', 'UserController@get_lesson');
    Route::post('/delete_lesson', 'UserController@delete_lesson');
    Route::get('/teacher', 'UserController@teacher');
    Route::post('/add_teacher', 'UserController@add_teacher');
    Route::post('/give_class_toteacher', 'UserController@give_class_toteacher');
    Route::post('/get_teacher_class', 'UserController@get_teacher_class');
    Route::post('/delete_teacher_class', 'UserController@delete_teacher_class');
    Route::get('/get_teacher', 'UserController@get_teacher');
    Route::post('/delete_teacher', 'UserController@delete_teacher');
    Route::get('/stu', 'UserController@stu');
    Route::post('/add_stu', 'UserController@add_stu');
    Route::post('/get_lesson_stu', 'UserController@get_lesson_stu');
    Route::post('/give_class_tostu', 'UserController@give_class_tostu');
    Route::post('/get_stu_class', 'UserController@get_stu_class');
    Route::post('/stu_teacher_class', 'UserController@stu_teacher_class');
    Route::get('/get_stu', 'UserController@get_stu');
    Route::post('/delete_stu', 'UserController@delete_stu');
    Route::get('/film', 'UserController@film');
    Route::post('/change_lesson', 'UserController@change_lesson');
    Route::post('/add_film', 'UserController@add_film');
    Route::post('/allow_show', 'UserController@allow_show');
    Route::post('/get_film', 'UserController@get_film');
    Route::post('/delete_film', 'UserController@delete_film');
    Route::post('/edit_filmfunc', 'UserController@edit_filmfunc');
    Route::get('/exit_user', 'UserController@exit_user');
});
Route::post('formSubmit', 'UserController@formSubmit');
// ********** student
Route::group(['prefix' => 'stu'], function () {
    Route::post('/login', 'StuController@login');
    Route::get('/index', 'StuController@index');
    Route::get('/getstu', 'StuController@getstu');
});
