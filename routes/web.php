<?php

use App\Http\Controllers\AuthController;

Route::get('/registration', [AuthController::class, 'showRegistrationForm'])->name('registration');
Route::post('/registration', [AuthController::class, 'registerUser']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'loginUser']);

Route::get('/about', [AuthController::class, 'showAbout'])->name('about');
