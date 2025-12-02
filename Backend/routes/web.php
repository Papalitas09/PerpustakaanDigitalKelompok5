<?php

use App\Http\Controllers\Admin\UserManagement;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PenggunaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// contoh: return user jika sudah login via sanctum/session
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(['auth:sanctum']);

Route::get('/', function(){
    return redirect('login');
});

// AUTH
Route::get('/login', [AuthController::class, 'LoginView'])->name('login.view');
Route::post('/login', [AuthController::class, 'Login'])->name('login.process');
Route::get('/register', [AuthController::class, 'RegisterView'])->name('register.view');
Route::post('/register', [AuthController::class, 'Register'])->name('register.process');

// PENGGUNA (user role)
Route::middleware('check.role:pengguna')->group(function () {
    
    Route::get('/pengguna/dashboard', [PenggunaController::class, 'index'])->name('dashboard.pengguna');
    Route::get('/pengguna/buku/all', [PenggunaController::class, 'BukuShowAll'])->name('buku.show.pengguna');
    Route::get('/pengguna/buku/count', [BukuController::class, 'CountBukuPinjam'])->name('countBuku.pengguna');
    Route::get('/pengguna/buku/{id}', [BukuController::class, 'show'])->name('buku.pengguna.id');
    Route::post('/pengguna/minjam', [PeminjamanController::class, 'store'])->name('minjam.process.pengguna');
    Route::get('/pengguna/minjam', [PeminjamanController::class, 'index'])->name('minjam.show.pengguna');
});

// ADMIN
Route::middleware('check.role:admin')->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard.admin');
    Route::resource('/admin/akun', UserManagement::class);
    Route::resource('/admin/buku', BukuController::class);
    Route::get('/admin/userCount', [UserManagement::class, 'CountAllUsers']);
});

// PETUGAS
Route::middleware(['auth:sanctum', 'check.role:petugas'])->group(function () {
    Route::get('/petugas/requestMinjam', [PeminjamanController::class, 'ShowAllRequest'])->name('');
});
