<?php

use App\Http\Middleware\LogApiRequests;

Route::get('/', 'HomeController@index');
Route::post('/url', 'HomeController@getVideoUrl')->middleware(LogApiRequests::class);

Route::get('/api', 'HomeController@apiDocs');

Route::get('/downloader.php', 'HomeController@legacy');
