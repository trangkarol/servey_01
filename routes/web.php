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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('user.login');
});
Auth::routes();
Route::get('/home', 'HomeController@index');
Route::get('/redirect/{provider}', 'User\SocialAuthController@redirect');
Route::get('/callback/{provider}', 'User\SocialAuthController@callback');
Route::get('/logout', 'Auth\LoginController@logout');
Route::post('/login', 'Auth\LoginController@login');
