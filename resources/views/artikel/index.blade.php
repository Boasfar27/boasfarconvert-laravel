@extends('layouts.master')

@section('title', 'Artikel')

@section('content')
    <main class="artikel-page">
        <section class="hero-section">
            <div class="container">
                <div class="hero-content text-center">
                    <h1>Artikel Boasfar Convert</h1>
                    <p class="lead">Tips, tutorial, dan panduan seputar konversi file</p>
                </div>
            </div>
        </section>

        <section class="artikel-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        @if ($category)
                            <div class="category-heading mb-4">
                                <h2>Kategori: {{ $category }}</h2>
                                <a href="{{ route('artikel.index') }}" class="btn btn-outline-primary btn-sm">Lihat
                                    Semua</a>
                            </div>
                        @endif

                        <div class="artikel-grid">
                            @forelse($articles as $article)
                                <div class="artikel-card">
                                    <div class="artikel-image">
                                        <a href="{{ route('artikel.show', $article->slug) }}">
                                            <img loading="lazy" src="{{ $article->thumbnail_url }}"
                                                alt="{{ $article->title }}" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="artikel-content">
                                        <div class="artikel-meta">
                                            <span class="artikel-category">{{ $article->category }}</span>
                                            <span class="artikel-date">{{ $article->formatted_date }}</span>
                                        </div>
                                        <h3 class="artikel-title">
                                            <a href="{{ route('artikel.show', $article->slug) }}">{{ $article->title }}</a>
                                        </h3>
                                        <div class="artikel-excerpt">
                                            {!! Str::limit(strip_tags($article->excerpt), 150) !!}
                                        </div>
                                        <div class="artikel-footer">
                                            <span class="artikel-author">Oleh: {{ $article->author->name }}</span>
                                            <span class="artikel-views"><i class="fas fa-eye"></i>
                                                {{ $article->views }}</span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="no-articles">
                                    <p>Belum ada artikel yang dipublikasikan.</p>
                                </div>
                            @endforelse
                        </div>

                        <div class="pagination-container">
                            {{ $articles->links() }}
                        </div>
                    </div>

                    {{-- <div class="col-md-4">
                        <div class="artikel-sidebar">
                            <div class="sidebar-block">
                                <h3>Kategori</h3>
                                <ul class="category-list">
                                    @foreach ($categories as $cat)
                                        <li>
                                            <a href="{{ route('artikel.index', ['category' => $cat]) }}"
                                                class="{{ $category == $cat ? 'active' : '' }}">
                                                {{ $cat }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="sidebar-block">
                                <h3>Layanan Kami</h3>
                                <ul class="service-list">
                                    <li><a href="{{ route('convert.image.form') }}">Konversi Gambar</a></li>
                                    <li><a href="{{ route('convert.pdf-to-word.form') }}">PDF ke Word</a></li>
                                    <li><a href="{{ route('convert.word-to-pdf.form') }}">Word ke PDF</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>
    </main>
@endsection

@push('styles')
    <style>
        .artikel-page {
            background-color: var(--bg-secondary);
            min-height: 100vh;
        }

        .hero-section {
            background-color: var(--color-primary);
            padding: 5rem 0;
            color: white;
            margin-bottom: 3rem;
        }

        .hero-content h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .hero-content .lead {
            font-size: 1.25rem;
            opacity: 0.9;
        }

        .artikel-content {
            padding-bottom: 5rem;
        }

        .category-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .artikel-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .artikel-card {
            background: var(--bg-primary);
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .artikel-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .artikel-image {
            height: 200px;
            overflow: hidden;
        }

        .artikel-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .artikel-card:hover .artikel-image img {
            transform: scale(1.05);
        }

        .artikel-content {
            padding: 1.5rem;
        }

        .artikel-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
            font-size: 0.85rem;
        }

        .artikel-category {
            color: var(--color-primary);
            font-weight: 600;
        }

        .artikel-date {
            color: var(--text-tertiary);
        }

        .artikel-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .artikel-title a {
            color: var(--text-primary);
            text-decoration: none;
        }

        .artikel-title a:hover {
            color: var(--color-primary);
        }

        .artikel-excerpt {
            color: var(--text-secondary);
            margin-bottom: 1rem;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .artikel-footer {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            color: var(--text-tertiary);
        }

        .artikel-sidebar {
            margin-top: 2rem;
        }

        .sidebar-block {
            background: var(--bg-primary);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .sidebar-block h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--border-color);
        }

        .category-list,
        .service-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .category-list li,
        .service-list li {
            margin-bottom: 0.5rem;
        }

        .category-list a,
        .service-list a {
            color: var(--text-primary);
            text-decoration: none;
            display: block;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--border-color);
            transition: color 0.3s ease;
        }

        .category-list a:hover,
        .service-list a:hover,
        .category-list a.active {
            color: var(--color-primary);
        }

        .no-articles {
            grid-column: 1 / -1;
            padding: 3rem;
            text-align: center;
            background: var(--bg-primary);
            border-radius: 10px;
            color: var(--text-secondary);
        }

        .pagination-container {
            margin-top: 2rem;
        }

        @media (max-width: 768px) {
            .artikel-grid {
                grid-template-columns: 1fr;
            }

            .artikel-sidebar {
                margin-top: 3rem;
            }

            .hero-content h1 {
                font-size: 2rem;
            }

            .hero-content .lead {
                font-size: 1rem;
            }
        }
    </style>
@endpush
