<?php

use App\Http\Controllers\Api\version2\CompleteTaskController;
use App\Http\Controllers\Api\version2\SummaryController;
use App\Http\Controllers\Api\version2\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('v2')->group(function () {
    Route::apiResource('/tasks', TaskController::class);
    Route::patch('/tasks/{task}/complete', CompleteTaskController::class);
    Route::get('/summaries', SummaryController::class);
});
