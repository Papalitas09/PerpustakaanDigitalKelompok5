@extends('layout')
@section('title', $buku->judul)

@section('content')
<div class="flex">

    <div class="w-full lg:ml-64 min-h-screen bg-gray-100 py-8 px-4 lg:px-8">
        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-xl overflow-hidden">

            {{-- Gambar --}}
            <div class="w-full h-80 lg:h-96 bg-gray-200">
                <img src="{{ $buku->cover }}" class="w-full h-full object-cover" alt="">
            </div>

            {{-- Detail --}}
            <div class="p-6 lg:p-8 space-y-6">

                {{-- FORM MULAI DI SINI --}}
                <form action="{{ route('minjam.process.pengguna') }}" method="POST">
                    @csrf

                    {{-- Input ID Buku --}}
                    <input type="hidden" name="buku_id" value="{{ $buku->id }}">

                    {{-- Input ID User --}}
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                    <h1 class="text-3xl lg:text-4xl font-bold">{{ $buku->judul }}</h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 py-4 border-y">
                        <div>
                            <p class="text-sm text-gray-500 uppercase">Pengarang</p>
                            <p class="text-lg font-medium">{{ $buku->pengarang }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 uppercase">Penerbit</p>
                            <p class="text-lg font-medium">{{ $buku->penerbit }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 uppercase">Tanggal Terbit</p>
                            <p class="text-lg font-medium">
                                {{ date('d M Y', strtotime($buku->tanggal_terbit)) }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 uppercase">ISBN</p>
                            <p class="text-lg font-medium">{{ $buku->isbn }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 uppercase">Stok Buku</p>
                            <p class="text-lg font-medium">
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full">
                                    {{ $buku->stok_buku }} tersedia
                                </span>
                            </p>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-2xl font-semibold mt-3">Deskripsi Buku</h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ $buku->deskripsi_buku }}
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 pt-4">
                        <a href="/buku" 
                            class="px-6 py-3 bg-gray-900 text-white rounded-lg text-center">
                            ← Kembali
                        </a>

                        <button type="submit"
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Pinjam Buku
                        </button>
                    </div>

                </form>
                {{-- FORM BERAKHIR DI SINI --}}

            </div>
        </div>
    </div>
</div>
@endsection
