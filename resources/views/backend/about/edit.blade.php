@extends('backend.app')

@section('title', 'About Configuration — ' . config('app.name'))

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --about-primary: #6366f1;
        --about-gradient: linear-gradient(135deg, #10b981 0%, #3b82f6 100%);
        --about-surface: #ffffff;
        --about-glass: rgba(255, 255, 254, 0.75);
        --about-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
        --about-font: 'Plus Jakarta Sans', sans-serif;
    }

    .about-editor-container {
        font-family: var(--about-font);
        color: #1e293b;
    }

    .premium-page-header {
        background: var(--about-gradient);
        border-radius: 2rem;
        padding: 3.5rem;
        position: relative;
        overflow: hidden;
        color: white;
        margin-bottom: 3rem;
        box-shadow: 0 25px 50px -12px rgba(16, 185, 129, 0.2);
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

    .glass-editor-card {
        background: var(--about-glass);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 2rem;
        padding: 2.5rem;
        box-shadow: var(--about-shadow);
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
        border-color: var(--about-primary);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        outline: none;
    }

    .section-indicator {
        width: 4px;
        height: 24px;
        background: var(--about-gradient);
        border-radius: 2px;
        margin-right: 0.75rem;
    }

    .btn-emerald {
        background: var(--about-gradient);
        color: white;
        border: none;
        padding: 0.75rem 2.5rem;
        border-radius: 12px;
        font-weight: 700;
        transition: all 0.3s ease;
    }

    .btn-emerald:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px -10px rgba(16, 185, 129, 0.5);
        color: white;
    }

    .badge-premium {
        padding: 0.5rem 1rem;
        border-radius: 30px;
        font-weight: 700;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
</style>
@endpush

@section('content')
<div id="app-content">
    <div class="app-content-area">
        <div class="container-fluid px-4 pt-3 pb-5 about-editor-container">
            
            <div class="premium-page-header">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <span class="badge bg-white text-success mb-3 badge-premium shadow-sm">HOMEPAGE CONTENT</span>
                        <h1 class="display-5 fw-800 mb-2">About Section</h1>
                        <p class="fs-5 opacity-90 mb-0">Manage the core mission statement and performance statistics of BDHRP.</p>
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
                            <h6 class="mb-0 fw-800">Success!</h6>
                            <p class="mb-0 small opacity-75">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('admin.about.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="glass-editor-card">
                    <div class="d-flex align-items-center mb-4">
                        <div class="section-indicator"></div>
                        <h4 class="fw-800 mb-0">Identity & Mission</h4>
                    </div>
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-12">
                            <label class="form-label-premium text-uppercase">Section Title</label>
                            <input type="text" name="home_about_title" class="form-control premium-input" value="{{ old('home_about_title', \App\Models\SiteSetting::query()->where('key', 'home_about_title')->value('value') ?? 'ABOUT BDHRP') }}" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label-premium text-uppercase">Mission Statement (Body)</label>
                            <textarea name="home_about_body" class="form-control premium-input" rows="5" required>{{ old('home_about_body', \App\Models\SiteSetting::query()->where('key', 'home_about_body')->value('value') ?? 'Founded in 2007...') }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-premium text-uppercase">CTA Button Label</label>
                            <input type="text" name="home_about_more_label" class="form-control premium-input" value="{{ old('home_about_more_label', \App\Models\SiteSetting::query()->where('key', 'home_about_more_label')->value('value') ?? 'more about us') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-premium text-uppercase">CTA Button Link</label>
                            <input type="text" name="home_about_more_href" class="form-control premium-input" value="{{ old('home_about_more_href', \App\Models\SiteSetting::query()->where('key', 'home_about_more_href')->value('value') ?? '/about-us') }}">
                        </div>
                    </div>
                </div>

                <div class="glass-editor-card">
                    <div class="d-flex align-items-center mb-4">
                        <div class="section-indicator"></div>
                        <h4 class="fw-800 mb-0">Impact Statistics</h4>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle border-0">
                            <thead class="bg-light-subtle">
                                <tr>
                                    <th class="border-0 px-4 py-3 small fw-bold text-muted">ORDER</th>
                                    <th class="border-0 py-3 small fw-bold text-muted">STAT LABEL</th>
                                    <th class="border-0 py-3 small fw-bold text-muted">VALUE / COUNT</th>
                                    <th class="border-0 py-3 small fw-bold text-muted">ICON CLASS (Optional)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stats as $i => $stat)
                                    <tr>
                                        <td class="px-4">
                                            <div class="rounded-pill bg-light d-inline-flex align-items-center justify-content-center fw-800 text-muted" style="width: 32px; height: 32px; font-size: 0.75rem;">
                                                0{{ $i + 1 }}
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="home_about_stats[{{ $i }}][label]" class="form-control premium-input border-0 bg-light-subtle shadow-none" value="{{ old('home_about_stats.' . $i . '.label', $stat['label'] ?? '') }}" required>
                                        </td>
                                        <td>
                                            <input type="text" name="home_about_stats[{{ $i }}][value]" class="form-control premium-input border-0 bg-light-subtle shadow-none" value="{{ old('home_about_stats.' . $i . '.value', $stat['value'] ?? '') }}" required>
                                        </td>
                                        <td>
                                            <input type="text" name="home_about_stats[{{ $i }}][icon]" class="form-control premium-input border-0 bg-light-subtle shadow-none" value="{{ old('home_about_stats.' . $i . '.icon', $stat['icon'] ?? '') }}" placeholder="bi bi-star">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="premium-footer-actions d-flex justify-content-end gap-3 mb-5">
                    <a href="{{ route('dashboard') }}" class="btn btn-light rounded-pill px-4 fw-bold">Cancel</a>
                    <button type="submit" class="btn btn-emerald shadow-lg px-5">
                        <i class="bi bi-save2-fill me-2"></i> Update About Section
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
