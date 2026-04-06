@extends('backend.app')

@section('title', 'Hero Management — ' . config('app.name'))

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --hero-primary: #6366f1;
        --hero-gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        --hero-surface: #ffffff;
        --hero-glass: rgba(255, 255, 254, 0.75);
        --hero-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
        --hero-font: 'Plus Jakarta Sans', sans-serif;
    }

    .hero-editor-container {
        font-family: var(--hero-font);
        color: #1e293b;
    }

    .premium-page-header {
        background: var(--hero-gradient);
        border-radius: 2rem;
        padding: 3.5rem;
        position: relative;
        overflow: hidden;
        color: white;
        margin-bottom: 3rem;
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

    .glass-editor-card {
        background: var(--hero-glass);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 2rem;
        padding: 2.5rem;
        box-shadow: var(--hero-shadow);
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
        border-color: var(--hero-primary);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        outline: none;
    }

    .section-indicator {
        width: 4px;
        height: 24px;
        background: var(--hero-gradient);
        border-radius: 2px;
        margin-right: 0.75rem;
    }

    .slide-preview-thumb {
        width: 120px;
        height: 70px;
        border-radius: 12px;
        object-fit: cover;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 2px solid white;
    }

    .btn-indigo {
        background: var(--hero-gradient);
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 12px;
        font-weight: 700;
        transition: all 0.3s ease;
    }

    .btn-indigo:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px -10px rgba(99, 102, 241, 0.5);
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
        <div class="container-fluid px-4 pt-3 pb-5 hero-editor-container">
            
            <div class="premium-page-header">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <span class="badge bg-white text-primary mb-3 badge-premium shadow-sm">HOMEPAGE CONTENT</span>
                        <h1 class="display-5 fw-800 mb-2">Hero Experience</h1>
                        <p class="fs-5 opacity-90 mb-0">Craft the first impression of your website with high-impact visuals and copy.</p>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success border-0 rounded-4 shadow-sm p-4 animate-reveal mb-4" role="alert">
                    <div class="d-flex align-items-center">
                        <div class="bg-success text-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-check-lg fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-800">Changes synchronized!</h6>
                            <p class="mb-0 small opacity-75">Homepage has been updated successfully.</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="glass-editor-card">
                    <div class="d-flex align-items-center mb-4">
                        <div class="section-indicator"></div>
                        <h4 class="fw-800 mb-0">Visual Storytelling</h4>
                    </div>
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="form-label-premium">MAIN HEADLINE</label>
                            <input type="text" name="hero_title" class="form-control premium-input" value="{{ old('hero_title', \App\Models\SiteSetting::query()->where('key', 'hero_title')->value('value') ?? 'Celebrate') }}" placeholder="The big idea...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-premium">SUB-HEADLINE</label>
                            <input type="text" name="hero_subtitle" class="form-control premium-input" value="{{ old('hero_subtitle', \App\Models\SiteSetting::query()->where('key', 'hero_subtitle')->value('value') ?? 'Our everyday essentials') }}" placeholder="Supporting detail...">
                        </div>
                        <div class="col-md-12">
                            <hr class="my-3 opacity-10">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-premium">KICKER TEXT</label>
                            <input type="text" name="hero_kicker" class="form-control premium-input" value="{{ old('hero_kicker', \App\Models\SiteSetting::query()->where('key', 'hero_kicker')->value('value') ?? 'Featured Content') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-premium">PRIMARY CALL TO ACTION</label>
                            <div class="input-group">
                                <input type="text" name="hero_primary_label" class="form-control premium-input mb-2 border-end-0" value="{{ old('hero_primary_label', \App\Models\SiteSetting::query()->where('key', 'hero_primary_label')->value('value') ?? 'Discover More') }}" placeholder="Label">
                                <input type="text" name="hero_primary_href" class="form-control premium-input mb-2 border-start-0" value="{{ old('hero_primary_href', \App\Models\SiteSetting::query()->where('key', 'hero_primary_href')->value('value') ?? '/') }}" placeholder="Link">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-premium">SECONDARY ACTION</label>
                            <div class="input-group">
                                <input type="text" name="hero_secondary_label" class="form-control premium-input mb-2 border-end-0" value="{{ old('hero_secondary_label', \App\Models\SiteSetting::query()->where('key', 'hero_secondary_label')->value('value') ?? 'Learn More') }}" placeholder="Label">
                                <input type="text" name="hero_secondary_href" class="form-control premium-input mb-2 border-start-0" value="{{ old('hero_secondary_href', \App\Models\SiteSetting::query()->where('key', 'hero_secondary_href')->value('value') ?? '/') }}" placeholder="Link">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="glass-editor-card">
                    <div class="d-flex align-items-center mb-4">
                        <div class="section-indicator"></div>
                        <h4 class="fw-800 mb-0">Immersive Backgrounds</h4>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle border-0">
                            <thead class="bg-light-subtle">
                                <tr>
                                    <th class="border-0 px-4 py-3 small fw-bold text-muted">ORDER</th>
                                    <th class="border-0 py-3 small fw-bold text-muted">MEDIA ASSET</th>
                                    <th class="border-0 py-3 small fw-bold text-muted">ACCESSIBILITY (ALT)</th>
                                    <th class="border-0 px-4 py-3 small fw-bold text-muted text-end">VISUAL PREVIEW</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($slides as $i => $slide)
                                    @php
                                        $existing = old('hero_slides.' . $i . '.existing_image', $slide['image'] ?? '');
                                        $img = $existing;
                                        if ($existing && !str_starts_with($existing, 'http')) {
                                            $img = asset('storage/' . ltrim($existing, '/'));
                                        }
                                    @endphp
                                    <tr>
                                        <td class="px-4">
                                            <div class="rounded-pill bg-light d-inline-flex align-items-center justify-content-center fw-800 text-muted" style="width: 32px; height: 32px; font-size: 0.75rem;">
                                                0{{ $i + 1 }}
                                            </div>
                                        </td>
                                        <td>
                                            <input type="file" name="hero_slides[{{ $i }}][image_file]" class="form-control premium-input border-0 bg-light-subtle shadow-none" accept="image/*">
                                            <input type="hidden" name="hero_slides[{{ $i }}][existing_image]" value="{{ $existing }}">
                                        </td>
                                        <td>
                                            <input type="text" name="hero_slides[{{ $i }}][alt]" class="form-control premium-input border-0 bg-light-subtle shadow-none" value="{{ old('hero_slides.' . $i . '.alt', $slide['alt'] ?? '') }}" placeholder="Describe this image...">
                                        </td>
                                        <td class="px-4 text-end">
                                            @if(!empty($existing))
                                                <img src="{{ $img }}" alt="Slide {{ $i + 1 }}" class="slide-preview-thumb">
                                            @else
                                                <div class="d-inline-flex align-items-center justify-content-center bg-light text-muted small rounded-4" style="width: 120px; height: 70px; border: 2px dashed #cbd5e1;">
                                                    Empty
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-5 p-4 bg-light rounded-4 border-start border-4 border-primary">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="fs-2 text-primary"><i class="bi bi-info-circle-fill"></i></div>
                            <div>
                                <h6 class="mb-0 fw-800">Did you know?</h6>
                                <p class="mb-0 small text-muted">High-quality images under 2MB provide the best balance between visual impact and page speed.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="premium-footer-actions d-flex justify-content-end gap-3 mb-5">
                    <a href="{{ route('dashboard') }}" class="btn btn-light rounded-pill px-4 fw-bold">Cancel</a>
                    <button type="submit" class="btn btn-indigo shadow-lg px-5">
                        <i class="bi bi-rocket-takeoff-fill me-2"></i> Deploy Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
