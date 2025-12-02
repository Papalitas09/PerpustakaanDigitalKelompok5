<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku_all = Buku::all();
       return redirect()->route("dashboard.pengguna", compact("$buku_all"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'judul' => 'required|string',
            'pengarang' => 'required:string',
            'penerbit' => 'required|string',
            'cover' => 'required|string',
            'tanggal_terbit' => 'required',
            'deskripsi_buku' => 'string',
            'stok_buku' => 'required|integer',
            'isbn' => 'required'
        ]);
        $data = Buku::create($validate);
        if($data){
            return response()->json([
                'message' => 'Clear',
                'status' => '200 | Ok',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not Clear',
                'status' => 'error',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $buku = Buku::findOrFail($id);
         return view('pengguna.detailBuku', compact('buku'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
       

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

    // 2. Lakukan Validasi
    // Catatan: Jika validasi gagal, Laravel akan otomatis melempar 422 dan menghentikan eksekusi.
        $validate = $request->validate([
            'judul' => 'required|string',
            // PERBAIKAN SINTAKS: Ubah 'required:string' menjadi 'required|string'
            'pengarang' => 'required|string', 
            'penerbit' => 'required|string',
            'cover' => 'required|string',
            'tanggal_terbit' => 'required|date', // Tambahkan validasi tipe date jika kolom DB adalah date
            'deskripsi_buku' => 'string|nullable', // Tambahkan nullable jika deskripsi boleh kosong
            'stok_buku' => 'required|integer',
            'isbn' => 'required|string' // Tambahkan validasi tipe string
        ]);

    // 3. Update instance model yang sudah ditemukan
        $buku->update($validate);
        
        // 4. Berikan Respons Sukses
        return response()->json([
            'message' => 'Clear',
            'status' => '200 | Ok',
            'data' => $buku // Mengembalikan instance model yang sudah diperbarui
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();
        if($buku){
            return response()->json([
                'message' => "Berhasil di hapus"
            ]);
        } else {
            return response()->json([
                'message' => "Gagal"
            ]);
        }

    }

    public function CountBukuPinjam(){
        $user = Auth::user();
        $buku = Buku::where('status_peminjaman', 'sedang_dipinjam')->where('user_id', $user->id)->count();
    }

     public function CountJatuhTempo(){
        $user = Auth::user();
        $buku = Buku::where('status_peminjaman', 'jatuh_tempo')->where('user_id', $user->id)->count();
    }

   
}
