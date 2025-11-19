<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = ['judul', 'pengarang', 'penerbit', 'cover', 'tanggal_terbit', 'deskripsi_buku', 'stok_buku', 'isbn'];
}
