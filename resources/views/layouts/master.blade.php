<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Boasfar Convert - Konversi gambar dan dokumen online dengan mudah">
    <meta name="keywords" content="konversi, gambar, webp, jpg, png, pdf, word, online, indonesia">
    <meta name="author" content="Boasfar Convert">
    <title>{{ config('app.name') }} - @yield('title', 'Konversi Gambar dan Dokumen Online')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Extra CSS -->
    @stack('styles')
</head>

<body>
    <!-- Header -->
    @include('partials.header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- SweetAlert Notifications -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonColor: '#6d28d9',
                    confirmButtonText: 'OK'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    title: 'Error!',
                    text: "{{ session('error') }}",
                    icon: 'error',
                    confirmButtonColor: '#6d28d9',
                    confirmButtonText: 'OK'
                });
            @endif

            @if (session('warning'))
                Swal.fire({
                    title: 'Perhatian!',
                    text: "{{ session('warning') }}",
                    icon: 'warning',
                    confirmButtonColor: '#6d28d9',
                    confirmButtonText: 'OK'
                });
            @endif

            @if (session('info'))
                Swal.fire({
                    title: 'Informasi',
                    text: "{{ session('info') }}",
                    icon: 'info',
                    confirmButtonColor: '#6d28d9',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>

    <!-- Scripts -->
    @stack('scripts')
</body>

</html>
