@extends('backend.app')

@section('title', 'Video Reports Library')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --video-primary: #ef4444; 
        --video-gradient: linear-gradient(135deg, #ef4444 0%, #ca8a04 100%);
    }
    .video-container { font-family: 'Plus Jakarta Sans', sans-serif; }
    .premium-page-header {
        background: var(--video-gradient);
        border-radius: 2rem;
        padding: 3.5rem;
        position: relative;
        overflow: hidden;
        color: white;
        margin-bottom: 2.5rem;
        box-shadow: 0 25px 50px -12px rgba(239, 68, 68, 0.2);
    }
    .premium-card {
        border-radius: 1.5rem;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .btn-create {
        background: white;
        color: var(--video-primary);
        font-weight: 800;
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        transition: all 0.3s ease;
    }
    .btn-create:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(255,255,255,0.2);
        color: #ef4444;
    }
</style>
@endpush

@section('content')
<div id="app-content">
    <div class="app-content-area video-container">
        <div class="container-fluid px-4 pt-4 pb-5">
            
            <div class="premium-page-header">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <span class="badge bg-white text-danger mb-3 px-3 py-2 rounded-pill fw-bold small">MEDIA ASSETS</span>
                        <h1 class="display-5 fw-800 mb-2 mt-2">Video Reports</h1>
                        <p class="fs-5 opacity-90 mb-0">List and manage all dynamic video documentaries for the global homepage.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('admin.articles_videos.create') }}" class="btn btn-create shadow-sm">
                            <i class="bi bi-plus-circle-fill me-2"></i> Add New Video
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
                                <th class="px-4 py-3">SORT</th>
                                <th class="py-3">REPORT TITLE</th>
                                <th class="py-3">YOUTUBE LINK</th>
                                <th class="py-3 text-center">DURATION</th>
                                <th class="py-3 text-center">STATUS</th>
                                <th class="py-3 text-end px-4">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($videos as $video)
                                <tr>
                                    <td class="px-4">
                                        <div class="badge bg-secondary rounded-pill">{{ $video->sort_order }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-800 text-dark">{{ $video->title }}</div>
                                        <div class="text-muted small">Updated {{ $video->updated_at->diffForHumans() }}</div>
                                    </td>
                                    <td>
                                        <a href="{{ $video->url }}" target="_blank" class="text-primary text-decoration-none small">
                                            <i class="bi bi-link-45deg"></i> {{ Str::limit($video->url, 40) }}
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark fw-bold border">{{ $video->duration }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ $video->status ? 'success' : 'danger' }}-soft text-{{ $video->status ? 'success' : 'danger' }} rounded-pill px-3">
                                            {{ $video->status ? 'Active' : 'Hidden' }}
                                        </span>
                                    </td>
                                    <td class="text-end px-4">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.articles_videos.edit', $video->id) }}" class="btn btn-icon btn-light rounded-circle shadow-sm" title="Edit Video">
                                                <i class="bi bi-pencil-fill text-primary"></i>
                                            </a>
                                            <form action="{{ route('admin.articles_videos.destroy', $video->id) }}" method="POST" onsubmit="return confirm('Archive this video report?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-icon btn-light rounded-circle shadow-sm" title="Delete Video">
                                                    <i class="bi bi-trash-fill text-danger"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="py-4">
                                            <i class="bi bi-camera-reels display-1 text-light"></i>
                                            <h4 class="mt-4 text-muted fw-800">No videos found</h4>
                                            <p class="text-muted">Start by adding your first journalistic video report.</p>
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
