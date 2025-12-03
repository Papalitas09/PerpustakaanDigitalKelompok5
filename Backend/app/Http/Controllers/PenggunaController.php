<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengguna;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function BukuShowAll(){
        $buku_all = Buku::all();
        return view('pengguna.semuaBuku', compact(['buku_all']));
    }

    public function index()
    {
        $user = Auth::user();
        $buku_all = Buku::all();
        $buku_pinjam = Peminjaman::where('status_peminjaman', 'sedang_dipinjam')->where('user_id', $user->id)->where('status_perizinan', 'diizinkan')->count();
        $buku_req = Peminjaman::where('status_peminjaman', 'sedang_dipinjam')->where('user_id', $user->id)->where('status_perizinan', 'menunggu_respon')->count();
        $buku_jatuhTempo = Peminjaman::where('status_peminjaman', 'jatuh_tempo')->where('user_id', $user->id)->count();
        return view('pengguna.dashboard', compact(['buku_pinjam', 'buku_jatuhTempo', 'buku_all', 'buku_req']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengguna $pengguna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengguna $pengguna)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengguna $pengguna)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengguna $pengguna)
    {
        //
    }
}
