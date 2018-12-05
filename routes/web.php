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
    return view('login');
});

Route::post('/login', 'LoginController@login');

Route::get('/login', function () {
    return view('login');
});

Route::get('/user/create', function () {
    return view('create_user');
});

Route::post('/user/create', 'LoginController@create');

Route::get('/delete/session', function () {
    return view('login');
});

Route::post('/delete/session', 'LoginController@deleteSession');

Route::get('/user/delete', function () {
    return view('delete_user');
});

Route::post('/user/delete', 'LoginController@deleteUser');

Route::get('/user/display', function () {
    return view('user/create');
});

Route::post('/user/display', 'LoginController@dispYourUsers');

Route::get('/user/test', function () {
    return view('create_user_displayed');
});

Route::get('/user/info', 'LoginController@getAllUsersInfo');

Route::get('/user/edit', function () {
    return view('edit_user');
});

Route::post('/user/edit', 'LoginController@editUser');