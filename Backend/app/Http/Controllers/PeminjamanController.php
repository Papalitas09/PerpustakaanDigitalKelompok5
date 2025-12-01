<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $peminjaman = Peminjaman::where('user_id', $user->id)->get();
        if($peminjaman){
            return response()->json([
                'message' => 'Sukses',
                'data' => $peminjaman
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'buku_id' => 'required|exists:bukus,id',
        'user_id' => 'required|exists:users,id',
    ]);

    $userId = auth()->id();

    // Cek apakah buku tersedia
    $book = Buku::findOrFail($request->buku_id);

    $peminjaman = Peminjaman::create([
        'user_id' => $userId,
        'buku_id' => $book->id,
        'tanggal_minjam' => now(),
        'jatuh_tempo' => now()->addDays(7), // contoh 7 hari
        'status_peminjaman' => 'sedang_dipinjam',
        'status_perizinan' => 'menunggu_respon'
    ]);

    return response()->json([
        'message' => 'Peminjaman berhasil dibuat',
        'data' => $peminjaman
    ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
       return response()->json($peminjaman);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();
    }

     public function ShowAllRequest(){
        $peminjaman = Peminjaman::where('status_perizinan', 'menunggu_respon')->get();
        if($peminjaman){
            return response()->json([
                'Message' => 'berhasil',
                'data' => $peminjaman
            ]);
        } else{
             return response()->json([
                'Message' => 'gagal'
            ]);
        }
    }
}
