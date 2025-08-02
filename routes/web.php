<?php

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [WebController::class, 'showLoginForm'])->name('login');
Route::post('/login', [WebController::class, 'login'])->name('login.submit');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [WebController::class, 'logout'])->name('logout');
    Route::get('/tenant', [WebController::class, 'indexTenant'])->name('tenant.index');
    Route::post('/tenant/create', [WebController::class, 'createTenant'])->name('tenant.create');
    Route::get('/tenant/{id}/edit', [WebController::class, 'editTenant'])->name('tenant.edit');
    Route::put('/tenant/{id}', [WebController::class, 'updateTenant'])->name('tenant.update');
    Route::delete('/tenant/{id}', [WebController::class, 'destroyTenant'])->name('tenant.destroy');
    Route::get('/tenant/create', [WebController::class, 'showCreateTenantForm'])->name('tenant.create.form');

});


