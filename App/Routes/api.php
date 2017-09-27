<?php

Route::getApi('/', ['as' => 'home', 'uses' => 'ApiController@index']);
Route::postApi('/upload', [ 'as' => 'upload', 'uses' => 'ApiController@upload']);
Route::postApi('/rate', [ 'as' => 'rate', 'uses' => 'ApiController@rate']);

