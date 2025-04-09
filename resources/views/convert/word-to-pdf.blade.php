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

        @if (session('success'))
            <div class="convert-success">
                <h3 class="convert-success-title">Konversi Berhasil!</h3>
                <div class="convert-result">
                    <div class="convert-result-image">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                    </div>
                    <div class="convert-result-info">
                        <p class="convert-result-label">File Hasil Konversi:</p>
                        <p class="convert-result-filename">{{ session('pdf_name') }}</p>
                        <div class="convert-actions">
                            <a href="{{ session('pdf_path') }}" download="{{ session('pdf_name') }}"
                                class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                Download File
                            </a>
                        </div>
                    </div>
                </div>
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
                        <p class="feature-text">Menghasilkan dokumen PDF beresolusi tinggi yang siap dicetak atau
                            dibagikan.
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

                // Function to show custom styled alert
                function showCustomAlert(message, type = 'error') {
                    // Remove any existing alerts
                    const existingAlerts = document.querySelectorAll('.custom-alert');
                    existingAlerts.forEach(alert => alert.remove());

                    // Create alert container
                    const alertContainer = document.createElement('div');
                    alertContainer.className = `convert-${type} custom-alert`;

                    // Create alert title
                    const alertTitle = document.createElement('h3');
                    alertTitle.className = `convert-${type}-title`;
                    alertTitle.textContent = type === 'error' ? 'Error' :
                        type === 'info' ? 'Informasi' : 'Perhatian';

                    // Create alert message
                    const alertMessage = document.createElement('p');
                    alertMessage.className = `convert-${type}-message`;
                    alertMessage.textContent = message;

                    // Assemble alert
                    alertContainer.appendChild(alertTitle);
                    alertContainer.appendChild(alertMessage);

                    // Insert alert before the form
                    const form = document.querySelector('.convert-form');
                    form.parentNode.insertBefore(alertContainer, form);

                    // Auto remove after 5 seconds
                    setTimeout(() => {
                        alertContainer.remove();
                    }, 5000);
                }

                // Handle file selection via input
                wordInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        // Check file type
                        const fileName = this.files[0].name.toLowerCase();
                        if (!fileName.endsWith('.doc') && !fileName.endsWith('.docx')) {
                            showCustomAlert('Hanya file Word (.doc atau .docx) yang diperbolehkan', 'error');
                            this.value = '';
                            wordNameDisplay.style.display = 'none';
                            return;
                        }

                        // Check file size
                        if (this.files[0].size > 10 * 1024 * 1024) {
                            showCustomAlert('Ukuran file tidak boleh melebihi 10MB', 'error');
                            this.value = '';
                            wordNameDisplay.style.display = 'none';
                            return;
                        }

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

                    if (files && files[0]) {
                        // Check file type
                        const fileName = files[0].name.toLowerCase();
                        if (!fileName.endsWith('.doc') && !fileName.endsWith('.docx')) {
                            showCustomAlert('Hanya file Word (.doc atau .docx) yang diperbolehkan', 'error');
                            return;
                        }

                        // Check file size
                        if (files[0].size > 10 * 1024 * 1024) {
                            showCustomAlert('Ukuran file tidak boleh melebihi 10MB', 'error');
                            return;
                        }

                        input.files = files;
                        display.textContent = 'File dipilih: ' + files[0].name;
                        display.style.display = 'block';
                    }
                }
            });
        </script>
    @endpush
@endsection
