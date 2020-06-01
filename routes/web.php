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
    Route::get('/report', 'UserController@report');
    Route::post('/report_absent', 'UserController@report_absent');
    Route::post('/edit_active', 'UserController@edit_active');
    Route::get('/pass', 'UserController@pass');
    Route::post('/edit_pass', 'UserController@edit_pass');
    Route::get('/get_index', 'UserController@get_index');
    Route::post('/get_stupost', 'UserController@get_stupost');
    Route::get('/reportstu', 'UserController@reportstu');
    Route::post('/report_stu', 'UserController@report_stu');
    Route::post('/detale_stu', 'UserController@detale_stu');
    Route::get('/admins', 'UserController@admins');
    Route::post('/add_admin', 'UserController@add_admin');
    Route::get('/get_admin', 'UserController@get_admin');
    Route::post('/delete_admin', 'UserController@delete_admin');
});
Route::post('formSubmit', 'UserController@formSubmit');
// ********** student
Route::group(['prefix' => 'stu'], function () {
    Route::post('/login', 'StuController@login');
    Route::get('/index', 'StuController@index');
    Route::get('/getstu', 'StuController@getstu');
    Route::post('/get_branch_stu', 'StuController@get_branch_stu');
    Route::post('/show_dars', 'StuController@show_dars');
    Route::post('/show_film', 'StuController@show_film');
    Route::post('/play_film', 'StuController@play_film');
    Route::get('/lesson', 'StuController@lesson');
    Route::get('/film', 'StuController@film');
    Route::get('/play_film', 'StuController@play_a_film');
    Route::post('/onEnd', 'StuController@onEnd');
    Route::get('/profile', 'StuController@profile');
    Route::post('/get_profile_stu', 'StuController@get_profile_stu');
    Route::get('/pass', 'StuController@pass');
    Route::post('/edit_pass', 'StuController@edit_pass');
});
// ********** student
Route::group(['prefix' => 'teacher'], function () {
    Route::post('/login', 'TeacherController@login');
    Route::get('/index', 'TeacherController@index');
    Route::get('/getteach', 'TeacherController@getteach');
    Route::post('/get_paye_teacher', 'TeacherController@get_paye_teacher');
    Route::post('/get_lesson_teacher', 'TeacherController@get_lesson_teacher');
    Route::post('/get_reshte_teacher', 'TeacherController@get_reshte_teacher');
    Route::get('/profile', 'TeacherController@profile');
    Route::get('/dars', 'TeacherController@dars');
    Route::post('/get_branch_teacher', 'TeacherController@get_branch_teacher');
    Route::get('/pass', 'TeacherController@pass');
    Route::post('/edit_pass_teacher', 'TeacherController@edit_pass_teacher');
    Route::get('/plan', 'TeacherController@plan');
    Route::get('/reportstu', 'TeacherController@reportstu');
    Route::post('/report_stu_teacher', 'TeacherController@report_stu_teacher');
});
// ********** admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/index', 'AdminController@index');
    Route::post('/get_branch_admin', 'AdminController@get_branch_admin');
    Route::get('/film', 'AdminController@film');
    Route::get('/reportstu', 'AdminController@reportstu');
    Route::get('/report', 'AdminController@report');
    Route::get('/pass', 'AdminController@pass');
});