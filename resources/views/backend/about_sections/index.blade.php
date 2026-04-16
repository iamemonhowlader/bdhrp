@extends('backend.app')

@section('title', 'About Page Sections Management')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --about-primary: #006039;
        --about-gradient: linear-gradient(135deg, #006039 0%, #059669 100%);
    }
    .about-container { font-family: 'Plus Jakarta Sans', sans-serif; }
    .premium-page-header {
        background: var(--about-gradient);
        border-radius: 2rem;
        padding: 3.5rem;
        position: relative;
        overflow: hidden;
        color: white;
        margin-bottom: 2.5rem;
        box-shadow: 0 25px 50px -12px rgba(0, 96, 57, 0.2);
    }
    .premium-card { border-radius: 1.5rem; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); overflow: hidden; }
    .btn-create { background: white; color: var(--about-primary); font-weight: 800; border-radius: 12px; padding: 0.75rem 1.5rem; transition: all 0.3s ease; }
    .btn-create:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(255,255,255,0.2); }
    .section-row { transition: all 0.3s ease; border-left: 4px solid transparent; }
    .section-row:hover { transform: translateY(-2px); border-left-color: var(--about-primary); box-shadow: 0 15px 35px rgba(0,0,0,0.1); }
    .status-badge { font-size: 0.75rem; font-weight: 600; padding: 0.25rem 0.75rem; border-radius: 1rem; }
    .status-active { background: #10b981; color: white; }
    .status-inactive { background: #ef4444; color: white; }
    .position-badge { font-size: 0.75rem; font-weight: 600; }
    .position-left { background: #3b82f6; color: white; }
    .position-right { background: #f59e0b; color: white; }
</style>
@endpush

@section('content')
<div id="app-content">
    <div class="app-content-area about-container">
        <div class="container-fluid px-4 pt-4 pb-5">

            <div class="premium-page-header">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <span class="badge bg-white text-success mb-3 px-3 py-2 rounded-pill fw-bold small shadow-sm">ABOUT PAGE CMS</span>
                        <h1 class="display-5 fw-800 mb-2 mt-2">About Sections</h1>
                        <p class="fs-5 opacity-90 mb-0">Manage story, mission, and vision sections for about us page.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('admin.about-sections.create') }}" class="btn btn-create shadow-sm">
                            <i class="bi bi-plus-circle-fill me-2"></i> Add New Section
                        </a>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success border-0 rounded-4 shadow-sm p-4 mb-4" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill me-3 text-success"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                </div>
            @endif

            <!-- Sections Grid -->
            @if($sections->count() > 0)
                <div class="row g-4">
                    @foreach($sections as $section)
                        <div class="col-lg-6 mb-4">
                            <div class="premium-card section-row h-100">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <h5 class="fw-bold mb-1">{{ $section->title }}</h5>
                                            @if($section->label)
                                                <span class="badge bg-light text-dark small">{{ $section->label }}</span>
                                            @endif
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="status-badge {{ $section->is_active ? 'status-active' : 'status-inactive' }}">
                                                {{ $section->is_active ? 'ACTIVE' : 'INACTIVE' }}
                                            </span>
                                        </div>
                                    </div>

                                    @if($section->highlight)
                                        <div class="mb-3">
                                            <span class="badge bg-primary text-white">{{ $section->highlight }}</span>
                                            @if($section->title_end)
                                                <span class="text-white ms-2">{{ $section->title_end }}</span>
                                            @endif
                                        </div>
                                    @endif

                                    <p class="text-muted small mb-3">{{ Str::limit(strip_tags($section->description), 100) }}</p>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex gap-2">
                                            <span class="position-badge {{ $section->image_position === 'left' ? 'position-left' : 'position-right' }}">
                                                <i class="bi bi-image-fill me-1"></i> {{ strtoupper($section->image_position) }}
                                            </span>
                                            <span class="badge bg-light text-dark small">
                                                <i class="bi bi-sort-numeric-down me-1"></i> {{ $section->sort_order }}
                                            </span>
                                        </div>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.about-sections.edit', $section) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.about-sections.destroy', $section) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this section?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="premium-card">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-inbox display-1 text-muted mb-3"></i>
                        <h4 class="fw-bold mb-2">No Sections Found</h4>
                        <p class="text-muted mb-4">Create your first about section to get started.</p>
                        <a href="{{ route('admin.about-sections.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Create First Section
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
