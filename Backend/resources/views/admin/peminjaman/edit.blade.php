<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peminjaman</title>
</head>
<body>

<h2>Edit Data Peminjaman</h2>

<form action="{{ route('peminjaman.admin.update', $peminjaman->id) }}" method="POST">
    @csrf
    @method('PUT')

    {{-- Tanggal Minjam --}}
    <div>
        <label>Tanggal Minjam:</label><br>
        <input 
            type="date" 
            name="tanggal_minjam"
            value="{{ old('tanggal_minjam', $peminjaman->tanggal_minjam) }}"
            required
        >
    </div>

    <br>

    {{-- Jatuh Tempo --}}
    <div>
        <label>Jatuh Tempo:</label><br>
        <input 
            type="date" 
            name="jatuh_tempo"
            value="{{ old('jatuh_tempo', $peminjaman->jatuh_tempo) }}"
            required
        >
    </div>

    <br>

    {{-- Status Peminjaman --}}
    <div>
        <label>Status Peminjaman:</label><br>
        <select name="status_peminjaman" required>
            <option value="sedang_dipinjam" {{ old('status_peminjaman', $peminjaman->status_peminjaman) == 'sedang_dipinjam' ? 'selected' : '' }}>
                Sedang Dipinjam
            </option>
            <option value="sudah_dikembalikan" {{ old('status_peminjaman', $peminjaman->status_peminjaman) == 'sudah_dikembalikan' ? 'selected' : '' }}>
                Sudah Dikembalikan
            </option>
            <option value="lewat_tempo" {{ old('status_peminjaman', $peminjaman->status_peminjaman) == 'lewat_tempo' ? 'selected' : '' }}>
                Lewat Tempo
            </option>
        </select>
    </div>

    <br>

    {{-- Status Perizinan --}}
    <div>
        <label>Status Perizinan:</label><br>
        <select name="status_perizinan" required>
            <option value="menunggu_respon" {{ old('status_perizinan', $peminjaman->status_perizinan) == 'menunggu_respon' ? 'selected' : '' }}>
                Menunggu Respon
            </option>
            <option value="diizinkan" {{ old('status_perizinan', $peminjaman->status_perizinan) == 'diizinkan' ? 'selected' : '' }}>
                Diizinkan
            </option>
            <option value="ditolak" {{ old('status_perizinan', $peminjaman->status_perizinan) == 'ditolak' ? 'selected' : '' }}>
                Ditolak
            </option>
        </select>
    </div>

    <br>

    {{-- User --}}
    <div>
        <label>Peminjam (User):</label><br>
        <select name="user_id" required>
            @foreach ($users as $user)
                <option 
                    value="{{ $user->id }}" 
                    {{ old('user_id', $peminjaman->user_id) == $user->id ? 'selected' : '' }}
                >
                    {{ $user->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <br>

    {{-- Buku --}}
    <div>
        <label>Buku:</label><br>
        <select name="buku_id" required>
            @foreach ($bukus as $buku)
                <option 
                    value="{{ $buku->id }}" 
                    {{ old('buku_id', $peminjaman->buku_id) == $buku->id ? 'selected' : '' }}
                >
                    {{ $buku->judul }}
                </option>
            @endforeach
        </select>
    </div>

    <br>

    <button type="submit">Update</button>

</form>

</body>
</html>
