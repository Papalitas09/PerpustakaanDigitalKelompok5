<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = Buku::all();
        return response()->json(
            [
                'data' => $buku,
                'status' => '200 || Success',
            ], 200
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string',
            'pengarang' => 'required:string',
            'penerbit' => 'required|string',
            'cover' => 'required|string',
            'tanggal_terbit' => 'required',
            'deskripsi_buku' => 'string',
            'stok_buku' => 'required|integer',
            'isbn' => 'required'
        ]);

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $buku)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
    {
        //
    }
}
