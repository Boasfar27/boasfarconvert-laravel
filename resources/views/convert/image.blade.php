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

        @if (session('converted_images'))
            <div class="convert-success">
                <h3 class="convert-success-title">Konversi Berhasil!</h3>
                <p class="convert-success-message">{{ count(session('converted_images')) }} gambar telah dikonversi ke
                    format WebP.</p>

                <div class="convert-actions">
                    @if (count(session('converted_images')) > 1)
                        <a href="{{ route('convert.image.download-all', ['files' => implode(',', array_column(session('converted_images'), 'name'))]) }}"
                            class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                width="16" height="16"
                                style="display: inline-block; margin-right: 5px; vertical-align: text-top;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Unduh Semua (ZIP)
                        </a>
                    @endif
                </div>

                <div class="convert-result-gallery">
                    @foreach (session('converted_images') as $image)
                        <div class="convert-result-item">
                            <div class="convert-result-image">
                                <img src="{{ $image['path'] }}" alt="Converted WebP"
                                    onerror="this.onerror=null; this.src='{{ asset('images/placeholder.svg') }}';">
                            </div>
                            <p class="convert-result-filename">{{ $image['name'] }}</p>
                            <a href="{{ $image['path'] }}" download="{{ $image['name'] }}"
                                class="btn btn-primary download-link">
                                Unduh WebP
                            </a>
                        </div>
                    @endforeach
                </div>

                <a href="{{ route('convert.image.form') }}" class="btn btn-secondary" style="margin-top: 1.5rem;">
                    Konversi Gambar Lain
                </a>
            </div>
        @endif

        @if (session('webp_path'))
            <div class="convert-success">
                <h3 class="convert-success-title">Konversi Berhasil!</h3>

                <div class="convert-result">
                    <div class="convert-result-image">
                        <img src="{{ session('webp_path') }}" alt="Converted WebP"
                            onerror="this.onerror=null; this.src='{{ asset('images/placeholder.svg') }}'; console.log('Gambar tidak dapat dimuat:', '{{ session('webp_path') }}');">
                    </div>
                    <div class="convert-result-info">
                        <p class="convert-result-label">Gambar WebP telah dibuat:</p>
                        <p class="convert-result-filename">{{ session('webp_name') }}</p>

                        <a href="{{ session('webp_path') }}" download="{{ session('webp_name') }}"
                            class="btn btn-primary">
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
                <label for="image" class="form-label">Pilih Gambar (JPG/PNG) - Maksimal 5 File</label>
                <div class="file-upload-container" id="dropzone">
                    <input type="file" name="images[]" id="image" accept="image/jpeg,image/jpg,image/png"
                        class="file-upload" style="display: none;" required multiple>

                    <svg class="file-upload-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="file-upload-text">Klik untuk memilih gambar atau seret gambar ke sini</p>
                    <p class="file-upload-hint">Maksimal 5 file, masing-masing 2MB</p>
                    <div id="file-names" class="file-upload-name-list" style="display: none;"></div>
                </div>
                @error('images')
                    <p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
                @enderror
                @error('images.*')
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
                        <p class="feature-text">Website dengan gambar WebP akan loading lebih cepat, meningkatkan
                            pengalaman
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
                const fileNamesContainer = document.getElementById('file-names');
                const dropzone = document.getElementById('dropzone');

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
                fileInput.addEventListener('change', function() {
                    if (this.files && this.files.length > 0) {
                        displaySelectedFiles(this.files);
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

                    // Check if trying to upload more than 5 files
                    if (files.length > 5) {
                        showCustomAlert('Maksimal 5 file yang dapat dikonversi sekaligus.', 'error');
                        return;
                    }

                    fileInput.files = files;
                    displaySelectedFiles(files);
                }

                function displaySelectedFiles(files) {
                    // Clear previous list
                    fileNamesContainer.innerHTML = '';

                    // Check if trying to upload more than 5 files
                    if (files.length > 5) {
                        showCustomAlert('Maksimal 5 file yang dapat dikonversi sekaligus.', 'error');
                        fileInput.value = '';
                        fileNamesContainer.style.display = 'none';
                        return;
                    }

                    // Create list of file names
                    const fileList = document.createElement('ul');
                    fileList.className = 'file-list';

                    for (let i = 0; i < files.length; i++) {
                        const listItem = document.createElement('li');
                        listItem.className = 'file-item';
                        listItem.textContent = files[i].name;
                        fileList.appendChild(listItem);
                    }

                    fileNamesContainer.appendChild(fileList);
                    fileNamesContainer.style.display = 'block';
                }
            });
        </script>
    @endpush
@endsection
