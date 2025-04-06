@extends('layouts.app')

@section('title', 'Konversi Gambar')

@section('content')
    <div class="card">
        <h1 class="text-2xl font-bold mb-2">Konversi Gambar ke WebP</h1>
        <p class="text-gray-600 mb-6">Optimalkan gambar Anda untuk web dengan format WebP yang lebih ringan</p>

        @if (session('webp_path'))
            <div class="mb-8 bg-green-50 p-6 rounded-lg border border-green-200">
                <h3 class="text-lg font-semibold text-green-700 mb-4">Konversi Berhasil!</h3>

                <div class="flex flex-col md:flex-row gap-6 items-center">
                    <div class="flex-1">
                        <img src="{{ session('webp_path') }}" alt="Converted WebP" class="max-w-full h-auto rounded shadow-md">
                    </div>
                    <div class="flex-1">
                        <p class="text-green-700 mb-2">Gambar WebP telah dibuat:</p>
                        <p class="font-medium mb-4">{{ session('webp_name') }}</p>

                        <a href="{{ session('webp_path') }}" download="{{ session('webp_name') }}"
                            class="btn-primary block text-center mb-2">
                            Unduh Gambar WebP
                        </a>

                        <a href="{{ route('convert.image.form') }}" class="btn-secondary block text-center">
                            Konversi Gambar Lain
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('convert.image') }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto">
            @csrf

            <div class="mb-6">
                <label for="image" class="block text-gray-700 mb-2">Pilih Gambar (JPG/PNG)</label>
                <div
                    class="border-2 border-dashed border-gray-300 rounded-md p-6 text-center hover:border-blue-400 transition-colors">
                    <input type="file" name="image" id="image" accept="image/jpeg,image/jpg,image/png"
                        class="hidden" required>
                    <label for="image" class="cursor-pointer">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="mt-1 text-sm text-gray-600">Klik untuk memilih gambar atau seret gambar ke sini</p>
                        <p class="mt-1 text-xs text-gray-500">Maksimal ukuran 2MB</p>
                    </label>
                    <p id="file-name" class="mt-2 text-sm text-blue-600 hidden"></p>
                </div>
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn-primary px-8">Konversi ke WebP</button>
            </div>
        </form>

        <div class="mt-12 bg-blue-50 p-6 rounded-lg">
            <h3 class="text-lg font-semibold text-blue-700 mb-2">Kenapa WebP?</h3>

            <div class="space-y-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mt-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-base font-medium text-blue-800">Ukuran File Lebih Kecil</h4>
                        <p class="text-blue-600">WebP bisa 25-34% lebih kecil daripada JPG dan PNG dengan kualitas visual
                            yang sama.</p>
                    </div>
                </div>

                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mt-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-base font-medium text-blue-800">Kecepatan Loading</h4>
                        <p class="text-blue-600">Website dengan gambar WebP akan loading lebih cepat, meningkatkan
                            pengalaman pengguna dan SEO.</p>
                    </div>
                </div>

                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mt-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-base font-medium text-blue-800">Dukungan Browser Modern</h4>
                        <p class="text-blue-600">WebP didukung oleh semua browser modern seperti Chrome, Firefox, Edge, dan
                            Safari.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const fileInput = document.getElementById('image');
                const fileNameDisplay = document.getElementById('file-name');

                fileInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        fileNameDisplay.textContent = 'File dipilih: ' + this.files[0].name;
                        fileNameDisplay.classList.remove('hidden');
                    }
                });
            });
        </script>
    @endpush
@endsection
