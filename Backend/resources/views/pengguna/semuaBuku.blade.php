@extends('layout')

@section('title', 'Daftar Buku')
@section('content')
 <div id="recommendationContainer" 
         class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 p-10">

        @foreach ($buku_all as $buku)
        <div class="book-card bg-white rounded-xl shadow-md border hover:shadow-lg transition overflow-hidden">

            <!-- Cover -->
        <a href="{{ route('buku.pengguna.id', $buku->id) }}">
            <div class="h-72 bg-gray-200 flex items-center justify-center">
                <img src="{{ asset('storage/' . $buku->cover)}}" 
                     alt="Cover Buku"
                     class="h-full w-full object-cover">
            </div>

            <!-- Judul -->
            <h3 class="text-center p-5 font-semibold text-gray-800">
                {{ $buku->judul }}
            </h3>
            </a>
        </div>
        @endforeach

@endsection