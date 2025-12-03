 @extends('layout')
 @section('title', 'e')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        .mobile-menu.open {
            transform: translateX(0);
        }
        .overlay {
            display: none;
        }
        .overlay.active {
            display: block;
        }
        .book-card {
            transition: transform 0.2s ease-in-out;
        }
        .book-card:hover {
            transform: translateY(-5px);
        }
        .scroll-container {
            max-height: 500px;
            overflow-y: auto;
        }
        .scroll-container::-webkit-scrollbar {
            width: 6px;
        }
        .scroll-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .scroll-container::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
        .scroll-container::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
    <!-- Check login status -->
    <!-- <script>
        if (!localStorage.getItem('isLoggedIn')) {
            window.location.href = 'login.html';
        }
    </script> -->

    <!-- Mobile Header -->
    <div class="lg:hidden bg-white shadow-sm border-b sticky top-0 z-30">
        <div class="flex justify-between items-center px-4 py-3">
            <div class="flex items-center space-x-3">
                <button onclick="toggleMobileMenu()" class="p-2 rounded-lg hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-lg font-bold text-gray-800">7hz Library</h1>
            </div>
            <button  
                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-sm transition">
                Logout
            </button>
        </div>
    </div>

        </div>

        <!-- Main Content -->
        <div class="flex-1 p-4 lg:p-6 w-full">
            <!-- Search Bar Mobile -->
            <div class="lg:hidden mb-6">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="searchInputMobile" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Cari judul, penulis, atau ISBN...">
                </div>
            </div>

            <!-- Dashboard Content -->
            <div id="dashboard-content" class="page-content">
                <!-- Header -->
                <div class="mb-6 lg:mb-8">
                    <h2 class="text-xl lg:text-2xl font-bold text-gray-800 mb-2">Dashboard Saya</h2>
                    <p class="text-gray-600 text-sm lg:text-base">Selamat Datang, Pengguna</p>
                </div>

                <!-- Stats Cards -->
                <div class="mb-6 lg:mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-white rounded-xl shadow-sm border p-5">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 mb-2">Buku Sedang Dipinjam</h3>
                                    <p class="text-3xl font-bold text-gray-800">{{ $buku_pinjam }}</p>
                                </div>
                                <div class="p-3 bg-blue-50 rounded-lg">
                                    <i class="fas fa-book text-blue-500 text-xl"></i>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm border p-5">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 mb-2">Melewati Batas Waktu</h3>
                                    <p class="text-3xl font-bold text-red-500">{{ $buku_jatuhTempo }}</p>
                                </div>
                                <div class="p-3 bg-red-50 rounded-lg">
                                    <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm border p-5">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 mb-2">Buku Menunggu Request </h3>
                                    <p class="text-3xl font-bold text-yellow-500">{{ $buku_req }}</p>
                                </div>
                                <div class="p-3 bg-yellow-50 rounded-lg">
                                    <i class="fas fa-bell text-yellow-500 text-xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-200 my-6 lg:my-8"></div>

                <!-- Rekomendasi Buku Section -->
                <div class="mb-6 lg:mb-8">
    <h3 class="text-lg lg:text-xl font-bold text-gray-800 mb-4">
        Rekomendasi Buku Hanya Untuk Mu
    </h3>

    <div id="recommendationContainer" 
         class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 pb-4">

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

    </div>
</div>
                          
                </div>
            </div>
        </div>
    </div>

   

    <script>
        // Tampilkan email user
        const userEmail = localStorage.getItem('userEmail') || 'm.halkal.alfat@gmail.com';
        document.getElementById('userEmail').textContent = userEmail;
        
        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.querySelector('.mobile-menu');
            const overlay = document.querySelector('.overlay');
            mobileMenu.classList.toggle('open');
            overlay.classList.toggle('active');
        }

        // Navigation functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners to book borrow buttons
            const borrowButtons = document.querySelectorAll('.book-card button');
            borrowButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const bookTitle = this.closest('.book-card').querySelector('h4').textContent;
                    alert(`Anda meminjam: ${bookTitle}`);
                });
            });
            
            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const searchInputMobile = document.getElementById('searchInputMobile');
            
            if (searchInput) {
                searchInput.addEventListener('keyup', function(e) {
                    if (e.key === 'Enter') {
                        performSearch(this.value);
                    }
                });
            }
            
            if (searchInputMobile) {
                searchInputMobile.addEventListener('keyup', function(e) {
                    if (e.key === 'Enter') {
                        performSearch(this.value);
                    }
                });
            }
        });

        // Perform search
        function performSearch(query) {
            if (query.trim() !== '') {
                alert(`Mencari: ${query}`);
                // In a real application, you would implement actual search logic here
            }
        }

        // Close mobile menu on resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                const mobileMenu = document.querySelector('.mobile-menu');
                const overlay = document.querySelector('.overlay');
                mobileMenu.classList.remove('open');
                overlay.classList.remove('active');
            }
        });




    </script>

    @endsection