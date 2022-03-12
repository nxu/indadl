<?php

use App\Http\Controllers\StatsController;

Route::group(['prefix' => 'stats'], function () {
    Route::get('/', [StatsController::class, 'index']);
    Route::get('/24h', [StatsController::class, 'last24h']);
    Route::get('/7d', [StatsController::class, 'last7d']);
    Route::get('/14d', [StatsController::class, 'last14d']);
});
