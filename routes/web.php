<?php

Route::get('/', 'HomeController@index');
Route::post('/url', 'HomeController@getVideoUrl');
