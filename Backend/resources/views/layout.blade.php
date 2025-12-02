<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{-- <link rel="icon" href="{{ @yield('icon_path') }}"> --}}
    @vite('resources/css/app.css')
</head>
<body>
 {{-- Header --}}
    <header>
        @include('components.sidebar')
    </header>

    {{-- Main Content --}}
    <main class="container">
        @yield('content')
    </main>

    {{-- Footer --}}
    {{-- <footer>
        @include('footer')
    </footer> --}}
</body>
</html>