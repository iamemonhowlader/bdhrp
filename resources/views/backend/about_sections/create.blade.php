@extends('backend.app')

@section('title', 'Add New About Section')

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
</style>
@endpush

@section('content')
<div id="app-content">
    <div class="app-content-area about-container">
        <div class="container-fluid px-4 pt-4 pb-5">

            <div class="premium-page-header">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <span class="badge bg-white text-success mb-3 p-2 rounded-pill fw-bold shadow-sm">NEW SECTION</span>
                        <h1 class="display-5 fw-800 mb-2 mt-2">Add New About Section</h1>
                        <p class="fs-5 opacity-90 mb-0">Create a dynamic story, mission, or vision block for the about us page.</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.about-sections.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="glass-editor-card">
                            <h4 class="fw-800 mb-4 border-bottom pb-2">Content Information</h4>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label class="form-label-premium">SECTION LABEL</label>
                                    <input type="text" name="label" class="form-control premium-input shadow-sm" value="{{ old('label') }}" placeholder="e.g. OUR STORY">
                                </div>
                                <div class="col-md-8 mb-4">
                                    <label class="form-label-premium">SECTION TITLE</label>
                                    <input type="text" name="title" class="form-control premium-input shadow-sm" value="{{ old('title') }}" placeholder="e.g., A Movement Born to Protect">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label-premium">SLUG</label>
                                    <input type="text" name="slug" class="form-control premium-input shadow-sm" value="{{ old('slug') }}" placeholder="e.g. about-us">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label-premium">MENU LABEL</label>
                                    <input type="text" name="menu_label" class="form-control premium-input shadow-sm" value="{{ old('menu_label') }}" placeholder="e.g. About Us">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label-premium">HIGHLIGHTED TEXT</label>
                                    <input type="text" name="highlight" class="form-control premium-input shadow-sm" value="{{ old('highlight') }}" placeholder="e.g., Human Dignity">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label-premium">TITLE ENDING</label>
                                    <input type="text" name="title_end" class="form-control premium-input shadow-sm" value="{{ old('title_end') }}" placeholder="e.g., in Bangladesh">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label-premium">DESCRIPTION BODY</label>
                                <textarea name="description" rows="6" class="form-control premium-input shadow-sm" placeholder="Detailed description of this section...">{{ old('description') }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label-premium">SECTION IMAGE</label>
                                    <input type="file" name="image_file" class="form-control premium-input shadow-sm" accept="image/*">
                                    <div class="form-text">Main featured image. Max 10MB.</div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label-premium">IMAGE POSITION</label>
                                    <select name="image_position" class="form-control premium-input shadow-sm">
                                        <option value="left">Image on Left</option>
                                        <option value="right">Image on Right</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label-premium">ADDITIONAL IMAGES (Optional - e.g. Partner Logos)</label>
                                <input type="file" name="additional_images[]" class="form-control premium-input shadow-sm" accept="image/*" multiple>
                                <div class="form-text">Upload multiple images. Useful for grids like Partner Logos.</div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label-premium">SORT ORDER</label>
                                    <input type="number" name="sort_order" class="form-control premium-input shadow-sm" value="{{ old('sort_order', 0) }}">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-label-premium">SETTINGS</div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked>
                                        <label class="form-check-label fw-bold" for="is_active">
                                            Publicly Visible
                                        </label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" name="show_in_menu" id="show_in_menu" checked>
                                        <label class="form-check-label fw-bold" for="show_in_menu">
                                            Show In About Menu
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-save btn-lg">
                        <i class="bi bi-check-circle me-2"></i> Create Section
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
