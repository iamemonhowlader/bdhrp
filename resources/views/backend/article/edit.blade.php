@extends('backend.app')

@section('title', 'Editing: ' . $article->title . ' — ' . config('app.name'))

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --form-primary: #6366f1;
        --form-gradient: linear-gradient(135deg, #10b981 0%, #3b82f6 100%);
        --form-surface: #ffffff;
        --form-glass: rgba(255, 255, 254, 0.75);
        --form-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
        --form-font: 'Plus Jakarta Sans', sans-serif;
    }

    .form-container {
        font-family: var(--form-font);
        color: #1e293b;
    }

    .premium-page-header {
        background: var(--form-gradient);
        border-radius: 2rem;
        padding: 3.5rem;
        position: relative;
        overflow: hidden;
        color: white;
        margin-bottom: 3rem;
        box-shadow: 0 25px 50px -12px rgba(16, 185, 129, 0.2);
    }

    .glass-editor-card {
        background: var(--form-glass);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 2rem;
        padding: 2.5rem;
        box-shadow: var(--form-shadow);
        margin-bottom: 2.5rem;
    }

    .form-label-premium {
        font-weight: 700;
        font-size: 0.875rem;
        color: #475569;
        margin-bottom: 0.65rem;
        display: block;
        letter-spacing: 0.5px;
    }

    .premium-input {
        border-radius: 12px;
        border: 1.5px solid #e2e8f0;
        padding: 0.75rem 1.25rem;
        font-size: 0.95rem;
        background: #f8fafc;
        transition: all 0.3s ease;
    }
</style>
@endpush

@section('content')
<div id="app-content">
    <div class="app-content-area form-container">
        <div class="container-fluid px-4 pt-3 pb-5">
            
            <div class="premium-page-header">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <span class="badge bg-white text-success mb-3 badge-premium shadow-sm">PUBLISHING CENTER</span>
                        <h1 class="display-5 fw-800 mb-2 mt-2">Refining the Narrative</h1>
                        <p class="fs-5 opacity-90 mb-0">Updating: <span class="fw-bold">{{ $article->title }}</span></p>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-lg-8">
                        <div class="glass-editor-card">
                            <div class="mb-4">
                                <label class="form-label-premium">ARTICLE TITLE</label>
                                <input type="text" name="title" class="form-control premium-input @error('title') is-invalid @enderror" value="{{ old('title', $article->title) }}" placeholder="The powerful headline...">
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label-premium">EXCERPT (SHORT SUMMARY)</label>
                                <textarea name="excerpt" class="form-control premium-input @error('excerpt') is-invalid @enderror" rows="3" placeholder="A brief hook for the readers...">{{ old('excerpt', $article->excerpt) }}</textarea>
                                @error('excerpt') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-0">
                                <label class="form-label-premium">CONTENT BODY</label>
                                <textarea name="body" class="form-control premium-input @error('body') is-invalid @enderror" rows="15" placeholder="Tell the full story here...">{{ old('body', $article->body) }}</textarea>
                                @error('body') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="glass-editor-card">
                            <div class="mb-4">
                                <label class="form-label-premium">FEAT. IMAGE</label>
                                @if($article->featured_image)
                                    <img src="{{ asset('storage/' . $article->featured_image) }}" class="img-fluid rounded mb-3 shadow-sm" alt="">
                                @endif
                                <input type="file" name="featured_image" class="form-control premium-input @error('featured_image') is-invalid @enderror">
                                @error('featured_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label-premium">STATUS</label>
                                <select name="status" class="form-select premium-input">
                                    <option value="draft" {{ $article->status === 'draft' ? 'selected' : '' }}>Save as Draft</option>
                                    <option value="published" {{ $article->status === 'published' ? 'selected' : '' }}>Publish Live</option>
                                </select>
                            </div>

                            <div class="mb-0">
                                <div class="form-check form-switch p-0 py-2">
                                    <input class="form-check-input ms-0 me-2" type="checkbox" name="is_featured" value="1" id="isFeatured" {{ $article->is_featured ? 'checked' : '' }}>
                                    <label class="form-label-premium d-inline" for="isFeatured">MARK AS FEATURED ON HOME PAGE</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-emerald rounded-pill py-3 fw-bold shadow-lg" style="background: linear-gradient(135deg, #10b981 0%, #3b82f6 100%); color: white; border: none;">Save Changes</button>
                            <a href="{{ route('admin.articles.index') }}" class="btn btn-light rounded-pill py-3 fw-bold">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
