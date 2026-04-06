@extends('backend.app')

@section('title', 'New Article — ' . config('app.name'))

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --form-primary: #6366f1;
        --form-gradient: linear-gradient(135deg, #6366f1 0%, #3b82f6 100%);
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
        box-shadow: 0 25px 50px -12px rgba(99, 102, 241, 0.2);
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

    .premium-input:focus {
        background: white;
        border-color: var(--form-primary);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        outline: none;
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
                        <span class="badge bg-white text-primary mb-3 badge-premium shadow-sm">STORYTELLING</span>
                        <h1 class="display-5 fw-800 mb-2 mt-2">Craft New Story</h1>
                        <p class="fs-5 opacity-90 mb-0">Write stories that inspire action and advocate for human rights.</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                @if ($errors->any())
                    <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-left: 4px solid #ef4444; background: rgba(239, 68, 68, 0.05); border-radius: 12px;">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <i class="fas fa-exclamation-circle text-danger fs-4"></i>
                            </div>
                            <div>
                                <h6 class="alert-heading text-danger mb-1 fw-bold">Whoops! Something went wrong.</h6>
                                <ul class="mb-0 small text-danger-emphasis">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-lg-8">
                        <div class="glass-editor-card">
                            <div class="mb-4">
                                <label class="form-label-premium">ARTICLE TITLE</label>
                                <input type="text" name="title" class="form-control premium-input @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="The powerful headline...">
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label-premium">EXCERPT (SHORT SUMMARY)</label>
                                <textarea name="excerpt" class="form-control premium-input @error('excerpt') is-invalid @enderror" rows="3" placeholder="A brief hook for the readers...">{{ old('excerpt') }}</textarea>
                                @error('excerpt') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-0">
                                <label class="form-label-premium">CONTENT BODY</label>
                                <textarea name="body" class="form-control premium-input @error('body') is-invalid @enderror" rows="15" placeholder="Tell the full story here...">{{ old('body') }}</textarea>
                                @error('body') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="glass-editor-card">
                            <div class="mb-4">
                                <label class="form-label-premium">FEATURED IMAGE</label>
                                <input type="file" name="featured_image" class="form-control premium-input @error('featured_image') is-invalid @enderror">
                                @error('featured_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label-premium">STATUS</label>
                                <select name="status" class="form-select premium-input @error('status') is-invalid @enderror">
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Save as Draft</option>
                                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Publish Live</option>
                                </select>
                                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-0">
                                <div class="form-check form-switch p-0 py-2">
                                    <input class="form-check-input ms-0 me-2" type="checkbox" name="is_featured" value="1" id="isFeatured" {{ old('is_featured') ? 'checked' : '' }}>
                                    <label class="form-label-premium d-inline" for="isFeatured">MARK AS FEATURED</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary rounded-pill py-3 fw-bold shadow-lg">Save Article</button>
                            <a href="{{ route('admin.articles.index') }}" class="btn btn-light rounded-pill py-3 fw-bold">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
