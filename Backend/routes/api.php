<?php

use App\Http\Controllers\Admin\UserManagement;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PenggunaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::post('/login', [AuthController::Class, 'Login'])->middleware('cors');
// Route::post('/register', [AuthController::Class, 'Register']);


// Route::get('/Buku', [BukuController::class, 'index']);
// Route::middleware(['auth:sanctum', 'check.role:pengguna'])->group(function () {
//     Route::get('/Pengguna/Buku/Count', [BukuController::class, 'CountBukuPinjam']);
//     Route::post('/Pengguna/minjam', [PeminjamanController::class, 'store']);
//     Route::get('/Pengguna/minjam', [PeminjamanController::class, 'index']);
// });

// Route::middleware(['auth:sanctum', 'check.role:admin'])->group(function () {
//     Route::apiResource('/Admin/Akun', UserManagement::class);
//     Route::apiResource('/Admin/Buku', BukuController::class);
//     Route::get('/Admin/userCount', [UserManagement::class, 'CountAllUsers']);
// });

// Route::middleware(['auth:sanctum', 'check.role:petugas'])->group(function () {
//     Route::get('/Petugas/requestMinjam', [PeminjamanController::class, 'ShowAllRequest']);
// });
