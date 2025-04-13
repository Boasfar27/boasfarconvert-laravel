@extends('layouts.master')

@section('content')
    <main class="convert-page">
        <div class="container">
            <div class="page-header" data-aos="fade-up">
                <h1 class="page-title">Pilih Jenis Konversi</h1>
                <p class="page-subtitle">Pilih jenis konversi yang ingin Anda lakukan</p>
            </div>

            <div class="conversion-options" data-aos="fade-up" data-aos-delay="100">
                <div class="option-card">
                    <div class="option-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="option-content">
                        <h3 class="option-title">Konversi Gambar</h3>
                        <p class="option-description">Konversi gambar JPG dan PNG ke format WebP untuk optimasi SEO dan
                            performa web yang lebih baik.</p>

                        <ul class="option-features">
                            <li class="option-feature">
                                <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <span>Format input: JPG, PNG</span>
                            </li>
                            <li class="option-feature">
                                <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <span>Format output: WebP</span>
                            </li>
                            <li class="option-feature">
                                <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <span>Optimasi kualitas</span>
                            </li>
                        </ul>

                        <a href="{{ route('convert.image.form') }}" class="btn btn-primary">Konversi Gambar</a>
                    </div>
                </div>

                @if (Auth::user()->isPremium() || Auth::user()->isAdmin())
                    <div class="option-card">
                        <div class="option-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="option-content">
                            <h3 class="option-title">Konversi PDF ke Word</h3>
                            <p class="option-description">Konversi dokumen PDF ke Word dengan akurasi tinggi dan kualitas
                                profesional.</p>

                            <ul class="option-features">
                                <li class="option-feature">
                                    <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                        <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>Format input: PDF</span>
                                </li>
                                <li class="option-feature">
                                    <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                        <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>Format output: DOCX</span>
                                </li>
                                <li class="option-feature">
                                    <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                        <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>Tanpa watermark</span>
                                </li>
                            </ul>

                            <a href="{{ route('convert.pdf-to-word.form') }}" class="btn btn-primary">Konversi PDF ke
                                Word</a>
                        </div>
                    </div>

                    <div class="option-card">
                        <div class="option-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="option-content">
                            <h3 class="option-title">Konversi Word ke PDF</h3>
                            <p class="option-description">Konversi file Word ke PDF dengan menjaga layout dan format asli
                                dokumen.</p>

                            <ul class="option-features">
                                <li class="option-feature">
                                    <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                        <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>Format input: DOCX, DOC</span>
                                </li>
                                <li class="option-feature">
                                    <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                        <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>Format output: PDF</span>
                                </li>
                                <li class="option-feature">
                                    <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                        <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>Format terjaga</span>
                                </li>
                            </ul>

                            <a href="{{ route('convert.word-to-pdf.form') }}" class="btn btn-primary">Konversi Word ke
                                PDF</a>
                        </div>
                    </div>
                @else
                    <div class="option-card premium-locked">
                        <div class="premium-badge">Premium</div>
                        <div class="option-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="option-content">
                            <h3 class="option-title">Konversi PDF ke Word</h3>
                            <p class="option-description">Konversi dokumen PDF ke Word dengan akurasi tinggi dan kualitas
                                profesional.</p>

                            <ul class="option-features">
                                <li class="option-feature">
                                    <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                        <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>Format input: PDF</span>
                                </li>
                                <li class="option-feature">
                                    <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                        <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>Format output: DOCX</span>
                                </li>
                                <li class="option-feature">
                                    <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                        <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>Tanpa watermark</span>
                                </li>
                            </ul>

                            <a href="{{ route('premium.index') }}" class="btn btn-primary">Upgrade ke Premium</a>
                        </div>
                    </div>

                    <div class="option-card premium-locked">
                        <div class="premium-badge">Premium</div>
                        <div class="option-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="option-content">
                            <h3 class="option-title">Konversi Word ke PDF</h3>
                            <p class="option-description">Konversi file Word ke PDF dengan menjaga layout dan format asli
                                dokumen.</p>

                            <ul class="option-features">
                                <li class="option-feature">
                                    <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                        <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>Format input: DOCX, DOC</span>
                                </li>
                                <li class="option-feature">
                                    <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                        <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>Format output: PDF</span>
                                </li>
                                <li class="option-feature">
                                    <svg class="feature-icon" viewBox="0 0 24 24" fill="none">
                                        <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>Format terjaga</span>
                                </li>
                            </ul>

                            <a href="{{ route('premium.index') }}" class="btn btn-primary">Upgrade ke Premium</a>
                        </div>
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
                                    <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span>Konversi PDF ke Word</span>
                            </div>
                            <div class="cta-feature">
                                <svg class="feature-check" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span>Konversi Word ke PDF</span>
                            </div>
                            <div class="cta-feature">
                                <svg class="feature-check" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span>Fitur Premium Lainnya</span>
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
