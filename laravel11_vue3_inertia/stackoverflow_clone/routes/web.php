<?php

use App\Http\Controllers\Api\AcceptAnswerController;
use App\Http\Controllers\Api\AnswersController;
use App\Http\Controllers\Api\FavoritesController;
use App\Http\Controllers\Api\QuestionsController;
use App\Http\Controllers\Api\VoteAnswerController;
use App\Http\Controllers\Api\VoteQuestionController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Auth routes
Auth::routes(['verify' => true]);

Route::view('/{any}', 'spa')->where('any', '.*');
Route::get('/', [QuestionsController::class, 'index']);

Route::middleware('verified')->group(function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('questions', QuestionsController::class)->except('show', 'index');
    Route::resource('questions.answers', AnswersController::class)->except(['create', 'show', 'index']);
    Route::post('/answers/{answer}/accept', AcceptAnswerController::class)->name('answers.accept');

    Route::post('/questions/{question}/favorites', [FavoritesController::class, 'store'])->name('questions.favorite');
    Route::delete('/questions/{question}/favorites', [FavoritesController::class, 'destroy'])->name('questions.unfavorite');

    Route::post('/questions/{question}/vote', VoteQuestionController::class);
    Route::post('/answers/{answer}/vote', VoteAnswerController::class);
});

Route::get('/questions/{question}/answers', [AnswersController::class, 'index'])->name('questions.answers.index');
Route::get('/questions/{slug}', [QuestionsController::class, 'show'])->name('questions.show');
Route::get('/questions', [QuestionsController::class, 'index'])->name('questions.index');
