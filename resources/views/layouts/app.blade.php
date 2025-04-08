<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-900 text-gray-200 min-h-screen flex flex-col">
    <header class="bg-gray-800 border-b border-gray-700 shadow-xl">
        <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('welcome') }}" class="font-bold text-xl text-white flex items-center space-x-2"
                data-aos="fade-right">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>Boasfar Convert</span>
            </a>

            <div class="flex items-center space-x-6">
                <button id="dark-mode-toggle" class="text-gray-300 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

                @guest
                    <a href="{{ route('login') }}" class="nav-link" data-aos="fade-down" data-aos-delay="100">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-primary" data-aos="fade-down"
                        data-aos-delay="200">Daftar</a>
                @else
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center text-gray-300 hover:text-white">
                            <span class="mr-2">{{ Auth::user()->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                viewBox="0 0 16 16">
                                <path
                                    d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 mt-2 w-48 bg-gray-800 rounded-md shadow-lg py-1 z-50 border border-gray-700"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95">
                            <a href="{{ route('home') }}"
                                class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Dashboard</a>
                            <a href="{{ route('convert.index') }}"
                                class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Konversi</a>

                            @if (Auth::user()->isPremium() || Auth::user()->isAdmin())
                                <a href="{{ route('premium.index') }}"
                                    class="block px-4 py-2 text-sm text-yellow-500 hover:bg-gray-700">Premium</a>
                            @endif

                            @if (Auth::user()->isAdmin())
                                <a href="/admin" class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-700">Admin</a>
                            @endif

                            <hr class="my-1 border-gray-700">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-gray-700 hover:text-red-300">Keluar</button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </nav>
    </header>

    <main class="container mx-auto px-4 py-8 flex-grow">
        @if (session('success'))
            <div class="bg-green-900 border border-green-700 text-green-300 px-4 py-3 rounded-lg relative mb-6 shadow-lg"
                role="alert">
                <div class="flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-900 border border-red-700 text-red-300 px-4 py-3 rounded-lg relative mb-6 shadow-lg"
                role="alert">
                <div class="flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @if (session('info'))
            <div class="bg-gray-900 border border-gray-700 text-gray-300 px-4 py-3 rounded-lg relative mb-6 shadow-lg"
                role="alert">
                <div class="flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zm-1 7a1 1 0 01-1-1v-2a1 1 0 112 0v2a1 1 0 01-1 1z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('info') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>
