  @extends('layout')
 @section('title', 'e')

@section('content')
 <div class="overflow-x-auto overflow-y-auto max-h-[350px]">

        <table class="min-w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-white text-black">
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Nama Peminjam</th>
                    <th class="border px-4 py-2">Judul Buku</th>
                    <th class="border px-4 py-2">Tanggal Minjam</th>
                    <th class="border px-4 py-2">Jatuh Tempo</th>
                    <th class="border px-4 py-2">Status Peminjaman</th>
                    <th class="border px-4 py-2">Status Perizinan</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($peminjaman as $index => $item)
                    <tr>
                        <td class="border px-4 py-2">{{ $index + 1 }}</td>

                        <td class="border px-4 py-2">
                            {{ $item->user->nama }}
                        </td>

                        <td class="border px-4 py-2">
                            {{ $item->buku->judul }}
                        </td>

                        <td class="border px-4 py-2">
                            {{ $item->tanggal_minjam }}
                        </td>

                        <td class="border px-4 py-2">
                            {{ $item->jatuh_tempo }}
                        </td>

                        <td class="border px-4 py-2">
                            @if ($item->status_peminjaman == 'sedang_dipinjam')
                                <span class="text-blue-600 font-semibold">Sedang Dipinjam</span>
                            @elseif ($item->status_peminjaman == 'sudah_dikembalikan')
                                <span class="text-green-600 font-semibold">Sudah Dikembalikan</span>
                            @else
                                <span class="text-red-600 font-semibold">Lewat Tempo</span>
                            @endif
                        </td>

                        <td class="border px-4 py-2">
                            @if ($item->status_perizinan == 'menunggu_respon')
                                <span class="text-yellow-600 font-semibold">Menunggu</span>
                            @elseif ($item->status_perizinan == 'diizinkan')
                                <span class="text-green-600 font-semibold">Diizinkan</span>
                            @else
                                <span class="text-red-600 font-semibold">Ditolak</span>
                            @endif
                        </td>

                
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center border px-4 py-2">
                            <span class="text-gray-400">Tidak ada data peminjaman</span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    @endsection