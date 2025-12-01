<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $akun = User::whereIn('role', ['pengguna', 'petugas'])->get();
        return response()->json(
            [
                'data' => $akun,
                'status' => '200 || Success',
            ], 200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        
        $hashedPassword = Hash::make($request->password);
        $akun = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $hashedPassword,
            'role' => 'pengguna'
        ]);
        if($akun){
           return response()->json([
               'message' => 'Berhasil',
               'data' => $akun
           ]);
        } else{
            return response()->json([
               'message' => 'Error'
           ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $akun = User::findOrFail($id);
        return response()->json($akun);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. Cari instance model User
    // Jika tidak ditemukan, Laravel otomatis melempar 404
    $user = User::findOrFail($id);

    // 2. Tentukan Aturan Validasi
    // 'email' harus unik KECUALI untuk user yang sedang diupdate ($id)
    $validationRules = [
        'nama' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        'role' => 'required|in:admin,pengguna,petugas',
        // Password bersifat opsional, tetapi jika ada, harus divalidasi
        'password' => 'nullable|string|min:8|confirmed',
    ];

    $validate = $request->validate($validationRules);

    // 3. Proses Update Data
    
    // Siapkan data untuk update. Kita akan mengabaikan field 'password' 
    // karena perlu di-hash secara terpisah.
    $dataToUpdate = [
        'nama' => $validate['nama'],
        'email' => $validate['email'],
        'role' => $validate['role'],
        // Catatan: Jika Anda ingin mengupdate 'email_verified_at', tambahkan logikanya di sini.
    ];
    
    // Cek dan hash password HANYA jika disediakan
    if (!empty($request->input('password'))) {
        $dataToUpdate['password'] = Hash::make($request->password);
    }
    
    // Lakukan pembaruan pada instance model yang sudah ditemukan
    $user->update($dataToUpdate);

    // 4. Berikan Respons Sukses
    return response()->json([
        'message' => 'Update Akun Berhasil',
        'status' => '200 | Ok',
        'data' => $user // Mengembalikan instance model User yang sudah diperbarui
    ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
         if($user){
            return response()->json([
                'message' => "Berhasil di hapus"
            ]);
        } else {
            return response()->json([
                'message' => "Gagal"
            ]);
        }
    }

    public function CountAllUsers(){
        $user = User::where('role',['petugas', 'pengguna'] )->count();
        if($user){
            return response()->json([
                'message' => 'Sukses',
                'data' => $user
            ]);
        }
    }
}
