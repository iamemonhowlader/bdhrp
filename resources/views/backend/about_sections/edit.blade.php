@extends('backend.app')

@section('title', 'Edit About Section: ' . $aboutSection->title)

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --about-primary: #006039; 
        --about-gradient: linear-gradient(135deg, #006039 0%, #059669 100%);
    }
    .about-container { font-family: 'Plus Jakarta Sans', sans-serif; color: #1e293b; }
    .premium-page-header { background: var(--about-gradient); border-radius: 2rem; padding: 3.5rem; color: white; margin-bottom: 2.5rem; }
    .glass-editor-card { background: rgba(255, 255, 254, 0.9); backdrop-filter: blur(10px); border-radius: 2rem; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.05); margin-bottom: 2rem; }
    .form-label-premium { font-weight: 700; font-size: 0.8rem; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; }
    .premium-input { border-radius: 12px; border: 1.5px solid #e2e8f0; padding: 0.75rem 1.25rem; background: #f8fafc; transition: all 0.3s ease; }
    .premium-input:focus { border-color: var(--about-primary); box-shadow: 0 0 0 4px rgba(0, 96, 57, 0.1); background: white; outline: none; }
    .btn-save { background: var(--about-gradient); color: white; border: none; padding: 1rem 2.5rem; border-radius: 999px; font-weight: 800; box-shadow: 0 10px 15px rgba(0, 96, 57, 0.3); }
    .btn-save:hover { transform: translateY(-2px); color: white; }
    .current-image-preview { border-radius: 1rem; border: 2px solid #e2e8f0; overflow: hidden; margin-bottom: 1.5rem; }
</style>
@endpush

@section('content')
<div id="app-content">
    <div class="app-content-area about-container">
        <div class="container-fluid px-4 pt-4 pb-5">
            
            <div class="premium-page-header">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <span class="badge bg-white text-success mb-3 p-2 rounded-pill fw-bold shadow-sm">EDIT SECTION</span>
                        <h1 class="display-5 fw-800 mb-2 mt-2">{{ $aboutSection->title }}</h1>
                        <p class="fs-5 opacity-90 mb-0">Update this story, mission, or vision block.</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.about-sections.update', $aboutSection->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-8">
                        <div class="glass-editor-card">
                            <h4 class="fw-800 mb-4 border-bottom pb-2">Content Information</h4>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label class="form-label-premium">SECTION LABEL</label>
                                    <input type="text" name="label" class="form-control premium-input shadow-sm" value="{{ old('label', $aboutSection->label) }}" placeholder="e.g. OUR STORY">
                                </div>
                                <div class="col-md-8 mb-4">
                                    <label class="form-label-premium">SECTION TITLE</label>
                                    <input type="text" name="title" class="form-control premium-input shadow-sm @error('title') is-invalid @enderror" value="{{ old('title', $aboutSection->title) }}" placeholder="e.g. A Movement Born to Protect">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label-premium">SLUG</label>
                                    <input type="text" name="slug" class="form-control premium-input shadow-sm" value="{{ old('slug', $aboutSection->slug) }}" placeholder="e.g. about-us">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label-premium">MENU LABEL</label>
                                    <input type="text" name="menu_label" class="form-control premium-input shadow-sm" value="{{ old('menu_label', $aboutSection->menu_label) }}" placeholder="e.g. About Us">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label-premium">HIGHLIGHTED TEXT</label>
                                    <input type="text" name="highlight" class="form-control premium-input shadow-sm" value="{{ old('highlight', $aboutSection->highlight) }}" placeholder="e.g. Human Dignity">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label-premium">TITLE ENDING</label>
                                    <input type="text" name="title_end" class="form-control premium-input shadow-sm" value="{{ old('title_end', $aboutSection->title_end) }}" placeholder="e.g. in Bangladesh">
                                </div>
                            </div>

                            <div class="mb-0">
                                <label class="form-label-premium">DESCRIPTION BODY</label>
                                <textarea name="description" class="form-control premium-input shadow-sm @error('description') is-invalid @enderror" rows="8" placeholder="Detailed description of this section...">{{ old('description', $aboutSection->description) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="glass-editor-card">
                            <h4 class="fw-800 mb-4 border-bottom pb-2">Visual & Layout</h4>
                            @if($aboutSection->image)
                                <div class="current-image-preview">
                                    <img src="{{ asset('storage/' . $aboutSection->image) }}" class="w-100 h-auto">
                                </div>
                            @endif
                            <div class="mb-4">
                                <label class="form-label-premium">REPLACE IMAGE</label>
                                <input type="file" name="image_file" class="form-control premium-input shadow-sm">
                            </div>

                            <div class="mb-0">
                                <label class="form-label-premium">IMAGE POSITION</label>
                                <select name="image_position" class="form-select premium-input shadow-sm">
                                    <option value="left" {{ old('image_position', $aboutSection->image_position) == 'left' ? 'selected' : '' }}>Image on Left</option>
                                    <option value="right" {{ old('image_position', $aboutSection->image_position) == 'right' ? 'selected' : '' }}>Image on Right</option>
                                </select>
                            </div>
                        </div>

                        <div class="glass-editor-card">
                            <h4 class="fw-800 mb-4 border-bottom pb-2">Additional Images</h4>
                            @if(is_array($aboutSection->additional_images) && count($aboutSection->additional_images) > 0)
                                <div class="row g-2 mb-3">
                                    @foreach($aboutSection->additional_images as $img)
                                        <div class="col-4">
                                            <div class="rounded overflow-hidden border">
                                                <img src="{{ asset('storage/' . $img) }}" class="w-100 h-auto">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="mb-0">
                                <label class="form-label-premium">REPLACE ADDITIONAL IMAGES</label>
                                <input type="file" name="additional_images[]" class="form-control premium-input shadow-sm" accept="image/*" multiple>
                                <div class="form-text">Uploading new ones will replace all current additional images.</div>
                            </div>
                        </div>

                        <div class="glass-editor-card">
                            <h4 class="fw-800 mb-4 border-bottom pb-2">Settings</h4>
                            <div class="mb-4">
                                <label class="form-label-premium">SORT ORDER</label>
                                <input type="number" name="sort_order" class="form-control premium-input shadow-sm" value="{{ old('sort_order', $aboutSection->sort_order) }}">
                            </div>
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox" name="is_active" id="activeSwitch" value="1" {{ $aboutSection->is_active ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold text-muted small" for="activeSwitch">Publicly Visible</label>
                            </div>
                            <div class="form-check form-switch mt-3 mb-0">
                                <input class="form-check-input" type="checkbox" name="show_in_menu" id="menuSwitch" value="1" {{ $aboutSection->show_in_menu ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold text-muted small" for="menuSwitch">Show In About Menu</label>
                            </div>
                        </div>

                        <div class="d-grid shadow-lg rounded-pill overflow-hidden">
                            <button type="submit" class="btn btn-save py-3">
                                <i class="bi bi-cloud-check-fill me-2"></i> UPDATE SECTION
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
