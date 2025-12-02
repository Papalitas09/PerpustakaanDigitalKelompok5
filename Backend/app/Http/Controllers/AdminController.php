<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\User;

class AdminController extends Controller
{
    public function index(){
       $buku_pinjam = Peminjaman::all()->Count();
        $data_req = Peminjaman::where('status_perizinan', 'menunggu_respon')->Count();
        $peminjaman = Peminjaman::with(['user', 'buku'])->get();
        $akun = User::where('role', ['petugas', 'admin'])->count();
        return view('admin.dashboard', compact(['buku_pinjam', 'data_req', 'peminjaman', 'akun']));
    }


}
