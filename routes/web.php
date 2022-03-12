<?php

use App\Http\Middleware\LogApiRequests;




Route::post('/url', 'DownloadController@getVideoUrl')->middleware(LogApiRequests::class);

Route::group(['prefix' => 'stats'], function () {
    Route::get('/', 'StatsController@index');
    Route::get('/24h', 'StatsController@last24h');
    Route::get('/7d', 'StatsController@last7d');
    Route::get('/14d', 'StatsController@last14d');
});
