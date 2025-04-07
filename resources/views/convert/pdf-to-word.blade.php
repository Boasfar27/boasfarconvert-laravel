@extends('layouts.master')

@section('title', 'Konversi PDF ke Word')

@section('content')
    <div class="convert-container">
        <h1 class="convert-heading">Konversi PDF ke Word</h1>
        <p class="convert-description">Konversi dokumen PDF menjadi file Word yang dapat diedit dengan mempertahankan format
            asli</p>

        @if (session('error'))
            <div class="convert-error">
                <h3 class="convert-error-title">Batas Konversi Tercapai</h3>
                <p class="convert-error-message">{{ session('error') }}</p>
                <a href="{{ route('premium') }}" class="btn btn-primary" style="margin-top: 1rem;">
                    Upgrade ke Premium
                </a>
            </div>
        @endif

        @if (session('info'))
            <div class="convert-info">
                <h3 class="convert-info-title">Informasi</h3>
                <p class="convert-info-message">{{ session('info') }}</p>
            </div>
        @endif

        <div class="convert-document-card">
            <form action="{{ route('convert.pdf-to-word') }}" method="POST" enctype="multipart/form-data"
                class="convert-form">
                @csrf

                <div class="form-group">
                    <label for="pdf" class="form-label">Pilih file PDF</label>
                    <div class="file-upload-container" id="pdf-dropzone">
                        <input type="file" name="pdf" id="pdf" accept="application/pdf" class="file-upload"
                            style="display: none;" required>

                        <svg class="file-upload-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="file-upload-text">Klik untuk memilih file PDF</p>
                        <p class="file-upload-hint">Maksimal ukuran 10MB</p>
                        <p id="pdf-name" class="file-upload-name" style="display: none;"></p>
                    </div>
                    @error('pdf')
                        <p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-submit">
                    <button type="submit" class="btn btn-primary">Konversi ke Word</button>
                </div>
            </form>
        </div>

        <div class="convert-features">
            <h3 class="convert-features-title">Keunggulan Fitur Konversi PDF ke Word</h3>

            <div class="feature-list">
                <div class="feature-item">
                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="feature-content">
                        <h4 class="feature-title">Tanpa Watermark</h4>
                        <p class="feature-text">Hasil konversi tanpa watermark dan tanpa batasan format.</p>
                    </div>
                </div>

                <div class="feature-item">
                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="feature-content">
                        <h4 class="feature-title">Kualitas Tinggi</h4>
                        <p class="feature-text">Mempertahankan format, gambar, dan tabel dokumen asli dengan sempurna.</p>
                    </div>
                </div>

                <div class="feature-item">
                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="feature-content">
                        <h4 class="feature-title">Ukuran File Lebih Besar</h4>
                        <p class="feature-text">Mendukung konversi file hingga 50MB untuk pengguna premium.</p>
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
                const pdfDropzone = document.getElementById('pdf-dropzone');

                // Handle file selection via input
                pdfInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        pdfNameDisplay.textContent = 'File dipilih: ' + this.files[0].name;
                        pdfNameDisplay.style.display = 'block';
                    }
                });

                // Handle click on the dropzone
                pdfDropzone.addEventListener('click', function() {
                    pdfInput.click();
                });

                // Implement drag and drop functionality
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    pdfDropzone.addEventListener(eventName, preventDefaults, false);
                });

                function preventDefaults(e) {
                    e.preventDefault();
                    e.stopPropagation();
                }

                ['dragenter', 'dragover'].forEach(eventName => {
                    pdfDropzone.addEventListener(eventName, function() {
                        highlight(pdfDropzone);
                    }, false);
                });

                ['dragleave', 'drop'].forEach(eventName => {
                    pdfDropzone.addEventListener(eventName, function() {
                        unhighlight(pdfDropzone);
                    }, false);
                });

                function highlight(element) {
                    element.style.borderColor = 'var(--color-purple-500)';
                    element.style.backgroundColor = 'rgba(124, 58, 237, 0.05)';
                }

                function unhighlight(element) {
                    element.style.borderColor = 'var(--color-gray-700)';
                    element.style.backgroundColor = 'transparent';
                }

                pdfDropzone.addEventListener('drop', function(e) {
                    handleDrop(e, pdfInput, pdfNameDisplay);
                }, false);

                function handleDrop(e, input, display) {
                    const dt = e.dataTransfer;
                    const files = dt.files;
                    input.files = files;

                    if (files && files[0]) {
                        display.textContent = 'File dipilih: ' + files[0].name;
                        display.style.display = 'block';
                    }
                }
            });
        </script>
    @endpush
@endsection
