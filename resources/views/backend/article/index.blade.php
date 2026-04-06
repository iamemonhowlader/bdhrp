@extends('backend.app')

@section('title', 'Article Management — ' . config('app.name'))

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --news-primary: #6366f1;
        --news-gradient: linear-gradient(135deg, #6366f1 0%, #3b82f6 100%);
        --news-surface: #ffffff;
        --news-glass: rgba(255, 255, 254, 0.75);
        --news-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
        --news-font: 'Plus Jakarta Sans', sans-serif;
    }

    .article-container {
        font-family: var(--news-font);
        color: #1e293b;
    }

    .premium-page-header {
        background: var(--news-gradient);
        border-radius: 2rem;
        padding: 3.5rem;
        position: relative;
        color: white;
        margin-bottom: 2.5rem;
        box-shadow: 0 25px 50px -12px rgba(99, 102, 241, 0.2);
    }

    .premium-page-header::before {
        content: '';
        position: absolute;
        width: 350px;
        height: 350px;
        background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
        top: -100px;
        right: -80px;
        border-radius: 50%;
    }

    .smart-table-card {
        background: white;
        border-radius: 2rem;
        border: none;
        box-shadow: var(--news-shadow);
        overflow: hidden;
    }

    .article-row:hover {
        background: #f8fafc;
        transform: scale(1.002);
        transition: all 0.2s ease;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-published { background: #ecfdf5; color: #10b981; }
    .status-draft { background: #fef2f2; color: #ef4444; }

    .article-thumb {
        width: 80px;
        height: 50px;
        border-radius: 10px;
        object-fit: cover;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .btn-create {
        background: white;
        color: var(--news-primary);
        border: none;
        padding: 0.85rem 1.75rem;
        border-radius: 12px;
        font-weight: 800;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 10;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-create:hover {
        background: #f1f5f9;
        transform: translateY(-3px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        color: var(--news-primary);
    }

    .btn-create:active {
        transform: translateY(0);
    }
</style>
@endpush

@section('content')
<div id="app-content">
    <div class="app-content-area article-container">
        <div class="container-fluid px-4 pt-4 pb-5">
            
            <div class="premium-page-header">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <span class="badge bg-white text-primary mb-3 badge-premium shadow-sm">PUBLISHING CENTER</span>
                        <h1 class="display-5 fw-800 mb-2 mt-2">Latest News & Articles</h1>
                        <p class="fs-5 opacity-90 mb-0">Share impactful stories and legal updates with the BDHRP community.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ url('admin/articles/create') }}" 
                           onclick="window.location.href='{{ url('admin/articles/create') }}'; return true;"
                           class="btn btn-primary shadow-lg fw-bold px-4 py-3" 
                           style="border-radius: 12px; position: relative; z-index: 99999 !important; pointer-events: auto !important; display: inline-flex; align-items: center; gap: 10px; background: #ffffff !important; color: #6366f1 !important; border: 2px solid #ffffff; min-width: 160px; justify-content: center;">
                            <i class="bi bi-plus-circle-fill" style="font-size: 1.2rem;"></i>
                            <span>New Article</span>
                        </a>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success border-0 rounded-4 shadow-sm p-4 mb-4" role="alert">
                    <div class="d-flex align-items-center">
                        <div class="bg-success text-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-check-lg fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-800">Mission Accomplished!</h6>
                            <p class="mb-0 small opacity-75">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="smart-table-card">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 px-4 py-4 small fw-bold text-muted">ARTICLE</th>
                                <th class="border-0 py-4 small fw-bold text-muted">AUTHOR</th>
                                <th class="border-0 py-4 small fw-bold text-muted">STATUS</th>
                                <th class="border-0 py-4 small fw-bold text-muted">PUBLISHED</th>
                                <th class="border-0 px-4 py-4 small fw-bold text-muted text-end">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($articles as $article)
                                <tr class="article-row border-bottom">
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            @if($article->featured_image)
                                                <img src="{{ asset('storage/' . $article->featured_image) }}" class="article-thumb me-3" alt="">
                                            @else
                                                <div class="article-thumb me-3 bg-light d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-image text-muted"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-800 text-dark" style="font-size: 0.95rem;">{{ $article->title }}</div>
                                                <div class="text-muted small">{{ Str::limit($article->excerpt, 50) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm rounded-circle bg-primary-soft text-primary me-2 fw-bold d-flex align-items-center justify-content-center" style="width: 24px; height: 24px; font-size: 0.65rem; background: #eef2ff;">
                                                {{ strtoupper(substr($article->author->first_name ?? 'A', 0, 1)) }}
                                            </div>
                                            <span class="small fw-semibold">{{ trim(($article->author->first_name ?? '') . ' ' . ($article->author->last_name ?? '')) ?: 'Admin' }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge status-{{ $article->status }}">
                                            {{ $article->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="small text-muted fw-bold">
                                            <i class="bi bi-calendar-event me-1"></i>
                                            {{ $article->published_at ? $article->published_at->format('M d, Y') : 'Pending' }}
                                        </span>
                                    </td>
                                    <td class="text-end px-4">
                                        <div class="d-flex gap-2 justify-content-end">
                                            <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-icon btn-light rounded-circle shadow-sm">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </a>
                                            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Archive this story?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-icon btn-light rounded-circle shadow-sm">
                                                    <i class="bi bi-trash3 text-danger"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-5 text-center">
                                        <div class="text-muted fs-4"><i class="bi bi-pencil-square"></i></div>
                                        <p class="text-muted fw-semibold">No stories have been written yet.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-3 border-top">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
