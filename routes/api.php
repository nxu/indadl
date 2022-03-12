<?php

use App\Http\Controllers\DownloadController;
use App\Http\Middleware\LogApiRequests;

Route::post('/url', [DownloadController::class, 'getVideoUrl'])->middleware(LogApiRequests::class);
