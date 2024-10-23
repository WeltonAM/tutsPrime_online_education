<?php

use App\Http\Controllers\Api\AnswersController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\FavoritesController;
use App\Http\Controllers\Api\MyPostsController;
use App\Http\Controllers\Api\QuestionsController;
use App\Http\Controllers\Api\VoteAnswerController;
use App\Http\Controllers\Api\VoteQuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::post('/login', [LoginController::class, 'store'])->name('login');
Route::delete('/logout', [LoginController::class, 'destroy'])->middleware('auth:api')->name('logout');
Route::post('/register', [LoginController::class, 'store'])->name('register');

// Public questions routes
Route::get('/questions', [QuestionsController::class, 'index']);
Route::get('/questions/{question}-{slug}', [QuestionsController::class, 'show']);

// Protected routes
Route::middleware(['auth:api'])->group(function() {
    // Resource route for questions (excluding index)
    Route::apiResource('questions', QuestionsController::class)->except('index');

    // Resource route for answers nested under questions
    Route::apiResource('questions.answers', AnswersController::class)->only('index', 'store', 'show', 'update', 'destroy');

    // Additional routes
    Route::post('/questions/{question}/vote', [VoteQuestionController::class, 'store']);
    Route::post('/answers/{answer}/vote', [VoteAnswerController::class, 'store']);
    Route::post('/answers/{answer}/accept', [AnswersController::class, 'accept']);
    Route::post('/questions/{question}/favorites', [FavoritesController::class, 'store']);
    Route::delete('/questions/{question}/favorites', [FavoritesController::class, 'destroy']);
    Route::get('/my-posts', MyPostsController::class);
});

// User information route
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
