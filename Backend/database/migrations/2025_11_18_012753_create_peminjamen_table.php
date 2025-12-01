<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_minjam');
            $table->date('jatuh_tempo');
            $table->enum('status_peminjaman',['sedang_dipinjam', 'sudah_dikembalikan', 'lewat_tempo']);
            $table->enum('status_perizinan',['ditolak', 'menunggu_respon', 'diizinkan'])->default('menunggu_respon');
            $table->foreignId('user_id');
            $table->foreignId('buku_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('buku_id')->references('id')->on('bukus')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
