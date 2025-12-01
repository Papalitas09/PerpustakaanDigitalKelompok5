<?php

namespace App\Models;
use App\Models\User;
use App\Models\Buku;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $fillable = ['tanggal_minjam', 'jatuh_tempo', 'status_peminjaman', 'status_perizinan', 'user_id', 'buku_id'];

    protected $table = 'peminjamen';
    public function User(){
        return $this->belongsTo(User::class);   
    }

    public function Buku(){
        return $this->belongsTo(Buku::class);   
    }
}
