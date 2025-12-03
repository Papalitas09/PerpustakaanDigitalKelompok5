@extends('layout')
<h2>Daftar Peminjaman</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Peminjam</th>
            <th>Buku</th>
            <th>Tanggal Minjam</th>
            <th>Jatuh Tempo</th>
            <th>Status Peminjaman</th>
            <th>Status Perizinan</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($peminjaman as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->user->nama }}</td>
                <td>{{ $p->buku->judul }}</td>

                <td>{{ $p->tanggal_minjam }}</td>
                <td>{{ $p->jatuh_tempo }}</td>

                <td>{{ $p->status_peminjaman }}</td>
                <td>{{ $p->status_perizinan }}</td>
                <td>
                     <form action="{{ route('approve.request', $p->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method("PUT")
                    <button type="submit">Diizinkan</button>
                    </form>

                    <form action="{{ route('reject.request', $p->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method("PUT")
                        <button type="submit">Ditolak</button>
                    </form>
                </td>

                {{-- <td>
                    <a href="{{ route('admin.peminjaman.edit', $p->id) }}">Edit</a>

                    <form action="{{ route('admin.peminjaman.destroy', $p->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td> --}}
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
