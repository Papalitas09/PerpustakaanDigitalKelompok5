<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $peminjaman = Peminjaman::all();
       return view('admin.peminjaman.index', compact('peminjaman'));
    }

    public function AnakIndex(){
        $peminjaman = Peminjaman::all();
        return view('petugas.peminjaman.index', compact('peminjaman'));
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

   return redirect()->route('dashboard.pengguna');
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
    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $users = User::all();
        $bukus = Buku::all();

        return view('admin.peminjaman.edit', compact('peminjaman', 'users', 'bukus'));        
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    $request->validate([
        'tanggal_minjam' => 'required|date',
        'jatuh_tempo' => 'required|date',
        'status_peminjaman' => 'required|in:sedang_dipinjam,sudah_dikembalikan,lewat_tempo',
        'status_perizinan' => 'required|in:ditolak,menunggu_respon,diizinkan',
        'user_id' => 'required|exists:users,id',
        'buku_id' => 'required|exists:bukus,id',
    ]);

    $peminjaman = Peminjaman::findOrFail($id);
    $peminjaman->update($request->all());

    return redirect()->route('peminjaman.admin.index')
        ->with('success', 'Data peminjaman berhasil diperbarui.');
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

    public function ShowPenggunaPeminjaman(){
        $user = Auth::user();
        $peminjaman = Peminjaman::where('user_id', $user->id)->where('status_perizinan', 'diizinkan')->get();
        $buku_pinjam = Peminjaman::where('status_peminjaman', 'sedang_dipinjam')->where('user_id', $user->id)->where('status_perizinan', 'diizinkan')->count();
        $buku_jatuhTempo = Peminjaman::where('status_peminjaman', 'jatuh_tempo')->where('user_id', $user->id)->count();
         $buku_req = Peminjaman::where('status_peminjaman', 'sedang_dipinjam')->where('user_id', $user->id)->where('status_perizinan', 'menunggu_respon')->count();
        return view('pengguna.pinjaman', compact(['peminjaman', 'buku_pinjam', 'buku_jatuhTempo', 'buku_req']));
    }

    public function ShowRiwayatPeminjaman(){
        $user = Auth::user();
        $peminjaman_universal = Peminjaman::where('user_id', $user->id)->get();
        $buku_pinjam = Peminjaman::where('status_peminjaman', 'sedang_dipinjam')->where('user_id', $user->id)->where('status_perizinan', 'diizinkan')->count();
        $buku_jatuhTempo = Peminjaman::where('status_peminjaman', 'jatuh_tempo')->where('user_id', $user->id)->count();
         $buku_req = Peminjaman::where('status_peminjaman', 'sedang_dipinjam')->where('user_id', $user->id)->where('status_perizinan', 'menunggu_respon')->count();
        return view('pengguna.riwayatPinjam', compact(['peminjaman_universal', 'buku_pinjam', 'buku_jatuhTempo', 'buku_req']));
    }

    public function Approve($id){
        $peminjaman = Peminjaman::findOrFail($id);
        $buku = Buku::findOrFail($peminjaman->buku_id);

        if ($peminjaman->status_perizinan !== 'menunggu_respon') {
            return back()->withErrors(['status' => 'Peminjaman sudah diproses.']);
        }

        // if ($buku->stok < 1) {
        //     return back()->withErrors(['stok_buku' => 'Stok buku habis.']);
        // }

        // $buku->decrement('stok_buku');

         $peminjaman->update([
            'status_perizinan' => 'diizinkan'
        ]);

        return back()->with('success', 'Peminjaman telah disetujui.');
    }

      public function Reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status_perizinan !== 'menunggu_respon') {
            return back()->withErrors(['status' => 'Peminjaman sudah diproses.']);
        }

        $peminjaman->update([
            'status_perizinan' => 'ditolak'
        ]);

        return back()->with('success', 'Peminjaman telah ditolak.');
    }

    public function Pengembalian($id)
       
   {
       $peminjaman = Peminjaman::findOrFail($id);
       $peminjaman->update([
           'status_peminjaman' => 'sudah_dikembalikan',
           'tanggal_kembali' => now()
       ]);
       
       // Tambah stok buku
       $peminjaman->buku->increment('stok_buku');
       
       return redirect()->back()->with('success', 'Buku berhasil dikembalikan');
   }
    


}
