<?php

namespace App\Models;
use App\Models\Peminjaman;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = ['judul', 'pengarang', 'penerbit', 'cover', 'tanggal_terbit', 'deskripsi_buku', 'stok_buku', 'isbn'];

    public function Peminjaman(){
        return $this->hasMany(Peminjaman::class);
    }
}
