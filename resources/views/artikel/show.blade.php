@extends('layouts.master')

@section('title', $article->title)

@section('content')
    <main class="bc-article-page">
        <article class="bc-article-detail">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="bc-article-header">
                            <div class="bc-article-meta">
                                <span class="bc-article-category">{{ $article->category }}</span>
                                <span class="bc-article-date">{{ $article->formatted_date }}</span>
                            </div>
                            <h1 class="bc-article-title">{{ $article->title }}</h1>
                            <div class="bc-article-author">
                                <span>Oleh: {{ $article->author->name }}</span>
                                <span class="bc-article-views"><i class="fas fa-eye"></i> {{ $article->views }} kali
                                    dibaca</span>
                            </div>
                        </div>

                        <div class="bc-article-featured-image">
                            <img loading="lazy" src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}"
                                class="img-fluid">
                        </div>

                        <div class="bc-article-body">
                            {!! $article->content !!}
                        </div>

                        <div class="bc-article-actions">
                            <div class="bc-article-tags">
                                <a href="{{ route('artikel.index', ['category' => $article->category]) }}"
                                    class="bc-tag">{{ $article->category }}</a>
                            </div>

                            <div class="bc-article-share">
                                <span>Bagikan:</span>
                                <div class="bc-share-buttons">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('artikel.show', $article->slug)) }}"
                                        target="_blank" class="bc-share-btn bc-facebook" aria-label="Share to Facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('artikel.show', $article->slug)) }}&text={{ urlencode($article->title) }}"
                                        target="_blank" class="bc-share-btn bc-twitter" aria-label="Share to Twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . route('artikel.show', $article->slug)) }}"
                                        target="_blank" class="bc-share-btn bc-whatsapp" aria-label="Share to WhatsApp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('artikel.show', $article->slug)) }}"
                                        target="_blank" class="bc-share-btn bc-linkedin" aria-label="Share to LinkedIn">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <a href="mailto:?subject={{ urlencode($article->title) }}&body={{ urlencode('Baca artikel ini: ' . route('artikel.show', $article->slug)) }}"
                                        class="bc-share-btn bc-email" aria-label="Share via Email">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>

        @if ($relatedArticles->count() > 0)
            <section class="bc-related-articles">
                <div class="container">
                    <h2>Artikel Terkait</h2>
                    <div class="row g-4">
                        @foreach ($relatedArticles as $related)
                            <div class="col-md-4">
                                <div class="bc-artikel-card h-100 shadow-sm">
                                    <div class="bc-artikel-image">
                                        <a href="{{ route('artikel.show', $related->slug) }}">
                                            <img loading="lazy" src="{{ $related->thumbnail_url }}"
                                                alt="{{ $related->title }}" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="bc-artikel-content">
                                        <div class="bc-artikel-meta">
                                            <span class="bc-artikel-category">{{ $related->category }}</span>
                                            <span class="bc-artikel-date">{{ $related->formatted_date }}</span>
                                        </div>
                                        <h3 class="bc-artikel-title">
                                            <a
                                                href="{{ route('artikel.show', $related->slug) }}">{{ $related->title }}</a>
                                        </h3>
                                        <div class="bc-artikel-footer">
                                            <span class="bc-artikel-author">Oleh: {{ $related->author->name }}</span>
                                            <span class="bc-artikel-views"><i class="fas fa-eye"></i>
                                                {{ $related->views }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <div class="bc-back-to-artikel">
            <div class="container text-center">
                <a href="{{ route('artikel.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Artikel
                </a>
            </div>
        </div>
    </main>
@endsection

@push('styles')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .bc-article-page {
            background-color: var(--bg-secondary);
            padding-bottom: 4rem;
            padding-top: 6rem;
        }

        .bc-article-detail {
            padding: 2rem 0;
        }

        .bc-article-header {
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
        }

        .bc-article-meta {
            display: flex;
            margin-bottom: 1rem;
            gap: 1rem;
            font-size: 0.9rem;
        }

        .bc-article-category {
            color: var(--color-primary);
            font-weight: 600;
        }

        .bc-article-date {
            color: var(--text-tertiary);
        }

        .bc-article-title {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 1rem;
            color: var(--text-primary);
        }

        .bc-article-author {
            display: flex;
            justify-content: space-between;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .bc-article-featured-image {
            margin-bottom: 2rem;
            border-radius: 12px;
            overflow: hidden;
        }

        .bc-article-featured-image img {
            width: 100%;
            height: auto;
        }

        .bc-article-body {
            color: var(--text-primary);
            line-height: 1.8;
            font-size: 1.1rem;
            margin-bottom: 3rem;
        }

        .bc-article-body p {
            margin-bottom: 1.5rem;
        }

        .bc-article-body h2 {
            font-size: 1.8rem;
            font-weight: 600;
            margin: 2.5rem 0 1rem;
        }

        .bc-article-body h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 2rem 0 1rem;
        }

        .bc-article-body img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 1.5rem 0;
        }

        .bc-article-body ul,
        .bc-article-body ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }

        .bc-article-body li {
            margin-bottom: 0.5rem;
        }

        .bc-article-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 3rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-color);
        }

        .bc-article-tags .bc-tag {
            display: inline-block;
            padding: 0.35rem 0.75rem;
            background-color: rgba(109, 40, 217, 0.1);
            color: var(--color-primary);
            border-radius: 50px;
            font-size: 0.85rem;
            text-decoration: none;
            margin-right: 0.5rem;
            transition: background-color 0.3s ease;
        }

        .bc-article-tags .bc-tag:hover {
            background-color: rgba(109, 40, 217, 0.2);
        }

        .bc-article-share {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .bc-article-share span {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .bc-share-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .bc-share-btn {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: white !important;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .bc-share-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
        }

        .bc-share-btn.bc-facebook {
            background-color: #3b5998;
        }

        .bc-share-btn.bc-twitter {
            background-color: #1da1f2;
        }

        .bc-share-btn.bc-whatsapp {
            background-color: #25d366;
        }

        .bc-share-btn.bc-linkedin {
            background-color: #0077b5;
        }

        .bc-share-btn.bc-email {
            background-color: #dd4b39;
        }

        .bc-related-articles {
            background: var(--bg-primary);
            padding: 3rem 0;
            margin-bottom: 2rem;
        }

        .bc-related-articles h2 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }

        .bc-back-to-artikel {
            margin: 2rem 0;
        }

        .bc-artikel-card {
            background: var(--bg-primary);
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .bc-artikel-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .bc-artikel-image {
            height: 180px;
            overflow: hidden;
        }

        .bc-artikel-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .bc-artikel-card:hover .bc-artikel-image img {
            transform: scale(1.05);
        }

        .bc-artikel-content {
            padding: 1.5rem;
        }

        .bc-artikel-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
            font-size: 0.85rem;
        }

        .bc-artikel-category {
            color: var(--color-primary);
            font-weight: 600;
        }

        .bc-artikel-date {
            color: var(--text-tertiary);
        }

        .bc-artikel-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .bc-artikel-title a {
            color: var(--text-primary);
            text-decoration: none;
        }

        .bc-artikel-title a:hover {
            color: var(--color-primary);
        }

        .bc-artikel-footer {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            color: var(--text-tertiary);
            margin-top: auto;
            padding-top: 0.5rem;
            border-top: none;
        }

        @media (max-width: 768px) {
            .bc-article-title {
                font-size: 1.75rem;
            }

            .bc-artikel-image {
                height: 160px;
            }

            .bc-article-actions {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .bc-article-share {
                width: 100%;
            }

            .bc-share-buttons {
                flex-wrap: wrap;
            }
        }
    </style>
@endpush
