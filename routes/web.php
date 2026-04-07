<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\HskListController;
use App\Http\Controllers\HskQuizController;
use App\Http\Controllers\HskTypeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/hsk-list', [HskListController::class, 'index']);
Route::get('/hsk-quiz', [HskQuizController::class, 'index']);
Route::get('/hsk-type', [HskTypeController::class, 'index']);
