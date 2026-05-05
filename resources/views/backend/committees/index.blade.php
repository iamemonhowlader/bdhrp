@extends('backend.app')

@section('title', 'Manage Committees')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --comm-primary: #006039;
        --comm-gradient: linear-gradient(135deg, #006039 0%, #059669 100%);
    }
    .comm-container { font-family: 'Plus Jakarta Sans', sans-serif; }
    .premium-page-header {
        background: var(--comm-gradient);
        border-radius: 2rem;
        padding: 3.5rem;
        position: relative;
        overflow: hidden;
        color: white;
        margin-bottom: 2.5rem;
        box-shadow: 0 25px 50px -12px rgba(0, 96, 57, 0.2);
    }
    .premium-card { border-radius: 1.5rem; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); overflow: hidden; transition: all 0.3s ease; }
    .premium-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
    .btn-create { background: white; color: var(--comm-primary); font-weight: 800; border-radius: 12px; padding: 0.75rem 1.5rem; transition: all 0.3s ease; }
    .btn-create:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(255,255,255,0.2); }
    .comm-image { width: 100%; height: 200px; object-fit: cover; }
</style>
@endpush

@section('content')
<div id="app-content">
    <div class="app-content-area comm-container">
        <div class="container-fluid px-4 pt-4 pb-5">

            <div class="premium-page-header">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <span class="badge bg-white text-success mb-3 px-3 py-2 rounded-pill fw-bold small shadow-sm">REGIONAL HUB</span>
                        <h1 class="display-5 fw-800 mb-2 mt-2">Parishad Committees</h1>
                        <p class="fs-5 opacity-90 mb-0">Manage the global network of volunteers and regional committees.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('admin.committees.create') }}" class="btn btn-create shadow-sm">
                            <i class="bi bi-plus-circle-fill me-2"></i> Create Committee
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

            <div class="row g-4">
                @forelse($committees as $committee)
                    <div class="col-xl-4 col-lg-6">
                        <div class="premium-card h-100 bg-white">
                            @if($committee->landscape_image)
                                <img src="{{ asset('storage/' . $committee->landscape_image) }}" alt="{{ $committee->name }}" class="comm-image">
                            @else
                                <div class="comm-image d-flex align-items-center justify-content-center bg-light">
                                    <i class="bi bi-geo-alt-fill display-1 text-muted opacity-25"></i>
                                </div>
                            @endif
                            <div class="card-body p-4">
                                <h4 class="fw-800 mb-1">{{ $committee->name }}</h4>
                                <p class="text-muted small mb-3">Slug: <span class="text-primary fw-bold">{{ $committee->slug }}</span></p>

                                <div class="d-flex flex-wrap gap-2 mb-4">
                                    @if($committee->contact_email)
                                        <span class="badge bg-light text-dark rounded-pill"><i class="bi bi-envelope me-1"></i> Email</span>
                                    @endif
                                    @if($committee->leadership_pdf)
                                        <span class="badge bg-light text-danger rounded-pill"><i class="bi bi-file-earmark-pdf me-1"></i> PDF</span>
                                    @endif
                                </div>

                                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                    <a href="{{ route('admin.committees.members.index', $committee) }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                        <i class="bi bi-people me-1"></i> Team members
                                    </a>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.committees.edit', $committee) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-2">
                                            <i class="bi bi-pencil-square me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.committees.destroy', $committee) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Are you sure you want to delete this committee?')">
                                                <i class="bi bi-trash me-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="premium-card">
                            <div class="card-body text-center py-5">
                                <i class="bi bi-layers display-1 text-muted mb-3"></i>
                                <h4 class="fw-bold">No Committees Found</h4>
                                <p class="text-muted mb-4">Start by creating your first regional committee (e.g. Barishal, Dhaka).</p>
                                <a href="{{ route('admin.committees.create') }}" class="btn btn-primary px-4 py-2 rounded-pill">
                                    Create Your First Committee
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</div>
@endsection
