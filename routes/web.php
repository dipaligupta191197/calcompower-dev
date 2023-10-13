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
Route::get('/', 'UserController@login')->name('loginview');
Route::post('/signin', 'UserController@signin')->name('login');
Route::get('/signup', 'UserController@signup')->name('signupview');
Route::post('/register', 'UserController@register')->name('signup');
Route::get('/forgot', 'UserController@forgot')->name('forgotview');
Route::post('/resetpassword', 'UserController@resetPassword')->name('forgot');
Route::get('/thankyou', 'UserController@thankyou')->name('thankyou');

Route::group(['middleware' => 'user'], function () {
    Route::get('/logout', 'UserController@logout')->name('logout');
    Route::get('/home', 'UserController@index')->name('index');
    Route::get('/settings', 'UserController@settings')->name('settings');
    Route::post('/profile', 'UserController@profile')->name('profile');
    Route::post('/changepassword', 'UserController@changePassword')->name('changepassword');
});
