<?php

use App\Http\Controllers\BukuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// //user
// Route::get('/Pengguna/Dashboard','');
// //admin
// Route::get('/Admin/Dashboard','');
// Route::apiResource('/Admin/Akun', );
Route::apiResource('/Admin/Buku', BukuController::class);

// //petugas
// Route::get('/petugas/Dashboard','');
// Route::apiResource('Petugas/Buku');