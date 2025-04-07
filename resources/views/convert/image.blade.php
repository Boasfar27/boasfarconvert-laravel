@extends('layouts.master')

@section('title', 'Konversi Gambar')

@section('content')
    <div class="convert-container">
        <h1 class="convert-heading">Konversi Gambar ke WebP</h1>
        <p class="convert-description">Optimalkan gambar Anda untuk web dengan format WebP yang lebih ringan</p>

        @if (session('error'))
            <div class="convert-error">
                <h3 class="convert-error-title">Batas Konversi Tercapai</h3>
                <p class="convert-error-message">{{ session('error') }}</p>
                <a href="{{ route('premium') }}" class="btn btn-primary" style="margin-top: 1rem;">
                    Upgrade ke Premium
                </a>
            </div>
        @endif

        @if (session('webp_path'))
            <div class="convert-success">
                <h3 class="convert-success-title">Konversi Berhasil!</h3>

                <div class="convert-result">
                    <div class="convert-result-image">
                        <img src="{{ session('webp_path') }}" alt="Converted WebP">
                    </div>
                    <div class="convert-result-info">
                        <p class="convert-result-label">Gambar WebP telah dibuat:</p>
                        <p class="convert-result-filename">{{ session('webp_name') }}</p>

                        <a href="{{ session('webp_path') }}" download="{{ session('webp_name') }}" class="btn btn-primary">
                            Unduh Gambar WebP
                        </a>

                        <a href="{{ route('convert.image.form') }}" class="btn btn-secondary" style="margin-top: 10px;">
                            Konversi Gambar Lain
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('convert.image') }}" method="POST" enctype="multipart/form-data" class="convert-form">
            @csrf

            <div class="form-group">
                <label for="image" class="form-label">Pilih Gambar (JPG/PNG)</label>
                <div class="file-upload-container" id="dropzone">
                    <input type="file" name="image" id="image" accept="image/jpeg,image/jpg,image/png"
                        class="file-upload" style="display: none;" required>

                    <svg class="file-upload-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="file-upload-text">Klik untuk memilih gambar atau seret gambar ke sini</p>
                    <p class="file-upload-hint">Maksimal ukuran 2MB</p>
                    <p id="file-name" class="file-upload-name" style="display: none;"></p>
                </div>
                @error('image')
                    <p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-submit">
                <button type="submit" class="btn btn-primary">Konversi ke WebP</button>
            </div>
        </form>

        <div class="convert-features">
            <h3 class="convert-features-title">Kenapa WebP?</h3>

            <div class="feature-list">
                <div class="feature-item">
                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="feature-content">
                        <h4 class="feature-title">Ukuran File Lebih Kecil</h4>
                        <p class="feature-text">WebP bisa 25-34% lebih kecil daripada JPG dan PNG dengan kualitas visual
                            yang sama.</p>
                    </div>
                </div>

                <div class="feature-item">
                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="feature-content">
                        <h4 class="feature-title">Kecepatan Loading</h4>
                        <p class="feature-text">Website dengan gambar WebP akan loading lebih cepat, meningkatkan pengalaman
                            pengguna dan SEO.</p>
                    </div>
                </div>

                <div class="feature-item">
                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="feature-content">
                        <h4 class="feature-title">Dukungan Browser Modern</h4>
                        <p class="feature-text">WebP didukung oleh semua browser modern seperti Chrome, Firefox, Edge, dan
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
                const dropzone = document.getElementById('dropzone');

                // Handle file selection via input
                fileInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        fileNameDisplay.textContent = 'File dipilih: ' + this.files[0].name;
                        fileNameDisplay.style.display = 'block';
                    }
                });

                // Handle click on the dropzone
                dropzone.addEventListener('click', function() {
                    fileInput.click();
                });

                // Handle drag and drop
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    dropzone.addEventListener(eventName, preventDefaults, false);
                });

                function preventDefaults(e) {
                    e.preventDefault();
                    e.stopPropagation();
                }

                ['dragenter', 'dragover'].forEach(eventName => {
                    dropzone.addEventListener(eventName, highlight, false);
                });

                ['dragleave', 'drop'].forEach(eventName => {
                    dropzone.addEventListener(eventName, unhighlight, false);
                });

                function highlight() {
                    dropzone.style.borderColor = 'var(--color-purple-500)';
                    dropzone.style.backgroundColor = 'rgba(124, 58, 237, 0.05)';
                }

                function unhighlight() {
                    dropzone.style.borderColor = 'var(--color-gray-700)';
                    dropzone.style.backgroundColor = 'transparent';
                }

                dropzone.addEventListener('drop', handleDrop, false);

                function handleDrop(e) {
                    const dt = e.dataTransfer;
                    const files = dt.files;
                    fileInput.files = files;

                    if (files && files[0]) {
                        fileNameDisplay.textContent = 'File dipilih: ' + files[0].name;
                        fileNameDisplay.style.display = 'block';
                    }
                }
            });
        </script>
    @endpush
@endsection
