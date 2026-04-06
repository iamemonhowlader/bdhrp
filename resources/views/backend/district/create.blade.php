@extends('backend.app')

@section('title', 'Add New District Profile')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --geo-primary: #006039; 
        --geo-gradient: linear-gradient(135deg, #006039 0%, #059669 100%);
    }
    .geo-container { font-family: 'Plus Jakarta Sans', sans-serif; color: #1e293b; }
    .premium-page-header { background: var(--geo-gradient); border-radius: 2rem; padding: 3.5rem; color: white; margin-bottom: 2.5rem; }
    .glass-editor-card { background: rgba(255, 255, 254, 0.9); backdrop-filter: blur(10px); border-radius: 2rem; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.05); margin-bottom: 2rem; }
    .form-label-premium { font-weight: 700; font-size: 0.8rem; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; }
    .premium-input { border-radius: 12px; border: 1.5px solid #e2e8f0; padding: 0.75rem 1.25rem; background: #f8fafc; transition: all 0.3s ease; }
    .premium-input:focus { border-color: var(--geo-primary); box-shadow: 0 0 0 4px rgba(0, 96, 57, 0.1); background: white; outline: none; }
    .btn-save { background: var(--geo-gradient); color: white; border: none; padding: 1rem 2.5rem; border-radius: 999px; font-weight: 800; box-shadow: 0 10px 15px rgba(0, 96, 57, 0.3); }
    .btn-save:hover { transform: translateY(-2px); color: white; }
    .landmark-row { background: #f8fafc; border-radius: 1rem; border-left: 5px solid var(--geo-primary); }
</style>
@endpush

@section('content')
<div id="app-content">
    <div class="app-content-area geo-container">
        <div class="container-fluid px-4 pt-4 pb-5">
            
            <div class="premium-page-header">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <span class="badge bg-white text-success mb-3 p-2 rounded-pill fw-bold shadow-sm">NEW PROFILE</span>
                        <h1 class="display-5 fw-800 mb-2 mt-2">Add New District</h1>
                        <p class="fs-5 opacity-90 mb-0">Create a comprehensive information profile for a specific region.</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.districts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="glass-editor-card">
                            <h4 class="fw-800 mb-4 border-bottom pb-2">Identification</h4>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label-premium">DISTRICT NAME</label>
                                    <input type="text" name="name" class="form-control premium-input shadow-sm @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g. Barguna">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label-premium">PARENT DIVISION</label>
                                    <input type="text" name="division" class="form-control premium-input shadow-sm @error('division') is-invalid @enderror" value="{{ old('division') }}" placeholder="e.g. Barishal">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label-premium">HERO SUMMARY (SHORT)</label>
                                <textarea name="about_short" class="form-control premium-input shadow-sm" rows="2" placeholder="Brief welcome intro..."></textarea>
                            </div>

                            <div class="mb-0">
                                <label class="form-label-premium">ABOUT DESCRIPTION (LONG)</label>
                                <textarea name="about_body" id="editor" class="form-control premium-input shadow-sm" rows="6" placeholder="Detailed history and landmarks..."></textarea>
                            </div>
                        </div>

                        <div class="glass-editor-card">
                            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                                <h4 class="fw-800 mb-0">Key Landmarks Repeater</h4>
                                <button type="button" id="add-landmark" class="btn btn-sm btn-success rounded-pill px-3 fw-bold shadow-sm">
                                    <i class="bi bi-plus-circle me-1"></i> Add Item
                                </button>
                            </div>

                            <div id="landmarks-container">
                                <div class="landmark-row p-4 mb-3 position-relative">
                                    <div class="row">
                                        <div class="col-md-5 mb-3">
                                            <label class="form-label-premium small">LANDMARK TITLE</label>
                                            <input type="text" name="landmark_titles[]" class="form-control premium-input" placeholder="Historical Site #1">
                                        </div>
                                        <div class="col-md-7 mb-3">
                                            <label class="form-label-premium small">LANDMARK IMAGE (UPLOAD / URL)</label>
                                            <input type="file" name="landmark_files[]" class="form-control premium-input mb-2">
                                            <input type="text" name="landmark_urls[]" class="form-control premium-input small" placeholder="Or paste image URL...">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label-premium small">BRIEF DESCRIPTION</label>
                                            <textarea name="landmark_descs[]" class="form-control premium-input" rows="2" placeholder="Description of the landmark..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="glass-editor-card">
                            <h4 class="fw-800 mb-4 border-bottom pb-2">Quick Stats</h4>
                            <div class="mb-3">
                                <label class="form-label-premium">POPULATION</label>
                                <input type="text" name="population" class="form-control premium-input" value="{{ old('population') }}" placeholder="e.g. 892,781">
                            </div>
                            <div class="mb-3">
                                <label class="form-label-premium">AREA</label>
                                <input type="text" name="area" class="form-control premium-input" value="{{ old('area') }}" placeholder="e.g. 1831 sq km">
                            </div>
                            <div class="mb-0">
                                <label class="form-label-premium">ESTABLISHED</label>
                                <input type="text" name="established" class="form-control premium-input" value="{{ old('established') }}" placeholder="e.g. 1984">
                            </div>
                        </div>

                        <div class="glass-editor-card">
                            <h4 class="fw-800 mb-4 border-bottom pb-2">Status</h4>
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox" name="is_active" id="activeSwitch" value="1" checked>
                                <label class="form-check-label fw-bold text-muted small" for="activeSwitch">Publicly Visible</label>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-save shadow-lg py-3">
                                <i class="bi bi-cloud-check-fill me-2"></i> PUBLISH PROFILE
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('add-landmark').addEventListener('click', function() {
    const container = document.getElementById('landmarks-container');
    const newRow = document.createElement('div');
    newRow.className = 'landmark-row p-4 mb-3 position-relative scale-in';
    newRow.innerHTML = `
        <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-row" style="z-index:10"></button>
        <div class="row">
            <div class="col-md-5 mb-3">
                <label class="form-label-premium small">LANDMARK TITLE</label>
                <input type="text" name="landmark_titles[]" class="form-control premium-input" placeholder="Historical Site">
            </div>
            <div class="col-md-7 mb-3">
                <label class="form-label-premium small">LANDMARK IMAGE (UPLOAD / URL)</label>
                <input type="file" name="landmark_files[]" class="form-control premium-input mb-2">
                <input type="text" name="landmark_urls[]" class="form-control premium-input small" placeholder="Or paste image URL...">
            </div>
            <div class="col-12">
                <label class="form-label-premium small">BRIEF DESCRIPTION</label>
                <textarea name="landmark_descs[]" class="form-control premium-input" rows="2" placeholder="Description of the landmark..."></textarea>
            </div>
        </div>
    `;
    container.appendChild(newRow);
    
    newRow.querySelector('.remove-row').addEventListener('click', function() {
        newRow.remove();
    });
});
</script>
@endsection
