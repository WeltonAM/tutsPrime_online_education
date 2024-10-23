<?php

use App\Http\Controllers\QuestionsController;
use Illuminate\Support\Facades\Route;

Route::resource('questions', QuestionsController::class);

