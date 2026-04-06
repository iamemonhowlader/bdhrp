@extends('backend.app')

@section('title', 'Add New Video Report')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --video-primary: #ef4444; 
        --video-gradient: linear-gradient(135deg, #ef4444 0%, #ca8a04 100%);
        --video-font: 'Plus Jakarta Sans', sans-serif;
    }
    .video-container { font-family: var(--video-font); color: #1e293b; }
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
    .glass-editor-card {
        background: rgba(255, 255, 254, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 2rem;
        padding: 2.5rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        margin-bottom: 2rem;
    }
    .form-label-premium { font-weight: 700; font-size: 0.8rem; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; }
    .premium-input { border-radius: 12px; border: 1.5px solid #e2e8f0; padding: 0.75rem 1.25rem; background: #f8fafc; transition: all 0.3s ease; }
    .premium-input:focus { border-color: #ef4444; box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1); outline: none; background: white; }
    .btn-save { background: var(--video-gradient); color: white; border: none; padding: 1rem 2.5rem; border-radius: 999px; font-weight: 800; box-shadow: 0 10px 15px rgba(239, 68, 68, 0.3); transition: all 0.3s ease; }
    .btn-save:hover { transform: translateY(-2px); box-shadow: 0 20px 25px rgba(239, 68, 68, 0.4); color: white; }
</style>
@endpush

@section('content')
<div id="app-content">
    <div class="app-content-area video-container">
        <div class="container-fluid px-4 pt-4 pb-5">
            
            <div class="premium-page-header">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <span class="badge bg-white text-danger mb-3 p-2 rounded-pill fw-bold shadow-sm">NEW MEDIA ENTRY</span>
                        <h1 class="display-5 fw-800 mb-2 mt-2">Add New Video</h1>
                        <p class="fs-5 opacity-90 mb-0">Prepare and publish a new video documentary for the public audience.</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.articles_videos.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="glass-editor-card">
                            <div class="mb-4">
                                <label class="form-label-premium">REPORT TITLE</label>
                                <input type="text" name="title" class="form-control premium-input shadow-sm @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="e.g. Breaking the Authoritarian Wave">
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label-premium">YOUTUBE URL</label>
                                <input type="text" name="url" class="form-control premium-input shadow-sm @error('url') is-invalid @enderror" value="{{ old('url') }}" placeholder="https://www.youtube.com/watch?v=...">
                                @error('url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label-premium">DURATION</label>
                                    <input type="text" name="duration" class="form-control premium-input shadow-sm" value="{{ old('duration', '04:29') }}" placeholder="MM:SS or HH:MM:SS">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label-premium">SORT ORDER</label>
                                    <input type="number" name="sort_order" class="form-control premium-input shadow-sm" value="{{ old('sort_order', 0) }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="glass-editor-card">
                            <h4 class="fw-800 mb-4 border-bottom pb-2">Status & Visibility</h4>
                            <div class="form-check form-switch mb-4">
                                <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" value="1" checked>
                                <label class="form-check-label fw-bold small text-muted" for="statusSwitch">Public Visibility</label>
                            </div>
                            <div class="alert bg-light border-0 small text-muted p-4 rounded-4 shadow-inner">
                                <i class="bi bi-info-circle-fill text-primary me-2"></i>
                                Ensure that the YouTube link is set to "Public" or "Unlisted". Private videos will not playback on the frontend.
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-save shadow-lg">
                                <i class="bi bi-plus-circle-fill me-2"></i>PUBLISH VIDEO
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
