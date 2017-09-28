<?php
Route::get('/', [ 'as' => 'home', 'uses' => 'HomeController@index']);
Route::get('/javascript', [ 'as' => 'javascript', 'uses' => 'HomeController@javascript']);
Route::get('/images', [ 'as' => 'images', 'uses' => 'HomeController@images']);
Route::get('/login', [ 'as' => 'auth:view', 'uses' => 'AuthController@index']);
Route::get('/logout', [ 'as' => 'auth:logout', 'uses' => 'AuthController@logout']);

Route::post('/login', [ 'as' => 'auth:login', 'uses' => 'AuthController@login']);
Route::post('/register', [ 'as' => 'auth:register', 'uses' => 'AuthController@register']);