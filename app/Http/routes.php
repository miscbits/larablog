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
Route::group(['middleware'=> 'jwt.auth'], function()
{
    Route::put('article/{article}', 'ArticleController@update');
    Route::post('article', 'ArticleController@create');
    Route::put('article/restore/{article}', 'ArticleController@restore');
    Route::delete('article/{article}', 'ArticleController@destory');

    Route::post('category', 'CategoryController@create');
    Route::delete('category/{category}', 'CategoryController@destory');
    
    Route::put('user/{user}', 'UserController@update');
    Route::delete('user/{user}', 'UserController@destory');
    
});

Route::post('register', 'UserController@create');
Route::get('register/verify/{confirmationCode}', 'UserController@confirm');
Route::post('authenticate', 'AuthenticateController@authenticate');

    Route::get('user', 'UserController@read');
    Route::get('user/{user}', 'UserController@show');
    Route::get('user/{user}/articles', 'ArticleController@userArticles');

    Route::post('user', 'UserController@create');
    
    Route::get('article', 'ArticleController@read');
    Route::get('article/{article}', 'ArticleController@show');

    Route::get('category', 'CategoryController@all');
    Route::get('category/{category}', 'CategoryController@read');

/*
|--------------------------------------------------------------------------
| Article Routes
|--------------------------------------------------------------------------
*/

Route::resource('articles', 'ArticleController', ['except' => ['show']]);
Route::post('articles/search', [
    'as' => 'articles.search',
    'uses' => 'ArticleController@search'
]);
