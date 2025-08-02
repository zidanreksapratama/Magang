<?php

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [WebController::class, 'showLoginForm'])->name('login');
Route::post('/login', [WebController::class, 'login'])->name('login.submit');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [WebController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [WebController::class, 'logout'])->name('logout');
    Route::post('/tenant/create', [WebController::class, 'createTenant'])->name('tenant.create');
});


