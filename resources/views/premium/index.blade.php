@extends('layouts.app')

@section('title', 'Area Premium')

@section('content')
    <div class="card">
        <h1 class="text-2xl font-bold mb-6">Area Premium</h1>

        <div class="bg-gradient-to-r from-blue-100 to-purple-100 p-6 rounded-lg mb-8">
            <div class="flex items-center mb-4">
                <div class="bg-yellow-400 p-2 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-800" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>
                <h2 class="text-xl font-semibold ml-2">Selamat Datang di Area Premium!</h2>
            </div>
            <p class="text-gray-700">Terima kasih telah menjadi pengguna premium kami. Anda memiliki akses ke semua fitur
                premium Boasfar Convert.</p>
        </div>

        <h3 class="text-lg font-semibold mb-4">Fitur Premium yang Tersedia</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="border rounded-lg p-5 flex">
                <div class="rounded-full bg-blue-100 p-3 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-semibold">Konversi PDF ke Word</h4>
                    <p class="text-gray-600 text-sm mb-2">Konversi dokumen PDF ke Word dengan mudah dan cepat.</p>
                    <a href="{{ route('convert.pdf.form') }}" class="text-blue-600 hover:underline text-sm">Gunakan fitur
                        →</a>
                </div>
            </div>

            <div class="border rounded-lg p-5 flex">
                <div class="rounded-full bg-red-100 p-3 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-semibold">Konversi Word ke PDF</h4>
                    <p class="text-gray-600 text-sm mb-2">Konversi dokumen Word ke PDF dengan kualitas tinggi.</p>
                    <a href="{{ route('convert.pdf.form') }}" class="text-blue-600 hover:underline text-sm">Gunakan fitur
                        →</a>
                </div>
            </div>

            <div class="border rounded-lg p-5 flex">
                <div class="rounded-full bg-green-100 p-3 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-semibold">Konversi Gambar Batch</h4>
                    <p class="text-gray-600 text-sm mb-2">Konversi banyak gambar sekaligus ke format WebP.</p>
                    <span class="text-gray-500 text-sm">Segera hadir</span>
                </div>
            </div>

            <div class="border rounded-lg p-5 flex">
                <div class="rounded-full bg-purple-100 p-3 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-semibold">Kompresi PDF</h4>
                    <p class="text-gray-600 text-sm mb-2">Kompres ukuran file PDF tanpa mengurangi kualitas.</p>
                    <span class="text-gray-500 text-sm">Segera hadir</span>
                </div>
            </div>
        </div>

        <div class="bg-gray-100 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-2">Tentang Status Premium Anda</h3>
            <p class="text-gray-700 mb-4">Status premium Anda berlaku seumur hidup. Nikmati semua fitur premium tanpa
                batasan!</p>

            <h4 class="font-medium text-gray-800 mb-2">Perlu bantuan?</h4>
            <p class="text-gray-600">Jika Anda memiliki pertanyaan atau masalah dengan fitur premium, silakan hubungi tim
                dukungan kami di <a href="mailto:support@boasfarconvert.com"
                    class="text-blue-600 hover:underline">support@boasfarconvert.com</a>.</p>
        </div>
    </div>
@endsection
