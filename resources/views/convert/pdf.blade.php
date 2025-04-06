@extends('layouts.app')

@section('title', 'Konversi Dokumen')

@section('content')
    <div class="card">
        <h1 class="text-2xl font-bold mb-2">Konversi Dokumen</h1>
        <p class="text-gray-600 mb-6">Konversi PDF ke Word dan sebaliknya dengan mudah dan cepat</p>

        <div class="flex flex-col md:flex-row gap-8">
            <div class="flex-1 border rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    PDF ke Word
                </h2>

                <form action="{{ route('convert.pdf-to-word') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Pilih file PDF</label>
                        <div
                            class="border-2 border-dashed border-gray-300 rounded-md p-6 text-center hover:border-blue-400 transition-colors">
                            <input type="file" name="pdf" id="pdf" accept="application/pdf" class="hidden"
                                required>
                            <label for="pdf" class="cursor-pointer">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="mt-1 text-sm text-gray-600">Klik untuk memilih file PDF</p>
                                <p class="mt-1 text-xs text-gray-500">Maksimal ukuran 10MB</p>
                            </label>
                            <p id="pdf-name" class="mt-2 text-sm text-blue-600 hidden"></p>
                        </div>
                        @error('pdf')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn-primary w-full">Konversi ke Word</button>
                </form>
            </div>

            <div class="flex-1 border rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500 mr-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Word ke PDF
                </h2>

                <form action="{{ route('convert.word-to-pdf') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Pilih file Word</label>
                        <div
                            class="border-2 border-dashed border-gray-300 rounded-md p-6 text-center hover:border-blue-400 transition-colors">
                            <input type="file" name="word" id="word"
                                accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                class="hidden" required>
                            <label for="word" class="cursor-pointer">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="mt-1 text-sm text-gray-600">Klik untuk memilih file Word</p>
                                <p class="mt-1 text-xs text-gray-500">Maksimal ukuran 10MB</p>
                            </label>
                            <p id="word-name" class="mt-2 text-sm text-blue-600 hidden"></p>
                        </div>
                        @error('word')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn-primary w-full">Konversi ke PDF</button>
                </form>
            </div>
        </div>

        <div class="mt-12 bg-blue-50 p-6 rounded-lg">
            <h3 class="text-lg font-semibold text-blue-700 mb-2">Keunggulan Fitur Konversi Premium</h3>

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
                        <h4 class="text-base font-medium text-blue-800">Tanpa Watermark</h4>
                        <p class="text-blue-600">Hasil konversi tanpa watermark dan tanpa batasan format.</p>
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
                        <h4 class="text-base font-medium text-blue-800">Kualitas Tinggi</h4>
                        <p class="text-blue-600">Mempertahankan format, gambar, dan tabel dokumen asli dengan sempurna.</p>
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
                        <h4 class="text-base font-medium text-blue-800">Ukuran File Lebih Besar</h4>
                        <p class="text-blue-600">Mendukung konversi file hingga 50MB untuk pengguna premium.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const pdfInput = document.getElementById('pdf');
                const pdfNameDisplay = document.getElementById('pdf-name');

                pdfInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        pdfNameDisplay.textContent = 'File dipilih: ' + this.files[0].name;
                        pdfNameDisplay.classList.remove('hidden');
                    }
                });

                const wordInput = document.getElementById('word');
                const wordNameDisplay = document.getElementById('word-name');

                wordInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        wordNameDisplay.textContent = 'File dipilih: ' + this.files[0].name;
                        wordNameDisplay.classList.remove('hidden');
                    }
                });
            });
        </script>
    @endpush
@endsection
