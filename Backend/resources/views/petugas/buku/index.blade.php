@extends('layout')
@section('title', 'Daftar Buku')

@section('content')
<h2 class="text-2xl text-left font-bold">Data Buku</h2>
<a href="{{ route('buku.create')  }}" class="bg-green-600 text-white w-full px-4 py-1 rounded">Create Buku</a>
<div class="overflow-x-auto overflow-y-auto max-h-[500px] mt-4">

    <table class="min-w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-white text-black">
                <th class="border px-4 py-2">No</th>
                <th class="border px-4 py-2">Cover</th>
                <th class="border px-4 py-2">Judul</th>
                <th class="border px-4 py-2">Pengarang</th>
                <th class="border px-4 py-2">Penerbit</th>
                <th class="border px-4 py-2">Tanggal Terbit</th>
                <th class="border px-4 py-2">Stok</th>
                <th class="border px-4 py-2">ISBN</th>
                <th class="border px-4 py-2">Deskripsi</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($bukus as $index => $buku)
                <tr>
                    <td class="border px-4 py-2 text-center">
                        {{ $index + 1 }}
                    </td>

                    <td class="border px-4 py-2 text-center">
                        <img src="{{ asset('storage/' . $buku->cover) }}" 
                             class="w-12 h-16 object-cover mx-auto rounded shadow">
                    </td>

                    <td class="border px-4 py-2">
                        {{ $buku->judul }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $buku->pengarang }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $buku->penerbit }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $buku->tanggal_terbit }}
                    </td>

                    <td class="border px-4 py-2 text-center">
                        {{ $buku->stok_buku }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $buku->isbn }}
                    </td>

                    <td class="border px-4 py-2 max-w-[250px] truncate">
                        {{ $buku->deskripsi_buku }}
                    </td>
                    <td class="px-4 py-2 border text-center">
                            {{-- Setujui --}}
                    
                               
                                <a href="{{ route('buku.edit', $buku->id) }}" class="bg-blue-600 text-white w-full px-4 py-1 rounded">
                                    Edit
                                </a>
                         

                            {{-- Tolak --}}
                            <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-600 text-white w-full px-4 py-1 rounded">
                                    Delete
                                </button>
                            </form>
                        </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center border px-4 py-2">
                        <span class="text-gray-400">Belum ada buku terdaftar</span>
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>

</div>

@endsection
