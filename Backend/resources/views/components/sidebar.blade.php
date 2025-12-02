<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body>
    <!-- Mobile Sidebar Overlay -->
        <div class="overlay fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden" onclick="toggleMobileMenu()"></div>

        <!-- Mobile Sidebar -->
        <div class="mobile-menu fixed left-0 top-0 w-64 bg-white h-full shadow-2xl z-50 lg:hidden">
            <!-- User Profile -->
            <div class="p-6 border-b">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold">MH</span>
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-800">Satiria</h2>
                        <p class="text-sm text-gray-600">Pengguna Biasa</p>
                    </div>
                </div>
            </div>

            <!-- Menu -->
            <nav class="p-4">
                <div class="space-y-1">
                    <a href="{{ route('dashboard.pengguna') }}" class="menu-item bg-blue-50 text-blue-600 rounded-lg p-3 font-medium flex items-center space-x-3 block">
                        <i class="fas fa-chart-bar w-5"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="" class="menu-item text-gray-600 rounded-lg p-3 hover:bg-gray-100 cursor-pointer flex items-center space-x-3 block">
                        <i class="fas fa-book-open w-5"></i>
                        <span>All Books</span>
                    </a>
                    <a href="pinjamansaya.html" class="menu-item text-gray-600 rounded-lg p-3 hover:bg-gray-100 cursor-pointer flex items-center space-x-3 block">
                        <i class="fas fa-book w-5"></i>
                        <span>Pinjaman Saya</span>
                    </a>
                    <a href="riwayat.html" class="menu-item text-gray-600 rounded-lg p-3 hover:bg-gray-100 cursor-pointer flex items-center space-x-3 block">
                        <i class="fas fa-history w-5"></i>
                        <span>Riwayat Pinjaman</span>
                    </a>
                    <a href="profile.html" class="menu-item text-gray-600 rounded-lg p-3 hover:bg-gray-100 cursor-pointer flex items-center space-x-3 block">
                        <i class="fas fa-cog w-5"></i>
                        <span>Pengaturan Profil</span>
                    </a>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-200 my-4"></div>

                <!-- Logout -->
                <button onclick="logout()" class="w-full text-gray-600 rounded-lg p-3 hover:bg-gray-100 cursor-pointer flex items-center space-x-3">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span>Keluar</span>
                </button>
            </nav>
        </div>

        <!-- Desktop Sidebar -->
        <div class="hidden lg:block w-64 bg-white shadow-lg min-h-screen">
            <!-- User Profile -->
            <div class="p-6 border-b">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold">MH</span>
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-800">Satiria</h2>
                        <p class="text-sm text-gray-600">Pengguna Biasa</p>
                    </div>
                </div>
            </div>

            <!-- Menu -->
            <nav class="p-4">
                <div class="space-y-1">
                    <a href="dashboard.html" class="menu-item bg-blue-50 text-blue-600 rounded-lg p-3 font-medium flex items-center space-x-3 block">
                        <i class="fas fa-chart-bar w-5"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="allbooks.html" class="menu-item text-gray-600 rounded-lg p-3 hover:bg-gray-100 cursor-pointer flex items-center space-x-3 block">
                        <i class="fas fa-book-open w-5"></i>
                        <span>All Books</span>
                    </a>
                    <a href="pinjamansaya.html" class="menu-item text-gray-600 rounded-lg p-3 hover:bg-gray-100 cursor-pointer flex items-center space-x-3 block">
                        <i class="fas fa-book w-5"></i>
                        <span>Pinjaman Saya</span>
                    </a>
                    <a href="riwayat.html" class="menu-item text-gray-600 rounded-lg p-3 hover:bg-gray-100 cursor-pointer flex items-center space-x-3 block">
                        <i class="fas fa-history w-5"></i>
                        <span>Riwayat Pinjaman</span>
                    </a>
                    <a href="profile.html" class="menu-item text-gray-600 rounded-lg p-3 hover:bg-gray-100 cursor-pointer flex items-center space-x-3 block">
                        <i class="fas fa-cog w-5"></i>
                        <span>Pengaturan Profil</span>
                    </a>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-200 my-4"></div>

                <!-- Logout -->
                <button onclick="logout()" class="w-full text-gray-600 rounded-lg p-3 hover:bg-gray-100 cursor-pointer flex items-center space-x-3">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span>Keluar</span>
                </button>
            </nav>
        </div>
</body>
</html>