<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>

<h2>Edit User</h2>

<form action="{{ route('akun.admin.update', $akun->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Nama:</label><br>
        <input 
            type="text" 
            name="nama" 
            value="{{ old('nama', $akun->nama) }}" 
            required
        >
    </div>

    <br>

    <div>
        <label>Email:</label><br>
        <input 
            type="email" 
            name="email" 
            value="{{ old('email', $akun->email) }}" 
            required
        >
    </div>

    <br>

    <div>
        <label>Password (kosongkan jika tidak diganti):</label><br>
        <input 
            type="password" 
            name="password"
        >
    </div>

    <br>

    <div>
        <label>Role:</label><br>
        <select name="role" required>
            <option value="pengguna" {{ old('role', $akun->role) == 'pengguna' ? 'selected' : '' }}>Pengguna</option>
            <option value="petugas"  {{ old('role', $akun->role) == 'petugas' ? 'selected' : '' }}>Petugas</option>
        </select>
    </div>

    <br>

    <button type="submit">Update</button>
</form>

</body>
</html>
