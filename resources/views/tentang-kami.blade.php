@extends('layouts.master')

@section('title', 'Tentang Kami')

@section('content')
    <div class="page-content">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">Tentang Kami</h1>
                <p class="page-subtitle">Mengenal lebih dekat dengan Boasfar Convert</p>
            </div>

            <div class="content-card">
                <div class="content-section">
                    <h2 class="content-title">Siapa Kami?</h2>
                    <p>Boasfar Convert adalah layanan konversi file digital terkemuka yang didirikan pada tahun 2023. Kami
                        berfokus pada penyediaan solusi konversi gambar dan dokumen yang cepat, aman, dan andal untuk
                        pengguna di seluruh Indonesia dan dunia.</p>

                    <p>Tim kami terdiri dari para ahli di bidang teknologi pengolahan file dan pengembangan web yang
                        berkomitmen untuk memberikan pengalaman terbaik dalam konversi file online.</p>
                </div>

                <div class="content-section">
                    <h2 class="content-title">Visi Kami</h2>
                    <p>Menjadi platform konversi file terdepan yang memudahkan setiap orang mengakses dan menggunakan
                        teknologi konversi file secara mudah, cepat, dan aman.</p>
                </div>

                <div class="content-section">
                    <h2 class="content-title">Misi Kami</h2>
                    <ul class="content-list">
                        <li>Menyediakan layanan konversi file dengan kualitas tinggi dan mudah digunakan</li>
                        <li>Memastikan keamanan dan privasi data pengguna</li>
                        <li>Mengembangkan teknologi konversi yang inovatif dan efisien</li>
                        <li>Memberikan dukungan pelanggan yang responsif dan berkualitas</li>
                        <li>Berkontribusi pada kemajuan teknologi digital di Indonesia</li>
                    </ul>
                </div>

                <div class="content-section">
                    <h2 class="content-title">Nilai-Nilai Kami</h2>
                    <div class="values-grid">
                        <div class="value-card">
                            <div class="value-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <h3 class="value-title">Keamanan</h3>
                            <p class="value-description">Kami memprioritaskan keamanan data pengguna di atas segalanya.</p>
                        </div>
                        <div class="value-card">
                            <div class="value-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h3 class="value-title">Kecepatan</h3>
                            <p class="value-description">Layanan konversi yang cepat untuk menghemat waktu Anda.</p>
                        </div>
                        <div class="value-card">
                            <div class="value-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                </svg>
                            </div>
                            <h3 class="value-title">Inovasi</h3>
                            <p class="value-description">Terus berinovasi untuk memberikan solusi terbaik.</p>
                        </div>
                        <div class="value-card">
                            <div class="value-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                </svg>
                            </div>
                            <h3 class="value-title">Dukungan</h3>
                            <p class="value-description">Dukungan pelanggan yang responsif dan membantu.</p>
                        </div>
                    </div>
                </div>

                <div class="content-section">
                    <h2 class="content-title">Tim Kami</h2>
                    <p>Kami adalah tim yang beragam dengan keahlian di berbagai bidang seperti pengembangan web, keamanan
                        siber, desain UI/UX, dan pengolahan data. Semua anggota tim kami berkomitmen untuk memberikan
                        layanan terbaik dan terus meningkatkan platform kami.</p>
                </div>

                <div class="content-section">
                    <h2 class="content-title">Hubungi Kami</h2>
                    <p>Jika Anda memiliki pertanyaan atau saran, jangan ragu untuk menghubungi kami melalui:</p>
                    <div class="contact-info">
                        <div class="contact-item">
                            <span class="contact-label">Email:</span>
                            <a href="mailto:muhammadfarhan2747@gmail.com">muhammadfarhan2747@gmail.com</a>
                        </div>
                        <div class="contact-item">
                            <span class="contact-label">Telepon:</span>
                            <a href="tel:+6281234567890">+62-851-5844-2747</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
