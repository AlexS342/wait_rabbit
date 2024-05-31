<?php

use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ReviewController::class, 'index'])->name('review');
Route::post('/create', [ReviewController::class, 'create'])->name('create');
Route::get('/captcha', [ReviewController::class, 'captcha'])->name('captcha');
