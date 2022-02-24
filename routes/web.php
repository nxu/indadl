<?php

use App\Http\Middleware\LogApiRequests;

Route::get('/', 'HomeController@index');
Route::post('/url', 'HomeController@getVideoUrl')->middleware(LogApiRequests::class);

Route::get('/api', 'HomeController@apiDocs');

Route::get('/downloader.php', 'HomeController@legacy');

Route::group(['prefix' => 'stats'], function () {
    Route::get('/', 'StatsController@index');
    Route::get('/24h', 'StatsController@last24h');
    Route::get('/7d', 'StatsController@last7d');
    Route::get('/14d', 'StatsController@last14d');
});
