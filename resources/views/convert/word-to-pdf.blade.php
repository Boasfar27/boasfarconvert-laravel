@extends('layouts.master')

@section('title', 'Konversi Word ke PDF')

@section('content')
    <div class="convert-container">
        <h1 class="convert-heading">Konversi Word ke PDF</h1>
        <p class="convert-description">Konversi file Word menjadi PDF profesional dengan layout yang sempurna</p>

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
            <form action="{{ route('convert.word-to-pdf') }}" method="POST" enctype="multipart/form-data"
                class="convert-form">
                @csrf

                <div class="form-group">
                    <label for="word" class="form-label">Pilih file Word</label>
                    <div class="file-upload-container" id="word-dropzone">
                        <input type="file" name="word" id="word"
                            accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                            class="file-upload" style="display: none;" required>

                        <svg class="file-upload-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="file-upload-text">Klik untuk memilih file Word</p>
                        <p class="file-upload-hint">Maksimal ukuran 10MB</p>
                        <p id="word-name" class="file-upload-name" style="display: none;"></p>
                    </div>
                    @error('word')
                        <p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-submit">
                    <button type="submit" class="btn btn-primary">Konversi ke PDF</button>
                </div>
            </form>
        </div>

        <div class="convert-features">
            <h3 class="convert-features-title">Keunggulan Fitur Konversi Word ke PDF</h3>

            <div class="feature-list">
                <div class="feature-item">
                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="feature-content">
                        <h4 class="feature-title">Format Terjaga</h4>
                        <p class="feature-text">Layout dan format dokumen asli tetap dipertahankan dengan sempurna.</p>
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
                        <p class="feature-text">Menghasilkan dokumen PDF beresolusi tinggi yang siap dicetak atau dibagikan.
                        </p>
                    </div>
                </div>

                <div class="feature-item">
                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="feature-content">
                        <h4 class="feature-title">Kompabilitas</h4>
                        <p class="feature-text">PDF dapat dibuka di semua perangkat tanpa perlu software khusus.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const wordInput = document.getElementById('word');
                const wordNameDisplay = document.getElementById('word-name');
                const wordDropzone = document.getElementById('word-dropzone');

                // Handle file selection via input
                wordInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        wordNameDisplay.textContent = 'File dipilih: ' + this.files[0].name;
                        wordNameDisplay.style.display = 'block';
                    }
                });

                // Handle click on the dropzone
                wordDropzone.addEventListener('click', function() {
                    wordInput.click();
                });

                // Implement drag and drop functionality
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    wordDropzone.addEventListener(eventName, preventDefaults, false);
                });

                function preventDefaults(e) {
                    e.preventDefault();
                    e.stopPropagation();
                }

                ['dragenter', 'dragover'].forEach(eventName => {
                    wordDropzone.addEventListener(eventName, function() {
                        highlight(wordDropzone);
                    }, false);
                });

                ['dragleave', 'drop'].forEach(eventName => {
                    wordDropzone.addEventListener(eventName, function() {
                        unhighlight(wordDropzone);
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

                wordDropzone.addEventListener('drop', function(e) {
                    handleDrop(e, wordInput, wordNameDisplay);
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
