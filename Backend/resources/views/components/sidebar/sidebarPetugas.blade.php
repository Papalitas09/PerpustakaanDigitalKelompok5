 <!-- Menu -->
            <nav class="p-4 md:hidden">
                <div class="space-y-1">
                    <a href="{{ route('dashboard.pengguna') }}" class="menu-item bg-blue-50 text-blue-600 rounded-lg p-3 font-medium flex items-center space-x-3 block">
                        <i class="fas fa-chart-bar w-5"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="" class="menu-item text-gray-600 rounded-lg p-3 hover:bg-gray-100 cursor-pointer flex items-center space-x-3 block">
                        <i class="fas fa-book-open w-5"></i>
                        <span>All Books</span>
                    </a>
                    <a href="{{ route('minjam.show.pengguna') }}" class="menu-item text-gray-600 rounded-lg p-3 hover:bg-gray-100 cursor-pointer flex items-center space-x-3 block">
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
                <form action="{{ route('logout.process') }}" method="POST">
                    @csrf
                <button class="w-full text-gray-600 rounded-lg p-3 hover:bg-gray-100 cursor-pointer flex items-center space-x-3">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span>Keluar</span>
                </button>
                </form>
            </nav>
        </div>

        <!-- Desktop Sidebar -->
        <div class="hidden lg:block w-64 bg-white shadow-lg min-h-screen">
            <!-- User Profile -->
            <div class="p-6 border-b">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold">PS</span>
                    </div>
                    <div>
                       <h2 class="font-bold text-gray-800">
                             @auth
                                {{  ucfirst(Auth::user()->nama)}}
                            @endauth</h2>
                        <p class="text-sm text-gray-600">
                             @auth
                                {{  ucfirst(Auth::user()->role)}}
                            @endauth</p>
                    </div>
                </div>
            </div>

            <!-- Menu -->
            <nav class="p-4">
                <div class="space-y-1">
                    <a href="{{ route('dashboard.petugas') }}" class="menu-item bg-blue-50 text-blue-600 rounded-lg p-3 font-medium flex items-center space-x-3 block">
                        <i class="fas fa-chart-bar w-5"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('buku.petugas.index') }}" class="menu-item text-gray-600 rounded-lg p-3 hover:bg-gray-100 cursor-pointer flex items-center space-x-3 block">
                        <i class="fas fa-book-open w-5"></i>
                        <span>Data Buku</span>
                    </a>
                    <a href="{{ route('peminjaman.all.petugas') }}" class="menu-item text-gray-600 rounded-lg p-3 hover:bg-gray-100 cursor-pointer flex items-center space-x-3 block">
                        <i class="fas fa-book w-5"></i>
                        <span>Data Pinjaman</span>
                    </a>
                    {{-- <a href="{{ route('dashboard.pengguna') }}" class="menu-item text-gray-600 rounded-lg p-3 hover:bg-gray-100 cursor-pointer flex items-center space-x-3 block">
                        <i class="fas fa-cog w-5"></i>
                        <span>Pengaturan Profil</span>
                    </a> --}}
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-200 my-4"></div>

                <!-- Logout -->
               <form action="{{ route('logout.process') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-gray-600 rounded-lg p-3 hover:bg-gray-100 cursor-pointer flex items-center space-x-3">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span>Keluar</span>
                    </button>
                </form>

</form>
</nav>