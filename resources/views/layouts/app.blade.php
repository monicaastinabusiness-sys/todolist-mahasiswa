<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Aplikasi Capstone')</title>
</head>
<body>
    {{-- Memanggil navbar di atas --}}
    @include('partials.navbar')

    {{-- Bagian isi halaman yang akan berubah-ubah --}}
    <main style="padding: 20px;">
        @yield('content')
    </main>

    {{-- Memanggil footer di bawah --}}
    @include('partials.footer')
</body>
</html>