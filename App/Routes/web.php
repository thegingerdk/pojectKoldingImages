<?php
Route::add('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::add('/login', ['as' => 'auth', 'uses' => 'AuthController@index']);