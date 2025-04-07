@extends('layouts.master')

@section('content')
    <main class="dashboard-page">
        <div class="container">
            <div class="dashboard-header" data-aos="fade-up">
                <h1 class="dashboard-title">Selamat Datang, {{ Auth::user()->name }}!</h1>
                <p class="dashboard-subtitle">Apa yang ingin Anda konversi hari ini?</p>
            </div>

            <div class="dashboard-stats" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-card">
                    <div class="stat-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-title">Sisa Konversi</h3>
                        <p class="stat-value">
                            {{ Auth::user()->getRemainingConversions() }}</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-title">Status Akun</h3>
                        <p class="stat-value">
                            @if (Auth::user()->isAdmin())
                                Admin
                            @elseif(Auth::user()->isPremium())
                                Premium
                            @else
                                Free
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="dashboard-grid" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card dashboard-card">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="feature-title">Konversi Gambar</h3>
                    <p class="feature-description">Konversi gambar JPG/PNG ke format WebP dengan kualitas tinggi dan ukuran
                        file lebih kecil</p>
                    <a href="{{ route('convert.image.form') }}" class="btn btn-primary">Konversi Gambar</a>
                </div>

                @if (Auth::user()->isPremium() || Auth::user()->isAdmin())
                    <div class="feature-card dashboard-card">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="feature-title">PDF ke Word</h3>
                        <p class="feature-description">Konversi dokumen PDF menjadi file Word yang dapat diedit dengan
                            mempertahankan format asli</p>
                        <a href="{{ route('convert.pdf-to-word.form') }}" class="btn btn-primary">Konversi Dokumen</a>
                    </div>

                    <div class="feature-card dashboard-card">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="feature-title">Word ke PDF</h3>
                        <p class="feature-description">Konversi file Word menjadi PDF profesional dengan layout yang
                            sempurna</p>
                        <a href="{{ route('convert.word-to-pdf.form') }}" class="btn btn-primary">Konversi Dokumen</a>
                    </div>
                @else
                    <div class="feature-card dashboard-card premium-locked">
                        <div class="premium-badge">Premium</div>
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="feature-title">PDF ke Word</h3>
                        <p class="feature-description">Konversi dokumen PDF menjadi file Word yang dapat diedit dengan
                            mempertahankan format asli</p>
                        <span class="btn btn-outline disabled">Fitur Premium</span>
                    </div>

                    <div class="feature-card dashboard-card premium-locked">
                        <div class="premium-badge">Premium</div>
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="feature-title">Word ke PDF</h3>
                        <p class="feature-description">Konversi file Word menjadi PDF profesional dengan layout yang
                            sempurna</p>
                        <span class="btn btn-outline disabled">Fitur Premium</span>
                    </div>
                @endif
            </div>

            @if (!Auth::user()->isPremium() && !Auth::user()->isAdmin())
                <div class="premium-cta" data-aos="fade-up" data-aos-delay="300">
                    <div class="premium-cta-content">
                        <h2 class="cta-title">Upgrade ke Premium!</h2>
                        <p class="cta-description">Dapatkan akses ke semua fitur konversi tanpa batasan, termasuk konversi
                            PDF ke Word dan sebaliknya.</p>
                        <div class="cta-features">
                            <div class="cta-feature">
                                <svg class="feature-check" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <span>Konversi Tak Terbatas</span>
                            </div>
                            <div class="cta-feature">
                                <svg class="feature-check" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <span>Ukuran File Maksimal 50MB</span>
                            </div>
                            <div class="cta-feature">
                                <svg class="feature-check" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span>Prioritas Konversi</span>
                            </div>
                        </div>
                        <a href="#" class="btn btn-primary">Upgrade Sekarang</a>
                    </div>
                    <div class="premium-cta-decoration"></div>
                </div>
            @endif
        </div>
    </main>
@endsection
