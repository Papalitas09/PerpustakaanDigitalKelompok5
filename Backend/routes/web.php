<?php

use App\Http\Controllers\Admin\UserManagement;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PetugasController;
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
Route::post('logout', [AuthController::class, 'Logout'])->name('logout.process');

// PENGGUNA (user role)
Route::middleware('check.role:pengguna')->group(function () {
    
    Route::get('/pengguna/dashboard', [PenggunaController::class, 'index'])->name('dashboard.pengguna');
    Route::get('/pengguna/buku/all', [PenggunaController::class, 'BukuShowAll'])->name('buku.show.pengguna');
    Route::get('/pengguna/buku/count', [BukuController::class, 'CountBukuPinjam'])->name('countBuku.pengguna');
    Route::get('/pengguna/buku/{id}', [BukuController::class, 'show'])->name('buku.pengguna.id');
    Route::post('/pengguna/minjam', [PeminjamanController::class, 'store'])->name('minjam.process.pengguna');
    Route::get('/pengguna/minjam', [PeminjamanController::class, 'ShowPenggunaPeminjaman'])->name('minjam.show.pengguna');
    Route::get('/pengguna/minjam/riwayat', [PeminjamanController::class, 'ShowRiwayatPeminjaman'])->name('riwayat.minjam.pengguna');
    Route::put('/pengguna/balikin/{$id}', [PeminjamanController::class, 'Pengembalian'])->name('balikin');
});

// ADMIN
Route::middleware('check.role:admin')->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard.admin');
    Route::resource('/admin/akun', UserManagement::class)->names('akun.admin');
    Route::resource('/admin/peminjaman', PeminjamanController::class)->names('peminjaman.admin');
    Route::get('/admin/userCount', [UserManagement::class, 'CountAllUsers']);
});

Route::resource('/buku', BukuController::class)->middleware(['check.role:petugas,admin'])->names('buku');
Route::put('/admin/peminjaman/approve/{id}',[ PeminjamanController::class, 'Approve'])->middleware(['check.role:petugas,admin'])->name('approve.request');
Route::put('/admin/peminjaman/reject/{id}',[ PeminjamanController::class, 'Reject'])->middleware(['check.role:petugas,admin'])->name('reject.request');
// PETUGAS
Route::middleware(['auth:sanctum', 'check.role:petugas'])->group(function () {
    Route::get('/petugas/dashboard', [PetugasController::class, 'index'])->name('dashboard.petugas');
    Route::resource('/petugas/buku', BukuController::class)->names('buku.petugas');
    Route::get('petugas/peminjaman', [PeminjamanController::class, 'AnakIndex'])->name('peminjaman.all.petugas');
    Route::get('/petugas/requestMinjam', [PeminjamanController::class, 'ShowAllRequest'])->name('');
});
