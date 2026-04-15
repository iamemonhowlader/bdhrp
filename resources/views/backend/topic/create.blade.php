@extends('backend.app')

@section('title', 'Add New Topic')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --topic-primary: #006039; 
        --topic-gradient: linear-gradient(135deg, #006039 0%, #059669 100%);
    }
    .topic-container { font-family: 'Plus Jakarta Sans', sans-serif; color: #1e293b; }
    .premium-page-header { background: var(--topic-gradient); border-radius: 2rem; padding: 3.5rem; color: white; margin-bottom: 2.5rem; }
    .glass-editor-card { background: rgba(255, 255, 254, 0.9); backdrop-filter: blur(10px); border-radius: 2rem; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.05); margin-bottom: 2rem; }
    .form-label-premium { font-weight: 700; font-size: 0.8rem; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; }
    .premium-input { border-radius: 12px; border: 1.5px solid #e2e8f0; padding: 0.75rem 1.25rem; background: #f8fafc; transition: all 0.3s ease; }
    .premium-input:focus { border-color: var(--topic-primary); box-shadow: 0 0 0 4px rgba(0, 96, 57, 0.1); background: white; outline: none; }
    .btn-save { background: var(--topic-gradient); color: white; border: none; padding: 1rem 2.5rem; border-radius: 999px; font-weight: 800; box-shadow: 0 10px 15px rgba(0, 96, 57, 0.3); }
    .btn-save:hover { transform: translateY(-2px); color: white; }
</style>
@endpush

@section('content')
<div id="app-content">
    <div class="app-content-area topic-container">
        <div class="container-fluid px-4 pt-4 pb-5">
            
            <div class="premium-page-header">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <span class="badge bg-white text-success mb-3 p-2 rounded-pill fw-bold shadow-sm">NEW TOPIC</span>
                        <h1 class="display-5 fw-800 mb-2 mt-2">Add New Topic</h1>
                        <p class="fs-5 opacity-90 mb-0">Create a new human rights topic profile with detailed information.</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.topics.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="glass-editor-card">
                            <h4 class="fw-800 mb-4 border-bottom pb-2">Topic Information</h4>
                            <div class="mb-4">
                                <label class="form-label-premium">TOPIC TITLE</label>
                                <input type="text" name="title" class="form-control premium-input shadow-sm @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="e.g. Children's Rights">
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-0">
                                <label class="form-label-premium">DESCRIPTION</label>
                                <textarea name="description" id="editor" class="form-control premium-input shadow-sm @error('description') is-invalid @enderror" rows="10" placeholder="Detailed description of the topic...">{{ old('description') }}</textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="glass-editor-card">
                            <h4 class="fw-800 mb-4 border-bottom pb-2">Featured Image</h4>
                            <div class="mb-0">
                                <label class="form-label-premium">UPLOAD IMAGE</label>
                                <input type="file" name="image_file" class="form-control premium-input shadow-sm @error('image_file') is-invalid @enderror">
                                <small class="text-muted mt-2 d-block">Recommended size: 1200x800px. Max 2MB.</small>
                                @error('image_file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="glass-editor-card">
                            <h4 class="fw-800 mb-4 border-bottom pb-2">Settings</h4>
                            <div class="mb-4">
                                <label class="form-label-premium">SORT ORDER</label>
                                <input type="number" name="sort_order" class="form-control premium-input shadow-sm @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', 0) }}">
                                @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox" name="is_active" id="activeSwitch" value="1" checked>
                                <label class="form-check-label fw-bold text-muted small" for="activeSwitch">Publicly Visible</label>
                            </div>
                        </div>

                        <div class="d-grid shadow-lg rounded-pill overflow-hidden">
                            <button type="submit" class="btn btn-save py-3">
                                <i class="bi bi-cloud-check-fill me-2"></i> PUBLISH TOPIC
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
