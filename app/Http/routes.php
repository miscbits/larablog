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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix'=>'api'], function()
{
    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
    Route::post('authenticate', 'AuthenticateController@authenticate');

    Route::get('user', 'UserController@read');
    Route::get('user/{user}', 'UserController@show');
    Route::get('user/{user}/articles', 'ArticleController@userArticles');
    Route::post('user', 'UserController@create');
    Route::put('user/{user}', 'UserController@update');
    Route::delete('user/{user}', 'UserController@destory');
    
    Route::get('article', 'ArticleController@read');
    Route::get('article/{article}', 'ArticleController@show');
    Route::post('article', 'ArticleController@create');
    Route::put('article/{article}', 'ArticleController@update');
    Route::put('article/restore/{article}', 'ArticleController@restore');
    Route::delete('article/{article}', 'ArticleController@destory');
    
    Route::get('category/{category}', 'CategoryController@read');
    Route::post('category', 'CategoryController@create');
    Route::delete('category/{category}', 'CategoryController@destory');
});
Route::post('register', 'UserController@create');

Route::get('register/verify/{confirmationCode}', 'UserController@confirm');
