<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
</head>
<body>

<div style="display: flex; min-height: 100vh;">

    <!-- Sidebar -->
    <aside style="width: 200px; padding: 20px; border-right: 1px solid #ccc;">
        <h3>Admin Perpustakaan</h3>
        <p>admin@library.com</p>

        <nav>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Book Management</a></li>
                <li><a href="#">User Management</a></li>
                <li><a href="#">Loans</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="{{ route('logout.process') }}">Log Out</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main style="flex: 1; padding: 20px;">

        <h1>User Account Management</h1>
        <p>Manage all users in the system.</p>

        <hr><br>

        <!-- Table -->
        <table border="1" cellspacing="0" cellpadding="8">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($akun as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        {{-- <td>{{ $user->created_at->format('d/m/Y')? }}</td> --}}

                        <td>
                            <a href="">Lihat</a> |
                            <a href="{{ route('akun.admin.edit', $user->id) }}">Edit</a> |

                            <form action="{{ route('akun.admin.destroy', $user->id) }}" 
                                  method="POST" 
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <br>

        <!-- Pagination -->
  

    </main>

</div>

</body>
</html>
