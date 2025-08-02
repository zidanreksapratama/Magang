<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login/company', [AuthController::class, 'loginCompany']);
Route::post('/login/tenant', [AuthController::class, 'loginTenant']);
Route::post('/register/karyawan', [AuthController::class, 'registerKaryawan']);
Route::post('/login/karyawan', [AuthController::class, 'loginKaryawan']);
Route::get('/news', [NewsController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/company/create-tenant', [AuthController::class, 'createTenant']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/news', [NewsController::class, 'store']);
});

Route::get('/tenant-companies', function () {
    return \App\Models\TenantCompany::select('id', 'name')->get();
});




Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);