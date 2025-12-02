@extends('layout')
@section('title', 'Edit Buku')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-sm p-8">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Edit Buku</h2>
            <p class="text-gray-600 text-sm mt-1">Ubah data buku sesuai kebutuhan</p>
        </div>

        <!-- Form -->
        <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                <input type="text" name="judul" value="{{ old('judul', $buku->judul) }}" required 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Masukkan judul buku">
                @error('judul')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pengarang -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pengarang</label>
                <input type="text" name="pengarang" value="{{ old('pengarang', $buku->pengarang) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Nama pengarang">
                @error('pengarang')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Penerbit -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Penerbit</label>
                <input type="text" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Nama penerbit">
                @error('penerbit')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- ISBN -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">ISBN</label>
                <input type="text" name="isbn" value="{{ old('isbn', $buku->isbn) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="ISBN buku">
                @error('isbn')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Terbit -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Terbit</label>
                <input type="date" name="tanggal_terbit" value="{{ old('tanggal_terbit', $buku->tanggal_terbit) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('tanggal_terbit')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Stok Buku -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Stok Buku</label>
                <input type="number" name="stok_buku" value="{{ old('stok_buku', $buku->stok_buku) }}" required min="0"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Jumlah stok">
                @error('stok_buku')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Cover -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cover Buku</label>
                @if($buku->cover)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $buku->cover) }}" alt="Cover" class="w-20 h-28 object-cover rounded-md">
                        <p class="text-gray-500 text-xs mt-1">Gambar saat ini</p>
                    </div>
                @endif
                <input type="file" name="cover" accept="image/jpeg,image/png,image/jpg,image/gif"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent file:mr-2 file:py-1 file:px-2 file:border-0 file:text-xs file:bg-gray-100 file:text-gray-700 file:cursor-pointer">
                <p class="text-gray-500 text-xs mt-1">Maks 1MB (JPEG, PNG, GIF) - Kosongkan jika tidak ingin mengubah</p>
                @error('cover')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Buku</label>
                <textarea name="deskripsi_buku" required rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                    placeholder="Deskripsi singkat buku">{{ old('deskripsi_buku', $buku->deskripsi_buku) }}</textarea>
                @error('deskripsi_buku')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 pt-6">
                <a href="{{ route('buku.index') }}"
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-md text-gray-700 font-medium text-sm hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit"
                    class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-md font-medium text-sm hover:bg-blue-700 transition">
                    Perbarui
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
