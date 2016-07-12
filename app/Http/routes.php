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

// See /docs/routes.md for full documentation

Route::auth();

// General routes
Route::get('/home', 'HomeController@index');

// Product routes
Route::get('/product/search', 'ProductController@getSearchPage');
Route::get('/product/search/{keywords}/{category?}/{page?}/{sort?}', 'ProductController@search');
Route::post('/product/search', 'ProductController@formSearch');