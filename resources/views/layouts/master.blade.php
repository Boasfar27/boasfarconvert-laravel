<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Primary Meta Tags -->
    <title>{{ config('app.name') }} - @yield('title', 'Konversi Gambar dan Dokumen Online')</title>
    <meta name="title" content="{{ config('app.name') }} - Konversi Gambar dan Dokumen Online">
    <meta name="description"
        content="Boasfar Convert - Platform konversi file terbaik di Indonesia. Konversi gambar ke WebP, PDF ke Word, dan Word ke PDF dengan mudah dan gratis. Hasil konversi berkualitas tinggi.">
    <meta name="keywords"
        content="konversi gambar, konversi pdf, konversi word, webp converter, jpg to webp, png to webp, pdf to word, word to pdf, konversi online, konversi file gratis, indonesia">
    <meta name="author" content="Boasfar Convert">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Indonesia">
    <meta name="revisit-after" content="7 days">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ config('app.name') }} - Konversi Gambar dan Dokumen Online">
    <meta property="og:description"
        content="Platform konversi file terbaik di Indonesia. Konversi gambar ke WebP, PDF ke Word, dan Word ke PDF dengan mudah dan gratis.">
    <meta property="og:image" content="{{ asset('images/og-image.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ config('app.name') }} - Konversi Gambar dan Dokumen Online">
    <meta property="twitter:description"
        content="Platform konversi file terbaik di Indonesia. Konversi gambar ke WebP, PDF ke Word, dan Word ke PDF dengan mudah dan gratis.">
    <meta property="twitter:image" content="{{ asset('images/og-image.png') }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Google AdSense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7311209549685817"
        crossorigin="anonymous"></script>

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

    <!-- Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "{{ config('app.name') }}",
      "url": "{{ url('/') }}",
      "logo": "{{ asset('images/og-image.svg') }}",
      "sameAs": [
        "https://twitter.com/boasfarconvert",
        "https://facebook.com/boasfarconvert",
        "https://www.instagram.com/farhaaan____/"
      ],
      "description": "Platform konversi file terbaik di Indonesia. Konversi gambar ke WebP, PDF ke Word, dan Word ke PDF dengan mudah dan gratis."
    }
    </script>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "url": "{{ url('/') }}",
      "name": "{{ config('app.name') }} - Konversi Gambar dan Dokumen Online",
      "description": "Boasfar Convert - Platform konversi file terbaik di Indonesia. Konversi gambar ke WebP, PDF ke Word, dan Word ke PDF dengan mudah dan gratis.",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "{{ url('/convert') }}?q={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>
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
