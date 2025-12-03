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
        .status-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
        }
        .status-dipinjam {
            background-color: #dbeafe;
            color: #1e40af;
        }
        .status-dikembalikan {
            background-color: #dcfce7;
            color: #166534;
        }
        .status-terlambat {
            background-color: #fef2f2;
            color: #dc2626;
        }
    </style>
    <!-- Check login status -->
            <!-- Pinjaman Saya Content -->
            <div id="my-loans-content" class="page-content ">
                <!-- Header -->
                <div class="mb-6 lg:mb-8">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-xl lg:text-2xl font-bold text-gray-800 mb-2">Riwayat Peminjaman </h2>
                            <p class="text-gray-600 text-sm lg:text-base">Buku yang sedang & sudah yang Anda pinjam</p>
                        </div>
                        <button onclick="goToDashboard()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition flex items-center space-x-2">
                            <i class="fas fa-arrow-left"></i>
                            <span>Kembali ke Dashboard</span>
                        </button>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="mb-6 lg:mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-white rounded-xl shadow-sm border p-5">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 mb-2">Total Diizinkan</h3>
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
                                    <h3 class="text-sm font-medium text-gray-500 mb-2">Akan Dikembalikan</h3>
                                    <p class="text-3xl font-bold text-yellow-500">{{ $buku_pinjam }}</p>
                                </div>
                                <div class="p-3 bg-yellow-50 rounded-lg">
                                    <i class="fas fa-clock text-yellow-500 text-xl"></i>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm border p-5">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 mb-2">Terlambat</h3>
                                    <p class="text-3xl font-bold text-red-500">{{ $buku_jatuhTempo }}</p>
                                </div>
                                <div class="p-3 bg-red-50 rounded-lg">
                                    <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-200 my-6 lg:my-8"></div>

                <!-- Daftar Pinjaman -->
                <div class="mb-6 lg:mb-8">
                    <h3 class="text-lg lg:text-xl font-bold text-gray-800 mb-4">Riwayat Peminjaman</h3>
                    
                    <div class="scroll-container">
                        @foreach ( $peminjaman_universal as $data )
                        <div class="space-y-4 pb-4">
                            <!-- Pinjaman 5 -->
                            <div class="book-card bg-white rounded-xl shadow-sm border p-5">
                                <div class="flex flex-col lg:flex-row lg:items-center justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-start space-x-4">
                                           @if(isset($data->buku->cover) && $data->buku->cover)
                                                {{--Jika cover disimpan di storage/app/public --}}
                                                <img src="{{ asset('storage/' . $data->buku->cover) }}" 
                                                    alt="{{ $data->buku->judul ?? 'Cover buku' }}" 
                                                    class="w-44 h-auto">
                                            @else
                                                {{--Fallback: icon sederhana atau gambar default --}}
                                                <img src="{{ asset('storage/' . '/images/default.jpg') }}" 
                                                    alt="Default cover" 
                                                    class="w-full h-full object-cover">
                                            @endif
                                            <div class="flex-1">
                                                <h4 class="font-bold text-gray-800 text-lg">{{ $data->buku->judul }}</h4>
                                                <p class="text-sm text-gray-600 mt-1">{{ $data->buku->pengarang }}</p>
                                                <div class="flex flex-wrap gap-2 mt-3">
                                                    <div class="flex items-center space-x-1 text-sm text-gray-500">
                                                        <i class="fas fa-calendar-alt"></i>
                                                        <span>Dipinjam: 30-11-2025</span>
                                                    </div>
                                                    <div class="flex items-center space-x-1 text-sm text-gray-500">
                                                        <i class="fas fa-calendar-check"></i>
                                                        <span>Jatuh Tempo: 14-12-2025</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 lg:mt-0 lg:ml-4 flex flex-col items-end space-y-2">
                                        <span class="status-badge status-dipinjam">{{ $data->status_peminjaman }}</span>
                                        <form action="{{ route('balikin', $data->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm transition">
                                                <i class="fas fa-undo-alt mr-1"></i> Kembalikan
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tampilkan email user
        const userEmail = localStorage.getItem('userEmail') || 'm.halkal.alfat@gmail.com';
        document.getElementById('userEmail').textContent = userEmail;
        
    

        // Function untuk kembali ke dashboard
   

        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.querySelector('.mobile-menu');
            const overlay = document.querySelector('.overlay');
            mobileMenu.classList.toggle('open');
            overlay.classList.toggle('active');
        }

        // Navigation functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners to menu items
            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => {
                item.addEventListener('click', function() {
                    const page = this.getAttribute('data-page');
                    if (page === 'dashboard') {
                        goToDashboard();
                    } else {
                        setActivePage(page);
                    }
                    
                    // Close mobile menu after selection
                    if (window.innerWidth < 1024) {
                        toggleMobileMenu();
                    }
                });
            });
            
            // Add event listeners to return book buttons
            const returnButtons = document.querySelectorAll('.bg-green-500');
            returnButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const bookTitle = this.closest('.book-card').querySelector('h4').textContent;
                    if (confirm(`Apakah Anda yakin ingin mengembalikan buku: ${bookTitle}?`)) {
                        alert(`Buku ${bookTitle} berhasil dikembalikan!`);
                        // In a real app, you would update the UI or refresh the page
                    }
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

        // Set active page and update menu
        function setActivePage(page) {
            // In a real application, you would navigate to different pages
            // For this demo, we'll just show an alert
            // alert(`Navigasi ke halaman: ${page}`);
            
            // Update active menu item
            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => {
                item.classList.remove('bg-blue-50', 'text-blue-600');
                item.classList.add('text-gray-600', 'hover:bg-gray-100');
                
                if (item.getAttribute('data-page') === page) {
                    item.classList.remove('text-gray-600', 'hover:bg-gray-100');
                    item.classList.add('bg-blue-50', 'text-blue-600');
                }
            });
        }

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