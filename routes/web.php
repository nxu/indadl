<?php

Route::get('/', 'HomeController@index');
Route::post('/url', 'HomeController@getVideoUrl');
Route::get('/api', 'HomeController@apiDocs');

Route::get('/downloader.php', 'HomeController@legacy');
