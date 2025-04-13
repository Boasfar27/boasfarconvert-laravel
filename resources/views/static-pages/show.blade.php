@extends('layouts.master')

@section('title', $page->meta_title ?: $page->title)

@section('meta')
    @if ($page->meta_description)
        <meta name="description" content="{{ $page->meta_description }}">
    @endif
@endsection

@section('content')
    <div class="page-content">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">{{ $page->title }}</h1>
                <p class="page-subtitle">Terakhir diperbarui: {{ $page->updated_at->format('d M Y') }}</p>
            </div>

            <div class="content-card">
                <div class="content-section">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
@endsection
