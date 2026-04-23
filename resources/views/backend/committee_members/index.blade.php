@extends('backend.app')

@section('title', 'Manage Committee Members')

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
        padding: 3rem;
        color: white;
        margin-bottom: 2.5rem;
        box-shadow: 0 25px 50px -12px rgba(0, 96, 57, 0.2);
    }
    .premium-card { border-radius: 1.5rem; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); overflow: hidden; }
    .member-img { width: 100%; height: 250px; object-fit: cover; border-bottom: 4px solid var(--comm-primary); }
</style>
@endpush

@section('content')
<div id="app-content">
    <div class="app-content-area comm-container">
        <div class="container-fluid px-4 pt-4 pb-5">

            <div class="premium-page-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3">
                        <li class="breadcrumb-item"><a href="{{ route('admin.committees.index') }}" class="text-white opacity-75">Committees</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">{{ $committee->name }} Members</li>
                    </ol>
                </nav>
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="display-6 fw-800 mb-0">Team: {{ $committee->name }}</h1>
                        <p class="opacity-90 mb-0">Manage leadership and activists for this committee.</p>
                    </div>
                    <div class="col-md-4 text-md-end mt-4 mt-md-0">
                        <a href="{{ route('admin.committees.members.create', $committee) }}" class="btn btn-light fw-bold rounded-pill px-4">
                            <i class="bi bi-plus-circle me-2"></i> Add Member
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
                        <div class="premium-card bg-white h-100">
                            @if($member->image)
                                <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}" class="member-img">
                            @else
                                <div class="member-img d-flex align-items-center justify-content-center bg-light">
                                    <i class="bi bi-person-fill display-1 text-muted opacity-25"></i>
                                </div>
                            @endif
                            <div class="card-body p-4">
                                <span class="badge bg-light text-success fw-bold mb-2">{{ $member->category ?? 'Member' }}</span>
                                <h5 class="fw-800 mb-1">{{ $member->name }}</h5>
                                <p class="text-primary fw-600 small mb-4">{{ $member->designation }}</p>
                                
                                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                    <span class="small text-muted">Order: {{ $member->sort_order }}</span>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.committees.members.edit', [$committee, $member]) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-1">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.committees.members.destroy', [$committee, $member]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Remove this member?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="premium-card bg-white p-5 text-center">
                            <i class="bi bi-people display-1 text-muted mb-3 opacity-25"></i>
                            <h4 class="fw-bold">No members yet</h4>
                            <p class="text-muted">Start by adding leadership for the {{ $committee->name }} committee.</p>
                            <a href="{{ route('admin.committees.members.create', $committee) }}" class="btn btn-success rounded-pill px-4 mt-2">Add Member</a>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</div>
@endsection
