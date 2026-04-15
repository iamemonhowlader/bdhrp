@extends('backend.app')

@section('title', 'Topics Management')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --topic-primary: #006039; 
        --topic-gradient: linear-gradient(135deg, #006039 0%, #059669 100%);
    }
    .topic-container { font-family: 'Plus Jakarta Sans', sans-serif; }
    .premium-page-header {
        background: var(--topic-gradient);
        border-radius: 2rem;
        padding: 3.5rem;
        position: relative;
        overflow: hidden;
        color: white;
        margin-bottom: 2.5rem;
        box-shadow: 0 25px 50px -12px rgba(0, 96, 57, 0.2);
    }
    .premium-card { border-radius: 1.5rem; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); overflow: hidden; }
    .btn-create { background: white; color: var(--topic-primary); font-weight: 800; border-radius: 12px; padding: 0.75rem 1.5rem; transition: all 0.3s ease; }
    .btn-create:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(255,255,255,0.2); }
</style>
@endpush

@section('content')
<div id="app-content">
    <div class="app-content-area topic-container">
        <div class="container-fluid px-4 pt-4 pb-5">
            
            <div class="premium-page-header">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <span class="badge bg-white text-success mb-3 px-3 py-2 rounded-pill fw-bold small shadow-sm">CMS CONTENT</span>
                        <h1 class="display-5 fw-800 mb-2 mt-2">Topics & Categories</h1>
                        <p class="fs-5 opacity-90 mb-0">Manage detailed profiles and descriptions for all human rights topics.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('admin.topics.create') }}" class="btn btn-create shadow-sm">
                            <i class="bi bi-plus-circle-fill me-2"></i> Add New Topic
                        </a>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success border-0 rounded-4 shadow-sm p-4 mb-4" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill fs-4 me-3 text-success"></i>
                        <div><h6 class="mb-0 fw-800">{{ session('success') }}</h6></div>
                    </div>
                </div>
            @endif

            <div class="premium-card bg-white">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-dark">
                            <tr>
                                <th class="px-4 py-3">TOPIC</th>
                                <th class="py-3">SORT</th>
                                <th class="py-3 text-center">STATUS</th>
                                <th class="py-3 text-end px-4">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topics as $topic)
                                <tr>
                                    <td class="px-4">
                                        <div class="d-flex align-items-center">
                                            @if($topic->image)
                                                <img src="{{ asset('storage/' . $topic->image) }}" class="rounded-3 me-3" style="width: 48px; height: 48px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded-3 me-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                                    <i class="bi bi-tag-fill text-muted"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-800 text-dark">{{ $topic->title }}</div>
                                                <div class="text-muted small">/topic/{{ $topic->slug }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border rounded-pill px-3 fw-bold">{{ $topic->sort_order }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ $topic->is_active ? 'success' : 'danger' }}-soft text-{{ $topic->is_active ? 'success' : 'danger' }} rounded-pill px-3 fw-bold">
                                            {{ $topic->is_active ? 'PUBLIC' : 'HIDDEN' }}
                                        </span>
                                    </td>
                                    <td class="text-end px-4">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.topics.edit', $topic->id) }}" class="btn btn-icon btn-light rounded-circle shadow-sm" title="Edit Topic">
                                                <i class="bi bi-pencil-fill text-success"></i>
                                            </a>
                                            <form action="{{ route('admin.topics.destroy', $topic->id) }}" method="POST" onsubmit="return confirm('Remove this topic from the database?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-icon btn-light rounded-circle shadow-sm" title="Delete Topic">
                                                    <i class="bi bi-trash-fill text-danger"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="py-4">
                                            <i class="bi bi-journal-text display-1 text-light"></i>
                                            <h4 class="mt-4 text-muted fw-800">No topics found</h4>
                                            <p class="text-muted">Start by adding your first human rights topic (like Arms or Children's Rights).</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
