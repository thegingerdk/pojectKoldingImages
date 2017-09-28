<?php

Route::getApi('/', ['as' => 'home', 'uses' => 'ApiController@index']);
Route::getApi('/picture/delete', ['as' => 'delete', 'uses' => 'ApiController@delete']);
Route::postApi('/upload', [ 'as' => 'upload', 'uses' => 'ApiController@upload']);
Route::postApi('/rate', [ 'as' => 'rate', 'uses' => 'ApiController@rate']);

Route::getApi('/images', [ 'as' => 'images', 'uses' => 'ApiController@getImages']);

