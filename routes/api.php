<?php

use App\Http\Controllers\Api\HskWordController;
use Illuminate\Support\Facades\Route;

Route::get('/hsk-words', [HskWordController::class, 'index']);
