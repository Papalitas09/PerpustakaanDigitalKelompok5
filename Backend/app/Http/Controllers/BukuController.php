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
        $bukus = Buku::where('stok_buku', '>=', 1)->get();
        return view('petugas.buku.index', compact('bukus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('petugas.buku.create');
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
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif',
            'tanggal_terbit' => 'required',
            'deskripsi_buku' => 'string',
            'stok_buku' => 'required|integer',
            'isbn' => 'required'
        ]);

        if ($request->hasFile('cover')) {
                $file = $request->file('cover');
                $path = $file->store('covers', 'public');
                $validate['cover'] = $path;
            }

        $data = Buku::create($validate);
        if($data){
            return redirect()->route('buku.petugas.index');
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
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
       return view('petugas.buku.edit', compact('buku'));

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
            'pengarang' => 'required:string',
            'penerbit' => 'required|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'tanggal_terbit' => 'required',
            'deskripsi_buku' => 'string',
            'stok_buku' => 'required|integer',
            'isbn' => 'required'// Tambahkan validasi tipe string
        ]);

          if ($request->hasFile('cover')) {
                $file = $request->file('cover');
                $path = $file->store('covers', 'public');
                $validate['cover'] = $path;
            }
    // 3. Update instance model yang sudah ditemukan
        $buku->update($validate);
        
        // 4. Berikan Respons Sukses
        return redirect()->route('buku.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();
       return redirect()->route('buku.index');

    }

    public function CountBukuPinjam(){
        $user = Auth::user();
    }

     public function CountJatuhTempo(){
        $user = Auth::user();
        $buku = Buku::where('status_peminjaman', 'jatuh_tempo')->where('user_id', $user->id)->count();
    }

   
}
