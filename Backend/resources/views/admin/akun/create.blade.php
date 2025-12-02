<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
</head>
<body>

<h2>Form Tambah User</h2>

<form action="{{ route('akun.admin.store') }}" method="POST">
    @csrf

    <div>
        <label>Nama:</label><br>
        <input type="text" name="nama" required>
    </div>

    <br>

    <div>
        <label>Email:</label><br>
        <input type="email" name="email" required>
    </div>

    <br>

    <div>
        <label>Password:</label><br>
        <input type="password" name="password" required>
    </div>

    <br>

    <div>
        <label>Role:</label><br>
        <select name="role" required>
            <option value="admin">Admin</option>
            <option value="pengguna">Pengguna</option>
            <option value="petugas">Petugas</option>
        </select>
    </div>

    <br>

    <button type="submit">Simpan</button>
</form>

</body>
</html>
