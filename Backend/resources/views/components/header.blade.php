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
    <!-- Desktop Header -->
    <div class="hidden lg:block bg-white shadow-sm border-b ">
        <div class="flex justify-between items-center px-6 py-4">
            <div class="flex items-center space-x-4">
                <h1 class="text-xl font-bold text-gray-800">7hz Library</h1>
                <!-- Search Bar -->
                <div class="relative w-96">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="searchInput" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Cari judul, penulis, atau ISBN...">
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <p class="text-sm text-gray-600">Welcome, <span class="font-medium">
                     @auth
                                {{  ucfirst(Auth::user()->email)}}
                    @endauth</h2></span></p>
                <form action="{{ route('logout.process') }}" method="POST">
                    @csrf
                <button 
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">
                    Logout
                </button>
                </form>
            </div>
        </div>
    </div>

    <div class="flex">
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
                        <h2 class="font-bold text-gray-800"> 
                            @auth
                                {{  ucfirst(Auth::user()->nama)}}
                            @endauth</h2></h2>
                        <p class="text-sm text-gray-600">
                             @auth
                                {{  ucfirst(Auth::user()->role)}}
                            @endauth</h2>
                        </p>
                    </div>
                </div>
            </div>

</body>
</html>