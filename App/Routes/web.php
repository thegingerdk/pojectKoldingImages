<?php
Route::get('/', [ 'as' => 'home', 'uses' => 'HomeController@index']);
Route::get('/login', [ 'as' => 'auth:view', 'uses' => 'AuthController@index']);
Route::get('/logout', [ 'as' => 'auth:logout', 'uses' => 'AuthController@logout']);

Route::post('/login', [ 'as' => 'auth:login', 'uses' => 'AuthController@login']);
Route::post('/register', [ 'as' => 'auth:register', 'uses' => 'AuthController@register']);