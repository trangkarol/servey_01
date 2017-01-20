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

Auth::routes();
Route::group(['prefix' => '/', 'middleware' => 'guest'], function () {
    Route::get('/register-user', 'Auth\RegisterController@getRegister');
    Route::post('/register-user', [
        'as' => 'register-user',
        'uses' => 'Auth\RegisterController@register',
    ]);
    Route::get('/login-user', 'Auth\LoginController@getLogin');
    Route::post('login-user', [
        'as' => 'login-user',
        'uses' => 'Auth\LoginController@login',
    ]);
    Route::get('/redirect/{provider}', 'User\SocialAuthController@redirect');
    Route::get('/callback/{provider}', 'User\SocialAuthController@callback');
});
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/home', 'HomeController@index');
