@extends('backend.app')

@section('title', 'Meet Our Leadership & Co-ordinators')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --team-primary: #006039;
        --team-gradient: linear-gradient(135deg, #006039 0%, #059669 100%);
    }
    .team-container { font-family: 'Plus Jakarta Sans', sans-serif; }
    .premium-page-header {
        background: var(--team-gradient);
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
    .btn-create { background: white; color: var(--team-primary); font-weight: 800; border-radius: 12px; padding: 0.75rem 1.5rem; transition: all 0.3s ease; }
    .btn-create:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(255,255,255,0.2); }
    .member-image { width: 100%; height: 250px; object-fit: cover; border-bottom: 4px solid var(--team-primary); }
    .category-badge { font-size: 0.7rem; font-weight: 800; padding: 0.4rem 1rem; border-radius: 2rem; text-transform: uppercase; letter-spacing: 1px; }
    .badge-leadership { background: #006039; color: white; }
    .badge-coordinator { background: #f05a28; color: white; }
</style>
@endpush

@section('content')
<div id="app-content">
    <div class="app-content-area team-container">
        <div class="container-fluid px-4 pt-4 pb-5">

            <div class="premium-page-header">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <span class="badge bg-white text-success mb-3 px-3 py-2 rounded-pill fw-bold small shadow-sm">TEAM MANAGEMENT</span>
                        <h1 class="display-5 fw-800 mb-2 mt-2">Our Leadership & Co-ordinators</h1>
                        <p class="fs-5 opacity-90 mb-0">Manage the dedicated individuals who lead and coordinate BDHRP initiatives.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('admin.team-members.create') }}" class="btn btn-create shadow-sm">
                            <i class="bi bi-plus-circle-fill me-2"></i> Add Team Member
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
                @forelse($members as $member)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="premium-card h-100 bg-white">
                            @if($member->image)
                                <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}" class="member-image">
                            @else
                                <div class="member-image d-flex align-items-center justify-content-center bg-light">
                                    <i class="bi bi-person-fill display-1 text-muted opacity-25"></i>
                                </div>
                            @endif
                            <div class="card-body p-4">
                                <div class="mb-3">
                                    <span class="category-badge badge-{{ $member->category }}">
                                        {{ $member->category }}
                                    </span>
                                </div>
                                <h5 class="fw-800 mb-1">{{ $member->name }}</h5>
                                <p class="text-primary fw-600 small mb-3">{{ $member->designation }}</p>
                                
                                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                                    <span class="badge bg-light text-dark fw-bold">Order: {{ $member->order }}</span>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.team-members.edit', $member) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-2">
                                            <i class="bi bi-pencil-square me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.team-members.destroy', $member) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Are you sure you want to delete this member?')">
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
                                <i class="bi bi-people display-1 text-muted mb-3"></i>
                                <h4 class="fw-bold">No Team Members Found</h4>
                                <p class="text-muted mb-4">Start by adding leadership or coordinators to your team.</p>
                                <a href="{{ route('admin.team-members.create') }}" class="btn btn-primary px-4 py-2 rounded-pill">
                                    Add Your First Member
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
