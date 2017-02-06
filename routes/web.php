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
    Route::get('/register', 'Auth\RegisterController@getRegister');
    Route::post('/register', [
        'as' => 'register-user',
        'uses' => 'Auth\RegisterController@register',
    ]);
    Route::get('/login', 'Auth\LoginController@getLogin');
    Route::post('login', [
        'as' => 'login-user',
        'uses' => 'Auth\LoginController@login',
    ]);
    Route::get('/redirect/{provider}', 'User\SocialAuthController@redirect');
    Route::get('/callback/{provider}', 'User\SocialAuthController@callback');
});
Route::get('/home', 'HomeController@index');
Route::get('/logout', 'Auth\LoginController@logout');
Route::group(['prefix' => '/admin', 'middleware' => 'admin'], function () {
    Route::resource('/dashboard', 'Admin\DashboardController', ['only' => ['index', 'show']]);
    Route::resource('survey', 'Admin\SurveyController', ['only' => ['index', 'update']]);
    Route::post('/destroy-survey', 'Admin\SurveyController@destroySurvey');
    Route::resource('user', 'Admin\UserController', ['only' => ['index', 'update', 'show']]);
    Route::post('/change-status-user/{status}', 'Admin\UserController@changeStatus');
    Route::get('/search', 'Admin\UserController@search');
});

Route::group(['prefix' => '/survey', 'middleware' => 'auth'], function () {
    Route::get('/invite/send', 'SurveyController@inviteUser');
    Route::get('/invite/{token}', [
        'as' => 'invite',
        'uses' => 'SurveyController@answer',
    ]);
    Route::get('/user/detail', 'User\UserController@show');
    Route::post('/user/update', 'User\UserController@update');
});
Route::resource('/survey/public', 'SurveyController', ['only' => ['index', 'show']]);
