@extends('layouts.master')

@section('content')
    <main class="home-page">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <div class="hero-content">
                    <div class="hero-text" data-aos="fade-right">
                        <h1 class="hero-title">Konversi Dokumen dengan <span class="text-gradient">Cepat & Mudah</span></h1>
                        <p class="hero-description">
                            Platform konversi file terbaik untuk kebutuhan profesional Anda. Konversi gambar dan dokumen
                            dengan kualitas tinggi dan cepat.
                        </p>
                        <div class="hero-actions">
                            <a href="{{ route('register') }}" class="btn btn-primary">Mulai Sekarang</a>
                            <a href="#features" class="btn btn-outline">Lihat Fitur</a>
                        </div>
                    </div>
                    <div class="hero-image" data-aos="fade-left">
                        {{-- <img loading="lazy" src="{{ asset('images/amico.webp') }}" alt="Boasfar Convert Platform"> --}}
                        <div class="floating-card card-1">
                            <div class="card-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path
                                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="card-text">
                                <span class="card-value">100%</span>
                                <span class="card-label">Akurasi</span>
                            </div>
                        </div>
                        <div class="floating-card card-2">
                            <div class="card-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="card-text">
                                <span class="card-value">2x</span>
                                <span class="card-label">Lebih Cepat</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="features-section">
            <div class="container">
                <div class="section-header" data-aos="fade-up">
                    <span class="section-tag">Fitur Unggulan</span>
                    <h2 class="section-title">Alat Konversi <span class="text-gradient">Serba Guna</span></h2>
                    <p class="section-description">
                        Boasfar Convert menyediakan berbagai alat konversi yang Anda butuhkan dengan kualitas terbaik
                    </p>
                </div>

                <div class="features-grid">
                    <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="feature-title">Konversi Gambar</h3>
                        <p class="feature-description">
                            Konversi JPG/PNG ke format WebP yang lebih efisien dengan kompresi tanpa mengurangi kualitas
                        </p>
                    </div>

                    <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="feature-title">PDF ke Word</h3>
                        <p class="feature-description">
                            Ubah dokumen PDF menjadi file Word yang dapat diedit dengan mempertahankan format asli
                        </p>
                    </div>

                    <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="feature-title">Word ke PDF</h3>
                        <p class="feature-description">
                            Konversi file Word menjadi PDF profesional dengan akurasi tinggi dan layout yang sempurna
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works -->
        <section id="how-it-works" class="how-section">
            <div class="container">
                <div class="section-header" data-aos="fade-up">
                    <span class="section-tag">Cara Kerja</span>
                    <h2 class="section-title">Konversi <span class="text-gradient">Dalam 3 Langkah Mudah</span></h2>
                    <p class="section-description">
                        Proses konversi yang sederhana dan cepat tanpa perlu keahlian teknis
                    </p>
                </div>

                <div class="steps-container">
                    <div class="step-line"></div>

                    <div class="step-item" data-aos="fade-right">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h3 class="step-title">Unggah File</h3>
                            <p class="step-description">
                                Pilih dan unggah file yang ingin Anda konversi dari perangkat Anda
                            </p>
                        </div>
                    </div>

                    <div class="step-item" data-aos="fade-left">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h3 class="step-title">Pilih Format</h3>
                            <p class="step-description">
                                Pilih format tujuan yang Anda inginkan untuk hasil konversi
                            </p>
                        </div>
                    </div>

                    <div class="step-item" data-aos="fade-right">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h3 class="step-title">Unduh Hasil</h3>
                            <p class="step-description">
                                Tunggu proses konversi selesai dan unduh file hasil konversi Anda
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pricing Section -->
        <section id="pricing" class="pricing-section">
            <div class="container">
                <div class="section-header" data-aos="fade-up">
                    <span class="section-tag">Paket Harga</span>
                    <h2 class="section-title">Pilih Paket yang <span class="text-gradient">Sesuai Kebutuhan</span></h2>
                    <p class="section-description">
                        Dapatkan akses ke semua fitur premium dengan harga yang terjangkau
                    </p>
                </div>

                <div class="pricing-grid">
                    <div class="pricing-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="pricing-header">
                            <h3 class="pricing-title">Gratis</h3>
                            <div class="pricing-price">
                                <span class="currency">Rp</span>
                                <span class="amount">0</span>
                                <span class="period">/bulan</span>
                            </div>
                        </div>
                        <ul class="pricing-features">
                            <li class="feature-item">
                                <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span>Konversi Gambar (20/hari)</span>
                            </li>
                            <li class="feature-item">
                                <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span>Ukuran maksimal 5MB</span>
                            </li>
                            <li class="feature-item feature-disabled">
                                <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                    <path d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span>PDF ke Word</span>
                            </li>
                            <li class="feature-item feature-disabled">
                                <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                    <path d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span>Word ke PDF</span>
                            </li>
                            <li class="feature-item feature-disabled">
                                <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                    <path d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span>Prioritas proses</span>
                            </li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn btn-outline btn-block">Daftar Gratis</a>
                    </div>

                    <div class="pricing-card pricing-featured" data-aos="fade-up">
                        <div class="popular-badge">Terpopuler</div>
                        <div class="pricing-header">
                            <h3 class="pricing-title">Premium</h3>
                            <div class="pricing-price">
                                <span class="currency">Rp</span>
                                <span class="amount">49k</span>
                                <span class="period">/bulan</span>
                            </div>
                        </div>
                        <ul class="pricing-features">
                            <li class="feature-item">
                                <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span>Konversi Gambar Tak Terbatas</span>
                            </li>
                            <li class="feature-item">
                                <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span>Ukuran maksimal 50MB</span>
                            </li>
                            <li class="feature-item">
                                <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span>PDF ke Word (20/hari)</span>
                            </li>
                            <li class="feature-item">
                                <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span>Word ke PDF (20/hari)</span>
                            </li>
                            <li class="feature-item">
                                <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span>Prioritas proses</span>
                            </li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-block">Berlangganan</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <div class="container">
                <div class="cta-container" data-aos="zoom-in">
                    <div class="cta-content">
                        <h2 class="cta-title">Mulai Konversi Anda Sekarang</h2>
                        <p class="cta-description">
                            Bergabunglah dengan ribuan pengguna yang telah menggunakan Boasfar Convert untuk kebutuhan
                            konversi mereka
                        </p>
                        <div class="cta-actions">
                            <a href="{{ route('register') }}" class="btn btn-primary">Daftar Sekarang</a>
                            <a href="{{ route('login') }}" class="btn btn-light">Masuk</a>
                        </div>
                    </div>
                    <div class="cta-image">
                        <img loading="lazy" src="{{ asset('images/cuate.webp') }}" alt="Boasfar Convert Platform">
                    </div>
                </div>
            </div>
        </section>

        <!-- Artikel Blog dan FAQ (untuk SEO) -->
        <section class="section artikel-section">
            <div class="container">
                <div class="section-header" data-aos="fade-up">
                    <span class="section-tag">Artikel Terbaru</span>
                    <h2 class="section-title">Tips dan Tutorial <span class="text-gradient">Konversi File</span></h2>
                    <p class="section-description">Pelajari informasi seputar konversi file dan tips produktivitas</p>
                </div>

                <div class="row justify-content-center">
                    @php
                        $latestArticles = \App\Models\Article::published()
                            ->with('author')
                            ->orderBy('published_at', 'desc')
                            ->limit(3)
                            ->get();

                        // Data placeholder untuk artikel
                        $placeholders = [
                            [
                                'title' => 'Keunggulan Format WebP untuk Website Modern',
                                'date' => now()->subDays(3),
                                'image' => 'blog-webp.jpg',
                            ],
                            [
                                'title' => 'Mengapa Konversi PDF ke Word Penting untuk Produktivitas',
                                'date' => now()->subDays(5),
                                'image' => 'blog-pdf.jpg',
                            ],
                            [
                                'title' => '5 Cara Mengoptimalkan Ukuran File Gambar',
                                'date' => now()->subDays(7),
                                'image' => 'blog-convert.jpg',
                            ],
                        ];
                    @endphp

                    @for ($i = 0; $i < 3; $i++)
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ ($i + 1) * 100 }}">
                            <div class="artikel-card h-100">
                                @if ($i < $latestArticles->count())
                                    <div class="artikel-image">
                                        <a href="{{ route('artikel.show', $latestArticles[$i]->slug) }}">
                                            <img loading="lazy" src="{{ $latestArticles[$i]->thumbnail_url }}"
                                                alt="{{ $latestArticles[$i]->title }}" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="artikel-content">
                                        <div class="artikel-meta">
                                            <span class="artikel-category">{{ $latestArticles[$i]->category }}</span>
                                            <span class="artikel-date">{{ $latestArticles[$i]->formatted_date }}</span>
                                        </div>
                                        <h3 class="artikel-title">
                                            <a
                                                href="{{ route('artikel.show', $latestArticles[$i]->slug) }}">{{ $latestArticles[$i]->title }}</a>
                                        </h3>
                                        <div class="artikel-excerpt">
                                            {!! Str::limit(strip_tags($latestArticles[$i]->excerpt), 100) !!}
                                        </div>
                                        <div class="artikel-footer">
                                            <a href="{{ route('artikel.show', $latestArticles[$i]->slug) }}"
                                                class="read-more">Baca selengkapnya</a>
                                        </div>
                                    </div>
                                @else
                                    <div class="artikel-image">
                                        <a href="{{ route('artikel.index') }}">
                                            <img loading="lazy" src="{{ asset('images/' . $placeholders[$i]['image']) }}"
                                                alt="{{ $placeholders[$i]['title'] }}" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="artikel-content">
                                        <div class="artikel-meta">
                                            <span class="artikel-category">Tutorial</span>
                                            <span
                                                class="artikel-date">{{ $placeholders[$i]['date']->format('d M Y') }}</span>
                                        </div>
                                        <h3 class="artikel-title">
                                            <a href="{{ route('artikel.index') }}">{{ $placeholders[$i]['title'] }}</a>
                                        </h3>
                                        <div class="artikel-excerpt">
                                            <p>Format WebP menawarkan kompresi lebih baik dibandingkan JPEG dan PNG tanpa
                                                mengorbankan kualitas. Hal ini membuat website lebih cepat dan menghemat
                                                bandwidth.</p>
                                        </div>
                                        <div class="artikel-footer">
                                            <a href="{{ route('artikel.index') }}" class="read-more">Baca
                                                selengkapnya</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endfor
                </div>

                <div class="text-center" data-aos="fade-up">
                    <a href="{{ route('artikel.index') }}" class="btn btn-primary">Lihat Semua Artikel</a>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="section faq-section">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Pertanyaan Umum</h2>
                    <p class="section-subtitle">Informasi yang sering ditanyakan seputar layanan kami</p>
                </div>

                <div class="faq-container">
                    <div class="faq-item">
                        <h3 class="faq-question">Apa itu format WebP?</h3>
                        <div class="faq-answer">
                            <p>WebP adalah format gambar modern yang dikembangkan oleh Google. Format ini menawarkan
                                kompresi yang lebih baik dibandingkan format JPEG dan PNG tradisional, sehingga menghasilkan
                                file yang lebih kecil tanpa mengorbankan kualitas gambar secara signifikan. Dengan ukuran
                                file yang lebih kecil, website dapat dimuat lebih cepat dan menghemat bandwidth.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <h3 class="faq-question">Bagaimana cara mengkonversi PDF ke Word?</h3>
                        <div class="faq-answer">
                            <p>Untuk mengkonversi PDF ke Word di platform kami, ikuti langkah-langkah berikut:</p>
                            <ol>
                                <li>Login ke akun Boasfar Convert Anda</li>
                                <li>Pilih menu "Konversi PDF ke Word"</li>
                                <li>Upload file PDF yang ingin dikonversi</li>
                                <li>Klik tombol "Konversi"</li>
                                <li>Tunggu proses konversi selesai</li>
                                <li>Download file Word hasil konversi</li>
                            </ol>
                            <p>Fitur ini tersedia untuk pengguna premium. Jika Anda pengguna gratisan, Anda dapat
                                mengupgrade akun Anda untuk menikmati fitur ini.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <h3 class="faq-question">Apakah layanan konversi file di Boasfar Convert aman?</h3>
                        <div class="faq-answer">
                            <p>Ya, layanan konversi file di Boasfar Convert sangat aman. Kami mengutamakan keamanan dan
                                privasi data pengguna. Semua file yang diupload ke platform kami akan dihapus secara
                                otomatis setelah 24 jam. Kami juga tidak pernah membaca, menganalisis, atau membagikan
                                konten dari file yang diupload tanpa izin eksplisit dari pengguna.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <h3 class="faq-question">Berapa banyak file yang bisa saya konversi per hari?</h3>
                        <div class="faq-answer">
                            <p>Untuk pengguna gratisan, kami menyediakan batas 20 konversi per hari. Untuk pengguna premium,
                                kami menyediakan konversi tak terbatas. Jika Anda memerlukan lebih banyak konversi, Anda
                                dapat mengupgrade ke akun premium dengan biaya yang sangat terjangkau.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <h3 class="faq-question">Apakah Boasfar Convert mendukung konversi batch?</h3>
                        <div class="faq-answer">
                            <p>Ya, Boasfar Convert mendukung konversi batch untuk gambar. Anda dapat mengupload hingga 20
                                gambar sekaligus untuk dikonversi ke format WebP. Untuk konversi PDF ke Word dan Word ke
                                PDF, saat ini kami hanya mendukung konversi satu file per waktu.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
