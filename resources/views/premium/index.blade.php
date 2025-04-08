@extends('layouts.master')

@section('title', 'Area Premium')

@section('content')
    <div class="premium-page">
        <div class="premium-card">
            <h1 class="premium-heading">Fitur Premium</h1>

            <div class="premium-welcome"
                style="background-color: var(--color-gray-900); padding: 1.5rem; border-radius: 0.75rem; margin-bottom: 2rem;">
                <div class="premium-welcome-header" style="display: flex; align-items: center; margin-bottom: 1rem;">
                    <div class="premium-badge"
                        style="display: flex; align-items: center; justify-content: center; width: 3rem; height: 3rem; background-color: #ffc107; border-radius: 50%; margin-right: 1rem;">
                        <svg class="premium-badge-icon" style="width: 1.5rem; height: 1.5rem; color: #121212;"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                    </div>
                    <h2 class="premium-welcome-title" style="font-size: 1.5rem; color: #ffc107; font-weight: 600;">Selamat
                        Datang di Premium</h2>
                </div>
                <p class="premium-welcome-text" style="color: var(--color-gray-300); font-size: 1rem; line-height: 1.5;">
                    Anda memiliki akses ke semua fitur premium. Nikmati konversi tanpa batas dan fitur-fitur eksklusif
                    lainnya.
                </p>
            </div>

            <h2 class="premium-section-title"
                style="font-size: 1.75rem; color: var(--color-white); margin-bottom: 1.5rem; font-weight: 600;">Fitur
                Tersedia</h2>

            <div class="premium-features"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                <div class="premium-feature"
                    style="background-color: var(--color-gray-900); border-radius: 0.75rem; padding: 1.5rem; display: flex; align-items: flex-start; transition: transform 0.3s ease;">
                    <div class="premium-feature-icon-container bg-blue-feature"
                        style="display: flex; align-items: center; justify-content: center; width: 3rem; height: 3rem; border-radius: 0.5rem; margin-right: 1rem; background-color: rgba(59, 130, 246, 0.2);">
                        <svg class="premium-feature-icon text-blue-feature"
                            style="width: 1.5rem; height: 1.5rem; color: #3b82f6;" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="premium-feature-content">
                        <h3 class="premium-feature-title"
                            style="font-size: 1.25rem; font-weight: 600; color: var(--color-white); margin-bottom: 0.5rem;">
                            Konversi PDF ke Word</h3>
                        <p class="premium-feature-description"
                            style="color: var(--color-gray-400); font-size: 0.875rem; margin-bottom: 0.75rem; line-height: 1.5;">
                            Ubah file PDF menjadi dokumen Word yang dapat diedit dengan mudah.
                        </p>
                        <a href="{{ route('convert.pdf-to-word.form') }}" class="premium-feature-link"
                            style="color: var(--color-purple-400); font-size: 0.875rem; font-weight: 500; display: inline-block;">Gunakan
                            Fitur →</a>
                    </div>
                </div>

                <div class="premium-feature"
                    style="background-color: var(--color-gray-900); border-radius: 0.75rem; padding: 1.5rem; display: flex; align-items: flex-start; transition: transform 0.3s ease;">
                    <div class="premium-feature-icon-container bg-red-feature"
                        style="display: flex; align-items: center; justify-content: center; width: 3rem; height: 3rem; border-radius: 0.5rem; margin-right: 1rem; background-color: rgba(239, 68, 68, 0.2);">
                        <svg class="premium-feature-icon text-red-feature"
                            style="width: 1.5rem; height: 1.5rem; color: #ef4444;" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="premium-feature-content">
                        <h3 class="premium-feature-title"
                            style="font-size: 1.25rem; font-weight: 600; color: var(--color-white); margin-bottom: 0.5rem;">
                            Konversi Word ke PDF</h3>
                        <p class="premium-feature-description"
                            style="color: var(--color-gray-400); font-size: 0.875rem; margin-bottom: 0.75rem; line-height: 1.5;">
                            Ubah dokumen Word menjadi file PDF yang aman dan mudah dibagikan.
                        </p>
                        <a href="{{ route('convert.word-to-pdf.form') }}" class="premium-feature-link"
                            style="color: var(--color-purple-400); font-size: 0.875rem; font-weight: 500; display: inline-block;">Gunakan
                            Fitur →</a>
                    </div>
                </div>

                <div class="premium-feature"
                    style="background-color: var(--color-gray-900); border-radius: 0.75rem; padding: 1.5rem; display: flex; align-items: flex-start; transition: transform 0.3s ease;">
                    <div class="premium-feature-icon-container bg-green-feature"
                        style="display: flex; align-items: center; justify-content: center; width: 3rem; height: 3rem; border-radius: 0.5rem; margin-right: 1rem; background-color: rgba(16, 185, 129, 0.2);">
                        <svg class="premium-feature-icon text-green-feature"
                            style="width: 1.5rem; height: 1.5rem; color: #10b981;" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="premium-feature-content">
                        <h3 class="premium-feature-title"
                            style="font-size: 1.25rem; font-weight: 600; color: var(--color-white); margin-bottom: 0.5rem;">
                            Konversi Gambar ke WebP</h3>
                        <p class="premium-feature-description"
                            style="color: var(--color-gray-400); font-size: 0.875rem; margin-bottom: 0.75rem; line-height: 1.5;">
                            Konversi JPG dan PNG ke format WebP yang lebih ringan.
                        </p>
                        <a href="{{ route('convert.image.form') }}" class="premium-feature-link"
                            style="color: var(--color-purple-400); font-size: 0.875rem; font-weight: 500; display: inline-block;">Gunakan
                            Fitur →</a>
                    </div>
                </div>

                <div class="premium-feature"
                    style="background-color: var(--color-gray-900); border-radius: 0.75rem; padding: 1.5rem; display: flex; align-items: flex-start; transition: transform 0.3s ease;">
                    <div class="premium-feature-icon-container bg-purple-feature"
                        style="display: flex; align-items: center; justify-content: center; width: 3rem; height: 3rem; border-radius: 0.5rem; margin-right: 1rem; background-color: rgba(139, 92, 246, 0.2);">
                        <svg class="premium-feature-icon text-purple-feature"
                            style="width: 1.5rem; height: 1.5rem; color: #8b5cf6;" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                    </div>
                    <div class="premium-feature-content">
                        <h3 class="premium-feature-title"
                            style="font-size: 1.25rem; font-weight: 600; color: var(--color-white); margin-bottom: 0.5rem;">
                            Kompresi PDF</h3>
                        <p class="premium-feature-description"
                            style="color: var(--color-gray-400); font-size: 0.875rem; margin-bottom: 0.75rem; line-height: 1.5;">
                            Kompresi file PDF dengan mempertahankan kualitas.
                        </p>
                        <span class="premium-feature-soon"
                            style="display: inline-block; font-size: 0.9rem; font-weight: 600; color: #ff9800; background-color: rgba(255, 152, 0, 0.15); padding: 0.25rem 0.75rem; border-radius: 4px; border: 1px dashed #ff9800; text-transform: uppercase; letter-spacing: 0.05em;">Segera
                            Hadir</span>
                    </div>
                </div>
            </div>

            <div class="premium-info"
                style="background-color: var(--color-gray-900); padding: 1.5rem; border-radius: 0.75rem;">
                <h3 class="premium-info-title"
                    style="font-size: 1.25rem; color: var(--color-white); margin-bottom: 1rem; font-weight: 600;">Tentang
                    Langganan Premium Anda</h3>
                <p class="premium-info-text"
                    style="color: var(--color-gray-400); font-size: 0.875rem; margin-bottom: 1.5rem; line-height: 1.5;">
                    Anda memiliki akses tanpa batas ke semua fitur premium. Nikmati konversi tanpa batasan dan fitur-fitur
                    eksklusif lainnya.
                </p>

                <h4 class="premium-help-title"
                    style="font-size: 1.125rem; color: var(--color-white); margin-bottom: 0.5rem; font-weight: 600;">Butuh
                    Bantuan?</h4>
                <p class="premium-help-text" style="color: var(--color-gray-400); font-size: 0.875rem; line-height: 1.5;">
                    Jika Anda memiliki pertanyaan atau masalah, silakan hubungi kami di <a
                        href="mailto:support@boasfarconvert.com" class="premium-feature-link"
                        style="color: var(--color-purple-400); font-weight: 500; text-decoration: none;">support@boasfarconvert.com</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Script untuk menangani interaksi dan responsif pada halaman premium -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Detect mobile devices untuk penyesuaian tambahan
            const isMobile = window.innerWidth < 768;

            // Efek hover untuk card fitur
            const features = document.querySelectorAll('.premium-feature');

            features.forEach(feature => {
                feature.addEventListener('mouseenter', function() {
                    if (!isMobile) { // Hindari efek hover pada mobile
                        this.style.transform = 'translateY(-5px)';
                        this.style.boxShadow =
                            '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)';
                    }
                });

                feature.addEventListener('mouseleave', function() {
                    if (!isMobile) {
                        this.style.transform = 'translateY(0)';
                        this.style.boxShadow = 'none';
                    }
                });
            });

            // Penyesuaian tampilan pada layar kecil
            const adjustLayout = () => {
                const currentWidth = window.innerWidth;
                const featureCards = document.querySelectorAll('.premium-feature');

                featureCards.forEach(card => {
                    if (currentWidth <= 375) {
                        card.style.flexDirection = 'column';
                        card.style.alignItems = 'center';
                        card.style.textAlign = 'center';

                        const iconContainer = card.querySelector('.premium-feature-icon-container');
                        if (iconContainer) {
                            iconContainer.style.marginRight = '0';
                            iconContainer.style.marginBottom = '1rem';
                        }

                        const content = card.querySelector('.premium-feature-content');
                        if (content) {
                            content.style.display = 'flex';
                            content.style.flexDirection = 'column';
                            content.style.alignItems = 'center';
                        }
                    } else {
                        card.style.flexDirection = '';
                        card.style.alignItems = '';
                        card.style.textAlign = '';

                        const iconContainer = card.querySelector('.premium-feature-icon-container');
                        if (iconContainer) {
                            iconContainer.style.marginRight = '1rem';
                            iconContainer.style.marginBottom = '';
                        }

                        const content = card.querySelector('.premium-feature-content');
                        if (content) {
                            content.style.display = '';
                            content.style.flexDirection = '';
                            content.style.alignItems = '';
                        }
                    }
                });
            };

            // Jalankan saat halaman dimuat dan saat ukuran layar berubah
            adjustLayout();
            window.addEventListener('resize', adjustLayout);
        });
    </script>
@endsection
