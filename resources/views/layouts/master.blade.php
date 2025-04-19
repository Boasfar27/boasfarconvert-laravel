<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Primary Meta Tags -->
    <title>{{ config('app.name') }} - @yield('title', 'Konversi Gambar dan Dokumen Online')</title>
    <meta name="title" content="@yield('meta_title', config('app.name') . ' - Konversi Gambar dan Dokumen Online')">
    <meta name="description" content="@yield('meta_description', 'Boasfar Convert - Platform konversi file terbaik di Indonesia. Konversi gambar ke WebP, PDF ke Word, dan Word ke PDF dengan mudah dan gratis. Hasil konversi berkualitas tinggi.')">
    <meta name="keywords" content="@yield('meta_keywords', 'konversi gambar, konversi pdf, konversi word, webp converter, jpg to webp, png to webp, pdf to word, word to pdf, konversi online, konversi file gratis, indonesia')">
    <meta name="author" content="Boasfar Convert">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Indonesia">
    <meta name="revisit-after" content="7 days">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', $article->title ?? config('app.name') . ' - Konversi Gambar dan Dokumen Online')">
    <meta property="og:description" content="@yield('og_description', isset($article) ? Str::limit(strip_tags($article->content), 160) : 'Platform konversi file terbaik di Indonesia. Konversi gambar ke WebP, PDF ke Word, dan Word ke PDF dengan mudah dan gratis.')">
    <meta property="og:image" content="@yield('og_image', isset($article) ? asset($article->thumbnail_url) : asset('images/og-image.png'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="{{ config('app.name') }}">

    <!-- WhatsApp Specific -->
    <meta property="og:app_id" content="boasfarconvert">
    <meta property="og:locale" content="id_ID">
    <meta property="og:image:secure_url" content="@yield('og_image', isset($article) ? asset($article->thumbnail_url) : asset('images/og-image.png'))">
    <meta property="og:image:alt" content="@yield('og_title', $article->title ?? config('app.name') . ' - Konversi Gambar dan Dokumen Online')">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('og_title', $article->title ?? config('app.name') . ' - Konversi Gambar dan Dokumen Online')">
    <meta name="twitter:description" content="@yield('og_description', isset($article) ? Str::limit(strip_tags($article->content), 160) : 'Platform konversi file terbaik di Indonesia. Konversi gambar ke WebP, PDF ke Word, dan Word ke PDF dengan mudah dan gratis.')">
    <meta name="twitter:image" content="@yield('og_image', isset($article) ? asset($article->thumbnail_url) : asset('images/og-image.png'))">
    <meta name="twitter:creator" content="@boasfarconvert">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="msapplication-TileImage" content="{{ asset('favicon.png') }}">
    <meta name="msapplication-TileColor" content="#6d28d9">
    <meta name="theme-color" content="#6d28d9">

    <!-- Resource Hints -->
    <link rel="preconnect" href="https://pagead2.googlesyndication.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Google AdSense - Loaded with both async and defer -->
    <script async defer src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7311209549685817"
        crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- FontAwesome untuk ikon terbaru -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Alpine.js - Lazy loaded -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- SweetAlert2 - Loaded only when needed -->
    <script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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
