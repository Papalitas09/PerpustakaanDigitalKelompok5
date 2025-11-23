<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PenggunaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [AuthController::Class, 'Login']);

// //user
// Route::get('/Pengguna/Dashboard','');
// //admin
// Route::get('/Admin/Dashboard','');
Route::middleware(['auth:sanctum', 'check.role'])->group(function () {
    Route::apiResource('/Admin/Akun', PenggunaController::class);
    Route::apiResource('/Admin/Buku', BukuController::class);
});

// Route::apiResource('/Admin/Buku', );

// //petugas
// Route::get('/petugas/Dashboard','');
// Route::apiResource('Petugas/Buku');